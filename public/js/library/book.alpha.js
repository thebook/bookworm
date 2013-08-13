var alpha = (function ( alpha, $ ) {

	alpha.book = {};

	alpha.format = function (format, append, number) { 
		
		var manifest = {};
			for (var i = 1; i < number+1; i++) manifest[i] = $.extend(true, {}, format);				
			return alpha.thought.prototype.manifestor(manifest, append);
	};

	alpha.parse = function (map, format, values) {
		$.each(map, function (index, road) {
			var path, action, get;
			path   = road.path.split('.');
			action = path.pop();
			get    = alpha.string_to_object(path, format);
			if ( action !== "text" && action !== "data" ) get.attr(action, values[road.value]);
			if ( action === "text" ) get.text(values[road.value]);
			// if ( action === "data" ) {
			// 	console.log(get);
			// 	get = values[road.value];
			// 	console.log(get);
			// }
		});
	};

	alpha.book.display_search_results = function (books, append_to) { 
		var format, manifest, map, wraps;
			format = {
				self : '<div class=""></div>',
				branch : {
					wrap : {
						self : '<div class="result_book_search"></div>',
						branch : {
							info : {
								self : '<span class="with-icon-info-for-book"></span>'
							},
							image : {
								self : '<img src="" class="result_book_thumbnail_image">'
							},
							description : {
								self : '<article class="result_book_search_text"></article>',
								branch : {
									title : {
										self : '<strong class="result_book_title"></strong>'
									},
									author : {
										self : '<div class="result_book_author"></div>'
									},
									price_wrap : {
										self : '<div class="result_book_price_wrap"></div>',
										branch : {
											text : {
												self : '<span class="result_book_price_text">Sell for - </span>'
											},
											price : {
												self : '<storng class="result_book_price"></storng>'
											}}}}},
							button : {
								self : '<div class="result_book_add_button_wrap"></div>',
								branch : {
									wrap : {
										self : '<div class="result_book_inner_wrap"></div>',
										branch : {											
											add_button : {
												instructions : {
													on : {
														the_event         : "click",
														is_asslep         : false,
														// with_instructions : { id : null },
														call              : function (change) {
															console.log(change);
															console.log(this);
															console.log(books);
														}
													}
												},
												self : '<div class="result_book_add_button"></div>',
												last_branch : {
													text :'<span class="result_book_add_button_text">Add To Sell Basket</span>'
												}},
											added_button :{
												self : '<div class="result_book_add_button_static"></div>',
												last_branch : {
													text : '<span class="with-icon-added-to-sell-basket-tick">Added To Basket</span>'
												}
											}
										}
									}
								}
							}
						}
					}
				}
			};
			wraps = {};
			wraps.on_wrap = 0;
			wraps.classes = [
				"result_book_search_wrapper_left", 
				"result_book_search_wrapper", 
				"result_book_search_wrapper_right"
			];
			map = [
				{
					path : "branch.wrap.branch.button.branch.wrap.branch.add_button.self.id",
					value: "id"
				},
				{
					path : "self.class",
					value: "wrap"
				},
				{
					path : "self.class",
					value: "wrap"
				},
				{ 
					path : "branch.wrap.branch.image.self.src",
					value: "image"
				},
				{
					path : "branch.wrap.branch.description.branch.title.self.text",
					value: "title"
				},
				{
					path : "branch.wrap.branch.description.branch.author.self.text",
					value: "author"
				},
				{
					path : "branch.wrap.branch.description.branch.price_wrap.branch.price.self.text",
					value: "price"
				}
			];

			append_to.empty();
			manifest = alpha.format(format, append_to, books.length );
			$.each(books, function (index, book) { 
				
				book.wrap   = wraps.classes[wraps.on_wrap];
				book.title  = book.title.slice(0, 10) +'...';
				book.author = book.author.slice(0, 18) +'...';
				book.price  = "£"+ book.price / 100;
				book.id     = index+1;

				alpha.parse(map, manifest[index+1], book);
				manifest[index+1].branch.wrap.branch.button.branch.wrap.branch.instructions = {
					book : book
				};

				( wraps.on_wrap === 2? wraps.on_wrap = 0 : wraps.on_wrap++ );
			});	
			return manifest;
	};

	alpha.book.show_searched_books = function (books, append) { 

		var books_html    = '', 
			keeping_count = 0, 
			wrap_names    = [
				'result_book_search_wrapper_left', 
				'result_book_search_wrapper', 
				'result_book_search_wrapper_right'
			],
			format = '<div id="book_{(id)}" class="{(wrapper)}">'+
				'<div class="result_book_search">'+				
					'<span data-function-instructions="{\'id\':\'{(id)}\'}" data-function-to-call="book.prototype.open_book_popup" class="with-icon-info-for-book"></span>'+
					'<img src="{(image)}" class="result_book_thumbnail_image">'+				
					'<article class="result_book_search_text">'+
						'<strong class="result_book_title">{(title)}</strong>'+
						'<div class="result_book_author">{(author)}</div>'+
						'<div class="result_book_price_wrap">'+
							'<span class="result_book_price_text">Sell for - </span>'+
							' <storng class="result_book_price">£{(price)}</storng>'+
						'</div>'+
					'</article>'+				
					'<div class="result_book_add_button_wrap">'+
						'<div class="result_book_inner_wrap">'+
							'<div class="result_book_add_button">'+
								'<span data-function-instructions="{\'id\':\'{(id)}\'}"data-function-to-call="book.prototype.add_to_basket" class="result_book_add_button_text">Add To Sell Basket</span>'+
							'</div>'+
							'<div class="result_book_add_button_static">'+
								'<span class="with-icon-added-to-sell-basket-tick">Added To Basket</span>'+
							'</div>'+
						'</div>'+						
					'</div>'+
				'</div>'+							
			'</div>';

			$.each(books, function (index, book) { 

				books_html += alpha.replace_placeholders_with_values_in_text(
					{ 	
						wrapper : wrap_names[keeping_count],
						image   : book.image,
						title   : book.title.slice(0, 10) +'...',
						author  : book.author.slice(0, 18) +'...',
						price   : book.price / 100,
						id 	    : index
					}, 
					format
				);
				( keeping_count === 2? keeping_count = 0 : keeping_count++ );
			});

			append.empty();
			append.append(books_html);
	};	

	alpha.book.add_book_to_basket = function (wake) { 

		var the_book, sell_again_buttons

		the_book = $('#book_'+ wake.instructions.id);

		the_book.children().addClass('result_book_search_added').removeClass('result_book_search');
			the_book.find('.result_book_add_button_wrap').children().css({ position : "relative" }).animate({ top : "-45px" }, 400 );
		
		// sell_again_buttons += alpha.replace_placeholders_with_values_in_text( { id : id },  alpha.front.prototype.being.sell_again_buttons );			
		// $(sell_again_buttons).css({ opacity : 0  }).appendTo(the_book);
		// the_book.find('.result_book_extra_options_buttons').animate({ opacity : 1 }, 500 );
	};

	return alpha;

})(alpha || {}, jQuery );