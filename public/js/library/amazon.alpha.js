var alpha = (function ( alpha, $ ) {

	alpha.pure_amazon_search = function (wake, callback) {

		var self = this;
		wake.search_by     = wake.search_by     || 'keywords';
		wake.search_for    = wake.search_for    || 'books';
		wake.filter_name   = wake.filter_name   || 'tiny';
		wake.bus_algorithm = wake.bus_algorithm || false;

		$.post( 
			ajaxurl, 
			{ 
				action     : 'amazon', 
				paramaters : wake
			}, 
			function (books) {
				callback(books);
			},
			'json');

	};

	alpha.search_book = function (wake, callback) {

		var self = this;
		wake.search_by     = wake.search_by     || 'isbn';
		wake.search_for    = wake.search_for    || 'books';
		wake.filter_name   = wake.filter_name   || 'sort';
		wake.algorithm     = wake.algorithm     || "post";

		$.post( 
			ajaxurl, 
			{ 
				action     : 'amazon', 
				paramaters : wake
			}, 
			function (book) {

				console.log(book); 
				var response, original_response, algorithm, index, final_book;

				response   = false;
				index      = 0;
				algorithm  = new alpha.algorithm();

				if ( book !== undefined || book.length > 0 ) {

					original_response = book;

					for (; index < original_response.length; index++) 
						if ( original_response[index].external_product_id === wake.typed ) 
							response = original_response[index];

					if ( response ) response = algorithm[wake.algorithm]();

				}

				callback(response);
			},
			'json'
		);
	};

	alpha.audio = function (wake) {

	};

	alpha.algorithm = function () {

		this.weight = {
			bus : [
				{
					range_one : 0,
					range_two : 100,
					price     : 0
				},
				{
					range_one : 99,
					range_two : 250,
					price     : 0
				},
				{
					range_one : 249,
					range_two : 500,
					price     : 0
				},
				{
					range_one : 499,
					range_two : 750,
					price     : -0.80
				},
				{
					range_one : 749,
					range_two : 1000,
					price     : -1.5
				},
				{
					range_one : 999,
					range_two : 2000,
					price     : -3.5
				},
				{
					range_one : 1999,
					range_two : 100000,
					price     : -8
				}
			],
			post: [
				{
					range_one : 0,
					range_two : 100,
					price     : -5
				},
				{
					range_one : 99,
					range_two : 250,
					price     : 0.43
				},
				{
					range_one : 249,
					range_two : 500,
					price     : -0.12
				},
				{
					range_one : 499,
					range_two : 750,
					price     : -1
				},
				{
					range_one : 749,
					range_two : 1000,
					price     : -3.5
				},
				{
					range_one : 999,
					range_two : 1250,
					price     : -6
				},
				{
					range_one : 1249,
					range_two : 1500,
					price     : -7.64
				},
				{
					range_one : 1499,
					range_two : 1750,
					price     : -0.38
				},
				{
					range_one : 1749,
					range_two : 2000,
					price     : -9.01
				}
			]
		};
	};

	alpha.algorithm.prototype.recalculate = function (book) {

		var weight, price;

		weight                    = parseInt( book.package_weight );
		weight                    = (weight/100) * 453;
		price                     = ( book.condition_type === "11" && book.prices.newest ? parseFloat(book.prices.newest) : parseFloat( book.standard_price) );
		price                    -= 0.01;
		price                     = ( price > 0 ? price : 1 );
		book.standard_price       = price.toFixed(2);
		if ( price < 1 && weight > 75 ) book.refused = true;
		return book;
	};

	alpha.algorithm.prototype.bus = function (book) {

		var starting_price, price, weight;
		
		weight                    = parseInt( book.package_weight );
		weight                    = (weight/100) * 453;
		price                     = parseFloat( book.standard_price);
		price                    *= 0.7;
		price                    += this.get_price_for_weight("bus", weight);
		starting_price            = price;
		price                    *= 0.75;
		if ( price > 0 )    price = ( price - ( 5/starting_price ) ) + 0.25;
		if ( price < 0.20 ) price = 0;
		price                    *= 1.2;
		price                     = price.toFixed(2);
		book.standard_price       = price;
		
		return book;
	};

	alpha.algorithm.prototype.post = function (book) {

		var starting_price, price, weight;

		weight                    = parseInt( book.package_weight );
		weight                    = (weight/100) * 453;
		price                     = parseFloat( book.standard_price);
		price                    *= 0.7;
		price                    += this.get_price_for_weight("post", weight);
		starting_price            = price;
		price                    *= 0.75;
		if ( price > 0 )    price = ( price - ( 5/starting_price ) ) + 0.25;
		if ( price < 0.20 ) price = 0;
		price                     = price.toFixed(2);
		book.standard_price       = price;
		
		return book;
	};

	alpha.algorithm.prototype.get_price_for_weight = function (type, weight) {

		var weights, price, index;

		index   = 0;
		weights = this.weight[type];
		price   = 0;
		for (; index < weights.length; index++) {
			if ( weight > weights[index].range_one && weight < weights[index].range_two ) {
				price = weights[index].price;
			}
		};
		return price;
	};

	alpha.amazon = function (wake) {

		var self = this;
		wake.search_by     = wake.search_by     || 'keywords';
		wake.search_for    = wake.search_for    || 'books';
		wake.filter_name   = wake.filter_name   || 'tiny';
		wake.callback      = wake.callback      || false;
		wake.bus_algorithm = wake.bus_algorithm || false;

		$.post( 
			ajaxurl, 
			{ 
				action     : 'amazon', 
				paramaters : wake
			}, 
			function (books) { 
				books = self.clean_array(books);
				books = self.pick_which_details_to_get_out_of_the_book_properties(books, 
				{
					lowest_used_price : 'Amount',
					image             : 'URL',
					lowest_new_price  : 'Amount',
					price  			  : 'Amount',
					editorial_review  : 'EditorialReview'
				});
				books = self.remove_books_that_dont_have_given_properties(books, ['image', 'author', 'lowest_used_price']);
				books = ( wake.bus_algorithm? self.bus_algorithm(books) : self.algorithm(books) );
				wake.callback(books);
			},
			'json'
		);
	};

	alpha.amazon.prototype.bus_algorithm = function (books) { 
		var sorted = [];
		for (var index = 0; index < books.length; index++) {

			var price          = parseInt( books[index]["lowest_used_price"] ),
				starting_price = 0,
				new_price      = parseInt(books[index]["lowest_new_price"]),
				retail_price   = parseInt(books[index].price) / 100,
				weights        = [
					{
						range_one : 0,
						range_two : 100,
						price     : 0
					},
					{
						range_one : 99,
						range_two : 250,
						price     : 0
					},
					{
						range_one : 249,
						range_two : 500,
						price     : 0
					},
					{
						range_one : 499,
						range_two : 750,
						price     : -0.80
					},
					{
						range_one : 749,
						range_two : 1000,
						price     : -1.5
					},
					{
						range_one : 999,
						range_two : 2000,
						price     : -3.5
					},
					{
						range_one : 1999,
						range_two : 100000,
						price     : -8
					}
				],
				weight = 0;
				new_price     -= (new_price*0.1);
			
			if ( price > new_price ) price = new_price;
			if ( books[index].dimensions && books[index].dimensions.Weight && books[index].dimensions.Weight !== "0" ) weight = books[index].dimensions.Weight;
			price /= 100;
			price *= 0.7;
			if ( price > retail_price ) return;
			weight = (weight/100) * 453;
			for (var i = 0; i < weights.length; i++) {
				if ( weight > weights[i].range_one && weight < weights[i].range_two ) {
					price += weights[i].price;
				}
			};
			starting_price            = price;
			price                    *= 0.75;
			if ( price > 0 )    price = ( price - ( 5/starting_price ) ) + 0.25;
			if ( price < 0.20 ) price = 0;
			price                     = price.toFixed(2);
			books[index].price = price;
			
			if ( weight > 1999 ) console.log("weight is past capacity");
			if ( price !== "0.00") sorted.push(books[index]);			
		};
		return sorted;
	};

	alpha.amazon.prototype.algorithm = function (books) { 
		var sorted = [];
		for (var index = 0; index < books.length; index++) {

			var price          = parseInt( books[index]["lowest_used_price"] ),
				starting_price = 0,
				new_price      = parseInt(books[index]["lowest_new_price"]),
				retail_price   = parseInt(books[index].price) / 100,
				weights        = [
					{
						range_one : 0,
						range_two : 100,
						price     : -5
					},
					{
						range_one : 99,
						range_two : 250,
						price     : 0.43
					},
					{
						range_one : 249,
						range_two : 500,
						price     : -0.12
					},
					{
						range_one : 499,
						range_two : 750,
						price     : -1
					},
					{
						range_one : 749,
						range_two : 1000,
						price     : -3.5
					},
					{
						range_one : 999,
						range_two : 1250,
						price     : -6
					},
					{
						range_one : 1249,
						range_two : 1500,
						price     : -7.64
					},
					{
						range_one : 1499,
						range_two : 1750,
						price     : -0.38
					},
					{
						range_one : 1749,
						range_two : 2000,
						price     : -9.01
					}
				],
				weight = 0;
				new_price     -= (new_price*0.1);
			
			if ( price > new_price ) price = new_price;
			if ( books[index].dimensions && books[index].dimensions.Weight && books[index].dimensions.Weight !== "0" ) weight = books[index].dimensions.Weight;
			price /= 100;
			price *= 0.7;
			if ( price > retail_price ) return;
			weight = (weight/100) * 453;
			for (var i = 0; i < weights.length; i++) {
				if ( weight > weights[i].range_one && weight < weights[i].range_two ) {
					price += weights[i].price;
				}
			};
			starting_price            = price;
			price                    *= 0.75;
			if ( price > 0 )    price = ( price - ( 5/starting_price ) ) + 0.25;
			if ( price < 0.20 ) price = 0;
			price                     = price.toFixed(2);
			books[index].price = price;
			
			if ( weight > 1999 ) console.log("weight is past capacity");
			if ( price !== "0.00") sorted.push(books[index]);			
		};
		return sorted;
	};


	alpha.amazon.prototype.clean_array = function (books) { 

		books = $.map(books, 
		function (book, key) {

			var filter_book = {};
			$.each(book, function (key, property) {

				if (property)
					if ( property[0] !== undefined && property[1] === undefined ) {
						filter_book[key] = property[0];
					}
					else if ( !$.isEmptyObject(property) ) {
						filter_book[key] = property;
					}
			});

			return filter_book;
		});

		return books;
	};

	alpha.amazon.prototype.pick_which_details_to_get_out_of_the_book_properties = function (books, details_to_get) { 

		books = $.map(books, 
		function (book, key) { 

			var filter_book = {};
			$.each(book, function (key, property) {
				
				filter_book[key] = (details_to_get[key]? property[details_to_get[key]] : property );
			});

			return filter_book;
		});

		return books;
	};

	alpha.amazon.prototype.remove_books_that_dont_have_given_properties = function (books, details_to_have) { 

		books = $.map(books,
		function (book, index) { 

			var cross_out_details = new Array;
				cross_out_details.push.apply(cross_out_details, details_to_have);
				
			$.each(book, function (key, property) {

				var does_it_contain_the_detail = $.inArray(key, cross_out_details);
					if ( does_it_contain_the_detail !== -1 )
						cross_out_details.splice(does_it_contain_the_detail, 1);
			});

			if ( cross_out_details.length === 0 )
				return book;
		});

		return books;
	};

	return alpha;

})( alpha || {}, jQuery );