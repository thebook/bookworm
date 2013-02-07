var alpha = (function ( alpha, $ ) {

	alpha.check_books = function (current_click) { 

		var books = current_click.instructions;
			this.prototype.memory = this.prototype.sort_books_by_isbn(books);
			this.prototype.new_memory = {};
			this.prototype.parts = {};
			this.prototype.parts.current_ticket_box = current_click.element.closest('.ticket_box');
			this.prototype.parts.books		        = $('<div class="ticket_information_row"><div class="ticket_information_type">Unexpected Books</div><div class="ticket_information"></div></div>');
			this.prototype.parts.display_books      = $(this.prototype.get_books(books));
			this.prototype.parts.next 				= 
				$('<div class="ticket_information_row">'+
					'<div data-function-to-call="check_books.prototype.complete_books_compiling" class="check_state button">Next</div>'+
					'<div data-function-to-call="check_books.prototype.remove_ticket_verifyer" class="cancel_verify button">Cancel</div>'+
				'</div>');
			this.prototype.parts.input              = 
				$('<div class="ticket_information_row">'+ 
					'<div class="ticket_information_type">Verify Books</div>'+
					'<div class="ticket_information">'+
						'<input class="ticket_input" id="verify_books_search" type="text" value="">'+
						'<div data-function-to-call="check_books.prototype.cross_out_book" class="ticket_button">'+
							'Submit'+
						'</div>'+
					'</div>'+
				'</div>');
			this.prototype.parts.verify_ticket_box = $('<div class="ticket_box_add_on"></div>');

			this.prototype.parts.current_ticket_box.css({ 'z-index' : '2', 'position' : 'relative' });

			this.prototype.parts.verify_ticket_box.css({
				'z-index'  : '0',
				'position' : 'relative'
			})
			.append(this.prototype.parts.display_books)
			.append(this.prototype.parts.input)
			.append(this.prototype.parts.books)
			.append(this.prototype.parts.next)
			.insertAfter(this.prototype.parts.current_ticket_box);
	};

	alpha.check_books.prototype.get_books = function (books) { 

		var books_element = 
			'<div class="ticket_information_row">'+
				'<div class="ticket_information_type">Books Expected</div>'+
				'<div class="ticket_information">';

			$.each(books,
			function (index, book) { 

				books_element += 
					'<div class="books_for_ticket_verifying books_for_ticket">'+
						'<div class="ticket_book_start_label '+ book.isbn +'">'+
							book.isbn +
						'</div>'+
					'</div>';
			});
					
			return books_element += '</div></div>';
	};

	alpha.check_books.prototype.sort_books_by_isbn = function (books) { 

		var sorted_books = {};

			$.each(books,
			function (key, book) { 

				( sorted_books[book.isbn]? sorted_books[book.isbn].push(book) : sorted_books[book.isbn] = [book] );
			});

		return sorted_books
	};

	alpha.check_books.prototype.cross_out_book = function () {

		var klass = alpha.check_books.prototype,
			isbn  = klass.parts.input.find('input').attr('value'),
			ticked_book = klass.parts.display_books.find('.'+ isbn );
			
			if ( alpha._is_number(isbn) && isbn.length === 10 ) {
				
				if ( ticked_book.length > 0 ) {

					var insert;

					if ( klass.memory[isbn].length > 1 ) {

					 	insert = klass.memory[isbn].pop(); 
					} 
					else {

						insert = klass.memory[isbn][0]; 
						delete klass.memory[isbn];
					}

					( klass.new_memory[isbn]? klass.new_memory[isbn].push(insert) : klass.new_memory[isbn] = [insert] );

					$(ticked_book[0]).css({ 'text-decoration' : 'line-through' }).removeClass(isbn);
				}
				else { 

					klass.parts.books.find('.ticket_information').append(
						'<div class="books_for_ticket_verifying books_for_ticket">'+
							'<div class="ticket_book_start_label">'+
								isbn+
							'</div>'+
						'</div>');

					( klass.new_memory[isbn]? klass.new_memory[isbn].push(isbn) : klass.new_memory[isbn] = [isbn] );
				}
			}
	};	

	alpha.check_books.prototype.complete_books_compiling = function () { 

		var klass  = alpha.check_books.prototype,
			new_memory = [],
			reference_of_number_of_books = [],
			string = '';

			$.each(klass.new_memory,
			function (isbn, book) { 

				if ( book.constructor === Array ) { 

					var reference = { number : book.length };

 					if ( book[0].constructor === Object ) { 

						reference.quote = book[0].quote;
						string += book[0].isbn +', ';	
					}
					else if ( book[0].constructor === String) { 

						string += book[0] +', ';	
					}					

					reference_of_number_of_books.push(reference);
				}				
			});

			$.post(
				ajaxurl, 
				{ action : 'amazon', paramaters : { typed : string, search_by : 'isbn', search_for : 'books', filter_name : 'tiny' } },
				function (amazon_books) { 

					$.each(amazon_books,
					function (index, book) { 
						
						var reference = reference_of_number_of_books[index];
					
						book.quote = (reference.quote? reference.quote : alpha.search_though_amazon_for_a_book.prototype.quote(book.lowest_used_price.Amount) );

						for (var i = 0; i < reference.number; i++) {
							new_memory.push(book);
						};
					});
					
					klass.new_memory = alpha.amazon.prototype.return_books(new_memory);

					klass.check_condition();
				},
				'json'
			);

	};

	alpha.check_books.prototype.sort_for_new_submit = function () {
	};

	alpha.check_books.prototype.check_condition = function () { 

		this.parts.verify_ticket_box.children().fadeOut(400, function () { $(this).empty().remove(); });
		this.parts.condition_ticker = 
			$('<div class="ticket_information_row">'+ 
					'<div class="ticket_information_type">Verify Books</div>'+
						this.sort_books_for_ticking() +
				'</div>');

		this.parts.condition_ticker.appendTo(this.parts.verify_ticket_box);
		console.log(this.new_memory);
	};

	alpha.check_books.prototype.sort_books_for_ticking = function () { 

		var books_element = '<div class="ticket_information">';

			$.each(this.new_memory,
			function (index, book) { 

				books_element += 
					'<div class="books_for_ticket_verifying books_for_ticket">'+
						'<div class="ticket_book_start_label '+ book.isbn +'">'+
							book.isbn +
						'</div>'+
						'<input type="checkbox" value="bad_condition">'+
					'</div>';
			});
					
		return books_element += '</div>';

	};

	alpha.check_books.prototype.remove_ticket_verifyer = function () { 

		alpha.check_books.prototype.parts.verify_ticket_box.empty().remove();
	};

	return alpha;

})(alpha || {}, jQuery );			