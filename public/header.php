<!DOCTYPE html>
<html>

<head>
	
	<title>Recyclabook</title>

	<link rel="shortcut icon" href="">
	
	<link rel="stylesheet" type="text/css" href="">

	<script src="js/manifest/jquery.js"></script>	
	<script src="js/library/mousewheel.jquery.js"></script>
	<script src="js/manifest/alpha.js"></script>

	<script>	  
	  	var scripts      = "<?php echo FRAMEWORKURI .'/js'; ?>",
	  		frameworkuri = "<?php echo FRAMEWORKURI; ?>",
	  		ajaxurl      = "<?php echo admin_url('admin-ajax.php'); ?>";

		alpha.load_scripts_asynchronously_with_callback([
			scripts+'/manifest/manifest.alpha.js',
			scripts+'/manifest/observe.alpha.js',
			scripts+'/manifest/route.alpha.js',
			scripts+'/library/amazon.alpha.js',
			scripts+'/library/scroll.alpha.js',
			scripts+'/library/book.alpha.js',
			scripts+'/library/table.alpha.js'
		],
		function (error, result) { 
			var book  = {};
				book.results = [];
				book.basket  = [];
			var animate = {};
				animate.load  = false;
				animate.state = false;
				animate.scroll= false;
				animate.page  = "home";
				animate.popup = false;
				animate.pop   = {};
				animate.pop.outside = false;

			var preset = {
				account : {
					credit 	           : "0.00",
					donate 	           : "0.00",
					last_withdraw      : "0000/00/00",
					first_name         : "",
					second_name        : "",
					price_promise      : [],
					history            : [],
					unaccepted_book    : [],
					email              : "",
					year               : "",
					university         : "",
					password           : "",
					recieve_newsletter : 1
				}
			}

			var state = {};
				state.viewed_item  = {};
				state.viewed_item.book   = {};
				state.viewed_item.parts  = {};
				state.viewed_item.show   = false;
				state.viewed_item.parts.external_product_id = "";
				state.viewed_item.parts.item_name           = "";
				state.viewed_item.parts.author              = "";
				state.viewed_item.parts.standard_price      = "";
				state.viewed_item.parts.main_image_url      = "";

				state.email = {};
				state.email.freepost = "";

				state.quote = "post";

				state.register_account    = false;
				state.password_remind     = false;
				state.give_freepost       = false;
				state.give_price_promise  = false;
				state.give_print_your_own = false;

				state.confirm           = {};
				state.confirm.tab       = 0;
				state.confirm.postage   = false;

				state.begin        = false;
				state.save_account = false;
				state.save_address = false;
				state.edit_account = false;

				state.edit = {};
				state.edit.confirm  = false;
				state.edit.withdraw = {};
				state.edit.withdraw.first_name = false;
				state.edit.withdraw.address    = false;

				state.notification = {};
				state.notification.reset = {};
				state.notification.reset.notify = false;
				state.notification.reset.text   = "";

				state.text = {};
				state.text.search = "";
				state.next_route  = "";

				state.process = {};
				state.process.search   = false;
				state.process.register = false;
				state.process.update   = false;
				state.process.log_in   = false;
				state.process.log_out  = false;
				state.process.bus_search     = false;
				state.process.false_register = false;
				state.process.donate         = false;
				state.process.add_book       = false;
				state.process.get_freepost   = false;

				state.password         = {};
				state.password.mistake = false;

				state.withdraw  = 0.00;
				state.signed    = false;
				state.addresses = [{}];
				state.account = {
					credit 	           : "0.00",
					donate 	           : "0.00",
					last_withdraw      : "0000/00/00",
					first_name         : "",
					second_name        : "",
					price_promise      : [],
					history            : [],
					unaccepted_book    : [],
					email              : "",
					year               : "",
					university         : "",
					password           : "",
					recieve_newsletter : 1
				};
				state.registration = {
					first_name : false,
					last_name  : false,
					post_code  : false,
					town       : false,
					area 	   : false,
					address    : false,
					email 	   : {
						size  : false,
						text  : false,
						unique: false,
						match : false
					},
					password   : {
						size : false,
						match: false 
					}
				};

				state.donate = {};
				state.donate.university = null;
				state.invisible_popup      = {};
				state.invisible_popup.open = false;
				state.invisible_popup.box  = false;

				state.stock = {};
				state.stock.page = false;
				state.stock.user = {
					notification : "",
					loged_in : false,
					name     : "",
					password : ""
				};

				state.stock.bus  = {
					search       : false,
					searching    : false,
					found        : false,
					search_query : "",
					add_book     : false,
					submit_expenses    : false,
					submiting_expenses : false,
					expenses_submited  : false,
					expenses     : [],
					add          : false,
					adding       : false,
					adding_books : [],
					added_books  : false,
					submit       : false,
					print        : false,
					books        : [],
					total        : 0,
					final_total  : 0,
					cheque_spell : 0,
					reset        : false,
					send_email   : false,
					sending_email: false,
					sent_email   : false
				};

				state.stock.post = {
					finished            : false,
					search_user_query   : "",
					search_user         : false,
					searching_user      : false,
					found_user          : false,
					user                : {},
					search_book_query   : "",
					search_book         : false,
					searching_book      : false,
					found_book          : false,
					books               : [],
					add_book            : false,
					price_promise_match : [],
					total               : 0,
					error               : "",
					submit_credit       : false,
					submiting_credit    : false,
					submited_credit     : false,
					submit_book         : false,
					submiting_book      : false,
					submited_book       : false,
					send_email          : false,
					sending_email       : false,
					sent_email          : false
				}

				state.stock.book = {
					recalculate_string   : "",
					begin_recalculation  : false,
					finish_recalculation : false,
					number_of_books      : {
						recalculated     : 0,
						uploaded         : 0,
						to_recalculate   : 0,
						to_upload        : 0
					},
					books                : {
						refused : [],
					},
					inventory_books_by   : {
						asin  : [],
						index : []
					},
					recalculate_again    : [],
					erronious_books      : [],
					table_wiped          : false,
					export_table         : false,
					table_exported       : false,
					exported_table_link  : ""
				};
				state.stock.book.add = {
					isbn      : "",
					condition : "",
					search    : false,
					searching : false,
					found     : false,
					add       : false,
					addding   : false,
					added     : false,
					book_added: {}
				};
				state.stock.book.list = {
					get_book : {
						get     : false,
						getting : false,
						done    : false
					}
				};

			var router = new alpha.route({
				on  : function () {
					world.wrap.branch.home_wrap.self.css({ display : "block" }).animate({ opacity : 1 });
					animate.state = false;
					animate.page  = "home";
				},
				off : function () {
					world.wrap.branch.home_wrap.self.css({ display : "none", opacity : 0 });
				},
				recyclabus : {
					on : function () {
						world.wrap.branch.bus.self.css({ display : "block" }).animate({ opacity : 1 });
						animate.state = false;
						animate.page  = "recyclabus";
					},
					off: function () { 
						world.wrap.branch.bus.self.css({ display : "none", opacity : 0 });
					}
				},
				sell: {
					on : function () {
						world.wrap.branch.sell.self.css({ display : "block" }).animate({ opacity : 1 });
						animate.state = false;
						animate.page  = "sell";
					},
					off: function () {
						world.wrap.branch.sell.self.css({ display : "none", opacity : 0 });
					}
				},
				hub : {
					on : function () {
						world.wrap.branch.hub.self.css({ display : "block" }).animate({ opacity : 1 });
						animate.state = false;
						animate.scroll= "hub";
					},
					off: function () {
						world.wrap.branch.hub.self.css({ display : "none", opacity : 0  });
					}
				},
				confirm_sign_in : {
					on : function () {
						world.wrap.branch.navigation.branch.wrap.branch.welcome_popup.self.css({ display : "block" }).animate({ opacity : 1 }, 700);
						animate.state = "welcome";
					},
					off: function () {
						world.wrap.branch.navigation.branch.wrap.branch.welcome_popup.self.css({ display : "none", opacity : 0 });
					}	
				},
				register : {
					on : function () {
						world.wrap.branch.registration.self.css({ display : "block" }).animate({ opacity : 1 });
						animate.state = "register";	
					},
					off: function () {
						world.wrap.branch.registration.self.css({ display : "none", opacity : 0  });					
					}
				},
				confirm : {
					on : function () {
						animate.state = "confirm";
						world.wrap.branch.confirm.self.css({ display : "block" }).animate({ opacity : 1 });
						animate.scroll= "confirm";
					},
					off: function () {
						world.wrap.branch.confirm.self.css({ display : "none", opacity : 0  });
					}
				}, 
				done : {
					on : function () { 
						animate.state = "done";
						world.wrap.branch.thank_you.self.css({ display : "block" }).animate({ opacity : 1 });
					},
					off: function () { 
						world.wrap.branch.thank_you.self.css({ display : "none", opacity : 0  });
					}
				},
				stock : {
					on : function () {
						world.wrap.branch.stock.self.css({ display : "block" });
						state.stock.page         = "bus";
						state.process.sign_out   = true;
						$('body').css({ overflow : "hidden" });
					},
					off : function () {
						world.wrap.branch.stock.self.css({ display : "none" });
						state.stock.page         = false;
						$('body').css({ overflow : "auto" });
					}
				}
			});
			
			var world = new alpha.thought;
			world.thought = {
				wrap : {
					instructions : {
						email : function (wake) {

							wake.text += '<p>Many Thanks,</p><p>The Recyclabook Team</p><p>We give out some MAD prizes.</p><p>Like us on Facebook or follow us on Twitter for a chance to win some great prizes including a brand new Mango Bike</p><p><a target="_blank" href="www.Facebook.com/Recyclabook">Facebook.com/Recyclabook</a></p><p><a target="_blank" href="www.Twitter.com/Recyclabook">Twitter.com/Recyclabook</a></p>';

							$.post(ajaxurl, {
								action : "set_email",
								method : "email",
								paramaters : {
									name    : wake.name,
									email   : wake.email,
									subject : wake.subject,
									text    : wake.text
								}
							}, function () {}, "json");
						},
						observers : [
							{
								who      : state.process,
								property : "log_out",
								call     : function (change) {
									if ( !change.new ) return;
									state.signed          = false;
									state.process.log_out = false;
									router.change_url("/");
									for ( var part in state.addresses[0] ) state.addresses[0][part] = "";
									for ( var part in state.account ) state.account[part] = preset.account[part];
								}
							},
							{
								who      : state.process,
								property : "log_in",
								call     : function (change) {
									if ( change.new === false || state.signed ) return;

									$.get(ajaxurl, {
										action : "get_account",
										method : "account",
										paramaters : {
											email : state.account.email
										}
									}, function (account) {
										if ( account.return ) {
											if ( state.account.password === account.return.password ) {
												$.get(ajaxurl, {
													action : "get_account",
													method : "address",
													paramaters : {
														email : state.account.email
													}
												}, function (address) { 
														
													for ( var part in state.account )    state.account[part]      = account.return[part];
													for ( var part in address.return[0]) state.addresses[0][part] = address.return[0][part];
													state.signed         = true;
													state.process.log_in = false;
													router.change_url(state.next_route);

												}, "json");
											} else {
												state.password.mistake = "Wrong password";
											}
										} 	
										else { 
											state.password.mistake = "Username "+ state.account.email +" does not exist";
										}
									}, 
									"json");
									
								}
							},
							{
								who      : state.process,
								property : "register",
								call     : function (change) { 
									if ( !change.new ) return;
									if (
										   state.registration.first_name  
										&& state.registration.last_name
										&& state.registration.post_code
										&& state.registration.town
										&& state.registration.area  
										&& state.registration.address
										&& state.registration.email.size  
										&& state.registration.email.unique
										&& state.registration.email.match    === state.account.email
										&& state.registration.password.size
										&& state.registration.password.match === state.account.password
									) {
										$.post( ajaxurl, { 
											action      : "set_account",
											method      : "new_account",
											paramaters  : {
												account : state.account
											}
										}, function () {

											state.addresses[0].user = state.account.email;

											$.post( ajaxurl, {
												action : "set_account",
												method : "new_address",
												paramaters : {
													address : state.addresses[0]
												}
											}, function () {
												state.signed           = true;
												state.process.register = false;
												router.change_url(state.next_route);
											},"json");
										},"json");
									} else {
										state.process.register = false;
									}
								}
							},
							{
								who      : state.process,
								property : "false_register",
								call     : function (change) {
									if ( !change.new ) return;
									state.addresses[0].address   = "none";
									state.addresses[0].town      = "none";
									state.addresses[0].area      = "none";
									state.addresses[0].post_code = "AAAAAAA";
									state.account.first_name     = ( state.account.first_name.length > 0? state.account.first_name : "none" );
									state.account.second_name    = ( state.account.second_name.length > 0? state.account.second_name : "none" );
									state.account.password       = state.account.password || Math.random().toFixed(7).slice(2);
									
									$.post( ajaxurl, { 
										action      : "set_account",
										method      : "new_account",
										paramaters  : {
											account : state.account
										}
									}, function () {

										state.addresses[0].user = state.account.email;
										$.post( ajaxurl, {
											action : "set_account",
											method : "new_address",
											paramaters : {
												address : state.addresses[0]
											}
										}, function () {
											state.signed                 = true;
											state.process.false_register = false;
										},"json");
									},"json");
								}
							},
							{ 
								who      : state, 
								property : "save_account",
								call     : function (change) { 

									if ( change.new ) { 
										$.post(ajaxurl,
										{ 
											action     : "set_account",
											method     : "account",
											paramaters : {
												account : state.account
											}
										}, function (response) {
											state.save_account = false;
										}, "json");
									}
								}
							},
							{ 
								who      : state, 
								property : "save_address",
								call     : function (change) { 

									var submit = state.addresses[0];
										submit.user = state.account.email;
									if ( change.new ) { 
										$.post(ajaxurl,
										{ 
											action     : "set_account",
											method     : "address",
											paramaters : {
												address : submit
											}
										}, function (response) {
											state.save_address = false;
										}, "json");
									}
								}
							},
							{
								who      : state,
								property : "give_price_promise",
								call     : function (change) {
									if ( !change.new ) return;

									var price_promise, added_books, email_text;
									
									if ( state.account.price_promise === null ) state.account.price_promise = [];
									price_promise = state.account.price_promise.concat(book.basket);
									state.account.price_promise = price_promise;
									added_books   = "<ul>";
									for (var index = 0; index < book.basket.length; index++) {
										added_books += "<li>"+ book.basket[index].title +"</li>";
									};
									added_books             += "</ul>";
									book.basket              = [];
									state.save_account       = true;
									state.give_price_promise = false;

									email = "<p>Hi "+ state.account.first_name +"</p>"+
									"<p>You have added the following books to your price promise basket.</p>"+ 
										added_books +
									"<p>"+
										"The the prices of books and quotes we give can change,"+
										"the price promise basket: is our way of promising that"+
										"we will give you the price quoted on that day for your books,"+ 
										"so you don't have to worry"+
									"</p>"+
									"<p> Your Price Promise Expires In Two Weeks.</p>"+
									"<p>"+
										"To check on your price promise basket, and add any new books, visit"+
										"<a href=\"www.recyclabook.com\">Recyclabook</a>,"+
										"where you can log in and monitor what is going on with your books though your account hub."+
									"</p>";

									world.wrap.instructions.email({
										email   : state.account.email,
										name    : state.account.first_name +", "+ state.account.second_name,
										subject : "New books have been added to your price promise",
										text    : email
									});
								}
							},
							{ 
								who      : state,
								property : "give_freepost",
								call     : function (change) {
									if ( !change.new ) return;

									var date = new Date();
									$.post(ajaxurl,
									{
										action : "set_ticket",
										method : "freepost",
										paramaters : {
											array : {
												email       : state.account.email,
												first_name  : state.account.first_name,
												second_name : state.account.second_name,
												address     : state.addresses[0].address,
												post_code   : state.addresses[0].post_code,
												town        : state.addresses[0].town,
												area        : state.addresses[0].area,
												date        : date.getFullYear() +"/"+ date.getMonth() +"/"+ date.getDate()
											}
										}
									}, function () {}, "json");

									world.wrap.instructions.email({
										email   : state.account.email,
										name    : state.account.first_name +", "+ state.account.second_name,
										subject : "Freepost pack",
										text    : "<p>Hi "+ state.account.first_name +"</p><p>We will dispatch a freepost pack soon to : </p><ul><li>"+ state.addresses[0].address +"</li><li>"+ state.addresses[0].town +"</li><li>"+ state.addresses[0].town +"</li><li>"+ state.addresses[0].post_code +"</li></ul><p>When you receive the pack all you have to do is post your books in the freepost envelope provided.</p><p>Once we receive the books we will send you a cheque.</p><p>For more information visit <a href=\"Recyclabook.com\">Recyclabook.com</a>.</p>"
									});
									state.give_freepost = false;
								}
							},
							{ 
								who      : state,
								property : "give_print_your_own",
								call     : function (change) {
									if ( !change.new ) return;

									$.get(ajaxurl, {
										action : "get_account",
										method : "account_value",
										paramaters : {
											email : state.account.email,
											get   : "id" 
										}
									}, function (response) { 
										state.account.id = response.return;
										state.give_print_your_own = false;
										world.wrap.instructions.email({
											email   : state.account.email,
											name    : state.account.first_name +", "+ state.account.second_name,
											subject : "Freepost pack",
											text    : "<p>Hi, "+ state.account.first_name +",</p><p>Thank you for selling your book with Recyclabook.</p><p>You have chosen to send your books to us with your own packaging.</p><p>All you have to do is now is post your books in the pre-paid envelope provided.</p><p>If you have one write this number on it: <strong>"+ state.account.id +"</strong>; so that we know it came from you,</p><p>Or if you have your own packaging material, print off the freepost code attached</p><p>and send it attached to your package.</p><p>We are looking forward to receiving your books.</p>"
										});
									}, "json");

								}
							},
							{ 
								who      : state,
								property : "add_account",
								call     : function (change) {
									if ( !change.new ) return;
									var text,
										normal_registration = "<p>Hi there "+ state.account.first_name +"</p><p>Thank you for registering an account with Recyclabook.</p><p>We focus on giving students the easiest possible way to sell their textbooks.</p><p>With an account you can track your order, see how much you’ve made from selling your textbooks, donate to your RAG campaign and more.</p><p>Your account details:</p><ul><li>Username:"+ state.account.email +"</li><li>Password:"+ state.account.password +"</li></ul>",
										bus_registration    = "<p>Hi there "+ state.account.email +"</p><p>Thank you for signing up to recieve updates about the Recyclabus.</p><p> We will make sure to email you as soon as our bus is coming new your University</p><p>Meanwhile we've gone and opened up an account for you, just in case you ever wish to use our onlline services</p><p>With an account you can track your orders, see how much you’ve made from selling your textbooks, donate to your RAG campaign and more.</p><p>Your account details:</p><ul><li>Username:"+ state.account.email +"</li><li>Password:"+ state.account.password +"</li></ul>";
										text                = ( state.account.first_name === state.account.email? bus_registration : normal_registration );
									
									world.wrap.instructions.email({
										email   : state.account.email,
										name    : state.account.first_name,
										subject : "Welcome to Recyclabook",
										text    : text
									});

									world.wrap.instructions.email({
										email   : "recyclabook@gmail.com",
										name    : "Recyclaguys",
										subject : "User Registered",
										text    : "You guys a user with the username :"+ state.account.email +" has registered for our services"
									});
									state.add_account = false;
								}
							},
							{ 
								who      : state,
								property : "quote",
								call     : function (change) {
									var labels = $('.result_book_price'),
										basket = $('.store_basket_pop_up_content_item_sell_price');

									for (var index = 0; index < labels.length; index++) {
										var price       = {};
											price.label = $(labels[index]);
											price.quote = parseFloat(price.label.text().trim());
											if ( change.new === "post" ) {
												price.quote/= 1.2;
											} else {
												price.quote*= 1.2;
											}
											price.quote = price.quote.toFixed(2)
											price.label.text(price.quote);
									};
								}
							},
							{
								who      : state.process,
								property : "search",
								call     : function (change) {
									if ( !change.new ) return;

									var display_book, prices, algorithm, search_query;

									algorithm    = new alpha.algorithm;
									prices       = [];
									search_query = state.text.search.replace(/[-\s]+/g, "");

									new alpha.pure_amazon_search({
										typed       : search_query,
										search_by   : "ISBN",
										filter_name : "sort"
									}, function (books) {
										if ( books.length > 0 ) {
											for (var index = 0; index < books.length; index++) {
												books[index] = algorithm.bus(books[index]);
												prices.push(books[index].standard_price);
											};

											display_book                = books[0];
											display_book.standard_price = Math.min.apply(Math, prices);
											display_book                = [display_book];
										} else {
											display_book = [];
										}

										state.quote                 = "post";
										book.results                = display_book;
										state.process.search        = false;

										if ( router.get_route() !== "/sell" ) router.change_url("sell");
									});
								}
							},
							{
								who      : state.process,
								property : "donate",
								call     : function (change) {

									if ( state.withdraw === 0 || state.withdraw === "0.00" ) return;

									var date = new Date();
									$.post(ajaxurl, {
										action : "set_ticket",
										method : "rag_donate",
										paramaters : {
											array : {
												email      : state.account.email,
												first_name : state.account.first_name,
												second_name: state.account.second_name,
												university : state.donate.university,
												amount     : state.withdraw,
												date       : date.getFullYear() +"/"+ date.getMonth() +"/"+ date.getDate()
											}
										}
									}, function (response) {}, "json");

									state.account.credit = parseFloat( state.account.credit ) - state.withdraw;
									state.account.credit = state.account.credit.toFixed(2);
									state.withdraw       = "0.00";
									state.save_account   = true;
								}
							},
							{
								who      : state.process,
								property : "bus_search",
								call     : function (change) {
									if ( !change.new ) return;
									new alpha.amazon({
										typed         : state.stock.bus.search,
										bus_algorithm : true,
										callback      : function (books) { 
											if ( books !== undefined ) {
												var basket = [],
													part   = {};

												if ( books.length === 0 ) {
													part.isbn  = state.stock.bus.search;
													part.title = "Book can not be accapted";
													part.price = "0.00";
													part.id    = "remove";
												} else { 
													if ( books.length > 1 ) books.splice(1,1);
													books[0].price  = parseFloat( books[0].price );
													books[0].price *= 1.2;
													books[0].price  = books[0].price.toFixed(2);
													part.price  = books[0].price;
													part.title  = books[0].title;
													part.isbn   = books[0].isbn;
													part.id     = state.stock.bus.basket.length;
												}

												basket                 = state.stock.bus.basket.concat(books)
												state.stock.bus.basket = basket;

												$('<div class="bus_control_item">'+
													'<div class="bus_control_item_isbn">'+   part.isbn  +'</div>'+
													'<div class="bus_control_item_title">'+  part.title +'</div>'+
													'<div class="bus_control_item_total">£'+ part.price +'</div>'+
													'<div class="bus_control_remove" id="'+  part.id  +'">Remove</div>'+
												'</div>').appendTo(world.wrap.branch.stock.branch.bus.branch.input.branch.items.self);
											}
										}
									});
								}
							},
							{
								who      : state.process,
								property : "add_book",
								call     : function (change) {
									if ( !change.new ) return;

									var basket = [];

									for (var index = 0; index < state.stock.bus.basket.length; index++) {										
										var book     = state.stock.bus.basket[index],
											new_book = {};	

											new_book.external_product_id      = book.isbn;
											new_book.external_product_id_type = "ISBN";
											new_book.item_name                = book.title.substring(0, 97);
											new_book.author                   = book.author;
											new_book.binding                  = book.binding;
											new_book.publication_date         = "2013/01/01";
											new_book.standard_price           = book.price;
											new_book.quantaty                 = 1;
											new_book.condition_type           = 3;
											new_book.product_description      = "";
											new_book.main_image_url           = book.image;
											basket.push(new_book);
									}

									$.post(ajaxurl, {
										action     : "set_book",
										method     : "book",
										paramaters : {
											books : basket
										}
									}, function () {}, "json");
								}
							}
						]
					},
					self   : '<div class="wrap"></div>',
					branch : {
						load : {
							instructions : {
								observers : [
									{
										who      : state.password,
										property : "mistake",
										call     : function (change) {

											animate.load     = change.new;
											setTimeout(function () {
												animate.load = false;
											}, 2000 );
										}
									},
									{
										who      : state.process,
										property : "search",
										call     : function (change) {
											if ( change.new ) {
												animate.load = "Searching for "+ state.text.search;
											} else { 
												animate.load = false;
											}
										}
									},
									{
										who      : state.process,
										property : "log_in",
										call     : function (change) {
											if ( change.new ) {
												animate.load = "Logging you in as "+ state.account.email;
											} else { 
												animate.load = false;
											}
										}
									},
									{
										who      : state.process,
										property : "register",
										call     : function (change) {
											if ( change.new ) {
												animate.load = "Registering you as "+ state.account.email;
											} else { 
												animate.load = false;
											}
										}
									},
									{
										who      : animate,
										property : "load",
										call     : function (change) { 
											var load = world.wrap.branch.load.self;
											if ( change.new === false ) {
												load.animate({ opacity : 0 }, 500, function () {
													load.css({ display : "none" });
												});
											} else { 
												load.text(change.new).css({ display : "block"}).animate({ opacity : 1 }, 200);
											}
										}
									}
								]
							},
							self : '<div class="load"></div>'
						},

						header : { 
							self   : '<section class="header"></section>',
							branch : {
								wrap : {
									self   : '<div class="header_wrap"></div>',
									branch : {
										invisible_box : {
											self   : '<div class="header_invisible_box"></div>',
											branch : {
												logo : {
													self : '<a href="/"><img src="'+frameworkuri+'/CSS/Includes/works/header_logo.png" alt="" class="header_invisible_box_image_title"></a>',
												},
												text : {
													self : '<div class="header_invisible_box_text_wrap"></div>',
													last_branch : { 
														title : '<div class="header_invisible_box_text_title">What We Do</div>',
														paragraph : '<div class="header_invisible_box_text">Recyclabook accepts over a million different titles, you can easily sell your book and get paid quickly and safely.</div>'
													}
												}
											}	
										},
										search_box : {
											self   : '<div class="header_text_box"></div>',
											branch : {
												title  : {
													self : '<div class="header_text_box_title">How <span class="header_text_box_title_highlight">much</span> is <br/><span class="header_text_box_title_highlight">your</span> book <span class="header_text_box_title_highlight">worth?</span></div>'
												},
												search : { 
													self   : '<div class="header_text_box_input"></div>',
													branch : {
														input_wrap : {
															self   : '<div class="header_field_for_input"></div>',
															branch : {
																input : {
																	instructions : {
																		on_events : [
																			{
																				the_event : "keyup",
																				is_asslep : false,
																				call      : function (change) {
																					state.text.search = change.self.val();
																				}
																			},
																			{
																				the_event : "keypress",
																				is_asslep : false,
																				call      : function (change) {
																					if ( change.event.keyCode === 13 ) state.process.search = true;
																				}
																			}
																		]
																	},
																	self  : '<input type="text" class="header_input_block_for_search block_for_search" placeholder="please enter your ISBN here">',
																}
															}
														},
														search_button : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function () {
																		state.process.search = true;
																	}
																}
															},
															self : '<span class="with-icon-header-search"></span>'
														}
													}
												}
											}
										},
										search_box_arrow : { 
											self : '<div class="with-icon-header-text-box-arrow"></div>' ,
										}
									}
								},
								header_image_wrap : {
									self : '<div class="header_image_wrap"></div>',
									last_branch : { 
										image : '<img src="'+ frameworkuri +'/CSS/Includes/works/jhonc.png" class="header_image">'
									}
								}
							}
						},
						home_wrap : {
							self   : '<section class="homepage_body_wrap pages"></section>',
							branch : { 
								home : { 
									self   :'<div class="homepage_body_inner_wrap"></div>',
									branch : {
										info_title : { 
											self   : '<div class="homepage_how_it_works_option_title_wrap"></div>',
											branch : {
												scrible : { 
													self :'<div class="homepage_how_it_works_option_title_scrible">1st option</div>' ,
												},
												title : {
													self   : '<div class="homepage_how_it_works_option_title"></div>',
													last_branch : {
														part_one : '<span class="homepage_how_it_works_option_title_part_one">Free</span>',
														part_two : '<span class="homepage_how_it_works_option_title_part_two">post</span>',
													}
												}
											}
										},
										info_numbers : {
											self   : '<div class="homepage_how_it_works_boxes_numbers_wrap"></div>',
											last_branch : {
												one : '<div class="with-icon-homepage-how-it-works-box-number-one"></div>',
												two : '<div class="with-icon-homepage-how-it-works-box-number-two"></div>',
												three : '<div class="with-icon-homepage-how-it-works-box-number-three"></div>'
											}
										},
										info_boxes : {
											self   : '<div class="homepage_how_it_works_boxes_wrap"></div>',
											branch : {
												first : {
													self   : '<div class="homepage_how_it_works_box_wrap_first"></div>',
													branch : {
														content : {
															self   : '<div class="homepage_how_it_works_box homepage_how_it_works_box_first"></div>',
															branch : {
																text : {
																	self   : '<div class="homepage_how_it_works_box_text_wrap"></div>',
																	last_branch : {
																		title : '<div class="homepage_how_it_works_box_title">Find Your Books</div>',
																		text  :'<div class="homepage_how_it_works_text">find your books and add them to your sell basket</div>'
																	}
																},
																image : {
																	self : '<img src="'+ frameworkuri +'/CSS/Includes/works/type.png" class="homepage_how_it_works_box_first_image">'
																}
															}
														},
														arrows : {
															self   : '<div class="homepage_arrows_warp"></div>',
															last_branch : {
																part_one   : '<div class="with-icon-homepage-how-it-works-box-left-blue-arrow"></div>',
																part_two   : '<div class="with-icon-homepage-how-it-works-box-right-arrow"></div>',
																part_three : '<div class="with-icon-homepage-how-it-works-box-left-arrow"></div>'
															}
														}
													}
												},
												second : {
													self   : '<div class="homepage_how_it_works_box_wrap_second"></div>',
													branch : {
														content : {
															self   :'<div class="homepage_how_it_works_box_second"></div>',
															branch : {
																text : {
																	self   : '<div class="homepage_how_it_works_box_text_wrap"></div>',
																	last_branch : {
																		title : '<div class="homepage_how_it_works_box_title">Freepost<br/>Your Books</div>',
																		text  :'<div class="homepage_how_it_works_text">we send you a freepost pack and you send us your books</div>'
																	}
																},
																image : {
																	self : '<img  src="'+frameworkuri+'/CSS/Includes/works/letter.png" class="homepage_how_it_works_box_second_image">'
																}
															}
														},
														arrows : {
															self   : '<div class="homepage_arrows_warp"></div>',
															last_branch : {
																part_one   : '<div class="with-icon-homepage-how-it-works-box-left-blue-arrow"></div>',
																part_two   : '<div class="with-icon-homepage-how-it-works-box-right-arrow"></div>',
																part_three : '<div class="with-icon-homepage-how-it-works-box-left-arrow"></div>'
															}
														}
													}
												},
												third : {
													self   : '<div class="homepage_how_it_works_box_wrap_last"></div>',
													branch : {
														content : {
															self   : '<div class="homepage_how_it_works_box homepage_how_it_works_box_last"></div>',
															branch : {
																text : {
																	self   : '<div class="homepage_how_it_works_box_text_wrap"></div>',
																	last_branch : {
																		title : '<div class="homepage_how_it_works_box_title"><br/>Get Paid</div>',
																		text  :'<div class="homepage_how_it_works_text">we send you a cheque the same day we receive your books</div>'
																	}
																},
																image : {
																	self : '<img src="'+frameworkuri+'/CSS/Includes/works/check.png" class="homepage_how_it_works_box_third_image">'
																}
															}
														}
													}
												}
											}
										},
										info_buttons : {
											self   : '<div class="homepage_how_it_works_boxes_buttons_wrap"></div>',
											branch : { 	
												button_one : {
													self   :  '<div class="homepage_how_it_works_box_first_button_wrap"></div>',
													branch : { 
														trigger : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		if ( this.trigger.instructions.open ) {
																			this.trigger.instructions.open = false;
																			this.text_box.self.css({ display : "none" });
																		} else { 
																			this.trigger.instructions.open = true;
																			this.text_box.self.css({ display : "block" });
																		}
																	}
																}
															},
															self :  '<div id="where_is_my_isbn_trigger" class="homepage_how_it_works_box_button">Where is My ISBN </div>',
															last_branch : {
																arrow :  '<span id="where_is_my_isbn_trigger" class="with-icon-down-arrow-for-how-it-works-button"></span>'
															}
														},
														text_box  : {
															self :  '<div id="where_is_my_isbn_toggle" class="homepage_how_it_works_box_button_expanded"></div>',
															last_branch : {
																image :  '<img src="'+frameworkuri+'/CSS/Includes/works/where_is_my_isbn.png" alt="how it works" class="homepage_how_it_works_box_button_expanded_image">',
																paragraph : '<div class="homepage_how_it_works_box_button_expanded_text">Just look at the back of your book and find the 13 or 9 digit number bellow.</div>'
															}
														}
													}
												},
												button_two : {
													self   :  '<div class="homepage_how_it_works_box_second_button_wrap"></div>',
													branch : { 
														trigger : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		if ( this.trigger.instructions.open ) {
																			this.trigger.instructions.open = false;
																			this.text_box.self.css({ display : "none" });
																		} else { 
																			this.trigger.instructions.open = true;
																			this.text_box.self.css({ display : "block" });
																		}
																	}
																}
															},
															self :  '<div id="freepost_trigger" data-function-to-call="front.prototype.toggle_popup_boxes" class="homepage_how_it_works_box_button">Freepost Options</div>',
															last_branch : {
																arrow :  '<span id="freepost_trigger" data-function-to-call="front.prototype.toggle_popup_boxes" class="with-icon-down-arrow-for-how-it-works-button"></span>'
															}
														},
														text_box  : {
															self :  '<div id="freepost_toggle" class="homepage_how_it_works_box_button_expanded"></div>',
															last_branch : {
																paragraph_one   :  '<div class="homepage_how_it_works_box_button_expanded_text">We\'ll send you a postage pack. You\'ll get a <strong>mailing bag</strong> with our freepost address sticker attached, so you won’t pay a penny to post your books to Recyclabook.</div>',
																paragraph_two   :  '<div class="homepage_how_it_works_box_button_expanded_text_highlight">or</div>',
																paragraph_three :  '<div class="homepage_how_it_works_box_button_expanded_text">If you have your own <strong>packaging</strong>, you can print off our own packaging label from this website. <strong>This will reduce the turnaround time of the order to give you peace of mind, while ensuring you get your payment even faster!</strong></div>',
																image           :  '<img src="'+frameworkuri+'/CSS/Includes/works/freepost_options.png" alt="how it works" class="homepage_how_it_works_box_button_expanded_image">'				
															}
														}
													}
												},
												button_three : {
													self   :  '<div class="homepage_how_it_works_box_third_button_wrap"></div>',
													branch : { 
														trigger : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		if ( this.trigger.instructions.open ) {
																			this.trigger.instructions.open = false;
																			this.text_box.self.css({ display : "none" });
																		} else { 
																			this.trigger.instructions.open = true;
																			this.text_box.self.css({ display : "block" });
																		}
																	}
																}
															},
															self :  '<div  id="paid_trigger" class="homepage_how_it_works_last_box_button">How Am I Being Paid?</div>',
															last_branch : {
																arrow : '<span id="paid_trigger" class="with-icon-down-arrow-for-how-it-works-button"></span>' 
															}
														},
														text_box  : {
															self :  '<div id="paid_toggle" class="homepage_how_it_works_box_button_expanded"></div>',
															last_branch : {
																paragraph : '<div class="homepage_how_it_works_box_button_expanded_text"><strong>Don’t</strong> worry about filling in your bank details. We\'ll send you a cheque on the same day we receive your books.</div>'
															}
														}
													}
												}
											}
										},
										recyclabus_sticker : {
											self : '<div class="with-icon-or-sticker-recyclabus"></div>'
										},
										recyclabus : {
											self   : '<div class="homepage_recyclabus_box_wrap"></div>',
											branch : {
												scrible : {
													self :'<div class="homepage_recyclabus_box_title_scrible">2nd option</div>'
												},
												title : {
													self : '<div class="homepage_recyclabus_box_title">Recycla<span class="homepage_recyclabus_box_title_color">Bus</span></div>'
												},
												text_wrap : {
													self   : '<div class="homepage_recyclabus_box_text_wrap"></div>',
													branch : {
														paragraph_one : {
															self : '<div class="homepage_recyclabus_box_point"></div>',
															last_branch : {
																leaf : '<div class="with-icon-recyclabus-point-leaf"></div>',
																text : '<div class="homepage_recyclabus_box_point_text">Our bus is touring Universities all over the country, come along and get paid instantly</div>' 
															}
														},
														paragraph_two : {
															self : '<div class="homepage_recyclabus_box_point"></div>',
															last_branch : {
																leaf : '<div class="with-icon-recyclabus-point-leaf"></div>',
																text : '<div class="homepage_recyclabus_box_point_text">You get paid <strong>20% extra</strong> when using the RecyclaBus</div>'
															}
														},
														paragraph_three : {
															self : '<div class="homepage_recyclabus_box_point"></div>',
															last_branch : {
																leaf : '<div class="with-icon-recyclabus-point-leaf"></div>',
																text : '<div class="homepage_recyclabus_box_point_text">No need to fill in any details <strong>just turn up on the day</strong></div>'
															}
														}
													}
												},
												find_out_more : {
													self : '<a href="recyclabus" class="homepage_recyclabus_box_button_wrap"></a>',
													last_branch : {
														text  : '<span class="homepage_recyclabus_box_button_text">Find Out More</span>',
														arrow :'<span class="with-icon-recyclabus-find-out-more-arrow"></span>'
													},
												},
												recyclabus_image : {
													self :'<img src="'+ frameworkuri +'/CSS/Includes/works/recyclabus.png"class="homepage_recyclabus_box_image">'
												}
											}
										}
									}
								}
							}
						},
						navigation : {
							self : '<section class="bar_outer_wrap"></section>',
							branch : {
								wrap : {
									self   : '<div class="bar"></div>',
									branch : {
										arrow : {
											instructions : {
												observe : {
													who      : animate,
													property : "state",
													call     : function (change) {
														var arrow = world.wrap.branch.navigation.branch.wrap.branch.arrow.self;
														if ( change.new === false || change.new === "done" ) arrow.css({ display : "none" });
														if ( change.new !== false && change.new !== "done" ) arrow.css({ display : "block" });
														if ( change.new === "welcome" )  arrow.animate({ left : "68px" });
														if ( change.new === "register" ) arrow.animate({ left : "152px" });
														if ( change.new === "confirm"  ) arrow.animate({ left : "234px" });
													}
												}
											},
											self : '<span class="with-icon-progress-pop-up-arrow"></span>'
										},
										navigation : {
											self   : '<div class="navigation_wrap"></div>',
											branch : {
												wrap : {
													instructions : { 
														observe : {
															who : animate,
															property : "state",
															call : function (change) {
																var progress = world.wrap.branch.navigation.branch.wrap.branch.navigation.branch.wrap.self;
																	if ( change.new !== false ) progress.animate({ top : "-52px" });
																	if ( change.new === false ) progress.animate({ top : "0px" });
															}
														}
													},
													self   : '<div class="navigation_inner_wrap"></div>',
													branch : {
														navigation : {
															self   : '<div class="navigation"></div>',
															branch : {
																how_it_works : {
																	instructions : {
																		observe : {
																			who      : animate,
																			property : "page",
																			call     : function (change) {
																				var self = world.wrap.branch.navigation.branch.wrap.branch.navigation.branch.wrap.branch.navigation.branch.how_it_works.self;
																				if ( change.new === "home" ) self.attr("class", "with-icon-for-navigation-text-for-bar-active");
																				if ( change.new !== "home" ) self.attr("class", "navigation_text_for_bar");
																			}
																		}
																	},
																	self : '<a href="/" id="homepage_navigation" class="with-icon-for-navigation-text-for-bar-active">How It Works</a>'
																},
																recyclabus : {
																	instructions : {
																		observe : {
																			who      : animate,
																			property : "page",
																			call     : function (change) {
																				var self = world.wrap.branch.navigation.branch.wrap.branch.navigation.branch.wrap.branch.navigation.branch.recyclabus.self;
																				if ( change.new === "recyclabus" ) self.attr("class", "with-icon-for-navigation-text-for-bar-active");
																				if ( change.new !== "recyclabus" ) self.attr("class", "navigation_text_for_bar");
																			}
																		}
																	},
																	self : '<a href="recyclabus" id="recyclabus_navigation" class="navigation_text_for_bar">Recyclabus</a>'
																},
																sell_books : {
																	instructions : {
																		observe : {
																			who      : animate,
																			property : "page",
																			call     : function (change) {
																				var self = world.wrap.branch.navigation.branch.wrap.branch.navigation.branch.wrap.branch.navigation.branch.sell_books.self;
																				if ( change.new === "sell" ) self.attr("class", "with-icon-for-navigation-text-for-bar-active");
																				if ( change.new !== "sell" ) self.attr("class", "navigation_text_for_bar");
																			}
																		}
																	},
																	self : '<a href="sell" class="navigation_text_for_bar">Sell Books</a>'
																}
															}
														},
														progress : {															
															self   : '<div class="progress_icons_for_bar_wrap"></div>',
															branch : {								
																welcome : {
																	instructions : {
																		observe : {
																			who      : animate,
																			property : "state",
																			call     : function (change) {
																				var icon = world.wrap.branch.navigation.branch.wrap.branch.navigation.branch.wrap.branch.progress.branch.welcome.self;
																					if ( change.new === "welcome") {
																						icon.attr("class", "progress_icon_for_bar");
																					} else {
																						icon.attr("class", "progress_icon_for_bar_done");
																					}
																			}
																		}
																	},
																	self   : '<div class="progress_icon_for_bar"></div>',
																	branch : {
																		circle : {
																			instructions : {
																				observe : {
																					who      : animate,
																					property : "state",
																					call     : function (change) {
																						var circle = world.wrap.branch.navigation.branch.wrap.branch.navigation.branch.wrap.branch.progress.branch.welcome.branch.circle.self;
																							if ( change.new === "welcome" ) {
																								circle.attr("class", "progress_icon_circle_doing");
																							} else { 
																								circle.attr("class", "progress_icon_circle_done");
																							}
																					}
																				}
																			},		
																			self   : '<div class="progress_icon_circle_doing"></div>',
																			last_branch : {
																				icon : '<span class="with-icon-welcome-progress-bar"></span>'
																			}
																		},
																		text : {
																			self : '<span class="progress_icon_for_bar_text">Welcome</span>'
																		}
																	}
																},
																account : {
																	instructions : {
																		observe : {
																			who      : animate,
																			property : "state",
																			call     : function (change) {
																				var icon = world.wrap.branch.navigation.branch.wrap.branch.navigation.branch.wrap.branch.progress.branch.account.self;
																					if ( change.new === "welcome" || change.new === "register") {
																						icon.attr("class", "progress_icon_for_bar");
																					} else {
																						icon.attr("class", "progress_icon_for_bar_done");
																					}
																			}
																		}
																	},
																	self   : '<div class="progress_icon_for_bar"></div>',
																	branch : {
																		circle : {
																			instructions : {
																				observe : {
																					who      : animate,
																					property : "state",
																					call     : function (change) {
																						var circle = world.wrap.branch.navigation.branch.wrap.branch.navigation.branch.wrap.branch.progress.branch.account.branch.circle.self;
																							if ( change.new === "welcome" ) {
																								circle.attr("class", "progress_icon_circle");
																							} else if ( change.new === "register" ) {
																								circle.attr("class", "progress_icon_circle_doing");
																							} else { 
																								circle.attr("class", "progress_icon_circle_done");
																							}
																					}
																				}
																			},	
																			self   : '<div class="progress_icon_circle"></div>',
																			last_branch : {
																				icon : '<span class="with-icon-account-progress-bar"></span>'
																			}
																		},
																		text : {
																			self : '<span class="progress_icon_for_bar_text">Account</span>'
																		}
																	}
																},
																confirm : {
																	instructions : {
																		observe : {
																			who      : animate,
																			property : "state",
																			call     : function (change) {
																				var icon = world.wrap.branch.navigation.branch.wrap.branch.navigation.branch.wrap.branch.progress.branch.confirm.self;
																					if ( change.new === "welcome" || change.new === "register" || change.new === "confirm") {
																						icon.attr("class", "progress_icon_for_bar");
																					} else {
																						icon.attr("class", "progress_icon_for_bar_done");
																					}
																			}
																		}
																	},
																	self   : '<div class="progress_icon_for_bar"></div>',
																	branch : {
																		circle : {
																			instructions : {
																				observe : {
																					who      : animate,
																					property : "state",
																					call     : function (change) {
																						var circle = world.wrap.branch.navigation.branch.wrap.branch.navigation.branch.wrap.branch.progress.branch.confirm.branch.circle.self;
																							if ( change.new === "welcome" || change.new === "register" ) {
																								circle.attr("class", "progress_icon_circle");
																							} else if ( change.new === "confirm" ) {
																								circle.attr("class", "progress_icon_circle_doing");
																							} else { 
																								circle.attr("class", "progress_icon_circle_done");
																							}
																					}
																				}
																			},	
																			self   : '<div class="progress_icon_circle"></div>',
																			last_branch : {
																				icon : '<span class="with-icon-confirm-progress-bar"></span>'
																			}
																		},
																		text : {
																			self : '<span class="progress_icon_for_bar_text">Confirm</span>'
																		}
																	}
																},
																thank_you : {
																	self   : '<div class="progress_icon_for_bar"></div>',
																	branch : {
																		circle : {
																			instructions : {
																				observe : {
																					who      : animate,
																					property : "state",
																					call     : function (change) {
																						var circle = world.wrap.branch.navigation.branch.wrap.branch.navigation.branch.wrap.branch.progress.branch.thank_you.branch.circle.self;
																							if ( change.new === "done" ) {
																								circle.attr("class", "progress_icon_circle_doing");
																							} else {
																								circle.attr("class", "progress_icon_circle");
																							}
																					}
																				}
																			},	
																			self   : '<div class="progress_icon_circle"></div>',
																			last_branch : {
																				icon : '<span class="with-icon-thank-you-progress-bar"></span>'
																			}
																		},
																		text : {
																			self : '<span class="progress_icon_for_bar_text">Thank You</span>'
																		}
																	}
																},
																back : {
																	self   : '<div class="progress_icon_for_bar"></div>',
																	branch : {
																		circle : {
																			self   : '<a href="sell" class="progress_icon_circle"></a>',
																			last_branch : {
																				icon : '<span data-function-to-call="front.prototype.go_back_to_shopping" class="with-icon-back-progress-bar"></span>'
																			}
																		},
																		text : {
																			self : '<span class="progress_icon_for_bar_text">Go Back</span>'
																		}
																	}
																}
															}
														}										
													}
												}
											}
										},
										progress_popup : {
											instructions : { 
												observe : {
													who : animate,
													property : "state",
													call : function (change) {
														var box = world.wrap.branch.navigation.branch.wrap.branch.progress_popup.self;
															if ( change.new === "register" || change.new === "confirm" ) {
																box.css({ display : "block" });
															} else { 
																box.css({ display : "none" });
															}
													}
												}
											},
											self   : '<div class="progress_pop_up"></div>',
											branch : {
												title : {
													self   : '<div class="progress_pop_up_title"></div>',
													branch : {
														text : {
															instructions : {
																observe : {
																	who : animate,
																	property : "state",
																	call : function (change) { 
																		var title = world.wrap.branch.navigation.branch.wrap.branch.progress_popup.branch.title.branch.text.self;
																			if ( change.new === "register" )  title.text("Create Account");
																			if ( change.new === "confirm"  )  title.text("Confirm Basket");
																	}
																}
															},
															self : '<span class="progress_pop_up_title_text"></span>'
														},
														icon : {
															self   : '<span class="progress_pop_up_title_icon"></span>',
															branch : {
																icon : {
																	instructions : {
																		observe : {
																			who : animate,
																			property : "state",
																			call : function (change) { 
																				var icon = world.wrap.branch.navigation.branch.wrap.branch.progress_popup.branch.title.branch.icon.branch.icon.self;
																					if ( change.new === "register" )  icon.attr("class", "with-icon-account-progress-bar");
																					if ( change.new === "confirm"  )  icon.attr("class", "with-icon-confirm-progress-bar");
																			}
																		}
																	},
																	self : '<span class="with-icon-welcome-progress-bar"></span>'
																}
															}
														}
													}
												},
												text : {
													instructions : {
														observe : {
															who : animate,
															property : "state",
															call : function (change) { 
																var text = world.wrap.branch.navigation.branch.wrap.branch.progress_popup.branch.text.self;
																	if ( change.new === "register" )  text.text("This will allow us to send the payment to the correct address, as well as allowing you to track these payments, check book orders and edit details.");
																	if ( change.new === "confirm"  )  text.text("Better be safe than sorry, Just check the books and address are correct and edit any mistakes if need be, then chose which type of freepost you prefer and confirm your sale. Shazam!");
															}
														}
													},
													self : '<p class="progress_pop_up_text"></p>'
												}
											}
										},						
										welcome_popup : {
											self   : '<div class="progress_welcome_pop_up"></div>',
											branch : {
												placeholder : {
													instructions : {
														observe : {
															who      : state,
															property : "signed",
															call     : function (change) {
																var holder = world.wrap.branch.navigation.branch.wrap.branch.welcome_popup.branch.placeholder.self;
																	if ( change.new ) {
																		holder.animate({ top : "0px", marginBottom : "20px" });
																	} else {
																		holder.animate({ top : "-220px", marginBottom : "-220px" });
																	}
															}
														}
													},
													self : '<div class="progress_welcome_pop_up_placeholder"></div>',
													branch : {
														text : {
															self : '<div class="progress_welcome_pop_up_placeholder_text">You are signed in...</div>'
														},
														sign_out : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function () { 
																		state.signed    = false;
																		for ( var part in state.addresses[0] ) state.addresses[0][part] = "";
																		for ( var part in state.account )      state.account[part]      = preset.account[part];
																	}
																}
															},
															self : '<div class="progress_welcome_pop_up_placeholder_link">sign out?</div>'
														}
													}
												},
												sign_in : {
													self   : '<div class="progress_welcome_sign_in_box"></div>',
													branch : {
														title    : {
															self : '<div class="progress_welcome_sign_in_box_title">Sign In</div>'
														},
														email    : {
															instructions : {
																on : {
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) {
																		state.account.email = change.self.val();
																	}
																}
															},
															self : '<input type="text" class="progress_welcome_sign_in_box_input" placeholder="Email Address" value="">'
														},
														password : {
															instructions : {
																on : {
																	the_event : "keypress",
																	is_asslep : false,
																	call      : function (change) {
																		if ( change.event.keyCode === 13 ) {
																			state.account.password  = change.self.val();
																			state.process.log_in    = true;
																			state.next_route        = "confirm";
																		}	
																	}
																}
															},
															self : '<input type="password" class="progress_welcome_sign_in_box_password" placeholder="Password" value="">'
														},
														enter : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function () {
																		state.account.password = this.password.self.val();
																		state.process.log_in   = true;
																		state.next_route       = "confirm";
																	}
																}
															},
															self : '<div alt="Log in" class="with-icon-enter-for-welcome-box"></div>'
														},
														forgoten : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		animate.pop.outside = "forgotten";
																	}
																}
															},
															self : '<span class="progress_welcome_sign_in_box_forgot_password">Forgoten Password?</span>'
														}
													}
												},
												register : {
													self   : '<div class="progress_welcome_register_box"></div>',
													branch : {
														text   : {
															self : '<div class="progress_welcome_register_box_text">New To Recyclabook >>></div>'
														},
														button : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		state.next_route = "confirm";
																	}
																}
															},
															self : '<a href="register" class="progress_welcome_register_box_button">Sign Up</a>'
														}
													}
												}
											}
										},							
										user_button : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														state.invisible_popup.open = true;
														state.invisible_popup.box  = "sign";
													}
												}
											},
											self   : '<div class="button_for_user"></div>',
											last_branch : {
												icon  : '<span class="with-icon-user"></span>',
												arrow : '<span class="with-icon-user-arrow"></span>'
											}
										},
									}
								}
							}
						},
						sell : {
							self : '<section class="body pages"></section>',
							branch : {
								quote : {
									self   : '<div class="sell_quote_box"></div>',
									branch : {
										title : {
											self : '<div class="sell_quote_box_title">Prices Shown</div>',
										},
										post : {
											instructions : {
												current : true,
												observe : {
													who      : state,
													property : "quote",
													call     : function (change) {
														var self = world.wrap.branch.sell.branch.quote.branch.post.self;

														if ( change.new === "post") {
															self.attr("class","with-icon-sell-quote-freepost");
														} else {
															self.attr("class","with-icon-sell-quote-freepost-unticked");
														}
													}
												},
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														if ( state.quote === "post" && this.post.instructions.current ) return;
														this.bus.instructions.current  = false;
														this.post.instructions.current = true; 
														state.quote = "post";
													}
												}
											},
											self : '<div class="with-icon-sell-quote-freepost">Freepost</div>'
										},
										bus : {
											instructions : {
												current : false,
												observe : {
													who      : state,
													property : "quote",
													call     : function (change) {
														var self = world.wrap.branch.sell.branch.quote.branch.bus.self;

														if ( change.new === "bus" ) {
															self.attr("class","with-icon-sell-quote-bus");
														} else {
															self.attr("class","with-icon-sell-quote-bus-unticked");
														}
													}
												},
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														if ( state.quote === "bus" && this.bus.instructions.current ) return;
														this.post.instructions.current = false; 
														this.bus.instructions.current  = true;
														state.quote = "bus";
													}
												}
											},
											self : '<div class="with-icon-sell-quote-bus-unticked">Recyclabus</div>',
										},
										description : {
											self : '<div class="sell_quote_box_description">You get an extra 20% if you use Recyclabus</div>'
										},
										link : {
											self : '<a href="recyclabus" class="sell_quote_box_link">Find out more about Recyclabus</a>'
										},
									}
								},	
								basket : {
									self   : '<div class="search_books_description_title"></div>',
									branch : {
										icon : {
											self : '<span class="with-icon-description-title-thumbs-up"></span>'
										},
										promotional_text : {
											self : '<span class="search_books_description_title_text">Our price promise guaranteed</span>'
										},
										basket_box : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														state.invisible_popup.open = true;
														state.invisible_popup.box  = "basket";
													}
												}
											},
											self   : '<div class="sell_and_buy_basket"></div>',
											branch : {
												stats : { 
													self   : '<div id="buy_basket" class="basket_stats"></div>',
													branch : {
														pig : {
															self : '<span class="with-icon-sell-basket-piggy"> :</span>'
														},
														quote : {
															instructions : {
																observe : {
																	who      : book,
																	property : "basket",
																	call     : function (change) { 
																		this.self.text(change.new.length);
																	}
																}
															},
															self : '<span class="with-icon-sell-basket-number"> 0</span>'
														}
													}
												}
											}
										}
									}
								},
								items : {
									instructions : {
										on : {
											the_event : "click",
											is_asslep : false,
											call      : function (change) {

												var current_book, part, id, promises;

												if ( change.event.target.className === "with-icon-info-for-book" ) {
													id                     = change.event.target.getAttribute("data-type-book");
													current_book           = book.results[id-1];
													for ( part in state.viewed_item.parts ) state.viewed_item.parts[part] = current_book[part];
													state.viewed_item.book = current_book;
													state.viewed_item.show = true;
												}

												if ( change.event.target.className === "result_book_add_button_text" || 
													 change.event.target.className === "result_book_added_book_add_again_button" ) {		
													id                     = change.event.target.getAttribute("data-type-book");
													current_book           = book.results[id-1];
													promises               = book.basket;
													promises.push(current_book);
													book.basket            = promises;
												}

												if ( change.event.target.className === "result_book_added_book_sell_button" ) {
													if ( book.basket.length === 0 ) return;
													(state.signed)? router.change_url("confirm") : router.change_url("confirm_sign_in");
												}

												if (  change.event.target.className === "result_book_add_button_text"  ) {
													$(change.event.target).closest('.result_book_inner_wrap').css({ position : "relative" }).animate({ top : "-45px" }, 400 );
													$(change.event.target).closest('.result_book_search').next().animate({ opacity : 1 }, 500);
												}
											}
										},
										observe : {
											who      : book,
											property : "results",
											call     : function (change) {
												var wraps, book_string;

												wraps = {};
												wraps.on_wrap = 0;
												wraps.classes = [
													"result_book_search_wrapper_left", 
													"result_book_search_wrapper", 
													"result_book_search_wrapper_right"
												];
												book_string = "";
													

												for (index = 0; index < book.results.length; index++) {

													book_string +=
														'<div class="'+ wraps.classes[wraps.on_wrap] +'">'+
															'<div class="result_book_search">';
													if ( book.results[index].standard_price ) book_string += 
																'<span data-type-book="'+ ( index + 1 ) +'" class="with-icon-info-for-book">'+'</span>';
													book_string +=
																'<img src="'+ book.results[index].main_image_url +'" class="result_book_thumbnail_image">'+
																'<article class="result_book_search_text">'+ 				
																	'<strong class="result_book_title">'+ book.results[index].item_name.slice(0, 10) +'...</strong>'+
																	'<div class="result_book_author">'+   book.results[index].author.slice(0, 18)    +'...</div>'+
																	'<div class="result_book_price_wrap">'+
																		'<span class="result_book_price_text">Sell for </span>'+
																		'<storng class="result_book_price">'+ book.results[index].standard_price +'</storng>'+
																	'</div>'+
																'</article>';
													if ( book.results[index].standard_price ) book_string += 
																'<div class="result_book_add_button_wrap">'+
																	'<div class="result_book_inner_wrap">'+
																		'<div class="result_book_add_button">'+
																			'<span data-type-book="'+ ( index + 1 ) +'" class="result_book_add_button_text">Add To Sell Basket</span>'+
																		'</div>'+
																		'<div class="result_book_add_button_static">'+
																			'<span class="with-icon-added-to-sell-basket-tick">Added To Basket</span>'+
																		'</div>'+
																	'</div>'+
																'</div>';
													if ( ! book.results[index].standard_price ) book_string += 
																'<div class="result_book_add_button_wrap">'+
																	'<div class="result_book_inner_wrap">'+
																		'<div class="result_book_add_button_static">'+
																			'<span class="result_book_refused_button">We dont accept this book</span>'+
																		'</div>'+
																	'</div>'+
																'</div>';
													book_string += 
															'</div>';
													if ( book.results[index].standard_price ) book_string += 
															'<div class="result_book_extra_options_buttons">'+
																'<span class="result_book_added_book_sell_button">'+
																	'<span class="with-icon-sell-now-arrow"></span>'+ 
																		'Sell now?'+
																	'</span>'+
																'<span data-type-book="'+ ( index + 1 ) +'" class="result_book_added_book_add_again_button">'+
																	'<span class="with-icon-add-again"></span>'+
																		'Add again'+ 
																	'</span>'+
															'</div>';
													book_string += 
														'</div>';
													( wraps.on_wrap === 2? wraps.on_wrap = 0 : wraps.on_wrap++ );
												};

												if (change.new.length === 0) book_string = "<div class=\"reslt_not_found\">No search results were found sorry</div>";
												this.self.empty();
												this.self[0].insertAdjacentHTML("afterbegin", book_string);
												this.self.css({ top : "800px"});
												this.self.animate({ top : "0px" }, 900);
											}
										}
									},
									self : '<div class="result_books"></div>',
								}
							}			
						},
						hub : {
							self : '<section class="profile_hub pages"></section>',
							branch : { 
								wrap : {
									self : '<div class="profile_hub_inner_wrap"></div>',
									branch : {
										header : { 
											self : '<div class="profile_hub_header"></div>',
											last_branch : {
												title : '<div class="profile_hub_header_title">Profile Hub</div>',
												text  : '<div class="profile_hub_header_text">For withdrawals, tracking, order history and editing account details</div>'
											}
										},
										left_boxes : {
											self : '<div class="profile_hub_left_boxes_wrap"></div>',
											branch : {
												account : {
													self : '<div class="profile_hub_account profile_hub_box"></div>',
													branch : {
														bar : {
															self : '<div class="profile_hub_account_bar"></div>',
															branch : {
																icon : {
																	self : '<div class="with-icon-profile-hub-account"></div>'
																},
																greeting : {
																	instructions : {
																		observe : {
																			who     : state.account,
																			property: "first_name",
																			call    : function (change) {
																				if ( state.edit_account ) return;
																					var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.bar.branch.greeting.self;
																					input.text("Hi, "+ change.new);
																			}
																		}
																	},
																	self : '<div class="profile_hub_account_bar_greeting"></div>'
																},
																text : {
																	self : '<div class="profile_hub_account_bar_text">Account Details</div>'
																}
															}
														},
														body : {
															self : '<div class="profile_hub_account_body"></div>',
															branch : {
																main_details : {
																	self : '<div class="profile_hub_account_main_details"></div>',
																	branch : {
																		first_name : {
																			instructions : {
																				observers : [
																					{
																						who     : state.account,
																						property: "first_name",
																						call    : function (change) {
																							if ( state.edit_account ) return;
																								var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.main_details.branch.first_name.self;
																								input.val(change.new);
																						}
																					},
																					{
																						who      : state,
																						property : "edit_account",
																						call     : function (change) {
																							var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.main_details.branch.first_name.self;
																								input.attr("readonly", (!state.edit_account));

																						}
																					}
																				],
																				on : {
																					the_event : "keyup",
																					is_asslep : false,
																					call      : function (change) {
																						state.account.first_name = change.self.val();
																					}
																				}
																			},
																			self : '<input type="text" class="profile_hub_account_main_details_small_input" readonly>'
																		},
																		second_name: {
																			instructions : {
																				observers : [
																					{
																						who     : state.account,
																						property: "second_name",
																						call    : function (change) {
																							if ( state.edit_account ) return;
																								var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.main_details.branch.second_name.self;
																								input.val(change.new);
																						}
																					},
																					{
																						who      : state,
																						property : "edit_account",
																						call     : function (change) {
																							var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.main_details.branch.second_name.self;
																								input.attr("readonly", (!state.edit_account));

																						}
																					}
																				],
																				on : {
																					the_event : "keyup",
																					is_asslep : false,
																					call      : function (change) {
																						state.account.second_name = change.self.val();
																					}
																				}
																			},
																			self : '<input type="text" class="profile_hub_account_main_details_small_input" readonly>'
																		},
																		address : {
																			instructions : {
																				observers : [
																					{
																						who     : state.addresses[0],
																						property: "address",
																						call    : function (change) {
																							if ( state.edit_account ) return;
																								var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.main_details.branch.address.self;
																								input.val(change.new);
																						}
																					},
																					{
																						who      : state,
																						property : "edit_account",
																						call     : function (change) {
																							var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.main_details.branch.address.self;
																								input.attr("readonly", (!state.edit_account));
																						}
																					}
																				],
																				on : {
																					the_event : "keyup",
																					is_asslep : false,
																					call      : function (change) {
																						state.addresses[0].address = change.self.val();
																					}
																				}
																			},
																			self : '<input type="text" class="profile_hub_account_main_details_large_input" readonly>'
																		},
																		town : {
																			instructions : {
																				observers : [
																					{
																						who     : state.addresses[0],
																						property: "town",
																						call    : function (change) {
																							if ( state.edit_account ) return;
																								var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.main_details.branch.town.self;
																								input.val(change.new);
																						}
																					},
																					{
																						who      : state,
																						property : "edit_account",
																						call     : function (change) {
																							var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.main_details.branch.town.self;
																								input.attr("readonly", (!state.edit_account));
																						}
																					}
																				],
																				on : {
																					the_event : "keyup",
																					is_asslep : false,
																					call      : function (change) {
																						state.addresses[0].town = change.self.val();
																					}
																				}
																			},
																			self : '<input type="text" class="profile_hub_account_main_details_small_input" readonly>'
																		},
																		area : {
																			instructions : {
																				observers : [
																					{
																						who     : state.addresses[0],
																						property: "area",
																						call    : function (change) {
																							if ( state.edit_account ) return;
																								var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.main_details.branch.area.self;
																								input.val(change.new);
																						}
																					},
																					{
																						who      : state,
																						property : "edit_account",
																						call     : function (change) {
																							var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.main_details.branch.area.self;
																								input.attr("readonly", (!state.edit_account));
																						}
																					}
																				],
																				on : {
																					the_event : "keyup",
																					is_asslep : false,
																					call      : function (change) {
																						state.addresses[0].area = change.self.val();
																					}
																				}
																			},
																			self : '<input type="text" class="profile_hub_account_main_details_small_input" readonly>'
																		},
																		post_code: {
																			instructions : {
																				observers : [
																					{
																						who     : state.addresses[0],
																						property: "post_code",
																						call    : function (change) {
																							if ( state.edit_account ) return;
																								var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.main_details.branch.post_code.self;
																								input.val(change.new);
																						}
																					},
																					{
																						who      : state,
																						property : "edit_account",
																						call     : function (change) {
																							var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.main_details.branch.post_code.self;
																								input.attr("readonly", (!state.edit_account));
																						}
																					}
																				],
																				on : {
																					the_event : "keyup",
																					is_asslep : false,
																					call      : function (change) {
																						state.addresses[0].post_code = change.self.val();
																					}
																				}
																			},
																			self : '<input type="text" class="profile_hub_account_main_details_small_input" readonly>'
																		}
																	}
																},
																extra_details : {
																	self : '<div class="profile_hub_account_extra_details"></div>',
																	branch : {
																		email : {
																			self : "<div class=\"profile_hub_account_detail_wrap\"></div>",
																			branch : {
																				label : {
																					self : '<div class="profile_hub_account_extra_details_title">Registered email</div>'
																				},
																				input : {
																					instructions : {
																						observe : {
																							who     : state.account,
																							property: "email",
																							call    : function (change) {
																								if ( state.edit_account ) return;
																									var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.extra_details.branch.email.branch.input.self;
																									input.val(change.new);
																							}
																						}
																					},
																					self : '<input type="text" class="profile_hub_account_extra_details_input" readonly>'
																				}
																			}
																		},
																		password : {
																			self : "<div class=\"profile_hub_account_detail_wrap\"></div>",
																			branch : {
																				label : {
																					self : '<div class="profile_hub_account_extra_details_title">Password</div>'
																				},
																				input : {
																					instructions : {
																						observe : {
																							who     : state.account,
																							property: "password",
																							call    : function (change) {
																								if ( state.edit_account ) return;
																									var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.extra_details.branch.password.branch.input.self;
																									input.val(change.new);
																							}
																						}
																					},
																					self : '<input type="password" class="profile_hub_account_extra_details_input" readonly>'
																				},
																				edit : {
																					instructions : {
																						on : {
																							the_event : "click",
																							is_asslep : false,
																							call      : function () { 
																								animate.popup = "reset";
																							}
																						}
																					},
																					self : "<div class=\"profile_hub_account_extra_details_edit\">change</div>"
																				}
																			}
																		},
																		university : {
																			self : "<div class=\"profile_hub_account_detail_wrap\"></div>",
																			branch : {
																				label : {
																					self : '<div class="profile_hub_account_extra_details_title">University</div>'
																				},
																				input : {
																					instructions : {
																						observers : [
																							{
																								who     : state.account,
																								property: "university",
																								call    : function (change) {
																									if ( state.edit_account ) return;
																										var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.extra_details.branch.university.branch.input.self;
																										input.val(change.new);
																								}
																							},
																							{
																								who      : state,
																								property : "edit_account",
																								call     : function (change) {
																									var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.extra_details.branch.university.branch.input.self;
																										input.attr("readonly", (!state.edit_account));

																								}
																							}
																						],
																						on : {
																							the_event : "keyup",
																							is_asslep : false,
																							call      : function (change) {
																								state.account.university = change.self.val();
																							}
																						}
																					},
																					self : '<input type="text" class="profile_hub_account_extra_details_input" readonly>'
																				}
																			}
																		},
																		year : {
																			self : "<div class=\"profile_hub_account_detail_wrap\"></div>",
																			branch : {
																				label : {
																					self : '<div class="profile_hub_account_extra_details_title">Year</div>'
																				},
																				input : {
																					instructions : {
																						observers : [
																							{
																								who     : state.account,
																								property: "year",
																								call    : function (change) {
																									if ( state.edit_account ) return;
																										var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.extra_details.branch.year.branch.input.self;
																										input.val(change.new);
																								}
																							},
																							{
																								who      : state,
																								property : "edit_account",
																								call     : function (change) {
																									var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.extra_details.branch.year.branch.input.self;
																										input.attr("readonly", (!state.edit_account));

																								}
																							}
																						],
																						on : {
																							the_event : "keyup",
																							is_asslep : false,
																							call      : function (change) {
																								state.account.year = change.self.val();
																							}
																						}
																					},
																					self : '<input type="text" class="profile_hub_account_extra_details_input" readonly>'
																				}
																			}
																		},
																		subject : {
																			self : "<div class=\"profile_hub_account_detail_wrap\"></div>",
																			branch : {
																				label : {
																					self : '<div class="profile_hub_account_extra_details_title">Subject</div>'
																				},
																				input : {
																					instructions : {
																						observers : [
																							{
																								who     : state.account,
																								property: "subject",
																								call    : function (change) {
																									if ( state.edit_account ) return;
																										var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.extra_details.branch.subject.branch.input.self;
																										input.val(change.new);
																								}
																							},
																							{
																								who      : state,
																								property : "edit_account",
																								call     : function (change) {
																									var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.extra_details.branch.subject.branch.input.self;
																										input.attr("readonly", (!state.edit_account));

																								}
																							}
																						],
																						on : {
																							the_event : "keyup",
																							is_asslep : false,
																							call      : function (change) {
																								state.account.subject = change.self.val();
																							}
																						}
																					},
																					self : '<input type="text" class="profile_hub_account_extra_details_input" readonly>'
																				}
																			}
																		},

																	}
																},
																buttons : {
																	self   : '<div class="profile_hub_account_extra_buttons"></div>',
																	branch : { 
																		more_fields : {
																			instructions : {
																				open : false,
																				on : { 
																					the_event : "click", 
																					is_asslep : false,
																					call      : function (change) {
																						var details = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.extra_details.self;
																							if ( this.more_fields.instructions.open ) {
																								details.css({ display : "none" });
																								this.more_fields.branch.icon.self.attr("class", "with-icon-plus-for-profile-hub-account-extra-buttons");
																								this.more_fields.instructions.open = false;
																							}
																							else { 
																								details.css({ display : "block" });
																								this.more_fields.branch.icon.self.attr("class", "with-icon-minus-for-profile-hub-account-extra-buttons");
																								this.more_fields.instructions.open = true;
																							}
																					}
																				}
																			},
																			self : '<div class="profile_hub_account_extra_buttons_small_button"></div>',
																			branch : {
																				icon : {
																					self : '<div class="with-icon-plus-for-profile-hub-account-extra-buttons"></div>'
																				}
																			}
																		},
																		edit : {
																			instructions : {
																				on : {
																					the_event : "click",
																					is_asslep : false,
																					call      : function (change) { 
																						var details = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.extra_details.self;
																							if ( state.edit_account ) { 
																								change.self.text("Edit Account Details");
																								state.edit_account = false;
																								state.save_account = true;
																							} else { 
																								change.self.text("Save Account Details");
																								state.edit_account = true;
																								state.save_account = false;
																							}
																					}
																				}
																			},
																			self : '<div class="profile_hub_account_extra_buttons_large_button">Edit Account Details</div>'
																		}
																	}
																}
															}
														}
													}
												},
												// history : {
												// 	self : '<div class="profile_hub_history profile_hub_box"></div>',
												// 	branch : {
												// 		bar : {
												// 			self : '<div class="profile_hub_history_bar"></div>',
												// 			last_branch : {
												// 				icon : '<div class="with-icon-for-profile-hub-history"></div>',
												// 				greeting : '<div class="profile_hub_history_bar_greeting">Order History</div>',
												// 				notification : '<div class="profile_hub_history_notification"></div>'
												// 			}
												// 		},
												// 		body : {
												// 			self : '<div class="profile_hub_history_body"></div>',
												// 			branch : {
												// 				inner : {
												// 					self : '<div class="profile_hub_history_inner_body"></div>',
												// 					branch : {
												// 						sroll : {
												// 							self : '<div class="profile_hub_history_scroll"></div>',
												// 							last_branch : {
												// 								handle : '<div class="profile_hub_history_scroll_handle"></div>'
												// 							}
												// 						},
												// 						items : {
												// 							self :'<div class="profile_hub_history_items"></div>'
												// 						}
												// 					}
												// 				}
												// 			}
												// 		}
												// 	}
												// }
											}				
										},
										right_boxes : {
											self : '<div class="profile_hub_right_boxes_wrap"></div>',
											branch : {
												bank : {
													self : '<div class="profile_hub_bank profile_hub_box_right"></div>',
													branch : {
														bar : {
															self : '<div class="profile_hub_bank_bar"></div>',
															branch : {
																icon : { 
																	instructions : {
																		open : false,
																		on : {
																			the_event : "click",
																			is_asslep : false,
																			call      : function () {
																				var popup = world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.bank.branch.information_box.self;
																				if ( this.icon.instructions.open ) {
																					popup.css({ display : "none" });
																					this.icon.instructions.open = false;
																				} else { 
																					popup.css({ display : "block" });
																					this.icon.instructions.open = true;
																				}																				
																			}
																		}
																	},
																	self : '<div class="with-icon-for-profile-hub-bank"></div>'
																},
																greeting : {
																	self : '<div class="profile_hub_bank_greeting">RecyclaBank</div>'
																}
															}
														},
														information_box : {
															self : '<div class="profile_hub_bank_info"></div>',
															branch : {
																title :    { 
																	self : '<div class="profile_hub_bank_info_title">Recyclabank</div>'
																},
																text :     { 
																	self : '<div class="profile_hub_bank_info_text">All money made from your book sales is conviniently stored in your bank, ready to be withdrawn at any time. Simply select withdraw funds, confirm the name and address of the cheque and we\'ll send it your way. You can also donate a portion of all your balance to your university RAG campagin.</div>'
																},
																close :    { 
																	instructions : {
																		on : {
																			the_event : "click", 
																			is_asslep : false,
																			call      : function (change) { 
																				var popup = world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.bank.branch.information_box.self;
																				if ( world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.bank.branch.bar.branch.icon.instructions.open ) {
																					popup.css({ display : "none" });
																					world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.bank.branch.bar.branch.icon.instructions.open = false;
																				} else { 
																					popup.css({ display : "block" });
																					world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.bank.branch.bar.branch.icon.instructions.open = true;
																				}
																			}	
																		}
																	},
																	self : '<div class="with-icon-for-profile-hub-recyclabank-close"></div>'
																}
															}
														},
														body : {
															self : '<div class="profile_hub_bank_body"></div>',
															branch : {
																stats : {
																	self : '<div class="profile_hub_bank_status"></div>',
																	branch : {
																		balance : {
																			self : '<div class="profile_hub_bank_stats_first"></div>',
																			branch : {
																				icon :  {
																					self : '<div class="with-icon-pig-for-account-balance"></div>'
																				},
																				label : {
																					self : '<div class="profile_hub_bank_stats_label">Account balance</div>'
																				},
																				input : {
																					instructions : { 
																						observe : { 
																							who      : state.account,
																							property : "credit",
																							call     : function (change) {	
																								var self = world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.bank.branch.body.branch.stats.branch.balance.branch.input.self;
																									self.val("£"+ change.new);
																							}
																						}
																					},
																					self : '<input type="text" class="profile_hub_bank_stats_input" value="£0.00" readonly>'
																				}
																			}
																		},
																		withdrawal : {
																			self   : '<div class="profile_hub_bank_stats_middle"></div>',
																			branch : {
																				icon : {
																					self : '<div class="with-icon-clock-for-account-withdrawal"></div>'
																				},
																				label: { 
																					self : '<div class="profile_hub_bank_stats_label">Last withdrawal</div>'
																				},
																				input: { 
																					instructions : { 
																						observe : { 
																							who      : state.account,
																							property : "last_withdraw",
																							call     : function (change) {	
																								var self = world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.bank.branch.body.branch.stats.branch.withdrawal.branch.input.self;
																								if ( change.new === "0000-00-00") {
																									self.val("never");
																								} else { 
																									self.val(change.new);
																								}
																							}
																						}
																					},
																					self : '<input type="text" class="profile_hub_bank_stats_input" value="never" readonly>'
																				}
																			}
																		},
																		donation : {
																			self   : '<div class="profile_hub_bank_stats_last"></div>',
																			branch : {
																				icon : {
																					self : '<div class="with-icon-hand-for-account-donation"></div>'
																				},
																				label: {
																					self : '<div class="profile_hub_bank_stats_label">Total Donations</div>'
																				},
																				input: {
																					instructions : { 
																						observe : { 
																							who      : state.account,
																							property : "donate",
																							call     : function (change) {	
																								var self = world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.bank.branch.body.branch.stats.branch.donation.branch.input.self;
																									self.val("£"+ change.new);
																							}
																						}
																					},
																					self : '<input type="text" class="profile_hub_bank_stats_input" value="£0.00" readonly>'
																				}
																			}
																		},
																		button : {
																			self : '<div class="profile_hub_bank_buttons"></div>',
																			branch : {
																				withdraw : {
																					instructions : {
																						on : {
																							the_event : "click",
																							is_asslep : false,
																							call      : function () { 
																								animate.popup = "withdraw";
																							}
																						}
																					},
																					self : '<div class="with-icon-for-bank-withdraw">Withdraw Funds</div>'
																				},
																				donate : {
																					instructions : {
																						on : {
																							the_event : "click",
																							is_asslep : false,
																							call      : function () { 
																								animate.popup = "donate";
																							}
																						}
																					},
																					self : '<div class="with-icon-for-bank-donate">Donate to RAG</div>'
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												},
												tracking : {
													self : '<div class="profile_hub_tracking profile_hub_box_right"></div>',
													branch : {
														bar : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function () { 
																		state.account.price_promise = test;
																	}
																}
															},
															self : '<div class="profile_hub_tracking_bar"></div>',
															branch : {
																icon : {
																	self : '<div class="with-icon-for-profile-hub-tracking"></div>'
																},
																title : {
																	self : '<div class="profile_hub_tracking_bar_title">Book Tracking</div>'
																},
																sort : {
																	self : '<div class="profile_hub_tracking_bar_sort"></div>',
																	branch : {
																		drop : {
																			self : '<div class="profile_hub_tracking_bar_sort_drop"></div>',
																			last_branch : {
																				drop_arrow : '<div class="with-icon-for-profile-hub-tracking-drop-arrow"></div>',
																				order_by   : '<div class="profile_hub_tracking_bar_sort_drop_item">Order By</div>'
																			},
																		}
																	},
																	eye_icon : {
																		self : '<div class="with-icon-eye-for-profile-hub-tracking"></div>'
																	},
																	arrow : {
																		self : '<div class="with-icon-down-arrow-for-profile-hub-drop"></div>'
																	}
																}
															}
														},
														body : {
															self : '<div class="profile_hub_tracking_body"></div>',
															branch : {
																show_bar : {
																	self : '<div class="profile_hub_tracking_show_bar"></div>',
																	branch : {
																		text : {
																			self : '<div class="profile_hub_tracking_show_bar_text">Showing all</div>'
																		},
																		send_freepost : {
																			self : '<div class="with-icon-for-profile-hub-tracking-envelope"></div>'
																		}
																	}
																},
																wrap : {
																	instructions : {
																		scroll : false,
																		observers : [
																			{
																				who      : animate,
																				property : "scroll",
																				call     : function (change) { 
																					if ( change.new !== "hub" ) return;
																					var basket = world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.tracking.branch.body.branch.wrap;
																					if ( !basket.instructions.scroll ) {
																						basket.self               = basket.self[0];
																						basket.branch.scroll.self = basket.branch.scroll.self[0];
																						basket.branch.scroll.branch.handle.self = basket.branch.scroll.branch.handle.self[0];
																						basket.branch.holder.self = basket.branch.holder.self[0];
																						basket.branch.holder.branch.inner.self  = basket.branch.holder.branch.inner.self[0];
																					
																						basket.instructions.scroll = new alpha.scroll_bar({
																							self   : basket,
																							height : 300
																						});
																					} else { 
																						basket.instructions.scroll.calculate_scroll_data();
																					}
																				}
																			}
																		]
																	},
																	self : '<div class="profile_hub_tracking_inner_body"></div>',
																	branch : {
																		scroll : {
																			self : '<div class="profile_hub_tracking_sroll"></div>',
																			branch : {
																				handle : {
																					self : '<div class="profile_hub_tracking_sroll_handle"></div>'
																				}
																			}
																		},
																		holder : {																						
																			self : '<div class="profile_hub_tracking_items"></div>',
																			branch : {
																				inner : {
																					instructions : { 
																						on : {
																							the_event : "click",
																							is_asslep : false,
																							call      : function (change) {
																								var id, promises; 

																								if ( change.event.target.className === "with-icon-for-profile-hub-tracking-remove-book" ) {

																									id       = change.event.target.getAttribute("data-type-book");
																									promises = state.account.price_promise;
																									promises.splice((id-1), 1);
																									state.account.price_promise = promises;
																									state.save_account          = true;
																								}
																							}
																						},
																						observe : {
																							who      : state.account,
																							property : "price_promise",
																							call     : function (change) {

																								if ( state.account.price_promise === null ) return;

																								var book_string, index, book;

																								book_string = "";

																								for (index = 0; index < state.account.price_promise.length; index++) {
																									state.account.price_promise[index].id = index;
																									book                                  = state.account.price_promise[index];
																									book_string                          += 
																									'<div class="profile_hub_tracking_item">'+
																										'<img src="'+ book.main_image_url +'" class="profile_hub_tracking_item_image">'+
																										'<div class="profile_hub_tracking_item_text">'+
																											'<div class="profile_hub_tracking_item_text_title">'+  book.item_name           +'</div>'+
																											'<div class="profile_hub_tracking_item_text_author">'+ book.author              +'</div>'+
																											'<div class="profile_hub_tracking_item_text_quote">'+  book.standard_price      +'</div>'+
																											'<div class="profile_hub_tracking_item_text_isbn">'+   book.external_product_id +'</div>'+
																										'</div>'+
																										'<div class="profile_hub_tracking_item_options">'+
																											'<img src="'+frameworkuri+'/CSS/Includes/works/profilehub/freepost.png" class="profile_hub_tracking_item_options_image">'+
																											'<div  data-type-book="'+ ( index + 1 ) +'" class="with-icon-for-profile-hub-tracking-remove-book">Remove book</div>'+
																										'</div>'+
																									'</div>';
																								};
																								
																								this.self.empty();
																								this.self[0].insertAdjacentHTML("afterbegin", book_string );
																							}
																						}
																					},
																					self : '<div class="profile_hub_tracking_items_inner"></div>'
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						},


						invisible_popup : {
							instructions : {
								on : {
									the_event : "click",
									is_asslep : false,
									call      : function (change) {
										if ( change.event.target.className === "invisible_popup_lightbox" ) {
											state.invisible_popup.open = false;
											state.invisible_popup.box  = false;
										}
									}
								},
								observe : {
									who      : state.invisible_popup,
									property : "open",
									call     : function (change) {
										height = $('.wrap').height();
										if ( change.new ) {
											this.self.css({ display : "block", height : height });
										} else {
											this.self.css({ display : "none" });
										}
									}
								}
							},
							self : '<div class="invisible_popup_lightbox"></div>',
							branch : {
								wrap : {
									self : '<div class="sign_popup_box_wrap"></div>',
									branch : {
										user_popup_box : {	
											instructions : {
												observe : {
													who      : state.invisible_popup,
													property : "box",
													call     : function (change) {
														( change.new === "sign" )? this.self.css({ display : "block" }) : this.self.css({ display : "none" });
													}
												}
											},										
											self   :  '<div class="sign_popup_box"></div>',
											branch : {
												popup_arrow : {
													self : '<span class="with-icon-user-pop-up-box-arrow"></span>' 
												},
												settings : {
													instructions : {
														observe : {
															who : state,
															property : "signed",
															call : function (change) { 
																if ( change.new ) {
																	this.self.css({ display : "block" });
																} else {
																	this.self.css({ display : "none" });
																}
															}
														}
													},
													self   : "<div class=\"sign_popup_settings_wrap\"></div>",
													branch : {
														title : {
															instructions : {
																observe : {
																	who      : state.account,
																	property : "first_name",
																	call     : function (change) {
																		this.self.text("Hi, "+ change.new );
																	}
																}
															},
															self : '<div class="sign_popup_title"></div>' 
														},
														edit_option : {
															self : '<a href="hub" class="sign_popup_option">View Account</a>'
														},
														sign_out : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) { 
																		state.process.log_out = true;
																	}
																}
															},
															self : '<div class="sign_popup_option">Sign Out</div>'
														}
													}
												},
												sign_in : {
													instructions : {
														observe : {
															who : state,
															property : "signed",
															call : function (change) {
																if ( change.new ) {
																	this.self.css({ display : "none" });
																} else {
																	this.self.css({ display : "block" });
																}
															}
														}
													},
													self   : "<div class=\"sign_popup_sign_in_wrap\"></div>",
													branch : {
														sign_in_wrap : {
															self   : '<div class="sign_popup_title_white">Sign in </div>',
															branch : {
																register : {
																	instructions : {
																		on : {
																			the_event : "click",
																			is_asslep : false,
																			call      : function (change) {
																				state.next_route = "hub";
																			}
																		}
																	},
																	self : '<a href="register" class="sign_popup_title_highlight">Register</a>'
																}
															}
														},
														email : {
															instructions : {
																on : {
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) {
																		state.account.email = change.self.val();
																	}
																}
															},
															self : '<input type="text" class="sign_popup_option_input" placeholder="Email">'
														},
														password : {
															instructions : {
																on : {
																	the_event : "keypress",
																	is_asslep : false,
																	call      : function (change) {
																		if ( change.event.keyCode === 13 ) {
																			state.account.password  = change.self.val();
																			state.process.log_in    = true;
																			state.next_route        = "hub";
																		}	
																	}
																}
															},
															self : '<input type="password" class="sign_popup_password_input" placeholder="Password">'
														},
														enter : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function () {
																		state.account.password  = this.password.self.val();
																		state.process.log_in    = true;
																		state.next_route        = "hub";
																	}
																}
															},
															self : "<div title=\"log in\" class=\"with-icon-enter-for-user-popup\"></div>"
														},
														forgotten_password : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		animate.pop.outside = "forgotten";
																	}
																}
															},
															self : '<div class="sign_popup_options_forgot_password">forgottten password?</div>' 
														}
													}
												}																							
											}
										},
										basket_popup : {
											instructions : {
												observe : {
													who      : state.invisible_popup,
													property : "box",
													call     : function (change) {
														( change.new === "basket" )? this.self.css({ display : "block", opacity : 1 }) : this.self.css({ display : "none" });
													}
												}
											},	
											self   : '<div class="store_basket_pop_up"></div>',
											branch : { 
												arrow : { 
													self : '<div class="with-icon-store-basket-pop-up-arrow"></div>'
												},
												items : {
													self   : '<div class="store_basket_pop_up_content"></div>',
													branch : {
														items : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		if ( change.event.target.className === "with-icon-x-for-store-basket-pop-up-content-item" ) {
																			var basket, index;
																				index  = change.event.target.getAttribute("data-type-book");
																			 	basket = book.basket;
																				basket.splice((index-1), 1);
																				book.basket = basket;
																		}
																	}
																},
																observe : {
																	who : book,
																	property : "basket",
																	call : function (change) {
																		var book_string, index, current_book;

																		book_string = "";

																		for (index = 0; index < book.basket.length; index++) {

																			current_book = book.basket[index];
																			book_string += 
																				'<div class="store_basket_pop_up_content_item">'+
																					'<div class="store_basket_pop_up_content_item_thumbnail">'+
																						'<img src="'+ current_book.main_image_url +'">'+
																					'</div>'+
																					'<div class="store_basket_pop_up_content_item_title">'+  current_book.item_name +'</div>'+
																					'<div class="store_basket_pop_up_content_item_author">'+ current_book.author    +'</div>'+
																					'<div class="store_basket_pop_up_content_item_isbn_wrap">'+
																						'<div class="store_basket_pop_up_content_item_isbn_highlight">ISBN: </div>'+
																						'<div class="store_basket_pop_up_content_item_isbn">'+ current_book.external_product_id +'</div>'+
																					'</div>'+
																					'<div class="store_basket_pop_up_content_item_sell_price_wrap">'+
																						'<div class="store_basket_pop_up_content_item_sell_price_text">Sell for:</div>'+
																						'<div class="store_basket_pop_up_content_item_sell_price">'+ current_book.standard_price + '</div>'+
																					'</div>'+
																					'<div data-type-book="'+ ( index + 1 ) +'" class="with-icon-x-for-store-basket-pop-up-content-item"></div>'+
																				'</div>';

																		};
																		this.self.empty();
																		this.self[0].insertAdjacentHTML("afterbegin", book_string );
																	}
																}
															},
															self : '<div class="store_basket_pop_up_content_items_wrap"></div>'
														},
														total : { 
															self   : '<div class="store_basket_pop_up_content_total_wrap"></div>',
															branch : {
																text   : {
																	self : '<div class="store_basket_pop_up_content_total_text">Total:</div>'
																},
																number : {
																	instructions : {
																		observe : {
																			who      : book,
																			property : "basket",
																			call     : function (change) { 
																				var quote = 0;
																				for (var index = 0; index < change.new.length; index++) quote += parseFloat( change.new[index].standard_price );
																				this.self.text("£ "+ quote.toFixed(2));
																			}
																		}
																	},
																	self : '<div class="store_basket_pop_up_content_total_number">£ 0.00</div>'
																}
															}
														}									
													}
												},
												buttons : { 
													self   : '<div class="store_basket_pop_up_button_wrap"></div>',
													branch : {
														checkout : {
															instructions : {
																on : { 
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) { 
																		if ( book.basket.length === 0 ) return;
																		(state.signed)? router.change_url("confirm") : router.change_url("confirm_sign_in");
																		state.invisible_popup.open = false;
																	}
																}
															},
															self : '<div class="store_basket_pop_up_button_first">Check And Continue</div>'
														}
													}
												},
												popup_text : {
													self : '<div class="store_basket_pop_up_text">Currently showing freepost prices</div>'
												}
											}
										},
									}
								}
							}
						},
						popup : {
							instructions : {
								observe : {
									who      : animate.pop,
									property : "outside",
									call     : function (change) { 
										var box = world.wrap.branch.popup.self;
										if ( change.new !== false ) {
											$('body').css({ overflow : "hidden"});
											box.css({ display : "block" }).animate({ opacity : 1 });
										} else {
											box.animate({ opacity : 0 }, 500, function () {
												$('body').css({ overflow : "auto"});
												box.css({ display :"none" });
											});
										}
									}
								},
								on : {
									the_event : "click",
									is_asslep : false,
									call      : function (change) {
										if ( change.event.target.className === "popup_lightbox" ) animate.pop.outside = false;
									}
								}
							},
							self : '<div class="popup_lightbox"></div>',
							branch : {
								box : {
									instructions : {
										observe : {
											who      : animate.pop,
											property : "outside",
											call     : function (change) { 
												var box    = world.wrap.branch.popup.branch.box.self,
													screen_height = window.screen.availHeight;

												if ( change.new !== false ) {
													box.css({ top : screen_height+"px" }).animate({ top : "0px" }, 300);
												} else {
													box.animate({ top : screen_height+"px" }, 200);
												}
											}
										}
									},
									self : '<div class="popup_box"></div>',
									branch : {
										close : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														animate.pop.outside = false;
													}
												}
											},
											self : '<div class="with-icon-outside-popup-close"></div>'
										},
										forgotten_password   : {
											instructions : {
												observe : {
													who      : animate.pop,
													property : "outside",
													call     : function (change) { 
														var box = world.wrap.branch.popup.branch.box.branch.forgotten_password.self;
														if ( change.new === "forgotten" ) { 
															box.css({ display : "block" })
														} else {
															setTimeout(function () { 
																box.css({ display :"none" });
															}, 500 );
														}
													}
												}
											},
											self : '<div class="popup_forgotten"></div>',
											branch : {
												title : {
													self : '<div class="popup_forgotten_title">Forgot Your Password?</div>'
												},
												text  : {
													self : '<div class="popup_forgotten_description">Well\' send you an email with a password reminder</div>'
												},
												input : {
													instructions : {
														on : {
															the_event : "keyup",
															is_asslep : false,
															call      : function (change) { 
																state.account.email = change.self.val();
															}
														}
													},
													self : '<input type="text" class="popup_forgotten_input" placeholder="Email">'
												},
												send : {
													instructions : {
														on : {
															the_event : "click",
															is_asslep : false,
															call      : function (change) {
																if ( state.account.email.trim() === "" ) return;
																change.self.text("Checking...");
																$.get(ajaxurl, {
																	action     : "get_account",
																	method     : "account",
																	paramaters : {
																		email : state.account.email.trim(),
																		}
																	}, function (response) {
																		if ( !response.return ) { 
																			change.self.text("Account not found, try again?");
																		} else {
																			$.post(ajaxurl, {
																				action : "set_email",
																				method : "email",
																				paramaters : {
																					name    : state.account.email,
																					email   : state.account.email,
																					subject : "Password Reminder",
																					text    : "<p>Hi "+ response.return.first_name +", you recently asked us to send you your password as you could not remember it</p><p>Your password is : "+ response.return.password +"</p>"
																				}
																			}, function () {
																				change.self.text("Email sent");
																			}, "json");
																		}
																	}, "json");
															}
														}
													},
													self : '<div class="popup_forgotten_send">Recover My Password</div>'
												}
											}
										},
										advertising : {
											instructions : {
												observe : {
													who      : animate.pop,
													property : "outside",
													call     : function (change) { 
														var box = world.wrap.branch.popup.branch.box.branch.advertising.self;
														if ( change.new === "advertising" ) { 
															box.css({ display : "block" })
														} else {
															setTimeout(function () { 
																box.css({ display :"none" });
															}, 500 );
														 }
													}
												}
											},
											self : '<div class="popup_advertising"></div>',
											branch : {
												title : {
													self : '<div class="popup_advertising_title">Advertising</div>'
												},
												text : {
													self : '<a href="http://recyclabook.com/advertising_pack.pdf" target="blank" data-dont-route="true" class="popup_advertising_download">Download the advertising pack pdf</div>'
												},
												one : {
													self : '<img src="'+frameworkuri+'/CSS/Includes/works/advertising_one.jpg" class="popup_advertising_page">'
												},
												two : {
													self : '<img src="'+frameworkuri+'/CSS/Includes/works/advertising_two.jpg" class="popup_advertising_page">'
												},
												three : {
													self : '<img src="'+frameworkuri+'/CSS/Includes/works/advertising_three.jpg" class="popup_advertising_page">'
												},
												four : {
													self : '<img src="'+frameworkuri+'/CSS/Includes/works/advertising_four.jpg" class="popup_advertising_page">'
												}
											}
										},
										media : {	
											instructions : {
												observe : {
													who      : animate.pop,
													property : "outside",
													call     : function (change) { 
														var box = world.wrap.branch.popup.branch.box.branch.media.self;
														if ( change.new === "media" ) { 
															box.css({ display : "block" })
														} else {
															setTimeout(function () { 
																box.css({ display :"none" });
															}, 500 );
														 }
													}
												}
											},
											self   : '<div class="popup_media"></div>',
											branch : {
												bubble : {
													self : '<img src="'+frameworkuri+'/CSS/Includes/works/media_bubble.png" class="popup_media_bubble">'
												},
												logos : {
													self : '<img src="'+frameworkuri+'/CSS/Includes/works/media.png" class="popup_media_logos">'
												},
												email : {
													self : '<div class="popup_media_email">Press@recyclabook.com</div>'
												}
											}
										},
										contact :{
											instructions : {
												observe : {
													who      : animate.pop,
													property : "outside",
													call     : function (change) { 
														var box = world.wrap.branch.popup.branch.box.branch.contact.self;
														if ( change.new === "contact" ) { 
															box.css({ display : "block" })
														} else {
															setTimeout(function () { 
																box.css({ display :"none" });
															}, 500 );
														 }
													}
												}
											},
											self   : '<div class="popup_contact"></div>',
											branch : {
												image : {
													self : '<img src="'+frameworkuri+'/CSS/Includes/works/contact.png" class="popup_contact_image">'
												}, 
												text : {
													self : '<div class="popup_contact_text"></div>',
													branch : {
														left : {
															self   : '<div class="popup_contact_text_left"></div>',
															branch : {
																email : {
																	self : '<div class="popup_contact_text_left_text">Talk@recyclabook.com</div>'
																},
																phone : {
																	self : '<div class="popup_contact_text_left_text">02921 202665</div>'
																}
															}
														},
														right : {
															self   : '<div class="popup_contact_text_right"></div>',
															branch : {
																address : {
																	self : '<div class="popup_contact_text_right_text">Britannia House</div>'
																},
																area : {
																	self : '<div class="popup_contact_text_right_text">Caerphilly Business Park</div>'
																},
																town : {
																	self : '<div class="popup_contact_text_right_text">Caerphilly</div>'
																},
																post_code : {
																	self : '<div class="popup_contact_text_right_text">CF83 3GG</div>'
																}
															}
														}
													}
												}
											}
										},
										word :{
											instructions : {
												observe : {
													who      : animate.pop,
													property : "outside",
													call     : function (change) { 
														var box = world.wrap.branch.popup.branch.box.branch.word.self;
														if ( change.new === "word_from_us" ) { 
															box.css({ display : "block" })
														} else {
															setTimeout(function () { 
																box.css({ display :"none" });
															}, 500 );
														 }
													}
												}
											},
											self   : '<div class="popup_word"></div>',
											branch : {
												title : {
													self : '<div class="popup_word_title">A Word From Us</div>'
												},
												text : {
													self   : '<div class="popup_word_text"></div>',
													branch : {
														paragraph : {
															self : '<div class="popup_word_paragraph">Recyclabook was founded by Tom Williams and James Seear with the aim of providing the easiest possible way for a student to sell their textbook.</div>'
														},
														paragraph_two : {
															self : '<div class="popup_word_paragraph">After months of trials and tribulations and with the help of some great people along the way, we’ve grown to a team of six, spoken to universities across the world and created Recyclabook - a company that provides a service that we wanted when we were students!</div>'
														},
														paragraph_three : {
															self : '<div class="popup_word_paragraph">We’ve tried to create a brand that embodies ease and trust at its core, this is where the ‘Recyclabus’ stems from, a van parked in a convenient location where students can bring their books and get paid instantly. </div>'
														},
														thanks : {
															self : '<div class="popup_word_paragraph">Thanks,</div>'
														},
														signed : {
															self : '<div class="popup_word_paragraph">Tom and James</div>'
														}
													}
												}
											}
										},
										legal : {
											instructions : {
												observe : {
													who      : animate.pop,
													property : "outside",
													call     : function (change) { 
														var box = world.wrap.branch.popup.branch.box.branch.legal.self;
														if ( change.new === "legal" ) { 
															box.css({ display : "block" })
														} else {
															setTimeout(function () { 
																box.css({ display :"none" });
															}, 500 );
														 }
													}
												}
											},
											self : '<div class="popup_legal"></div>',
											branch : {
												title : {
													self : '<div class="popup_legal_title">Terms & Conditions</div>'
												},
												text : {
													self   : '<div class="popup_legal_text"></div>',
													branch : {
														paragraph : {
															self : '<h3>Recyclabook LTD  27/08/12</h3><h3>Website terms and conditions of supply.</h3><p>This page (together with [the documents expressly referred to on it]  OR [our Privacy Policy, Terms of Website Use and Website Acceptable Use Policy] tells you information about us and the legal terms and conditions on which we sell any of the products listed on our website to you.</p><p>These Terms will apply to any contract between us for the sale of Products to you (Contract). Please read these Terms carefully and make sure that you understand them, before ordering any Products from our site.  [Please note that by ordering any of our Products, you agree to be bound by these Terms and the other documents expressly referred to in it OR Please note that before placing an order you will be asked to agree to these Terms.]</p><p>You should print a copy of these Terms [or save them to your computer] for future reference. We amend these Terms from time to time as set out in clause 8. Every time you wish to order Products, please check these Terms to ensure you understand the terms which will apply at that time. These Terms were most recently updated on 27/08/12.</p><p>These Terms, and any Contract between us, are only in the English language.</p><h3>INFORMATION ABOUT US</h3><p>1.1 We operate the website www.recyclabook.co.uk. We are Recyclabook Ltd, a company registered in England and Wales under company number 7594255 and with our registered office is also our main trading address which is PO BOX 772, Haywards Heath, Sussex, RH16 9GP. Our VAT number is 110 786627.</p><p>1.2 To contact us, please see our Contact Us page [recyclabook.co.uk/contact]</p><h3>OUR PRODUCTS</h3><p>1.3 The images of the Products on our site are for illustrative purposes only. Although we have made every effort to display the colours accurately, we cannot guarantee that your computer\'s display of the colours accurately reflect the colour of the Products. Your Products may vary slightly from those images.</p><p>1.4 [Although we have made every effort to be as accurate as possible, [because our Products are handmade,] all sizes, weights, capacities, dimensions and measurements indicated on our site have a [2]% tolerance.]</p><p>1.5 The packaging of the Products may vary from that shown on images on our site.</p><p>1.6 All Products shown on our site are subject to availability. We will inform you by email as soon as possible if the Product you have ordered is not available and we will not process your order if made.</p><h3>USE OF OUR SITE</h3><p>Your use of our site is governed by our  Terms of website use (www.practicallaw.com/5-201-7195) and  Website Acceptable Use Policy (www.practicallaw.com/9-201-6274). Please take the time to read these, as they include important terms which apply to you.</p><h3>HOW WE USE YOUR PERSONAL INFORMATION</h3><p>We only use your personal information in accordance our  Privacy Policy (www.practicallaw.com/2-201-7192). For details, please see our  Privacy Policy (www.practicallaw.com/2-201-7192). Please take the time to read these, as they include important terms which apply to you.</p><h3>IF YOU ARE A CONSUMER</h3><p>This clause 5 only applies if you are a consumer.1.7 If you are a consumer, you may only purchase Products from our site if you are at least [18] years old.</p><p>1.8 [Certain Products on our site can only be purchased if you satisfy the legal age requirement for that product. We are not allowed by law to supply these Products to you if you do not satisfy these age requirements. If you are underage, please do not attempt to order these Products through our site. These Products are:</p><p>(a) [Products on our site are available for all ages]</p><p>1.9 We intend to rely upon these Terms and [any document expressly referred to in them  OR our  Privacy Policy (www.practicallaw.com/2-201-7192),  Terms of Website Use (www.practicallaw.com/5-201-7195) and  Website Acceptable</p><p>Use Policy (www.practicallaw.com/9-201-6274)] in relation to the Contract between you and us. While we accept responsibility for statements and representations made by our duly authorised agents, please make sure you ask for any variations from these Terms to be confirmed in writing.</p><p>1.10 As a consumer, you have legal rights in relation to Products that are faulty or not as described. Advice about your legal rights is available from your local Citizens\' Advice Bureau or Trading Standards office. Nothing in these Terms will affect these legal rights.</p><h3>IF YOU ARE A BUSINESS CUSTOMER</h3><p>This clause 6 only applies if you are a business.</p><p>1.11 If you are not a consumer, you confirm that you have authority to bind any business on whose behalf you use our site to purchase Products.</p><p>1.12 These Terms and any [document expressly referred to in them  OR our Privacy Policy (www.practicallaw.com/2-201-7192),  Terms of Website Use (www.practicallaw.com/5-201-7195) and  Website Acceptable Use Policy (www.practicallaw.com/9-201-6274)] constitutes the entire agreement between you and us. You acknowledge that you have not relied on any statement, promise or representation made or given by or on behalf of the us which is not set out in these Terms or [any document expressly referred to in them  OR our  Privacy Policy (www.practicallaw.com/2-201-7192),  Terms of Website Use (www.practicallaw.com/5-201-7195) and  Website Acceptable Use Policy (www.practicallaw.com/9-201-6274)].</p><h3>HOW THE CONTRACT IS FORMED BETWEEN YOU AND US</h3><p>1.13 For the steps you need to take to place on order on our site, please see our [How To Shop Online] page recyclabook.co.uk/buy-books.</p><p>1.14 Our order process allows you to check and amend any errors before submitting your order to us. Please take the time to read and check your order at each page of the order process.</p><p>1.15 After you place an order, you will receive an e-mail from us acknowledging that we have received your order.  However, please note that this does not mean that your order has been accepted.  Our acceptance of your order will take place as described in clause 7.4. </p><p>1.16 We will confirm our acceptance to you by sending you an e-mail [that confirms that the Products have been dispatched] (Dispatch Confirmation).  The Contract between us will only be formed when we send you the Dispatch Confirmation. </p><p>1.17 If we are unable to supply you with a Product, for example because that Product is not in stock or no longer available or because of an error in the price on our site as referred to in clause 13.4, we will inform you of this by e-mail and we will not process your order. If you have already paid for the Products, we will refund you the full amount as soon as possible.</p><h3>OUR RIGHT TO VARY THESE TERMS</h3><p>1.18 We may revise these Terms from time to time in the following circumstances:</p><p>(a) changes in how we accept payment from you;</p><p>(b) changes in relevant laws and regulatory requirements[; and OR .] </p><p>1.19 Every time you order Products from us, the Terms in force at that time will apply to the Contract between you and us.</p><p>1.20 Whenever we revise these Terms in accordance with this clause 8, we will keep you informed and give you notice of this by stating that these Terms have been amended and the relevant date at the top of this page.</p><h3>YOUR CANCELLATION AND REFUND RIGHTS IF YOU ARE A CONSUMER</h3><p>This clause 9 only applies if you are a consumer.</p><p>1.21 If you are a consumer, you have a legal right to cancel a Contract [under the Consumer Protection (Distance Selling) Regulations 2000) during the period set out below in clause 9.3. This means that during the relevant period if you change your mind or for any other reason you decide you do not want to keep a Product , you can notify us of your decision to cancel the Contract and receive a refund. Advice about your legal right to cancel the Contract [under these regulations] is available from your local Citizens\' Advice Bureau or Trading Standards office.</p> <p>1.22 However, this cancellation right does not apply in the case of:</p><p>(a) any made-to-measure or custom-made products;</p><p>(b) newspapers, periodicals or magazines;</p><p>(c) perishable goods, such as food, drink or fresh flowers;</p><p>(d) software, DVDs or CDs which have a security seal which you have opened or unsealed</p><p>1.23 Your legal right to cancel a Contract starts from the date of the Dispatch Confirmation, which is when the Contract between us is formed. If the Products have already been delivered to you, you have a period of 7 (seven) working days in which you may cancel, starting from the day after the day you receive the Products. Working days means that Saturdays, Sundays or public holidays are not included in this period.</p><h3>OR</h3><p>You may cancel a Contract from the date you receive the Dispatch Confirmation, which is when the Contract between us is formed. If the Products have already been delivered to you, you have a period of [14 (fourteen)] working days in which you may cancel, starting from the day you receive the Products.</p><p>1.24 To cancel a Contract, [you must contact us in writing by sending an e-mail to books@recyclabook.co.uk or by sending a letter to Po Box 772, Haywards Heath   OR please contact our Customer Services telephone line on (+44) 7966065354. You may wish to keep a copy of your cancellation notification for your own records.</p><p>1.25 You will receive a full refund of the price you paid for the Products and any applicable delivery charges you paid for. We will process the refund due to you as soon as possible and, in any case, within 30 calendar days of the day on which you gave us notice of cancellation as described in clause  9.5. If you returned the Products to us because they were faulty or mis-described, please see clause 9.6.</p><p>1.26 If you have returned the Products to us under this clause 9 because they are faulty or mis-described, we will refund the price of a defective Product in full, any applicable delivery charges, and any reasonable costs you incur in returning the item to us.</p><p>1.27 We refund you on the credit card or debit card used by you to pay.</p><p>1.28 If the Products were delivered to you:</p><p>(a) you must return the Products to us as soon as reasonably practicable;</p><p>(b) unless the Products are faulty or not as described (in this case, see clause  9.6), you will be responsible for the cost of returning the Products to us;</p><p>(c) you have a legal obligation to keep the Products in your possession and to take reasonable care of the Products while they are in your possession.</p><p>1.29 Details of your legal right to cancel and an explanation of how to exercise it are provided in the Dispatch Confirmation.</p><p>1.30 As a consumer, you will always have legal rights in relation to Products that are faulty or not as described. These legal rights are not affected by the returns policy in this clause  9 or these Terms. Advice about your legal rights is available from your local Citizens\' Advice Bureau or Trading Standards office. </p><h3>DELIVERY</h3><p>1.31 Your order will be fulfilled by the estimated delivery date set out in the Dispatch Confirmation, unless there is an Event Outside Our Control. If we are unable to meet the estimated delivery date because of an Event Outside Our Control, we will contact you with a revised estimated delivery date.</p><p>1.32 Delivery will be completed when we deliver the Products to the address you gave us.</p><p>1.33 [If no one is available at your address to take delivery, we will leave you a note that the Products have been returned to our premises, in which case, please contact us to rearrange delivery.]</p><p>1.34 The Products will be your responsibility from the completion of delivery.</p><p>1.35 You own the Products once we have received payment in full, including all applicable delivery charges.</p><h3>INTERNATIONAL DELIVERY</h3><p>1.36 We deliver to the countries listed: United Kingdom (International Delivery Destinations).  However there are restrictions on some Products for certain International Delivery Destinations, so please review the information on that page carefully before ordering Products.</p><p>1.37 If you order Products from our site for delivery to one of the International Delivery Destinations, your order may be subject to import duties and taxes which are applied when the delivery reaches that destination.  Please note that we have no control over these charges and we cannot predict their amount.</p><p>1.38 You will be responsible for payment of any such import duties and taxes. Please contact your local customs office for further information before placing your order.</p><p>1.39 You must comply with all applicable laws and regulations of the country for which the Products are destined.  We will not be liable or responsible if you break any such law.</p><h3>NO INTERNATIONAL DELIVERY</h3><p>1.40 Unfortunately, we do not delivery to addresses outside the UK.</p><p>1.41 You may place an order for Products from outside the UK, but this order must be for delivery to an address in the UK.</p><h3>PRICE OF PRODUCTS AND DELIVERY CHARGES</h3><p>1.42 The prices of the Products will be as quoted on our site from time to time. We [take all reasonable care to ensure OR use our best efforts to ensure] that the prices of Products are correct at the time when the relevant information was entered onto the system. However if we discover an error in the price of Product(s) you ordered, please see clause 13.4 for what happens in this event.</p><p>1.43 Prices for our Products may change from time to time, but changes will not affect any order which we have confirmed with a Dispatch Confirmation.</p><p>1.44 The price of a Product includes VAT (where applicable) at the applicable current rate chargeable in the UK for the time being. However, if the rate of VAT changes between the date of your order and the date of delivery, we will adjust the VAT you pay, unless you have already paid for the Products in full before the change in VAT takes effect.</p><p>1.45 The price of a Product does not include delivery charges. Our delivery charges are as quoted on our site from time to time. To check relevant delivery charges, please refer to our Delivery Charges page.</p><p>1.46 Our site contains a large number of Products. It is always possible that, despite our [reasonable efforts OR best efforts], some of the Products on our site may be incorrectly priced. We will normally check prices as part of our dispatch procedures so that:</p><p>(a) where the Product\'s correct price is less than the price stated on our </p><p>(b) if the Product\'s correct price is higher than the price stated on our site, site, we will charge the lower amount when dispatching the Products to you. However, if the pricing error is obvious and unmistakeable and could have reasonably been recognised by you as a mispricing, we do not have to provide the Products to you at the incorrect (lower) price; and we will contact you [in writing] as soon as possible to inform you of this error and we will give you the option of continuing to purchase the Product at the correct price or cancelling your order. We will not process your order until we have your instructions. If we are unable to contact you using the contact details you provided during the order process, we will treat the order as cancelled and notify you in writing.</p><h3>OR</h3><p>Our site contains a large number of Products. It is always possible that, despite our [reasonable efforts  OR best efforts], some of the Products on our site may be incorrectly priced. If we discover an error in the price of the Products you have ordered we will inform you [in writing]  to inform you of this error and we will give you the option of continuing to purchase the Product at the correct price or cancelling your order. We will not process your order until we have your instructions. If we are unable to contact you using the contact details you provided during the order process, we will treat the order as cancelled and notify you in writing. Please note that if the pricing error is obvious and unmistakeable and could have reasonably been recognised by you as a mispricing, we do not have to provide the Products to you at the incorrect (lower) price.</p><h3>HOW TO PAY</h3><p>1.47 You can only pay for Products using a debit card or credit card.</p><p>1.48 Payment for the Products and all applicable delivery charges is in advance. We will not charge your debit card or credit card until we dispatch your order.</p><h3>MANUFACTURER GUARANTEES</h3><p>1.49 Some of the Products we sell to you come with a manufacturer\'s guarantee. For details of the applicable terms and conditions, please refer to the manufacturer\'s guarantee provided with the Products.</p><p>1.50 If you are a consumer, a manufacturer\'s guarantee is in addition to your legal rights in relation to Products that are faulty or not as described. Advice about your legal rights is available from your local Citizens\' Advice Bureau or Trading Standards office.</p><h3>OUR WARRANTY FOR THE PRODUCTS</h3><p>1.51 For Products which do not have a manufacturer\'s guarantee, we provide a warranty that on delivery and for a period of [12] months from delivery, the Products shall be free from material defects. However, this warranty does not apply in the circumstances described in clause 16.2.</p><p>1.52 The warranty in clause 16.1 does not apply to any defect in the Products arising from:</p><p>(a) fair wear and tear;</p><p>(b) wilful damage, abnormal storage or working conditions, accident, negligence by you or by any third party;</p><p>(c) if you fail to operate or use the Products in accordance with the user </p><p>instructions;</p><p>(d) any alteration or repair by you or by a third party who is not one of our authorised repairers; or</p><p>(e) any specification provided by you.</p><p>1.53 If you are a consumer, this warranty is in addition to your legal rights in relation to Products that are faulty or not as described. Advice about your legal rights is available from your local Citizens\' Advice Bureau or Trading Standards office.</p><h3>OUR LIABILITY IF YOU ARE A BUSINESS</h3><p>This clause 17 only applies if you are a business customer.</p><p>1.54 We only supply the Products for internal use by your business, and you agree not to use the Product for any re-sale purposes.</p><p>1.55 Nothing in these Terms limit or exclude our liability for:</p><p>(a) death or personal injury caused by our negligence;</p><p>(b) fraud or fraudulent misrepresentation;</p><p>(c) breach of the terms implied by section 12 of the Sale of Goods Act 1979 </p><p>(title and quiet possession); or</p><p>(d) defective products under the Consumer Protection Act 1987.</p><p>1.56 Subject to clause  17.2, we will under no circumstances whatever be liable to you, whether in contract, tort (including negligence), breach of statutory duty, or otherwise, arising under or in connection with the Contract for:</p><p>(a) any loss of profits, sales, business, or revenue;</p><p>(b) loss or corruption of data, information or software;</p><p>(c) loss of business opportunity;</p><p>(d) loss of anticipated savings;</p><p>(e) loss of goodwill; or</p><p>(f) any indirect or consequential loss.</p><p>1.57 Subject to clause 17.2 and clause 17.3 , our total liability to you in respect of all other losses arising under or in connection with the Contract, whether in contract, tort (including negligence), breach of statutory duty, or otherwise, shall in no circumstances exceed [£0 OR 0% of] the price of the Products].</p><p>1.58 Except as expressly stated in these Terms, we do not give any representation, warranties or undertakings in relation to the Products. Any representation, condition or warranty which might be implied or incorporated into these Terms by statute, common law or otherwise is excluded to the fullest extent permitted by law. In particular, we will not be responsible for ensuring that the Products are suitable for your purposes.</p><h3>OUR LIABILITY IF YOU ARE A CONSUMER</h3><p>This clause 18 only applies if you are a consumer.</p><p>1.59 If we fail to comply with these Terms, we are responsible for loss or damage you suffer that is a foreseeable result of our breach of these Terms or our negligence[, but we are not responsible for any loss or damage that is not foreseeable]. Loss or damage is foreseeable if they were an obvious consequence of our breach or if they were contemplated by you and us at the time we entered into the Contract.</p><p>1.60 We only supply the Products for domestic and private use. You agree not to use the product for any commercial, business or re-sale purposes, and we have no liability to you for any loss of profit, loss of business, business interruption, or loss of business opportunity.</p><p>1.61 We do not in any way exclude or limit our liability for:</p><p>(a) death or personal injury caused by our negligence;</p><p>(b) fraud or fraudulent misrepresentation;</p><p>(c) any breach of the terms implied by section 12 of the Sale of Goods Act 1979 (title and quiet possession);</p><p>(d) any breach of the terms implied by section 13 to 15 of the Sale of Goods Act 1979 (description, satisfactory quality, fitness for purpose and samples); and </p><p>(e) defective products under the Consumer Protection Act 1987.</p><h3>EVENTS OUTSIDE OUR CONTROL</h3><p>1.62 We will not be liable or responsible for any failure to perform, or delay in performance of, any of our obligations under a Contract that is caused by an Event Outside Our Control. An Event Outside Our Control is defined below in clause 19.2.</p><p>1.63 An Event Outside Our Control means any act or event beyond our reasonable control[, including without limitation strikes, lock-outs or other industrial action by third parties, civil commotion, riot, invasion, terrorist attack or threat of terrorist attack, war (whether declared or not) or threat or preparation for war, fire, explosion, storm, flood, earthquake, subsidence, epidemic or other natural disaster, or failure of public or private telecommunications networks [or impossibility of the use of railways, shipping, aircraft, motor transport or other means of public or private transport].</p><p>1.64 If an Event Outside Our Control takes place that affects the performance of our obligations under a Contract:</p><p>(a) we will contact you as soon as reasonably possible to notify you; and</p><p>(b) our obligations under a Contract will be suspended and the time for performance of our obligations will be extended for the duration of the Event Outside Our Control. Where the Event Outside Our Control affects our delivery of Products to you, we will arrange a new delivery date with you after the Event Outside Our Control is over.</p><h3>COMMUNICATIONS BETWEEN US</h3><p>1.65 When we refer, in these Terms, to "in writing", this will include e-mail.</p><p>1.66 If you wish to contact us in writing, or if any clause in these Terms requires you to give us notice in writing, you can send this to us by e-mail or by pre-paid post to Recyclabook Ltd at Po Box 772, Haywards Heath, RH16 9GP. We will confirm receipt of this by contacting you in writing, normally by e-mail. If you are a consumer and exercising your right to cancel under clause  9, please see that clause 9 for how to tell us this.</p><p>1.67 If we have to contact you or give you notice in writing, we will do so by e-mail or by pre-paid post to the address you provide to us in your order.</p><p>1.68 If you are a business, please note that any notice given by you to us, or by us to you, will be deemed received and properly served immediately when posted on our website, 24 hours after an e-mail is sent, or three days after the date of posting of any letter.  In proving the service of any notice, it will be sufficient to prove, in the case of a letter, that such letter was properly addressed, stamped and placed in the post and, in the case of an e-mail, that such e-mail was sent to the specified e-mail address of the addressee.</p><h3>OTHER IMPORTANT TERMS</h3><p>1.69 We may transfer our rights and obligations under a Contract to another organisation, but this will not affect your rights or our obligations under these Terms. [We will always notify you [in writing or] by posting on this webpage if this happens.]</p><p>1.70 You may only transfer your rights or your obligations under these Terms to another person if we agree in writing. [However if you are a consumer and you have purchased a Product as a gift, you may transfer the benefit of the our warranty in clause 16 to the recipient of the gift without needing to ask our consent].</p><p>1.71 This contract is between you and us. No other person shall have any rights to enforce any of its terms[, whether under the Contracts (Rights of Third Parties Act) 1999 or otherwise]. [However, if you are a consumer, the recipient of your gift of a Product will have the benefit of our warranty at clause 16, but we and you will not need their consent to cancel or make any changes to these Terms.]</p><p>1.72 Each of the paragraphs of these Terms operates separately. If any court or relevant authority decides that any of them are unlawful or unenforceable, the remaining paragraphs will remain in full force and effect.</p><p>1.73 If we fail to insist that you perform any of your obligations under these Terms, or if we do not enforce our rights against you, or if we delay in doing so, that will not mean that we have waived our rights against you and will not mean that you do not have to comply with those obligations. If we do waive a default by you, we will only do so in writing, and that will not mean that we will automatically waive any later default by you.</p><p>1.74 If you are a consumer, please note that these Terms are governed by English law. This means a Contract for the purchase of Products through our site and any dispute or claim arising out of or in connection with it will be governed by English law. You and we both agree to that the courts of England and Wales will have non-exclusive jurisdiction. [However, if you are a resident of Northern Ireland you may also bring proceedings in Northern Ireland, and if you are resident of Scotland, you may also bring proceedings in Scotland.]</p><p>1.75 If you are a business, these Terms are governed by English law. This means that a Contract, and any dispute or claim arising out of or in connection with it or its subject matter or formation (including non-contractual disputes or claims), will be governed by English law. We both agree to the exclusive jurisdiction of the courts of England and Wales.</p><p>1.76 [We will not file a copy of the Contract between us.]</p>'
														}
													}
												}
											}
										}	
									}
								}
							}
						},
						
						bus : {
							self : '<section class="bus pages"></div>',
							branch : {
								header : { 
									self : '<div class="bus_header_wrap"></div>',
									branch : {
										wrap : {
											self : '<div class="bus_header"></div>',
											last_branch : {
												title : '<div class="bus_header_title">Recyclabus</div>',
												text  : '<div class="bus_header_text">Dates and Information</div>'
											}
										}
									}
								},
								image : {
									self : '<img src="'+frameworkuri+'/CSS/Includes/works/bus.png" class="bus_image">'
								},
								left_split : {
									self : '<div class="bus_left_split"></div>',
									branch : {
										dates : {
											self   : '<div class="bus_dates"></div>',
											branch : {
												bar : {
													self : '<div class="bus_bar"></div>',
													branch : {
														branch : {
															search : {
																self : '<div class="bus_date_search"></div>',
																branch : {
																	icon : {
																		self : '<div class="with-icon-for-bus-dates-search"></div>'
																	},
																	input : {
																		instructions : {
																			on : {
																				the_event : "keyup",
																				is_asslep : false,
																				call      : function (change) {
																					var body, dates, value;
																						value = change.self.val().toLowerCase().trim();
																						body  = world.wrap.branch.bus.branch.left_split.branch.dates.branch.body.branch.wrap.branch;
																						dates = [
																							{
																								place : "Bath University",
																								date  : "22nd, 23rd May"
																							},
																							{
																								place : "Bristol University",							
																								date  : "4th, 5th, 14th June"
																							},
																							{
																								place : "Cardiff University",							
																								date  : "6th, 7th, 13th June"
																							},
																							{
																								place : "Swansea Metropolitan University",
																								date  : "29th May"
																							},
																							{
																								place : "Swansea University",						
																								date  : "20th, 30th, 31st May"
																							},
																							{
																								place : "The University of South Wales, Treforest Campus",
																								date  : "21st May"
																							},
																							{
																								place : "The University of the West of England, Frenchay Campus",	
																								date  : "23rd May"
																							},
																							{
																								place : "UWIC",
																								date  : "28th May"
																							}
																						];

																						for (var index = 0; index < dates.length; index++) {
																							var contains_text = ( dates[index].place.toLowerCase().indexOf(value) !== -1 || dates[index].date.toLowerCase().indexOf(value) !== -1 );
																								if (contains_text) {
																									body["date_"+index].self.css({ display : "block" });
																								} else { 
																									body["date_"+index].self.css({ display : "none" });
																								}
																						};

																				}
																			}
																		},
																		self : '<input type="text" class="bus_search_input" placeholder="Filters as you type">'
																	}
																}
															}
														}	
													}
												},
												body : {
													self : '<div class="bus_body"></div>',
													branch : {
														wrap : {
															self : '<div class="bus_body_wrap"></div>',
															branch : {
																date_0 : {
																	self   : '<div class="bus_date"></div>',
																	branch : {
																		place : {
																			self : '<div class="bus_date_place">Bath University</div>'
																		},
																		date  : {
																			self : '<div class="bus_date_date">22nd, 23rd May</div>'
																		},
																		mark : {
																			self : '<div class="with-icon-bus-date-mark"></div>'
																		}
																	}
																},
																date_1 : {
																	self   : '<div class="bus_date"></div>',
																	branch : {
																		place : {
																			self : '<div class="bus_date_place">Bristol University</div>'
																		},
																		date  : {
																			self : '<div class="bus_date_date">4th, 5th, 14th June</div>'
																		},
																		mark : {
																			self : '<div class="with-icon-bus-date-mark"></div>'
																		}
																	}
																},
																date_2 : {
																	self   : '<div class="bus_date"></div>',
																	branch : {
																		place : {
																			self : '<div class="bus_date_place">Cardiff University</div>'
																		},
																		date  : {
																			self : '<div class="bus_date_date">6th, 7th, 13th June</div>'
																		},
																		mark : {
																			self : '<div class="with-icon-bus-date-mark"></div>'
																		}
																	}
																},
																date_3 : {
																	self   : '<div class="bus_date"></div>',
																	branch : {
																		place : {
																			self : '<div class="bus_date_place">Swansea Metropolitan University</div>'
																		},
																		date  : {
																			self : '<div class="bus_date_date">29th May</div>'
																		},
																		mark : {
																			self : '<div class="with-icon-bus-date-mark"></div>'
																		}
																	}
																},
																date_4 : {
																	self   : '<div class="bus_date"></div>',
																	branch : {
																		place : {
																			self : '<div class="bus_date_place">Swansea University</div>'
																		},
																		date  : {
																			self : '<div class="bus_date_date">20th, 30th, 31st May</div>'
																		},
																		mark : {
																			self : '<div class="with-icon-bus-date-mark"></div>'
																		}
																	}
																},
																date_5 : {
																	self   : '<div class="bus_date"></div>',
																	branch : {
																		place : {
																			self : '<div class="bus_date_place">The University of South Wales, Treforest Campus</div>'
																		},
																		date  : {
																			self : '<div class="bus_date_date">21st May</div>'
																		},
																		mark : {
																			self : '<div class="with-icon-bus-date-mark"></div>'
																		}
																	}
																},
																date_6 : {
																	self   : '<div class="bus_date"></div>',
																	branch : {
																		place : {
																			self : '<div class="bus_date_place">The University of the West of England, Frenchay Campus</div>'
																		},
																		date  : {
																			self : '<div class="bus_date_date">23rd May</div>'
																		},
																		mark : {
																			self : '<div class="with-icon-bus-date-mark"></div>'
																		}
																	}
																},
																date_7 : {
																	self   : '<div class="bus_date"></div>',
																	branch : {
																		place : {
																			self : '<div class="bus_date_place">UWIC</div>'
																		},
																		date  : {
																			self : '<div class="bus_date_date">28th May</div>'
																		},
																		mark : {
																			self : '<div class="with-icon-bus-date-mark"></div>'
																		}
																	}
																}	
															}
														}
													}
												}
											}
										},
										twitter : {
											instructions : {
												observe : {
													who      : state,
													property : "begin",
													call     : function (change) {
														var box = world.wrap.branch.bus.branch.left_split.branch.twitter.self,
															js,
															fjs =document.getElementsByTagName("script")[0],
															p   =/^http:/.test(document.location)?'http':'https';

															if( !document.getElementById("twitter-wjs") ) {
																js     = document.createElement("script");
																js.id  = "twitter-wjs";
																js.src = p +"://platform.twitter.com/widgets.js";
																fjs.parentNode.insertBefore(js,fjs);
															}
													}
												}
											},
											self : '<div class="bus_twitter"></div>',
											branch : {
												box : {
													self : '<a class="twitter-timeline" width="550" href="https://twitter.com/Recyclabook" data-widget-id="329948817518632962"></a>'
												}
											}
										}
									}
								},
								right_split : {
									self : '<div class="bus_right_split"></div>',
									branch : {
										map : {
											self : '<div class="bus_map"></div>',
											branch : {
												map : {
													self : '<iframe src="http://mapsengine.google.com/map/u/0/view?mid=zGeNIY0VmxqQ.kfujWjwn6WWo" width="390" height="390"></iframe>'
												}
											}
										},
										notify : {
											self : '<div class="bus_signup"></div>',
											branch : {
												bar : {
													self : '<div class="bus_signup_bar">Don\'t Want To Miss Us?</div>'
												},
												body : {
													self : '<div class="bus_signup_body"></div>',
													branch : {
														text : {
															self : '<div class="bus_signup_text">Leave your email and university and we\'ll email you when we\'re coming your way. Don\'t worry, we\'ll only use this to send you reminders - nothing more!</div>'
														},
														email : {
															instructions : {
																observe : {
																	who      : state, 
																	property : "signed",
																	call     : function (change) {
																		var input = world.wrap.branch.bus.branch.right_split.branch.notify.branch.body.branch.email.self;
																		input.attr("readonly", change.new);
																		input.val(state.account.email);
																	}
																},
																on : {
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) { 
																		if ( state.signed ) return;
																		state.account.email            = change.self.val();
																		state.registration.email.match = state.account.email;
																	}	
																}	
															},
															self : '<input type="text" class="bus_signup_input" placeholder="Email">'
														},
														university : {
															instructions : {
																observe : {
																	who      : state, 
																	property : "signed",
																	call     : function (change) {
																		var input = world.wrap.branch.bus.branch.right_split.branch.notify.branch.body.branch.university.self;
																		if ( change.new && state.account.university !== "" ) {
																			input.attr("readonly", true);
																			input.val(state.account.university);
																		} else {
																			input.attr("readonly", false);
																		}
																	}
																},
																on : {
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) { 
																		state.account.university = change.self.val();
																	}	
																}	
															},
															self : '<input type="text" class="bus_signup_input" placeholder="University">'
														},
														button : {
															instructions : {
																observers : [
																	{ 
																		who      : state.account,
																		property : "recieve_newsletter",
																		call     : function (change) {
																			var self = world.wrap.branch.bus.branch.right_split.branch.notify.branch.body.branch.button;

																			if ( change.new === "1" && state.account.university.length > 2 ) {
																				self.self.text("You have signed up!");
																			} 
																			else if (change.new === "1" && state.account.university.length < 2 ) {
																				self.self.text("You have not given us your University");
																			} 
																			else {
																				self.self.text("Submit for reminders");
																			}
																		}
																	}
																],
																on : { 
																	the_event : "click", 
																	is_asslep : false,
																	call      : function (change) {
																		if ( state.account.university.trim() === "") return;
																		if ( state.account.email.trim() === "") return;
																		if ( state.signed ) {
																			state.account.recieve_newsletter = "1";
																			state.save_account               = true;
																		} else {	
																			state.process.false_register = true;
																		}
																	}
																}
															},
															self : '<div class="bus_signup_submit">Submit For Reminders</div>'
														}
													}
												}
											}
										}
									}
								}
							}
						},

						item : {
							instructions : {
								observe : {
									who      : state.viewed_item,
									property : "show",
									call     : function (change) { 
										var self = world.wrap.branch.item.self;

											if ( change.new ) {
												self.css({ display : "block" }).animate({ opacity : 1 }, 200 );
											} else { 
												self.animate({ opacity : 0 }, 300, function () {
													self.css({ display : "none" });
												});
											}
									}
								}
							},
							self   : ' <div class="search_books_expanded_book_wrap"></div>',
							branch : {
								book : {
									instructions : {
										observe : {
											who      : state.viewed_item,
											property : "show",
											call     : function (change) { 
												var self = world.wrap.branch.item.branch.book.self;
													if ( change.new ) {
														self.animate({ top : "50px" }, 300);
													} else { 
														self.animate({ top : "-"+window.screen.availHeight+"px" }, 200);
													}
											}
										}
									},
									self   : '<div class="search_books_expanded_book"></div>',
									branch : {
										close : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														state.viewed_item.show = false;
													}
												}
											} ,
											self : '<span class="with-icon-info-close"></span>'
										},
										image_wrap : {
											self   : '<div class="search_books_expanded_image_wrap"></div>',
											branch : {
												image : {
													instructions : {
														observe : {
															who      : state.viewed_item.parts,
															property : "main_image_url",
															call     : function (change) {
																this.self.attr("src", change.new);
															}
														}
													},
													self : '<img src="" class="search_books_expanded_image">'
												}
											}
										},
										books_text : {
											self   : '<div class="search_books_expanded_text"></div>',
											branch : {
												title : {
													instructions : {
														observe : {
															who      : state.viewed_item.parts,
															property : "item_name",
															call     : function (change) { 
																this.self.text(change.new);
															}
														}
													},
													self : '<div class="search_books_expanded_title"></div>'
												},
												author : { 
													instructions : {
														observe : {
															who      : state.viewed_item.parts,
															property : "author",
															call     : function (change) { 
																this.self.text(change.new);
															}
														}
													},
													self : '<div class="search_books_expanded_author"></div>'
												},
												isbn : { 
													instructions : {
														observe : {
															who      : state.viewed_item.parts,
															property : "external_product_id",
															call     : function (change) { 
																this.self.text(change.new);
															}
														}
													},
													self   : '<div class="search_books_expanded_isbn"></div>'
												},
												quote : {
													instructions : {
														observe : {
															who      : state.viewed_item.parts,
															property : "standard_price",
															call     : function (change) {
																this.self.text("£"+change.new);
															}
														}
													},
													self   : '<div class="search_books_expanded_book_price"></div>'
												},
												buttons : {
													self   : '<div class="search_books_expanded_book_add_to_sell_basket_wrap"></div>',
													branch : {
														inner : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		var promise = book.basket;
																			promise.push(state.viewed_item.book);
																			book.basket = promise;
																	}
																}
															},
															self   : '<div class="search_books_expanded_book_add_to_sell_basket_inner_wrap"></div>',
															branch : {
																add : {
																	instructions : {
																		on : {
																			the_event : "click",
																			is_asslep : false,
																			call      : function (change) {
																				change.self.animate({ top : "-49px", marginBottom : "-49px" }, 300);
																			}
																		},
																		observe : {
																			who      : state.viewed_item,
																			property : "show",
																			call     : function (change) { 
																				if ( !change.new ) this.self.css({ top : "0px", marginBottom : "0px" });
																			}
																		}
																	},
																	self   : '<div class="search_books_expanded_book_add_to_sell_basket_button"></div>',
																	branch : {
																		text : {
																			self : '<span class="search_books_expanded_book_add_to_sell_basket_button_text">Add To Basket</span>'
																		}
																	}
																},
																add_again : {
																	self   : '<div class="search_books_expanded_book_add_to_sell_basket_add_again_button"></div>',
																	branch : {
																		text : {
																			self : '<span class="with-icon-added-to-sell-basket-expanded-tick">Add Again?</span>'
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						},
						registration : {
							self   : '<section class="pages input_box_body_wrap account"></section>',
							branch : {
								wrap   : {
									instructions : { 
										observe : {
											who : animate,
											property : "state",
											call : function (change) {
												var wrap   = world.wrap.branch.registration.branch.wrap.self,
													box    = world.wrap.branch.navigation.branch.wrap.branch.progress_popup.self,
													offset = box.height() + 20;
													if ( change.new === "register" ) wrap.animate({ top : offset+"px" });
													if ( change.new !== "register" ) wrap.css({ top : "800px" });
											}
										}
									},
									self   : '<div class="account_wrap"></div>',
									branch : {	
										placeholder : {
											instructions : {
												observe : {
													who      : state,
													property : "signed",
													call     : function (change) {
														var self = world.wrap.branch.registration.branch.wrap.branch.name_and_address.self;
														if ( change.new ) {
															self.css({ display : "block" });
														} else { 
															self.css({ display : "none" });
														}
													}
												}
											},
											self : '<div class="account_placeholder">You have been registered</div>'
										},									
										legend : {
											instructions : {
												observe : {
													who      : state,
													property : "signed",
													call     : function (change) {
														var self = world.wrap.branch.registration.branch.wrap.branch.legend.self;
														if ( change.new ) {
															self.css({ display : "none" });
														} else { 
															self.css({ display : "block" });
														}
													}
												}
											},
											self   : '<div class="legend_wrap"></div>',
											branch : {
												green    : {
													self : '<div class="legend_mark_green">mandatory fields*</div>'
												},
												incorrect : {
													self : '<div class="legend_mark_x_wrap"></div>',
													branch : {
														first_name : {
															self : '<div id="" class="legend_mark_x_symbol"></div>',
															branch : {
																x    : 	{
																	self : '<span class="with-icon-x-for-legend"></span>'
																},
																text : 	{
																	self : '<span>First Name is empty</span>'
																}
															}
														},
														last_name : {
															self : '<div id="" class="legend_mark_x_symbol"></div>',
															branch : {
																x    : 	{
																	self : '<span class="with-icon-x-for-legend"></span>'
																},
																text : 	{
																	self : '<span>Second Name is empty</span>'
																}
															}
														},
														address : {
															self : '<div id="" class="legend_mark_x_symbol"></div>',
															branch : {
																x    : 	{
																	self : '<span class="with-icon-x-for-legend"></span>'
																},
																text : 	{
																	self : '<span>Address is empty</span>'
																}
															}
														},
														post_code : {
															self : '<div id="" class="legend_mark_x_symbol"></div>',
															branch : {
																x    : 	{
																	self : '<span class="with-icon-x-for-legend"></span>'
																},
																text : 	{
																	self : '<span>Post Code is empty</span>'
																}
															}
														},
														town : {
															self : '<div id="" class="legend_mark_x_symbol"></div>',
															branch : {
																x    : 	{
																	self : '<span class="with-icon-x-for-legend"></span>'
																},
																text : 	{
																	self : '<span>Town is empty</span>'
																}
															}
														},
														area : {
															self : '<div id="" class="legend_mark_x_symbol"></div>',
															branch : {
																x    : 	{
																	self : '<span class="with-icon-x-for-legend"></span>'
																},
																text : 	{
																	self : '<span>Area is empty</span>'
																}
															}
														},
														
														email : {
															self : '<div id="" class="legend_mark_x_symbol"></div>',
															branch : {
																x    : 	{
																	self : '<span class="with-icon-x-for-legend"></span>'
																},
																text : 	{
																	self : '<span>Email is empty</span>'
																}
															}
														},
														password : {
															self : '<div id="" class="legend_mark_x_symbol"></div>',
															branch : {
																x    : 	{
																	self : '<span class="with-icon-x-for-legend"></span>'
																},
																text : 	{
																	self : '<span>Password is empty</span>'
																}
															}
														},
													}
												}
											}
										},
										name_and_address : { 
											instructions : {
												observe : {
													who      : state,
													property : "signed",
													call     : function (change) {
														var self = world.wrap.branch.registration.branch.wrap.branch.name_and_address.self;
														if ( change.new ) {
															self.css({ display : "none" });
														} else { 
															self.css({ display : "block" });
														}
													}
												}
											},
											self   : '<div class="field_box_wrap"></div>',
											branch : {
												title : {
													self   : '<div class="field_box_title_wrap"></div>',
													last_branch : {
														icon  : '<div class="with-icon-leaf-one"></div>',
														title : '<div class="field_box_title">Adress Details.</div>'
													}
												},
												name : {
													self   : '<div class="field_box_input_wrap"></div>',
													branch : {
														title           : {
															self : '<div class="field_box_input_title">First Name and Last Name</div>'
														},
														name_input      : {
															instructions : {
																observers : [
																	{
																		who      : state.account,
																		property : "first_name",
																		call     : function (change) {
																			if ( change.new.length < 2 ) {
																				state.registration.first_name = "First name too short";
																			}
																			if ( change.new.length === 0 ) {
																				state.registration.first_name = "First name empty";
																			}
																			if ( change.new.length > 1 ) {
																				state.registration.first_name = true;
																			}
																		}
																	},
																	{
																		who      : state.registration,
																		property : "first_name",
																		call     : function (change) {
																			var label = world.wrap.branch.registration.branch.wrap.branch.legend.branch.incorrect.branch.first_name;
																				
																				( change.new === true )? label.self.css({ display : "none" }) : label.self.css({ display : "block" });
																				label.branch.text.self.text(change.new);
																		}
																	}
																],
																on : {
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) {
																		state.account.first_name = change.self.val().trim();
																	}
																}
															},
															self : '<input maxlength="22" type="text" class="field_box_input" placeholder="First Name">'
														},
														not_valid       : {
															self : '<span class="with-icon-not-valid-field"></span>'
														},
														last_name_input : {
															instructions : {
																observers : [
																	{
																		who      : state.account,
																		property : "second_name",
																		call     : function (change) {
																			if ( change.new.length < 2 ) {
																				state.registration.last_name = "Last name too short";
																			}
																			if ( change.new.length === 0 ) {
																				state.registration.last_name = "Last name empty";
																			}
																			if ( change.new.length > 1 ) {
																				state.registration.last_name = true;
																			}
																		}
																	},
																	{
																		who      : state.registration,
																		property : "last_name",
																		call     : function (change) {
																			var label = world.wrap.branch.registration.branch.wrap.branch.legend.branch.incorrect.branch.last_name;
																				
																				( change.new === true )? label.self.css({ display : "none" }) : label.self.css({ display : "block" });
																				label.branch.text.self.text(change.new);
																		}
																	}
																],
																on : {
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) {
																		state.account.second_name = change.self.val().trim();
																	}
																}
															},
															self : '<input maxlength="22" type="text" class="field_box_input" placeholder="Second Name">'
														}
													}
												},
												address : {
													self   : '<div class="field_box_input_wrap"></div>',
													branch : {
														title  			 : {
															self : '<div class="field_box_input_title">Where shall we send your freepost pack?</div>'
														},
														address_input    : {
															instructions : {
																observers : [
																	{
																		who      : state.addresses[0],
																		property : "address",
																		call     : function (change) {
																			if ( change.new.length < 3 ) {
																				state.registration.address = "Address too short";
																			}
																			if ( change.new.length === 0 ) {
																				state.registration.address = "Address is empty";
																			}
																			if ( change.new.length > 2 ) {
																				state.registration.address = true;
																			}
																		}
																	},
																	{
																		who      : state.registration,
																		property : "address",
																		call     : function (change) {
																			var label = world.wrap.branch.registration.branch.wrap.branch.legend.branch.incorrect.branch.address;
																				( change.new === true )? label.self.css({ display : "none" }) : label.self.css({ display : "block" });
																				label.branch.text.self.text(change.new);
																		}
																	}
																],
																on : {
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) {
																		state.addresses[0].address = change.self.val().trim();
																	}
																}
															},
															self : '<input maxlength="200" type="text" class="field_box_input" placeholder="House name or number">'
														},
														town_input       : {
															instructions : {
																observers : [
																	{
																		who      : state.addresses[0],
																		property : "town",
																		call     : function (change) {
																			if ( change.new.length < 2 ) {
																				state.registration.town = "Town too short";
																			}
																			if ( change.new.length === 0 ) {
																				state.registration.town = "Town is empty";
																			}
																			if ( change.new.length > 1 ) {
																				state.registration.town = true;
																			}
																		}
																	},
																	{
																		who      : state.registration,
																		property : "town",
																		call     : function (change) {
																			var label = world.wrap.branch.registration.branch.wrap.branch.legend.branch.incorrect.branch.town;																				
																				( change.new === true )? label.self.css({ display : "none" }) : label.self.css({ display : "block" });
																				label.branch.text.self.text(change.new);
																		}
																	}
																],
																on : {
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) {
																		state.addresses[0].town = change.self.val().trim();
																	}
																}
															},
															self : '<input maxlength="30" type="text" class="field_box_input" placeholder="Town/City">'
														},
														area_input       : {
															instructions : {
																observers : [
																	{
																		who      : state.addresses[0],
																		property : "area",
																		call     : function (change) {
																			if ( change.new.length < 2 ) {
																				state.registration.area = "County too short";
																			}
																			if ( change.new.length === 0 ) {
																				state.registration.area = "County is empty";
																			}
																			if ( change.new.length > 1 ) {
																				state.registration.area = true;
																			}
																		}
																	},
																	{
																		who      : state.registration,
																		property : "area",
																		call     : function (change) {
																			var label = world.wrap.branch.registration.branch.wrap.branch.legend.branch.incorrect.branch.area;
																				( change.new === true )? label.self.css({ display : "none" }) : label.self.css({ display : "block" });
																				label.branch.text.self.text(change.new);
																		}
																	}
																],
																on : {
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) {
																		state.addresses[0].area = change.self.val().trim();
																	}
																}
															},
															self : '<input maxlength="50" type="text" class="field_box_input" placeholder="County">'
														},
														post_code_input  : {
															instructions : {
																observers : [
																	{
																		who      : state.addresses[0],
																		property : "post_code",
																		call     : function (change) {
																			if ( change.new.length === 0 ) {
																				state.registration.post_code = "Post Code is empty";
																			}
																			if ( ( change.new.length < 6 || change.new.length > 7 ) && change.new.length !== 0 ) {
																				state.registration.post_code = "Invalid Post Code";
																			}
																			if (  change.new.length > 5 && change.new.length < 8 ) {
																				state.registration.post_code = true;
																			}
																		}
																	},
																	{
																		who      : state.registration,
																		property : "post_code",
																		call     : function (change) {
																			var label = world.wrap.branch.registration.branch.wrap.branch.legend.branch.incorrect.branch.post_code;
																				( change.new === true )? label.self.css({ display : "none" }) : label.self.css({ display : "block" });
																				label.branch.text.self.text(change.new);
																		}
																	}
																],
																on : {
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) {
																		state.addresses[0].post_code = change.self.val().replace(/\s+/g, '');;
																	}
																}
															},
															self : '<input maxlength="8" type="text" class="field_box_input" placeholder="Post Code">'
														}
													}
												}
											}
										},
										password : {
											instructions : {
												observe : {
													who      : state,
													property : "signed",
													call     : function (change) {
														var self = world.wrap.branch.registration.branch.wrap.branch.password.self;
														if ( change.new ) {
															self.css({ display : "none" });
														} else { 
															self.css({ display : "block" });
														}
													}
												}
											},
											self   : '<div class="field_box_wrap_left"></div>',
											branch : {
												title : {
													self   : '<div class="field_box_title_wrap"></div>',
													last_branch : {
														icon  : '<div class="with-icon-leaf-two"></div>',
														title : '<div class="field_box_title">Login Details.*</div>'
													}
												},
												email : {
													self   : '<div class="field_box_input_wrap"></div>',
													branch : {
														title 				: {
															self : '<div class="field_box_input_title">Email address</div>'
														},
														emai_input          : {
															instructions : {
																observers : [
																	{
																		who      : state.registration.email,
																		property : "match",
																		call     : function (change) {

																			if ( change.new !== state.account.email ) {
																				state.registration.email.text = "Emails do not match";
																			} else { 
																				$.get(ajaxurl,{ 
																					action     : "get_account",
																					method     : "is_email_in_use",
																					paramaters : {
																						email : state.account.email,
																					}
																				}, function (response) { 
																					if ( response.return ) {
																						state.registration.email.unique = false;
																						state.registration.email.text   = "Email is in use";
																					} else { 
																						state.registration.email.unique = true;
																						state.registration.email.text   = true;
																					}
																				}, "json");
																			}
																		}
																	},
																	{
																		who      : state.account,
																		property : "email",
																		call     : function (change) {

																			if ( change.new.length === 0 ) {
																				state.registration.email.size = false;
																				state.registration.email.text = "Email is empty";
																			}
																			if ( change.new.length < 5 || change.new.search("@") === -1 ) { 
																				state.registration.email.size = false;
																				state.registration.email.text = "Invalid Email";
																			}
																			if ( change.new.length > 4 && change.new.search("@") !== -1 ) {
																				state.registration.email.size = true;
																			}
																		}
																	},
																	{
																		who      : state.registration.email,
																		property : "text",
																		call     : function (change) {
																			var label = world.wrap.branch.registration.branch.wrap.branch.legend.branch.incorrect.branch.email;
																				( change.new === true )? label.self.css({ display : "none" }) : label.self.css({ display : "block" });
																				label.branch.text.self.text(change.new);
																		}
																	}
																],
																on : {
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) {
																		state.account.email = change.self.val().trim();
																	}
																}
															},
															self : '<input maxlength="30" type="text" class="field_box_input" placeholder="Email address">'
														},
														not_valid           : {
															self : '<span class="with-icon-not-valid-field"></span>'
														},
														confirm_email_input : {
															instructions : {
																on : {
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) {
																		state.registration.email.match = change.self.val().trim();
																	}
																}
															},
															self : '<input maxlength="30" type="text" class="field_box_input" placeholder="Confrim">'
														}
													}						
												},
												password : {
													self   : '<div class="field_box_input_wrap"></div>',
													branch : {
														title          		   : {
															self : '<div class="field_box_input_title">Password</div>'
														},
														password 		       : {
															instructions : {
																observers : [
																	{
																		who      : state.registration.password,
																		property : "match",
																		call     : function (change) {

																			if ( change.new !== state.account.password ) {
																				state.registration.password.text = "Passwords do not match";
																			} else { 
																				state.registration.password.text = true;
																			}
																		}
																	},
																	{
																		who      : state.account,
																		property : "password",
																		call     : function (change) {

																			if ( change.new.length < 6 ) {
																				state.registration.password.size = false;
																				state.registration.password.text = "Password must be over five characters";
																			}
																			if ( change.new.length === 0 ) {
																				state.registration.password.size = false;
																				state.registration.password.text = "Password is empty";
																			}
																			if ( change.new.length > 6 ) {
																				state.registration.password.size = true;
																			}
																		}
																	},
																	{
																		who      : state.registration.password,
																		property : "text",
																		call     : function (change) {
																			var label = world.wrap.branch.registration.branch.wrap.branch.legend.branch.incorrect.branch.password;
																				( change.new === true )? label.self.css({ display : "none" }) : label.self.css({ display : "block" });
																				label.branch.text.self.text(change.new);
																		}
																	}
																],
																on : {
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) {
																		state.account.password = change.self.val().trim();
																	}
																}
															},
															self : '<input maxlength="30" type="password" class="field_box_input" placeholder="Password">'
														},
														not_valid      		   : {
															self : '<span class="with-icon-not-valid-field"></span>'
														},
														password_input_confirm : {
															instructions : {
																on : {
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) {
																		state.registration.password.match = change.self.val().trim();
																	}
																}
															},
															self : '<input maxlength="30" type="password" class="field_box_input" placeholder="Confirm">'
														}
													}
												}
											}
										},
										disclaimer : {
											instructions : {
												observe : {
													who      : state,
													property : "signed",
													call     : function (change) {
														var self = world.wrap.branch.registration.branch.wrap.branch.disclaimer.self;
														if ( change.new ) {
															self.css({ display : "none" });
														} else { 
															self.css({ display : "block" });
														}
													}
												}
											},
											self   : '<div class="input_box_disclaimer"></div>',
											branch : {
												tick : {
													instructions : {
														on : {
															the_event : "click",
															is_asslep : false,
															call      : function (change) {
																if ( state.account.recieve_newsletter === 1 ) {
																	state.account.recieve_newsletter = 0;
																	this.tick.branch.tick.self.css({ display : "none" });
																} else {
																	state.account.recieve_newsletter = 1;
																	this.tick.branch.tick.self.css({ display : "inline" });
																}
															}
														}
													},
													self   : '<div class="input_box_disclaimer_box"></div>',
													branch : {
														tick : {					
															self : '<span class="with-icon-input-box-disclaimer-tick"></span>'
														}
													}
												},
												text_wrap : {
													self   : '<div class="input_box_disclaimer_text_wrap"></div>',
													branch : {
														text_one : {
															self : '<div class="input_box_disclaimer_text">If you don\'t want to receive emails with exclusive offers and competitions from Recyclabook and our friends then untick this</div>'
														},
														text_two : {
															self : '<div class="input_box_disclaimer_small">by pressing continue you agree to</div>'
														},
														link     : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		animate.pop.outside = "legal";
																	}
																}
															},
															self : '<div class="input_box_disclaimer_highlight">terms & conditions</div>'
														}
													}
												},
												continue_button : {
													instructions : {
														on : {
															the_event : "click",
															is_asslep : false,
															call      : function (change) { 
																state.process.register = true;
															}
														}
													},
													self : '<div class="input_box_button">Continue</div>'
												}
											}
										}
									}
								}								
							}
						},
						confirm : {
							self : '<section class="checkout pages"></section>',
							branch : {
								wrap : {
									instructions : { 
										observe : {
											who : animate,
											property : "state",
											call : function (change) {
												var wrap   = world.wrap.branch.confirm.branch.wrap.self,
													box    = world.wrap.branch.navigation.branch.wrap.branch.progress_popup.self,
													offset = box.height() + 50;
													if ( change.new === "confirm" ) wrap.animate({ top : offset+"px" }).css({ marginBottom : offset+"px" });
													if ( change.new !== "confirm" ) wrap.css({ top : "800px" });
											}
										}
									},
									self   : '<div class="checkout_wrap"></div>',
									branch : {
										confirmation_overview : {
											self   : '<div class="confirmation_overview"></div>',
											branch : {
												basket_overview : {
													self   : '<div class="basket_overview_outer_wrap"></div>',
													branch : {
														basket : {
															self   : '<div class="basket_overview_wrap"></div>',
															branch : {
																title : {
																	self : '<div class="basket_overview_title">Basket Overview</div>'
																},
																basket : {
																	instructions : {
																		scroll : false,
																		observe: {
																			who      : animate,
																			property : "scroll",
																			call     : function (change) { 
																				var basket = world.wrap.branch.confirm.branch.wrap.branch.confirmation_overview.branch.basket_overview.branch.basket.branch.basket;
																				if ( change.new !== "confirm" ) return;
																				if ( !basket.instructions.scroll ) {
																					basket.self               = basket.self[0];
																					basket.branch.scroll.self = basket.branch.scroll.self[0];
																					basket.branch.scroll.branch.handle.self = basket.branch.scroll.branch.handle.self[0];
																					basket.branch.holder.self = basket.branch.holder.self[0];
																					basket.branch.holder.branch.inner.self  = basket.branch.holder.branch.inner.self[0];
																					basket.instructions.scroll = new alpha.scroll_bar({
																						self   : basket,
																						height : 182
																					});
																				} else { 
																					basket.instructions.scroll.calculate_scroll_data();
																				}
																			}
																		},
																	},
																	self   : '<div class="basket_overview_basket"></div>',
																	branch : {
																		holder : {
																			self : '<div class="basket_overview_items"></div>', 
																			branch : {
																			 	inner : {
																					instructions : {
																						on : {
																							the_event : "click",
																							is_asslep : false,
																							call      : function (change) {
																								if ( change.event.target.className === "with-icon-x-for-overview-item confirm_basket_remove" ) {
																									var basket, index;
																									index       = change.event.target.getAttribute("data-type-book");
																								 	basket      = book.basket;
																									basket.splice((index-1), 1);
																									book.basket = basket;
																								}
																							}
																						},
																						observers : [
																							{
																								who      : book,
																								property : "basket",
																								call     : function (change) { 
																									
																									var book_string, index, current_book;

																									book_string = "";

																									for ( index = 0; index < book.basket.length; index++ ) {
																										current_book  = book.basket[index];
																										book_string  += 
																											'<div class="basket_overview_item">'+
																												'<div data-type-book="'+ ( index + 1 )  +'" style="display:block;" class="with-icon-x-for-overview-item confirm_basket_remove"></div>'+
																												'<img class="basket_overview_item_thumbnail" src="'+  current_book.main_image_url +'">'+
																												'<div class="basket_overview_item_text_wrap">'+
																													'<div class="basket_overview_item_text_title"> '+ current_book.item_name        +'</div>'+
																													'<div class="basket_overview_item_text_author">'+ current_book.author           +'</div>'+
																													'<div class="basket_overview_item_isbn">       '+ current_book.external_product_id +'</div>'+
																												'</div>'+
																												'<div class="basket_overview_item_price_wrap">'+
																													'<div class="basket_overview_item_price_text">Sell for</div>'+
																													'<div class="basket_overview_item_price">'+ current_book.standard_price +'</div>'+
																												'</div>'+
																											'</div>';
																									};
																									this.self.empty();
																									this.self[0].insertAdjacentHTML("afterbegin", book_string );
																								}
																							}
																						],
																					},
																			 		self : '<div class="basket_overview_items_wrap"></div>'
																			 	}
																			}
																		},
																		scroll : {
																			self   : '<div class="basket_overview_bar"></div>',
																			branch : {
																				handle : {
																					self : '<div class="basket_overview_bar_block"></div>'
																				}
																			}
																		}	
																	}
																},
															}
														},
														total : {
															self  : '<div class="basket_overview_total_wrap"></div>',
															branch : {
																total : {
																	instructions : {
																		observe : {
																			who      : book,
																			property : "basket",
																			call     : function (change) { 
																				var quote = 0;
																				for (var index = 0; index < change.new.length; index++) quote += parseFloat( change.new[index].standard_price );
																				this.self.text("£"+ quote.toFixed(2));
																			}
																		}
																	},
																	self : '<div class="basket_overview_total"></div>'
																},
																text  : {
																	self : '<div class="basket_overview_total_text">Total Sale: </div>'
																}
															}
														}
													}
												},
												address_overview : {
													self   : '<div class="address_overview_wrap_outer"></div>',
													branch : { 
														address : {
															self   : '<div class="address_overview_wrap"></div>',
															branch : {
																title : {
																	self : '<div class="address_overview_title">Address Confirmation</div>'
																},
																inputs : {
																	self   : '<div class="address_overview_inputs"></div>',
																	branch : {
																		address  : {
																			instructions : {
																				on : {
																					the_event : "keyup",
																					is_asslep : false,
																					call      : function (change) {
																						state.addresses[0].address = change.self.val();
																					}
																				},
																				observers : [
																					{
																						who     : state.addresses[0],
																						property: "address",
																						call    : function (change) {
																							var input = world.wrap.branch.confirm.branch.wrap.branch.confirmation_overview.branch.address_overview.branch.address.branch.inputs.branch.address.self;
																								input.val(change.new);
																								console.log(input);
																						}
																					},
																					{
																						who      : state.edit,
																						property : "confirm",
																						call     : function (change) {
																							var input = world.wrap.branch.confirm.branch.wrap.branch.confirmation_overview.branch.address_overview.branch.address.branch.inputs.branch.address.self;
																								input.attr("readonly", (!state.edit.confirm));
																						}
																					}
																				],
																			},
																			self : '<input readonly class="address_overview_input" value="Address">'
																		},
																		town     : {
																			instructions : {
																				on : {
																					the_event : "keyup",
																					is_asslep : false,
																					call      : function (change) {
																						state.addresses[0].town = change.self.val();
																					}
																				},
																				observers : [
																					{
																						who     : state.addresses[0],
																						property: "town",
																						call    : function (change) {
																							var input = world.wrap.branch.confirm.branch.wrap.branch.confirmation_overview.branch.address_overview.branch.address.branch.inputs.branch.town.self;
																								input.val(change.new);
																						}
																					},
																					{
																						who      : state.edit,
																						property : "confirm",
																						call     : function (change) {
																							var input = world.wrap.branch.confirm.branch.wrap.branch.confirmation_overview.branch.address_overview.branch.address.branch.inputs.branch.town.self;
																								input.attr("readonly", (!state.edit.confirm));
																						}
																					}
																				],
																			},
																			self : '<input readonly class="address_overview_input" value="Town">'
																		},
																		area     : {
																			instructions : {
																				on : {
																					the_event : "keyup",
																					is_asslep : false,
																					call      : function (change) {
																						state.addresses[0].area = change.self.val();
																					}
																				},
																				observers : [
																					{
																						who     : state.addresses[0],
																						property: "area",
																						call    : function (change) {
																							var input = world.wrap.branch.confirm.branch.wrap.branch.confirmation_overview.branch.address_overview.branch.address.branch.inputs.branch.area.self;
																								input.val(change.new);
																						}
																					},
																					{
																						who      : state.edit,
																						property : "confirm",
																						call     : function (change) {
																							var input = world.wrap.branch.confirm.branch.wrap.branch.confirmation_overview.branch.address_overview.branch.address.branch.inputs.branch.area.self;
																								input.attr("readonly", (!state.edit.confirm));
																						}
																					}
																				],
																			},
																			self : '<input readonly class="address_overview_input" value="Area">'
																		},
																		post_code: {
																			instructions : {
																				on : {
																					the_event : "keyup",
																					is_asslep : false,
																					call      : function (change) {
																						state.addresses[0].post_code = change.self.val();
																					}
																				},
																				observers : [
																					{
																						who     : state.addresses[0],
																						property: "post_code",
																						call    : function (change) {
																							var input = world.wrap.branch.confirm.branch.wrap.branch.confirmation_overview.branch.address_overview.branch.address.branch.inputs.branch.post_code.self;
																								input.val(change.new);
																						}
																					},
																					{
																						who      : state.edit,
																						property : "confirm",
																						call     : function (change) {
																							var input = world.wrap.branch.confirm.branch.wrap.branch.confirmation_overview.branch.address_overview.branch.address.branch.inputs.branch.post_code.self;
																								input.attr("readonly", (!state.edit.confirm));
																						}
																					}
																				],
																			},
																			self : '<input readonly class="address_overview_input_small" value="Post Code">'
																		}
																	}
																}
															}
														},
														edit : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		if ( state.edit.confirm ) {
																			state.save_address = true;
																			change.self.text("Edit Address");
																			state.edit.confirm = false;
																		} else { 
																			change.self.text("Save Edit");
																			state.edit.confirm = true;
																		}
																	}
																}
															},
															self : '<div class="address_overview_edit">Edit Address</div>'
														}
													}
												}
											}
										},
										choice_wrap : {
											self   : '<div class="how_would_you_like_wrap"></div>',
											branch : {
												title : {
													self : '<div class="how_would_you_like_title">How would you like to send your books?</div>'
												},
												titles_tab : {
													self   : '<div class="how_would_you_like_titles_wrap"></div>',
													branch : {
														tab_one : {
															instructions : {
																observe : {
																	who      : animate,
																	property : "state",
																	call     : function (change) { 
																		if ( change.new === "confirm" ) {
																			state.confirm.tab     = 0;
																			state.confirm.postage = "letter";
																		}
																	}
																},
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		state.confirm.tab = 0;
																	}
																}
															},
															self : '<div class="how_would_you_like_tab_title_active">We send you a freepost pack</div>'
														},
														tab_two : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		state.confirm.tab = 1;	
																	}
																}
															},
															self : '<div class="how_would_you_like_tab_title">Use your own postage with freepost code</div>'
														}
													}
												},
												tabs : {
													self   : '<div class="how_would_you_like_tab_wrap"></div>',
													branch : {
														tab_one : {
															instructions : {
																observe : {
																	who      : state.confirm,
																	property : "tab",
																	call     : function (change) {
																		var self = world.wrap.branch.confirm.branch.wrap.branch.choice_wrap.branch.tabs.branch.tab_one.self;
																		if ( change.new === 0 ) {
																			self.css({ display : "block" });
																		} else {
																			self.css({ display : "none" });
																		}
																	}
																}
															},
															self   : '<div class="how_would_you_like_we_send_dark_tab"></div>',
															branch : {
																image : {
																	self : '<img class="we_send_freepost_tab_image" src="'+ frameworkuri +'/CSS/Includes/works/freepost_send.png">'
																},
																text : {
																	self   : '<div class="we_send_freepost_tab_text_wrap"></div>',
																	branch : {
																		text : {
																			self   : '<ul class="we_send_freepost_tab_text"></ul>',
																			last_branch : {
																				paragraph_one   : '<li class="we_send_freepost_tab_paragraph">Youll get instructions to guide you through a Pre-paid Envelope for your books.</li>',
																				paragraph_two   : '<li class="we_send_freepost_tab_paragraph">Just pop them in the <strong>pre-paid</strong>, <strong>pre-addressed</strong> bag and send them to us for quick payment.</li>',
																				paragraph_three : '<li class="we_send_freepost_tab_paragraph">Well send you a cheque on the day we recieve your books.</li>'
																			}
																		},
																		check : {
																			self   : '<div class="we_send_freepost_tab_tick_button"></div>',
																			branch : {
																				tick : {
																					instructions : {
																						observe : {
																							who     : state.confirm,
																							property: "postage",
																							call    : function (change) {
																								if ( !change.new ) return;
																								
																								var self = world.wrap.branch.confirm.branch.wrap.branch.choice_wrap.branch.tabs.branch.tab_one.branch.text.branch.check.branch.tick.self;
																									if ( change.new === "letter" ) {
																										self.attr("class", "with-icon-we-checkout-tick" );
																									} else {
																										self.attr("class", "with-icon-we-checkout-tick-unticked" );
																									}
																							}
																						},
																						on : {
																							the_event : "click",
																							is_asslep : false,
																							call      : function (change) {
																								state.confirm.postage = "letter";
																							}
																						}
																					},
																					self : '<div class="with-icon-we-checkout-tick"></div>'
																				},
																				text : {
																					self : '<div class="we_send_freepost_tab_tick_button_text">I want this option</div>'
																				}
																			}
																		}
																	}
																}														
															}													
														},
														tab_two : {
															instructions : {
																observe : {
																	who      : state.confirm,
																	property : "tab",
																	call     : function (change) {
																		var self = world.wrap.branch.confirm.branch.wrap.branch.choice_wrap.branch.tabs.branch.tab_two.self;
																		if ( change.new === 1 ) {
																			self.css({ display : "block" });
																		} else {
																			self.css({ display : "none" });
																		}
																	}
																}
															},
															self   : '<div class="how_would_you_like_we_send_light_tab"></div>',
															branch : {
																image : {
																	self : '<img class="we_send_freepost_tab_image" src="'+ frameworkuri +'/CSS/Includes/works/print.png">'
																},
																text : {
																	self   : '<div class="we_send_freepost_tab_text_wrap"></div>',
																	branch : {
																		text : {
																			self   : '<ul class="we_send_freepost_tab_text"></ul>',
																			last_branch : {
																				paragraph_one   : '<li class="we_send_freepost_tab_paragraph">Select this option if your are using your own packaging material or if you already have a Recyclabook freepost envelope.</li>',
																				paragraph_two   : '<li class="we_send_freepost_tab_paragraph">If you are using your own packaging material, <strong>print the freepost label</strong>,<strong>stick it on the package</strong>, then <strong>post your books</strong></li>',
																				paragraph_three : '<li class="we_send_freepost_tab_paragraph">If you are using a Recyclabook Freepost Envelope, write your user id in space provided (send via email once you have pressed continue) and then post your books.</li>'
																			}
																		},
																		check : {
																			self   : '<div class="we_send_freepost_tab_tick_button"></div>',
																			branch : {
																				tick : {
																					instructions : {
																						observe : {
																							who     : state.confirm,
																							property: "postage",
																							call    : function (change) {
																								if ( !change.new ) return;
																								
																								var self = world.wrap.branch.confirm.branch.wrap.branch.choice_wrap.branch.tabs.branch.tab_two.branch.text.branch.check.branch.tick.self;
																									if ( change.new === "own" ) {
																										self.attr("class", "with-icon-we-checkout-dark-tick" );
																									} else {
																										self.attr("class", "with-icon-we-checkout-dark-tick-unticked" );
																									}
																							}
																						},
																						on : {
																							the_event : "click",
																							is_asslep : false,
																							call      : function (change) {
																								state.confirm.postage = "own";
																							}
																						}
																					},
																					self : '<div class="with-icon-we-checkout-dark-tick-unticked"></div>'
																				},
																				text : {
																					self : '<div class="we_send_freepost_tab_tick_button_text">I want this option</div>'
																				}
																			}
																		}
																	}
																}														
															}													
														}
													}
												},
												button : {
													instructions : {
														on : {
															the_event : "click",
															is_asslep : false,
															call      : function (change) { 
																if ( state.confirm.postage === "letter" ) {
 																	state.give_freepost = true;
																} else { 
 																	state.give_print_your_own = true;
 																}
																state.give_price_promise = true;
 																router.change_url("done");
															}
														}
													},
													self : '<div class="checkout_button">Confirm & Complete</div>'
												}
											}
										}
									}
								}
							}	
						},
						thank_you : {
							self   : '<section class="thank_you pages"></section>',
							branch : {
								banner : {
									instructions : { 
										observe : {
											who : animate,
											property : "state",
											call : function (change) {
												var wrap   = world.wrap.branch.thank_you.branch.banner.self;
													if ( change.new === "done" ) {
														setTimeout( function () {
															wrap.css({ display : "block" }).animate({ top : "0px" }, 1000);
														}, 500 );
													} else {
														if ( change.new !== "done" ) wrap.css({ top : "-410px", display : "none" });
													}
											}
										}
									},
									self   : '<div class="thank_you_banner_wrap"></div>',
									branch : {					
										inner_banner : {
											self   : '<div class="thank_you_banner"></div>',
											branch : {
												leaf : { 
													self : '<div class="with-icon-thank-you-icon-leaf"></div>'
												},
												title_one : {
													self :'<div class="thank_you_banner_title_one">Thank you </div>'
												},
												title_two : {
													self : '<div class="thank_you_banner_title_two">For using recyclabook</div>'
												},
												print_your_own : {
													instructions : {
														observe : {
															who     : state.confirm,
															property: "postage",
															call    : function (change) {
																if ( !change.new ) return;
																
																var self = world.wrap.branch.thank_you.branch.banner.branch.inner_banner.branch.print_your_own.self;
																	if ( change.new === "own" ) {
																		self.css({ display : "block" });
																	} else {
																		self.css({ display : "none" });
																	}
															}
														}
													},
													self : '<div style="display:none" class="thank_you_banner_paragraph">You have chosen to send your books to us using your own packaging, <a class="thank_you_banner_paragraph_link" target="blank" data-dont-route="true" href="http://www.recyclabook.co.uk/packaging_label.pdf">here is a link</a> to the label which you need to print out.</div>'
												},
												paragraph : {
													self : '<div class="thank_you_banner_paragraph">We\'ll be waiting for your books to arrive, in the meantime, <a class="thank_you_banner_paragraph_link" href="hub">you have an account now</a>. You can login and track the books and payments anytime and request more freepost packs.</div>'
												}
											}
										},
										bottom : {
											self : '<div class="with-icon-thank-you-bottom-arrow"></div>'
										}
									}
								},
								circle : {
									self   :'<div class="thank_you_circle_wrap"></div>',
									branch : {
										corn : {
											self :'<div class="with-icon-thank-you-corn"></div>'
										},
										text : {
											self   : '<div class="thank_you_circle_text_wrap"></div>',
											last_branch : {
												header : '<div class="thank_you_circle_text_header">RAG</div>',
												text   : '<div class="thank_you_circle_text">we also make it easy for you to donate directly to your University\'s RAG</div>		'
											}
										}
									}
								},
								icon : {
									self : '<div class="with-icon-your-account"></div>'
								}
							}
						},
						hub_popup : {
							instructions : {
								observe : {
									who      : animate,
									property : "popup",
									call     : function (change) {
										var box = world.wrap.branch.hub_popup.self;
										if ( change.new !== false ) {
											box.css({ display : "block" }).animate({ opacity : 1 });
										} else {
											box.animate({ opacity : 0 }, 500, function () {
												box.css({ display :"none" });
											});
										}
									}
								}
							},
							self : '<div class="profile_hub_popup_screen"></div>',
							branch : { 
								donate : {
									instructions : {
										observe : {
											who      : animate,
											property : "popup",
											call     : function (change) {
												var box = world.wrap.branch.hub_popup.branch.donate.self;
												if ( change.new === "donate" ) { 
													box.css({ display : "block", top : window.screen.availHeight+"px" }).animate({ top : "0px" }, 300);
												} else {
													box.animate({ top : window.screen.availHeight+"px" }, 200, function () {
														box.css({ display : "none" });
													});
												}
											}
										}
									},
									self : '<div class="profile_hub_donate"></div>',
									branch : {
										head : {
											self : '<div class="profile_hub_donate_logo_wrap"></div>',
											last_branch : {
												logo : '<img src="'+ frameworkuri +'/CSS/Includes/works/header_logo.png" class="profile_hub_donate_logo">',
												text : '<div class="profile_hub_donate_description">Donation to your uni RAG</div>'
											}
										},
										body : {
											self : '<div class="profile_hub_donate_body"></div>',
											branch : {
												send_to : {
													self :'<div class="profile_hub_donate_line"></div>' ,
													branch : {
														description : { 
															self : '<div class="profile_hub_donate_line_description">Cheque to be sent to :</div>'
														},
														text : {
															self :'<div class="profile_hub_donate_line_text_wrap"></div>' ,
															branch : { 
																select : {
																	self : '<select class="profile_hub_donate_line_select"></select>',
																	last_branch : {
																		none         : '<option value="null">Donate to which uni?</option>',
																		universities : '<option value="University of Aberdeen">University of Aberdeen</option><option value="University of Abertay Dundee">University of Abertay Dundee</option><option value="Aberystwyth University">Aberystwyth University</option><option value="Anglia Ruskin University, Cambridge and Chelmsford">Anglia Ruskin University, Cambridge and Chelmsford</option><option value="The Arts University Bournemouth">The Arts University Bournemouth</option><option value="University of the Arts London">University of the Arts London</option><option value="Camberwell College of Arts">Camberwell College of Arts</option><option value="Central Saint Martins College of Art and Design">Central Saint Martins College of Art and Design</option><option value="Chelsea College of Art and Design">Chelsea College of Art and Design</option><option value="London College of Communication">London College of Communication</option><option value="London College of Fashion">London College of Fashion</option><option value="Wimbledon College of Art">Wimbledon College of Art</option><option value="Aston University, Birmingham">Aston University, Birmingham</option><option value="Bangor University">Bangor University</option><option value="University of Bath">University of Bath</option><option value="Bath Spa University">Bath Spa University</option><option value="University of Bedfordshire">University of Bedfordshire</option><option value="University of Birmingham">University of Birmingham</option><option value="Birmingham City University">Birmingham City University</option><option value="Birmingham Conservatoire">Birmingham Conservatoire</option><option value="Bishop Grosseteste University">Bishop Grosseteste University</option><option value="University Centre at Blackburn College">University Centre at Blackburn College</option><option value="University of Bolton">University of Bolton</option><option value="Bournemouth University">Bournemouth University</option><option value="BPP University College of Professional Studies">BPP University College of Professional Studies</option><option value="University of Bradford">University of Bradford</option><option value="University of Bradford School of Management">University of Bradford School of Management</option><option value="University of Brighton">University of Brighton</option><option value="Brighton and Sussex Medical School">Brighton and Sussex Medical School</option><option value="University of Bristol">University of Bristol</option><option value="Brunel University, Uxbridge and London">Brunel University, Uxbridge and London</option><option value="University of Buckingham">University of Buckingham</option><option value="Buckinghamshire New University,">Buckinghamshire New University,</option><option value="High Wycombe University of Cambridge">High Wycombe University of Cambridge</option><option value="Canterbury Christ Church University">Canterbury Christ Church University</option><option value="Cardiff University">Cardiff University</option><option value="Cardiff International Academy of Voice">Cardiff International Academy of Voice</option><option value="Cardiff University School of Medicine">Cardiff University School of Medicine</option><option value="Cardiff Metropolitan University (UWIC)">Cardiff Metropolitan University (UWIC)</option><option value="University of Central Lancashire">University of Central Lancashire</option><option value="University of Chester">University of Chester</option><option value="University of Chichester">University of Chichester</option><option value="Crichton University Campus">Crichton University Campus</option><option value="City University London">City University London</option><option value="Cass Business School">Cass Business School</option><option value="City Law School">City Law School</option><option value="Coventry University">Coventry University</option><option value="Cranfield University">Cranfield University</option><option value="University for the Creative Arts">University for the Creative Arts</option><option value="University of Cumbria">University of Cumbria</option><option value="De Montfort University">De Montfort University</option><option value="University of Derby">University of Derby</option><option value="University of Dundee">University of Dundee</option><option value="Durham University">Durham University</option><option value="University of East Anglia">University of East Anglia</option><option value="University of East London">University of East London</option><option value="University of East London School of Law">University of East London School of Law</option><option value="Edge Hill University">Edge Hill University</option><option value="University of Edinburgh">University of Edinburgh</option><option value="Moray House School of Education">Moray House School of Education</option><option value="Edinburgh Napier University">Edinburgh Napier University</option><option value="University of Essex">University of Essex</option><option value="University of Exeter">University of Exeter</option><option value="Camborne School of Mines">Camborne School of Mines</option><option value="Falmouth University">Falmouth University</option><option value="Dartington College of Arts">Dartington College of Arts</option><option value="University of Glamorgan, Cardiff">University of Glamorgan, Cardiff</option><option value="University of Glasgow">University of Glasgow</option><option value="Glasgow Caledonian University">Glasgow Caledonian University</option><option value="University of Gloucestershire">University of Gloucestershire</option><option value="University of Greenwich">University of Greenwich</option><option value="Glyndŵr University, Wrexham">Glyndŵr University, Wrexham</option><option value="Harper Adams University">Harper Adams University</option><option value="Heriot-Watt University">Heriot-Watt University</option><option value="University of Hertfordshire, Hatfield">University of Hertfordshire, Hatfield</option><option value="University of the Highlands & Islands">University of the Highlands & Islands</option><option value="University of Huddersfield">University of Huddersfield</option><option value="University of Hull, Hull and Scarborough">University of Hull, Hull and Scarborough</option><option value="Hull York Medical School (HYMS)">Hull York Medical School (HYMS)</option><option value="Imperial College London">Imperial College London</option><option value="Imperial College at Wye">Imperial College at Wye</option><option value="Royal School of Mines">Royal School of Mines</option><option value="Keele University, Staffordshire">Keele University, Staffordshire</option><option value="University of Kent, Canterbury and Medway">University of Kent, Canterbury and Medway</option><option value="Kingston University">Kingston University</option><option value="Lancaster University">Lancaster University</option><option value="University of Leeds">University of Leeds</option><option value="Leeds Metropolitan University">Leeds Metropolitan University</option><option value="Leeds Trinity University">Leeds Trinity University</option><option value="University of Leicester">University of Leicester</option><option value="University of Lincoln, Lincoln">University of Lincoln, Lincoln</option><option value="University of Liverpool">University of Liverpool</option><option value="Liverpool School of Tropical Medicine">Liverpool School of Tropical Medicine</option><option value="Liverpool Hope University">Liverpool Hope University</option><option value="Liverpool John Moores University">Liverpool John Moores University</option><option value="University of London">University of London</option><option value="Birkbeck, University of London">Birkbeck, University of London</option><option value="Central School of Speech and Drama">Central School of Speech and Drama</option><option value="Courtauld Institute of Art">Courtauld Institute of Art</option><option value="Goldsmiths, University of London">Goldsmiths, University of London</option><option value="Heythrop College">Heythrop College</option><option value="Institute of Cancer Research">Institute of Cancer Research</option><option value="Institute of Education">Institute of Education</option><option value="King\'s College London">King\'s College London</option><option value="Institute of Psychiatry (IOP)">Institute of Psychiatry (IOP)</option><option value="London Business School">London Business School</option><option value="London School of Economics and Political Science (LSE)">London School of Economics and Political Science (LSE)</option><option value="London School of Hygiene and Tropical Medicine">London School of Hygiene and Tropical Medicine</option><option value="Queen Mary, University of London">Queen Mary, University of London</option><option value="Royal Academy of Music">Royal Academy of Music</option><option value="Royal Holloway, University of London, Egham">Royal Holloway, University of London, Egham</option><option value="Royal Veterinary College">Royal Veterinary College</option><option value="St George\'s, University of London">St George\'s, University of London</option><option value="School of Advanced Study">School of Advanced Study</option><option value="Institute for the Study of the Americas">Institute for the Study of the Americas</option><option value="Institute of Advanced Legal Studies">Institute of Advanced Legal Studies</option><option value="Institute of Classical Studies">Institute of Classical Studies</option><option value="Institute of Commonwealth Studies">Institute of Commonwealth Studies</option><option value="Institute of English Studies">Institute of English Studies</option><option value="Institute of Germanic & Romance Studies">Institute of Germanic & Romance Studies</option><option value="Institute of Historical Research">Institute of Historical Research</option><option value="Institute of Musical Research">Institute of Musical Research</option><option value="Institute of Philosophy">Institute of Philosophy</option><option value="Warburg Institute">Warburg Institute</option><option value="School of Oriental and African Studies (SOAS)">School of Oriental and African Studies (SOAS)</option><option value="School of Pharmacy, University of London">School of Pharmacy, University of London</option><option value="University College London (UCL)">University College London (UCL)</option><option value="Eastman Dental Institute">Eastman Dental Institute</option><option value="Institute of Archaeology">Institute of Archaeology</option><option value="Institute of Child Health">Institute of Child Health</option><option value="Institute of Neurology">Institute of Neurology</option><option value="School of Slavonic and East European Studies (SSEES)">School of Slavonic and East European Studies (SSEES)</option><option value="University Marine Biological Station">University Marine Biological Station</option><option value="London Metropolitan University">London Metropolitan University</option><option value="London South Bank University">London South Bank University</option><option value="Loughborough University">Loughborough University</option><option value="University of Manchester">University of Manchester</option><option value="Manchester Business School">Manchester Business School</option><option value="Manchester Metropolitan University">Manchester Metropolitan University</option><option value="Middlesex University, London">Middlesex University, London</option><option value="Newcastle University">Newcastle University</option><option value="Newman University">Newman University</option><option value="University of Northampton">University of Northampton</option><option value="Northumbria University, Newcastle upon Tyne">Northumbria University, Newcastle upon Tyne</option><option value="Norwich University of the Arts">Norwich University of the Arts</option><option value="University of Nottingham">University of Nottingham</option><option value="Nottingham Trent University">Nottingham Trent University</option><option value="The Open University">The Open University</option><option value="University of Oxford">University of Oxford</option><option value="Oxford Brookes University">Oxford Brookes University</option><option value="Peninsula College of Medicine and Dentistry">Peninsula College of Medicine and Dentistry</option><option value="University of Plymouth">University of Plymouth</option><option value="University of Portsmouth">University of Portsmouth</option><option value="Queen\'s University Belfast">Queen\'s University Belfast</option><option value="St Mary\'s University College">St Mary\'s University College</option><option value="Stranmillis University College">Stranmillis University College</option><option value="Queen Margaret University">Queen Margaret University</option><option value="University of Reading">University of Reading</option><option value="Henley Business School">Henley Business School</option><option value="The Robert Gordon University">The Robert Gordon University</option><option value="Roehampton University, London">Roehampton University, London</option><option value="Royal College of Art, London">Royal College of Art, London</option><option value="University of St Andrews">University of St Andrews</option><option value="University of Salford">University of Salford</option><option value="University of Sheffield">University of Sheffield</option><option value="Sheffield Hallam University">Sheffield Hallam University</option><option value="University of Southampton">University of Southampton</option><option value="Southampton Solent University">Southampton Solent University</option><option value="Staffordshire University">Staffordshire University</option><option value="University of Stirling">University of Stirling</option><option value="University of Strathclyde">University of Strathclyde</option><option value="University of Sunderland">University of Sunderland</option><option value="University of Surrey, Guildford">University of Surrey, Guildford</option><option value="University of Sussex">University of Sussex</option><option value="Swansea Metropolitan University">Swansea Metropolitan University</option><option value="Swansea University">Swansea University</option><option value="Teesside University">Teesside University</option><option value="University of Ulster">University of Ulster</option><option value="University of Wales">University of Wales</option><option value="University of Wales, Newport">University of Wales, Newport</option><option value="University of Wales, Trinity Saint David">University of Wales, Trinity Saint David</option><option value="University of Warwick">University of Warwick</option><option value="University of West London">University of West London</option><option value="London College of Music">London College of Music</option><option value="University of Westminster">University of Westminster</option><option value="University of the West of England">University of the West of England</option><option value="University of the West of Scotland">University of the West of Scotland</option><option value="University of Winchester">University of Winchester</option><option value="University of Wolverhampton">University of Wolverhampton</option><option value="University of Worcester">University of Worcester</option><option value="Worcester Business School">Worcester Business School</option><option value="University of York">University of York</option><option value="York St John University">York St John University</option>'
																	}
																}
															}
														}
													}
												},
												measure : {
													self : '<div class="profile_hub_donate_mesure"></div>',
													branch : {
														text : {
															self : '<div class="profile_hub_donate_mesure_text">Donate ammount :</div>'
														},
														first_ammount : {
															instructions : {
																observe : {
																	who      : state,
																	property : "withdraw",
																	call     : function (change) { 
																		var self = world.wrap.branch.hub_popup.branch.donate.branch.body.branch.measure.branch.first_ammount.self;
																		self.val("£"+change.new.split(".").shift());
																	}
																}
															},
															self : '<input type="text" class="profile_hub_donate_mesure_ammount" value="£0" readonly>'
														},
														seperator : {
															self :'<div class="profile_hub_donate_mesure_seperate"></div>'
														},
														second_ammount : {
															instructions : {
																observe : {
																	who      : state,
																	property : "withdraw",
																	call     : function (change) { 
																		var self = world.wrap.branch.hub_popup.branch.donate.branch.body.branch.measure.branch.second_ammount.self;
																		self.val(change.new.split(".").pop());
																	}
																}
															},
															self : '<input type="text" class="profile_hub_donate_mesure_ammount" value="00" readonly>'
														},
														incrementor : {
															self : '<div class="profile_hub_donate_mesure_incrimentor"></div>',
															branch : {
																up   : {
																	instructions : {
																		on : {
																			the_event : "click",
																			is_asslep : false,
																			call      : function (change) {
																				var value = parseFloat(state.withdraw) + 0.5;
																				if ( value > state.account.credit ) value = parseFloat(state.account.credit);
																				value = value.toFixed(2);
																				state.withdraw = value;
																			}
																		}
																	},
																	self : '<div class="profile_hub_donate_mesure_incrimentor_up"></div>'
																},
																down : {
																	instructions : {
																		on : {
																			the_event : "click",
																			is_asslep : false,
																			call      : function (change) {
																				var value = parseFloat(state.withdraw) - 0.5;
																				if ( value < 0.00 ) value = 0.00
																				value = value.toFixed(2);
																				state.withdraw = value;
																			}
																		}
																	},
																	self : '<div class="profile_hub_donate_mesure_incrimentor_down"></div>'
																}
															}
														}
													}
												},
												donate : {
													instructions : {
														on : {
															the_event : "click",
															is_asslep : false,
															call      : function (change) { 

																if ( state.withdraw === 0 || state.withdraw === "0.00" ) return;
																var date = new Date();
																$.post(ajaxurl, {
																	action : "set_ticket",
																	method : "rag_donate",
																	paramaters : {
																		array : {
																			email      : state.account.email,
																			first_name : state.account.first_name,
																			second_name: state.account.second_name,
																			university : this.send_to.branch.text.branch.select.self.val(),
																			amount     : state.withdraw,
																			date       : date.getFullYear() +"/"+ date.getMonth() +"/"+ date.getDate()
																		}
																	}
																}, function (response) {}, "json");

																state.account.credit          -= state.withdraw;
																state.account.credit           = state.account.credit.toFixed(2);
																state.withdraw                 = "0.00";
																animate.popup                  = false;
																state.save_account             = true;
															}
														}
													},
													self :'<div class="profile_hub_donate_save">Donate now</div>'
												},
												cancel : {
													instructions : {
														on : {
															the_event : "click",
															is_asslep : false,
															call      : function () { 
																animate.popup = false;
															}
														}
													},
													self : '<div class="profile_hub_donate_cancel">Cancel</div>'
												}
											}
										}
									}
								},
								reset : {
									instructions : {
										observe : {
											who      : animate,
											property : "popup",
											call     : function (change) {
												var box = world.wrap.branch.hub_popup.branch.reset.self;
												if ( change.new === "reset" ) {
													box.css({ display : "block", top : window.screen.availHeight+"px" }).animate({ top : "0px" }, 300);
												} else {
													box.animate({ top : window.screen.availHeight+"px" }, 200, function () {
														box.css({ display : "none" });
													});
												}
											}
										}
									},
									self   : '<div class="profile_hub_reset"></div>',
									branch : {
										head : {
											self : '<div class="profile_hub_reset_logo_wrap"></div>',
											last_branch : {
												logo : '<img src="'+ frameworkuri +'/CSS/Includes/works/header_logo.png" class="profile_hub_reset_logo">',
												text : '<div class="profile_hub_reset_description">Password Change</div>'
											}
										},
										body : {
											self : '<div class="profile_hub_reset_body"></div>',
											branch : {
												inner : {
													self : '<div class="profile_hub_reset_input_wrap"></div>',
													branch : {
														notification : {
															instructions : {
																observers : [
																	{ 
																		who      : state.notification.reset,
																		property : "notify",
																		call     : function (change) {
																			var self = world.wrap.branch.hub_popup.branch.reset.branch.body.branch.inner.branch.notification.self;
																			( change.new)? self.css({ display : "block" }) : self.css({ display : "none" });
																		}
																	},
																	{ 
																		who      : state.notification.reset,
																		property : "text",
																		call     : function (change) {
																			var self = world.wrap.branch.hub_popup.branch.reset.branch.body.branch.inner.branch.notification.self;
																			self.text(change.new);
																		}
																	}
																]
															},
															self : '<div class="profile_hub_reset_notification">Passwords do not match</div>'
														},
														old_password_label : {
															self : '<div class="profile_hub_reset_label">Current password</div>'
														},
														old_password : {
															self : '<input type="password" class="profile_hub_reset_input" placeholder="Current Password">'
														},
														new_password_label : {
															self : '<div class="profile_hub_reset_label">New password</div>'
														},
														new_password : {
															self : '<input type="password" class="profile_hub_reset_input" placeholder="New password">'
														},
														confirm_new_password : {
															self : '<input type="password" class="profile_hub_reset_input" placeholder="Confirm password">'
														}
													}
												},
												save : {
													instructions : { 
														on : {
															the_event : "click",
															is_asslep : false,
															call      : function () { 

																var password         = this.inner.branch.old_password.self.val(), 
																	new_password     = this.inner.branch.new_password.self.val().trim(), 
																	confirm_password = this.inner.branch.confirm_new_password.self.val().trim();

																state.notification.reset.notify = true;

																if ( password !== state.account.password ) {
																	state.notification.reset.text = "Old password is incorrect";
																	return;
																}
																if ( password !== state.account.password ) {
																	state.notification.reset.text = "Old password is incorrect";
																	return;
																}
																if (new_password === "" ) { 
																	state.notification.reset.text = "No new password set";
																	return;
																}
																if (new_password !== confirm_password ) {
																	state.notification.reset.text = "Passwords do not match";
																	return;
																}

																state.notification.reset.text   = "Password Changed";
																state.account.password          = new_password;
																state.save_account              = true;
																this.inner.branch.old_password.self.val("");
																this.inner.branch.new_password.self.val("");
																this.inner.branch.confirm_new_password.self.val("");
															}
														}
													},
													self :'<div class="profile_hub_reset_save">Save Changes</div>'
												},
												cancel : {
													instructions : {
														on : {
															the_event : "click",
															is_asslep : false,
															call      : function () { 
																animate.popup = false;
																state.notification.reset.notify = false;
																this.inner.branch.old_password.self.val("");
																this.inner.branch.new_password.self.val("");
																this.inner.branch.confirm_new_password.self.val("");
															}
														}
													},
													self :'<div class="profile_hub_reset_cancel">Cancel</div>'
												}
											}
										}
									}
								},
								withdraw : {
									instructions : {
										observe : {
											who      : animate,
											property : "popup",
											call     : function (change) {
												var box = world.wrap.branch.hub_popup.branch.withdraw.self;
												if ( change.new === "withdraw" ) {
													box.css({ display : "block", top : window.screen.availHeight+"px" }).animate({ top : "0px" }, 300);
												} else {
													box.animate({ top : window.screen.availHeight+"px" }, 200, function () {
														box.css({ display : "none" });
													});
												}
											}
										}
									},
									self : '<div class="profile_hub_withdraw"></div>',
									branch : {
										head : {
											self : '<div class="profile_hub_withdraw_logo_wrap"></div>',
											last_branch : {
												logo : '<img src="'+ frameworkuri +'/CSS/Includes/works/header_logo.png" class="profile_hub_withdraw_logo">',
												text : '<div class="profile_hub_withdraw_description">Withdraw Funds</div>'
											}
										},
										body : {
											self : '<div class="profile_hub_withdraw_body"></div>',
											branch : {
												cheque_name : {
													self : '<div class="profile_hub_withdraw_line"></div>',
													branch : {
														description : {
															self : '<div class="profile_hub_withdraw_line_description">Cheque to me made out to :</div>'
														},
														text : {
															self : '<div class="profile_hub_withdraw_line_text_wrap"></div>',
															branch : {
																input : {
																	instructions : {
																		observers : [
																			{
																				who : state.account,
																				property : "first_name",
																				call : function (change) { 
																					if ( state.edit.withdraw.first_name ) return;
																						var self = world.wrap.branch.hub_popup.branch.withdraw.branch.body.branch.cheque_name.branch.text.branch.input.self;
																							self.val(change.new);
																				}
																			},
																			{
																				who      : state.edit.withdraw,
																				property : "first_name",
																				call : function (change) { 
																					var self = world.wrap.branch.hub_popup.branch.withdraw.branch.body.branch.cheque_name.branch.text.branch.input.self;
																						self.attr("readonly", (!change.new));
																				}
																			}
																		],
																		on : {
																			the_event : "keyup",
																			is_asslep : false,
																			call      : function (change) {
																				state.account.first_name = change.self.val();
																			}
																		}
																	},
																	self : '<input type="text" class="profile_hub_withdraw_line_text" value="" readonly>'
																}
															}
														},
														edit : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) { 
																		if ( state.edit.withdraw.first_name ) {
																			state.edit.withdraw.first_name = false;
																			change.self.text("edit");
																		} else { 
																			state.edit.withdraw.first_name = true;
																			change.self.text("save");
																		}
																	}
																}
															},
															self : '<div class="profile_hub_withdraw_line_edit">edit</div>'
														}
													}
												},
												send_to : {
													self : '<div class="profile_hub_withdraw_line"></div>',
													branch : {
														description : {
															self : '<div class="profile_hub_withdraw_line_description">Cheque to be sent to :</div>'
														},
														text : {
															self : '<div class="profile_hub_withdraw_line_text_wrap"></div>',
															branch : {
																address : {
																	instructions : {
																		observers : [
																			{
																				who     : state.addresses[0],
																				property: "address",
																				call    : function (change) {
																					if ( state.edit.withdraw.address ) return;
																						var input = world.wrap.branch.hub_popup.branch.withdraw.branch.body.branch.send_to.branch.text.branch.address.self;
																						input.val(change.new);
																				}
																			},
																			{
																				who      : state.edit.withdraw,
																				property : "address",
																				call     : function (change) {
																					var input = world.wrap.branch.hub_popup.branch.withdraw.branch.body.branch.send_to.branch.text.branch.address.self;
																						input.attr("readonly", (!change.new));
																				}
																			}
																		],
																		on : {
																			the_event : "keyup",
																			is_asslep : false,
																			call      : function (change) { 
																				state.addresses[0].address = change.self.val();
																			}
																		}
																	},
																	self : '<input type="text" class="profile_hub_withdraw_line_text" value="" readonly>'
																},
																town    : {
																	instructions : {
																		observers : [
																			{
																				who     : state.addresses[0],
																				property: "town",
																				call    : function (change) {
																					if ( state.edit.withdraw.address ) return;
																						var input = world.wrap.branch.hub_popup.branch.withdraw.branch.body.branch.send_to.branch.text.branch.town.self;
																						input.val(change.new);
																				}
																			},
																			{
																				who      : state.edit.withdraw,
																				property : "address",
																				call     : function (change) {
																					var input = world.wrap.branch.hub_popup.branch.withdraw.branch.body.branch.send_to.branch.text.branch.town.self;
																						input.attr("readonly", (!change.new));
																				}
																			}
																		],
																		on : {
																			the_event : "keyup",
																			is_asslep : false,
																			call      : function (change) { 
																				state.addresses[0].town = change.self.val();
																			}
																		}
																	},
																	self : '<input type="text" class="profile_hub_withdraw_line_text" value="" readonly>'
																},
																area    : {
																	instructions : {
																		observers : [
																			{
																				who     : state.addresses[0],
																				property: "area",
																				call    : function (change) {
																					if ( state.edit.withdraw.address ) return;
																						var input = world.wrap.branch.hub_popup.branch.withdraw.branch.body.branch.send_to.branch.text.branch.area.self;
																						input.val(change.new);
																				}
																			},
																			{
																				who      : state.edit.withdraw,
																				property : "address",
																				call     : function (change) {
																					var input = world.wrap.branch.hub_popup.branch.withdraw.branch.body.branch.send_to.branch.text.branch.area.self;
																						input.attr("readonly", (!change.new));
																				}
																			}
																		],
																		on : {
																			the_event : "keyup",
																			is_asslep : false,
																			call      : function (change) { 
																				state.addresses[0].area = change.self.val();
																			}
																		}
																	},
																	self : '<input type="text" class="profile_hub_withdraw_line_text" value="" readonly>'
																},
																post_code : {
																	instructions : {
																		observers : [
																			{
																				who     : state.addresses[0],
																				property: "post_code",
																				call    : function (change) {
																					if ( state.edit.withdraw.address ) return;
																						var input = world.wrap.branch.hub_popup.branch.withdraw.branch.body.branch.send_to.branch.text.branch.post_code.self;
																						input.val(change.new);
																				}
																			},
																			{
																				who      : state.edit.withdraw,
																				property : "address",
																				call     : function (change) {
																					var input = world.wrap.branch.hub_popup.branch.withdraw.branch.body.branch.send_to.branch.text.branch.post_code.self;
																						input.attr("readonly", (!change.new));
																				}
																			}
																		],
																		on : {
																			the_event : "keyup",
																			is_asslep : false,
																			call      : function (change) { 
																				state.addresses[0].post_code = change.self.val();
																			}
																		}
																	},
																	self : '<input type="text" class="profile_hub_withdraw_line_text" value="" readonly>'
																}
															}
														},
														edit : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) { 
																		if ( state.edit.withdraw.address ) {
																			state.edit.withdraw.address = false;
																			change.self.text("edit");
																		} else { 
																			state.edit.withdraw.address = true;
																			change.self.text("save");
																		}
																	}
																}
															},
															self : '<div class="profile_hub_withdraw_line_edit">edit</div>'
														}
													}
												},
												measure : {
													self : '<div class="profile_hub_withdraw_mesure"></div>',
													branch : {
														text : {
															self : '<div class="profile_hub_withdraw_mesure_text">Withdraw ammount :</div>'
														},
														first_ammount : {
															instructions : {
																observe : {
																	who      : state,
																	property : "withdraw",
																	call     : function (change) { 
																		var self = world.wrap.branch.hub_popup.branch.withdraw.branch.body.branch.measure.branch.first_ammount.self;
																		self.val("£"+change.new.split(".").shift());
																	}
																}
															},
															self : '<input type="text" class="profile_hub_withdraw_mesure_ammount" value="0" readonly>'
														},
														seperator : {
															self : '<div class="profile_hub_withdraw_mesure_seperate"></div>'
														},
														second_ammount : {
															instructions : {
																observe : {
																	who      : state,
																	property : "withdraw",
																	call     : function (change) { 
																		var self = world.wrap.branch.hub_popup.branch.withdraw.branch.body.branch.measure.branch.second_ammount.self;
																		self.val(change.new.split(".").pop());
																	}
																}
															},
															self : '<input type="text" class="profile_hub_withdraw_mesure_ammount" value="00" readonly>'
														},
														incrementor : {
															self : '<div class="profile_hub_withdraw_mesure_incrimentor"></div>',
															branch : {
																up   : {
																	instructions : {
																		on : {
																			the_event : "click",
																			is_asslep : false,
																			call      : function (change) {
																				var value = parseFloat(state.withdraw) + 0.5;
																				if ( value > state.account.credit ) value = parseFloat(state.account.credit);
																				value = value.toFixed(2);
																				state.withdraw = value;
																			}
																		}
																	},
																	self : '<div class="profile_hub_withdraw_mesure_incrimentor_up"></div>'
																},
																down : {
																	instructions : {
																		on : {
																			the_event : "click",
																			is_asslep : false,
																			call      : function (change) {
																				var value = parseFloat(state.withdraw) - 0.5;
																				if ( value < 0.00 ) value = 0.00
																				value = value.toFixed(2);
																				state.withdraw = value;
																			}
																		}
																	},
																	self : '<div class="profile_hub_withdraw_mesure_incrimentor_down"></div>'
																}
															}
														}
													}
												},
												withdraw : {
													instructions : {
														on : {
															the_event : "click",
															is_asslep : false,
															call      : function (change) {
																
																if ( state.withdraw === 0 || state.withdraw === "0.00" ) return;
																var date = new Date();
																$.post(ajaxurl, {
																	action     : "set_ticket",
																	method     : "cheque",
																	paramaters : {
																		cheque : {
																			email      : state.account.email,
																			first_name : state.account.first_name,
																			second_name: state.account.second_name,
																			date       : date.getFullYear() +"/"+ date.getMonth() +"/"+ date.getDate(),
																			amount     : state.withdraw,
																			address    : state.addresses[0].address,
																			town       : state.addresses[0].town,
																			area       : state.addresses[0].area,	
																			post_code  : state.addresses[0].post_code
																		}
																	}
																}, function () {}, "json");

																state.edit.withdraw.first_name = false;
																state.edit.withdraw.address    = false;
																state.account.last_withdraw    = date.getFullYear() +"-"+ date.getMonth() +"-"+ date.getDate();
																state.account.credit          -= state.withdraw;
																state.account.credit           = state.account.credit.toFixed(2);
																state.withdraw                 = "0.00";
																animate.popup                  = false;
																state.save_account             = true;
															}
														}
													},
													self : '<div class="profile_hub_withdraw_and_send">Withdraw & Send</div>'
												},
												cancel : {
													instructions : {
														on : {
															the_event : "click",
															is_asslep : false,
															call      : function () { 
																animate.popup = false;
																state.edit.withdraw.first_name = false;
																state.edit.withdraw.address    = false;
															}
														}
													},
													self : '<div class="profile_hub_withdraw_cancel">Cancel</div>'
												}
											}
										}
									}
								}
							}
						},
						
						stock : {
							self : '<div class="stock"></div>',
							branch : {
								bar : {
									self   : '<div class="stock_bar"></div>',
									branch : {
										bus : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														state.stock.page = "bus";
													}
												}
											},
											self : '<div class="stock_bar_navigation">Recyclabus</div>'
										},
										post : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														state.stock.page = "post";
													}
												}
											},
											self : '<div class="stock_bar_navigation">Post</div>'
										},
										freepost : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														state.stock.page = "freepost";
													}
												}
											},
											self : '<div class="stock_bar_navigation">Freepost</div>'
										},
										book : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														state.stock.page = "book";
													}
												}
											},
											self : '<div class="stock_bar_navigation">Book</div>'
										},
										address : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														state.stock.page = "address";
													}
												}
											},
											self : '<div class="stock_bar_navigation">Adress</div>'
										},
										// table : {
										// 	instructions : {
										// 		on : {
										// 			the_event : "click",
										// 			is_asslep : false,
										// 			call      : function (change) {
										// 				state.stock.page = "table";
										// 			}
										// 		}
										// 	},
										// 	self : '<div class="stock_bar_navigation">Table</div>'
										// }
									}
								},
								// log : {
								// 	instructions :{
								// 		observe : {
								// 			who      : state.stock.user,
								// 			property : "loged_in",
								// 			call     : function (change) {
								// 				if ( change.new ) {
								// 					this.self.css({ display : "none" });
								// 				} else {
								// 					this.self.css({ display : "block" });
								// 				}
								// 			}
								// 		}
								// 	},
								// 	self   : '<div class="stock_log"></div>',
								// 	branch : {
								// 		notification : {
								// 			instructions : {
								// 				observe : {
								// 					who      : state.stock.user,
								// 					property : "notification",
								// 					call     : function (change) {
								// 						this.self.text(change.new);
								// 					}
								// 				}
								// 			},
								// 			self : '<div class="stock_log_notification">Enter Name & Password</div>',
								// 		},
								// 		user : {
								// 			instructions : {
								// 				on : {
								// 					the_event : "keyup",
								// 					is_asslep : false,
								// 					call      : function (change) {
								// 						state.stock.user.name = change.self.val();
								// 					}
								// 				}
								// 			},
								// 			self : '<input class="stock_log_user" placeholder="username">'
								// 		},
								// 		password : {
								// 			instructions : {
								// 				on : {
								// 					the_event : "keyup",
								// 					is_asslep : false,
								// 					call      : function (change) {
								// 						state.stock.user.password = change.self.val();
								// 					}
								// 				}
								// 			},
								// 			self : '<input type="password" class="stock_log_password" placeholder="password">'
								// 		},
								// 		submit : {
								// 			instructions : {
								// 				on : {
								// 					the_event : "click",
								// 					is_asslep : false,
								// 					call      : function (change) {

								// 						state.stock.user.notification = "Signing in..";

								// 						$.get(ajaxurl, {
								// 							action : "get_account",
								// 							method : "does_admin_user_exist",
								// 							paramaters : {
								// 								name     : state.stock.user.name,
								// 								password : state.stock.user.password
								// 							}
								// 						}, function (response) {
								// 							if ( response.return ) {
								// 								state.stock.user.loged_in = true;
								// 							} else {
								// 								state.stock.user.notification = "Wrong password or name or both";
								// 							}
								// 						},"json");
								// 					}
								// 				}
								// 			},
								// 			self : '<div class="stock_log_submit">Go</div>'
								// 		}
								// 	}
								// },
								address : {
									instructions : {
										observe : {
											who      : state.stock,
											property : "page",
											call     : function (change) {

												if ( change.new === "address" ) {
													this.self.css({ display : "block" });
												} else { 
													this.self.css({ display : "none" });
												}
											}
										}
									},
									self : '<div class="stock_table_wrap"></div>',
									branch : {
										table : {
											instructions : {
												observe : {
													who      : state.stock,
													property : "page",
													call     : function (change) {

														if ( change.new !== "address" || this.self[0].table ) return;

														new alpha.table({
															self         : this.self[0],
															table_name   : "address",
															column_width : 150,
															row_height   : 120,
															table_height : 400,
															column_number: 6,
															max_row_load : 10,
															columns      : [
																"id",
																"user",
																"address",
																"post code",
																"town",
																"area"
															],
															submision_column_names : [
																"id",
																"user",
																"address",
																"post code",
																"town",
																"area"
															],
															options : [
																{
																	name : "load",
																	type : function () { 
																		var table = this;

																		$.get(ajaxurl, {
																			action : "get_account",
																			method : "addresses"
																		}, function (response) { 
																			table.set_rows(response.return);
																		}, "json");
																	}
																},
																{
																	name : "un/select",
																	type : "un_select"
																},
																{
																	name : "stuff",
																	type : [
																		{
																			type         : "text", 
																			instructions : {
																				content : "ahh yes this be the summer of fruitfull joy"
																			}
																		}
																	]
																},
																{
																	name         : "add book",
																	type         : [
																		{
																			type         : "text", 
																			instructions : {
																				content  : "to select or unselect the question is now? for whom so ever shall be found in the depths of getting down, shall cry for all to see 'Hail the gods and their mercy'"
																			},
																		},
																		{	
																			type         : "input",
																			instructions : {
																				placeholder : "condition",
																				on          : {
																					event : "keyup",
																					call  : function (event) {
																						console.log("someting");
																					}
																				}
																			}
																		},
																		{	
																			type         : "input",
																			instructions : {
																				placeholder : "isbn",
																				on          : [
																					{
																						event : "keyup",
																						call  : function (event) {
																							event.box_data.isbn = event.element.value;
																						}
																					},
																				]
																			}
																		},
																		{
																			type         : "button",
																			instructions : {
																				text : "submit",
																				on   : {
																					event : "click",
																					call  : function (event) {
																						console.log(event.box_data);
																					}
																				}
																			}
																		}
																	]
																},
															],
															submit_field_callback : function (data) {

																// if ( data.column_name === "id" ) return;
																// $.post(ajaxurl, { 
																// 	action     : "set_ticket",
																// 	method     : "freepost_ticket_value",
																// 	paramaters : {
																// 		field : data.column_name,
																// 		value : data.value,
																// 		ticket: data.row["id"]
																// 	}
																// }, function (response) {
																// 	console.log(response);
																// }, "json");

															},
															visuals : {
																on_field : {
																	border : "2px solid #222"
																},
																not_on_field : {
																	border : "2px solid #f5f5f5"
																},

															},
															class_names : {
																selected_row   : "stock_table_row_option_selected",
																table_titles   : "stock_table_titles",
																title          : "stock_table_title",
																table_wrap     : "stock_table_move_wrap",
																head           : "stock_table_title",
																field          : "stock_table_field",
																selected_field : "stock_table_field_selected",
																used_field     : "stock_table_field_used",
																option_wrap    : "stock_table_option",
																option         : {
																	button      : "stock_button",
																	box         : "stock_table_option_box",
																	description : "stock_table_option_box_description",
																	input       : "stock_table_option_box_input",
																}
															}
														});
													}
												}
											},
											self : '<div id="freepost_table" class="stock_table"></div>',
										}
									}
								},
								freepost : {
									instructions : {
										observe : {
											who      : state.stock,
											property : "page",
											call     : function (change) {
												var self = world.wrap.branch.stock.branch.freepost.self;
												if ( change.new === "freepost" ) {
													self.css({ display : "block" });
												} else { 
													self.css({ display : "none" });
												}
											}
										}
									},
									self   : '<div class="stock_table_wrap"></div>',
									branch : {
										table : {
											instructions : {
												observe : {
													who      : state.stock,
													property : "page",
													call     : function (change) {
														if ( change.new !== "freepost" || this.self[0].table ) return;

														new alpha.table({
															self         : this.self[0],
															table_name   : "freepost",
															column_width : 150,
															row_height   : 120,
															table_height : 400,
															column_number: 9,
															max_row_load : 10,
															columns      : [
																"id",
																"email",
																"first name",
																"second name",
																"address",
																"post code",
																"town",
																"area",
																"date"
															],
															submision_column_names : [
																"id",
																"email",
																"first_name",
																"second_name",
																"address",
																"post_code",
																"town",
																"area",
																"date"
															],
															options : [
																{
																	name : "load",
																	type : function () { 
																		var table = this;

																		$.get(ajaxurl, {
																			action : "get_ticket",
																			method : "freepost"
																		}, function (response) { 
																			table.set_rows(response.return);
																		}, "json");
																	}
																},
																{
																	name : "un/select",
																	type : "un_select"
																},
																{
																	name : "wipe",
																	type : function () { 
																		if ( !confirm("Are you sure you want to wipe the table?") ) return;
																		$.post(ajaxurl, {
																			action : "set_book",
																			method : "clear_table"
																		}, function (event) { 
																			console.log("table cleared");
																		},"json");
																	}
																},
																{
																	name : "export",
																	type : function () { 

																		$.get(ajaxurl, {
																			action : "get_book",
																			method : "book_table_exported_as_tab_delimited_file",
																			paramaters: {},
																		}, function (response) {
																			console.log(response.return);
																		}, "json");
																	}
																},
																{
																	name         : "add book",
																	type         : [
																		{	
																			type         : "input",
																			instructions : {
																				placeholder : "condition",
																				on          : {
																					event : "keyup",
																					call  : function (event) {
																						event.box_data.condition = event.element.value;
																					}
																				}
																			}
																		},
																		{	
																			type         : "input",
																			instructions : {
																				placeholder : "isbn",
																				on          : [
																					{
																						event : "keyup",
																						call  : function (event) {
																							event.box_data.isbn = event.element.value;
																						}
																					},
																				]
																			}
																		},
																		{
																			type         : "audio",
																			instructions : {
																				source : "mixdown.wav"
																			}
																		},
																		{
																			type         : "audio",
																			instructions : {
																				source : "mixdown2.wav"
																			}
																		},
																		{
																			type         : "button",
																			instructions : {
																				text : "submit",
																				on   : {
																					event : "click",
																					call  : function (event) {

																						console.log(event.box.children);
																						new alpha.pure_amazon_search({
																							typed       : event.box_data.isbn,
																							filter_name : "sort"
																						}, function (book) {

																							var algorithm = new alpha.algorithm();

																							if ( book === undefined || book.length === 0 ) {
																								event.box.children[2].play();
																								return;
																							}

																							book                = book[0];
																							book.condition_type = event.box_data.condition,
																							book                = algorithm.recalculate(book);

																							if ( book.refused ) {
																								event.box.children[2].play();
																								return;
																							}

																							$.post(ajaxurl, {
																								action     : "set_book",
																								method     : "book",
																								paramaters : {
																									book : book
																								}
																							}, function (change) {
																								event.box.children[3].play();
																							}, "json");
																						});															
																					}
																				}
																			}
																		}
																	]
																},
															],
															submit_field_callback : function (data) {

																if ( data.column_name === "id" ) return;

																$.post(ajaxurl, { 
																	action     : "set_ticket",
																	method     : "freepost_ticket_value",
																	paramaters : {
																		field : data.column_name,
																		value : data.value,
																		ticket: data.row["id"]
																	}
																}, function (response) {
																	console.log(response);
																}, "json");

															},
															visuals : {
																on_field : {
																	border : "2px solid #222"
																},
																not_on_field : {
																	border : "2px solid #f5f5f5"
																},

															},
															class_names : {
																selected_row   : "stock_table_row_option_selected",
																table_titles   : "stock_table_titles",
																title          : "stock_table_title",
																table_wrap     : "stock_table_move_wrap",
																head           : "stock_table_title",
																field          : "stock_table_field",
																selected_field : "stock_table_field_selected",
																used_field     : "stock_table_field_used",
																option_wrap    : "stock_table_option",
																option         : {
																	button      : "stock_button",
																	box         : "stock_table_option_box",
																	description : "stock_table_option_box_description",
																	input       : "stock_table_option_box_input",
																}
															}
														});
													}
												}
											},
											self : '<div id="freepost_table" class="stock_table"></div>',
										}
									}
								},
								table : {
									instructions : {
										observe : {
											who      : state.stock,
											property : "page",
											call     : function (change) {
												if ( change.new === "table" ) {
													this.self.css({ display : "block" });
												} else { 
													this.self.css({ display : "none" });
												}
											}
										}
									},
									self   : '<div class="stock_table_wrap"></div>',
									branch : {
										controls : {
											self : '<div class="stock_table_controls"></div>',
										},
										table : {
											instructions : {
												observe : {
													who      : state.stock,
													property : "page",
													call     : function (change) {

														if ( change.new !== "table" || this.self[0].table ) return;
															console.log("make");														
															new alpha.table({
																self         : this.self[0],
																column_width : 150,
																row_height   : 120,
																table_height : 500,
																column_number: 6,
																submit : {

																},
																// column_width : 171,
																columns : [
																	"id",
																	"email",
																	"first name",
																	"second name",
																	"address",
																	"post code",
																],
																submision_column_names : [
																	"id",
																	"email",
																	"first_name",
																	"second_name",
																	"address",
																	"post_code",
																],
																submit_field_callback : function (data) {
																	console.log(data);
																},	
																class_names : {
																	row_options  : "stock_table_row_options",
																	row_option   : "stock_table_row_option",
																	selected_row : "stock_table_row_option_selected",
																	table_titles : "stock_table_titles",
																	title        : "stock_table_title",
																	table_wrap   : "stock_table_move_wrap",
																	head  : "stock_table_title",
																	field : "stock_table_field"
																}
															});
													}
												}
											},
											self : '<div class="stock_table"></div>',
										}
									}
								},
								book : {
									instructions : {
										observe : {
											who      : state.stock,
											property : "page",
											call     : function (change) {
												var self = world.wrap.branch.stock.branch.book.self;
												if ( change.new === "book" ) {
													self.css({ display : "block" });
												} else { 
													self.css({ display : "none" });
												}
											}
										}
									},
									self : '<div class="stock_book"></div>',
									branch : {
										notifications : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														var target = $(change.event.target);
														if ( target.attr("data-type-removable") ) {
															target.remove();
														}
													}
												},
												observers : [
													{
														who      : state.stock.book,
														property : "table_wiped",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Table wiped'+
															'</div>');
														}
													},
													{
														who      : state.stock.book,
														property : "begin_recalculation",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Recalculating books'+
															'</div>');
														}
													},
													{
														who      : state.stock.book,
														property : "finish_recalculation",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Recalculation finished'+
															'</div>');
														}
													},
													{
														who      : state.stock.book,
														property : "export_table",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Exporting table'+
															'</div>');
														}
													},
													{
														who      : state.stock.book,
														property : "exported_table_link",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Table has been exported, right click and select save link as on '+
																'<a class="stock_notification_link" href="'+ change.new +'">this baby</a>'+
																' to download the text file'+
															'</div>');
														}
													},
												]
											},
											self : '<div class="stock_notifications"></div>'
										},
										control : {
											self : '<div class="stock_book_control"></div>',
											branch : {
												options : {
													self : '<div class="stock_book_options"></div>',
													branch : {
														upload : {
															self   : '<div class="stock_book_upload_wrap"></div>',
															branch : { 
																upload : {
																	instructions : {
																		on : {
																			the_event : "change",
																			is_asslep : false,
																			call      : function (change) {

																				var file, read;

																				file = change.event.target.files || change.event.dataTransfer.files;
																				read = new FileReader();
																				read.onloadend = function (data) {
																					$.post(ajaxurl,{
																						action     : "set_book",
																						method     : "clear_table",
																						paramaters : {},
																					}, function () {
																						state.stock.book.recalculate_string = data.target.result;
																					}, "json");
																				};
																				read.readAsText(file[0]);
																			}
																		},
																		observers : [
																			{
																				who      : state.stock.book,
																				property : "recalculate_string",
																				call     : function (change) {

																					var inventory, column_count, inventory_book, index, sku, asin, calculated_index, books_by;

																					inventory     = change.new.split(/\t|\n/);
																					column_count  = 0;
																					books_by      = {
																						asin  : {},
																						index : []
																					};
																					inventory.splice(0,27);
																					state.stock.book.begin_recalculation  = true;
																					state.stock.book.number_of_books.recalculated     = 0;
																					state.stock.book.number_of_books.uploaded         = 0;
																					state.stock.book.number_of_books.to_recalculate   = Math.round( inventory.length/27 );
																					state.stock.book.number_of_books.to_upload        = 0;

																					for ( index = 0; index < state.stock.book.number_of_books.to_recalculate; index++ ) {
																						calculated_index = index*27;
																				    	sku              = inventory[calculated_index+3].match(/([a-zA-Z]+)|([0-9]+)|(-[0-9]+)/g);
																				    	if ( sku.length !== 3 ) sku = [inventory[calculated_index+3].substring(0,10), "0", "00"];
																				    	asin             = inventory[calculated_index+22];
																				    	inventory_book   = {
																							section             : sku[0],
																							level               : sku[1],
																							number              : sku[2].slice(1),
																							external_product_id : asin,
																							condition_type      : inventory[calculated_index+12],
																							quantity            : inventory[calculated_index+5]
																						};

																						books_by.index.push(inventory_book);
																						( books_by.asin[asin] ? books_by.asin[asin].push(inventory_book) : books_by.asin[asin] = [inventory_book] );
																					}

																					state.stock.book.inventory_books_by = books_by;
																				}
																			},
																			{
																				who      : state.stock.book,
																				property : "inventory_books_by",
																				call     : function (change) {

																					var algorithm, asin, inventory_book, count, refused, old_book;

																					refused      = [];
																					algorithm    = new alpha.algorithm;

																					for ( count = 0; count < change.new.index.length; count++)  {

																						new alpha.pure_amazon_search({
																							typed       : change.new.index[count].external_product_id,
																							filter_name : "sort"
																						}, function (book) {

																							old_book = book;
																							state.stock.book.number_of_books.recalculated = state.stock.book.number_of_books.recalculated+1;

																							if ( book === undefined || book.length === 0 ) {
																								console.warn("book is undefined or empty");
																								return;
																							}

																							book = book[0];

																							if ( !change.new.asin[book.external_product_id] ) {				
																								if ( old_book.length > 1 ) {
																									for (var i = 0; i < old_book.length; i++) {
																										if ( change.new.asin[old_book[i].external_product_id] ) book = old_book[i];
																									};
																									if ( !change.new.asin[book.external_product_id] ) return;
																								} else {
																									return;
																								}
																							}
																							if ( change.new.asin[book.external_product_id].length === 0 ) {
																								console.warn( book.external_product_id +" is empty");
																								return;
																							}
																							inventory_book      = change.new.asin[book.external_product_id].shift();
																							book.quantity       = inventory_book.quantity;
																							book.condition_type = inventory_book.condition_type;
																							book.section        = inventory_book.section;
																							book.level          = inventory_book.level;
																							book.number         = inventory_book.number;
																							book                = algorithm.recalculate(book);

																							if ( book.refused ) {
																								refused.push(book);
																								state.stock.book.books.refused = refused;
																								return;
																							}

																							state.stock.book.number_of_books.to_upload = state.stock.book.number_of_books.to_upload+1;

																							$.post(ajaxurl, {
																								action     : "set_book",
																								method     : "book",
																								paramaters : {
																									book : book
																								}
																							}, function (change) {
																								state.stock.book.number_of_books.uploaded = state.stock.book.number_of_books.uploaded+1;
																								if ( state.stock.book.number_of_books.uploaded === state.stock.book.number_of_books.to_upload ) state.stock.book.finish_recalculation = true;
																							}, "json");

																						});
																					}
																				}
																			}
																		]
																	},
																	self : '<input type="file" class="stock_book_upload">'
																},
																count : {
																	instructions : {
																		observe : {
																			who      : state.stock.book.number_of_books,
																			property : "to_recalculate",
																			call     : function (change) {
																				this.self.css({ display : "inline-block" });
																			}
																		}
																	},
																	self   : '<div class="stock_book_recalculate_count">recalculate </div>',
																	branch : {
																		realculated : {
																			instructions : {
																				observe : {
																					who      : state.stock.book.number_of_books,
																					property : "recalculated",
																					call     : function (change) {
																						this.self.text(change.new);
																					}
																				}
																			},
																			self : '<span>0</span>',
																		},
																		out_of : {
																			self : '<span> out of </span>'
																		},
																		to_recalculate : {
																			instructions : {
																				observe : {
																					who      : state.stock.book.number_of_books,
																					property : "to_recalculate",
																					call     : function (change) {
																						this.self.text(change.new);
																					}
																				}
																			},
																			self : "<span>0</span>"
																		}
																	}
																},
																upload_count : {
																	instructions : {
																		observe : {
																			who      : state.stock.book.number_of_books,
																			property : "to_upload",
																			call     : function (change) {
																				this.self.css({ display : "inline-block" });
																			}
																		}
																	},
																	self   : '<div class="stock_book_upload_count">upload </div>',
																	branch : {
																		realculated : {
																			instructions : {
																				observe : {
																					who      : state.stock.book.number_of_books,
																					property : "uploaded",
																					call     : function (change) {
																						this.self.text(change.new);
																					}
																				}
																			},
																			self : '<span>0</span>',
																		},
																		out_of : {
																			self : '<span> out of </span>'
																		},
																		to_recalculate : {
																			instructions : {
																				observe : {
																					who      : state.stock.book.number_of_books,
																					property : "to_upload",
																					call     : function (change) {
																						this.self.text(change.new);
																					}
																				}
																			},
																			self : "<span>0</span>"
																		}
																	}
																},
															}
														},
													}
												},
												// list : {
												// 	instructions : {
												// 		observe : {
												// 			who      : state.stock.book.books,
												// 			property : "refused",
												// 			call     : function (change) {
												// 				if ( !change.new ) return;

												// 				this.self.empty();

												// 				this.self.append(
												// 					'<div class="stock_book_list_item_title">'+
												// 						'<div class="stock_book_list_item_important">Refused Books</div>'+
												// 					'</div>');

												// 				for (var index = 0; index < change.new.length; index++) {																
												// 					this.self.append(
												// 						'<div class="stock_book_list_item">'+
												// 							'<div class="stock_book_list_name">'+
												// 					 			change.new[index].item_name +
												// 					 			' sku - '+ change.new[index].section + change.new[index].level + "-"+ change.new[index].number +  
												// 					 		'</div>'+
												// 					 	'</div>');
												// 				};
												// 			}
												// 		},
												// 	},
												// 	self   : '<div class="stock_book_list"></div>',
												// 	branch : {
												// 		list_head : {
												// 			self   : '<div class="stock_book_list_item_title"></div>',
												// 			branch : {
												// 				refused_books : {
												// 					self : '<div class="stock_book_list_item_important">Refused Books</div>'
												// 				},
												// 			}
												// 		}
												// 	}
												// }
											}
										},
										book_table : {
											self : '<div class="stock_table_wrap"></div>', 
											branch : {
												table : {
													instructions : {
														observe : {
															who      : state.stock,
															property : "page",
															call     : function (change) {
																if ( change.new !== "book" || this.self[0].table ) return;

																new alpha.table({
																	self         : this.self[0],
																	table_name   : "book",
																	column_width : 150,
																	row_height   : 120,
																	table_height : 400,
																	column_number: 37,
																	max_row_load : 10,
																	columns      : [
																		"sku",
																		"section",
																		"level",
																		"number",
																		"external product id",
																		"external product id type",
																		"item name",
																		"manufacturer",
																		"product description",
																		"update delete",
																		"standard price",
																		"quantity",
																		"condition type",
																		"condition note",
																		"generic keywords1",
																		"generic keywords2",
																		"generic keywords3",
																		"generic keywords4",
																		"generic keywords5",
																		"main image url",
																		"fulfillment center id",
																		"package height",
																		"package width",
																		"package length",
																		"package dimensions unit of measure",
																		"package weight",
																		"package weight unit of measure",
																		"author",
																		"binding",
																		"publication date",
																		"edition",
																		"expedited shipping",
																		"will ship internationally",
																		"unknown subject",
																		"language value",
																		"volume base",
																		"illustrator",
																	],
																	submision_column_names : [
																		"sku",
																		"section",
																		"level",
																		"number",
																		"external_product_id",
																		"external_product_id_type",
																		"item_name",
																		"manufacturer",
																		"product_description",
																		"update_delete",
																		"standard_price",
																		"quantity",
																		"condition_type",
																		"condition_note",
																		"generic_keywords1",
																		"generic_keywords2",
																		"generic_keywords3",
																		"generic_keywords4",
																		"generic_keywords5",
																		"main_image_url",
																		"fulfillment_center_id",
																		"package_height",
																		"package_width",
																		"package_length",
																		"package_dimensions_unit_of_measure",
																		"package_weight",
																		"package_weight_unit_of_measure",
																		"author",
																		"binding",
																		"publication_date",
																		"edition",
																		"expedited_shipping",
																		"will_ship_internationally",
																		"unknown_subject",
																		"language_value",
																		"volume_base",
																		"illustrator",
																	],
																	options : [
																		{
																			name : "load",
																			type : function () { 
																				var table = this;

																				$.get(ajaxurl, {
																					action : "get_book",
																					method : "book_table"
																				}, function (response) { 
																					table.set_rows(response.return);
																				}, "json");
																			}
																		},
																		{
																			name : "un/select",
																			type : "un_select"
																		},
																		{
																			name : "wipe",
																			type : function () { 
																				if ( !confirm("Are you sure you want to wipe the table?") ) return;
																				$.post(ajaxurl, {
																					action : "set_book",
																					method : "clear_table"
																				}, function (event) { 
																					console.log("table cleared");
																				},"json");
																			}
																		},
																		{
																			name : "export",
																			type : function () { 

																				$.get(ajaxurl, {
																					action : "get_book",
																					method : "book_table_exported_as_tab_delimited_file",
																					paramaters: {},
																				}, function (response) {
																					console.log(response.return);
																				}, "json");
																			}
																		},
																		{
																			name         : "add book",
																			type         : [
																				{	
																					type         : "input",
																					instructions : {
																						placeholder : "condition",
																						on          : {
																							event : "keyup",
																							call  : function (event) {
																								event.box_data.condition = event.element.value;
																							}
																						}
																					}
																				},
																				{	
																					type         : "input",
																					instructions : {
																						placeholder : "isbn",
																						on          : [
																							{
																								event : "keyup",
																								call  : function (event) {
																									event.box_data.isbn = event.element.value;
																								}
																							},
																						]
																					}
																				},
																				{
																					type         : "audio",
																					instructions : {
																						source : "mixdown.wav"
																					}
																				},
																				{
																					type         : "audio",
																					instructions : {
																						source : "mixdown2.wav"
																					}
																				},
																				{
																					type         : "button",
																					instructions : {
																						text : "submit",
																						on   : {
																							event : "click",
																							call  : function (event) {

																								console.log(event.box.children);
																								var self = this;

																								new alpha.pure_amazon_search({
																									typed       : event.box_data.isbn,
																									filter_name : "sort"
																								}, function (book) {

																									var algorithm = new alpha.algorithm();

																									if ( book === undefined || book.length === 0 ) {
																										event.box.children[2].play();
																										return;
																									}

																									book                = book[0];
																									book.condition_type = event.box_data.condition,
																									book                = algorithm.recalculate(book);

																									if ( book.refused ) {
																										event.box.children[2].play();
																										return;
																									}
																									self.set_row({
																										"sku"     : "",
																										"section" : "",
																										"level"   : "",
																										"number"  : "",
																										"external_product_id" : book.external_product_id,
																										"external_product_id_type" : "ASIN",
																										"item_name" : book.item_name,
																										"manufacturer" : book.manufacturer,
																										"product_description" : "",
																										"update_delete" : "",
																										"standard_price" : book.standard_price,
																										"quantity" : "",
																										"condition_type" : book.condition_type,
																										"condition_note" : "",
																										"generic_keywords1" : "",
																										"generic_keywords2" : "",
																										"generic_keywords3" : "",
																										"generic_keywords4" : "",
																										"generic_keywords5" : "",
																										"main_image_url" : book.main_image_url,
																										"fulfillment_center_id" : "",
																										"package_height" : book.package_height,
																										"package_width"  : book.package_weight,
																										"package_length" : book.package_length,
																										"package_dimensions_unit_of_measure" : book.package_dimensions_unit_of_measure,
																										"package_weight" : "",
																										"package_weight_unit_of_measure" : book.package_weight_unit_of_measure, 
																										"author" : book.author,
																										"binding" : book.binding,
																										"publication_date" : book.publication_date,
																										"edition" : "",
																										"expedited_shipping" : "",
																										"will_ship_internationally" : "",
																										"unknown_subject" : "",
																										"language_value" : "",
																										"volume_base" : "",
																										"illustrator" : ""
																									});

																									$.post(ajaxurl, {
																										action     : "set_book",
																										method     : "book",
																										paramaters : {
																											book : book
																										}
																									}, function (change) {
																										event.box.children[3].play();
																									}, "json");
																								});															
																							}
																						}
																					}
																				}
																			]
																		},
																	],
																	submit_field_callback : function (data) {

																		if ( data.column_name === "id" ) return;

																		$.post(ajaxurl, { 
																			action     : "set_ticket",
																			method     : "freepost_ticket_value",
																			paramaters : {
																				field : data.column_name,
																				value : data.value,
																				ticket: data.row["id"]
																			}
																		}, function (response) {
																			console.log(response);
																		}, "json");

																	},
																	visuals : {
																		on_field : {
																			border : "2px solid #222"
																		},
																		not_on_field : {
																			border : "2px solid #f5f5f5"
																		},

																	},
																	class_names : {
																		selected_row   : "stock_table_row_option_selected",
																		table_titles   : "stock_table_titles",
																		title          : "stock_table_title",
																		table_wrap     : "stock_table_move_wrap",
																		head           : "stock_table_title",
																		field          : "stock_table_field",
																		selected_field : "stock_table_field_selected",
																		used_field     : "stock_table_field_used",
																		option_wrap    : "stock_table_option",
																		option         : {
																			button      : "stock_button",
																			box         : "stock_table_option_box",
																			description : "stock_table_option_box_description",
																			input       : "stock_table_option_box_input",
																		}
																	}
																});
															}
														}
													},
													self : '<div id="book_table" class="stock_table"></div>',
												}
											}
										}
									}
								},
								bus : {
									instructions : {
										observers : [
											{
												who      : state.stock,
												property : "page",
												call     : function (change) {
													if ( change.new === "bus" ) {
														this.self.css({ display : "block" });
													} else { 
														this.self.css({ display : "none" });
													}
												}
											},
											{
												who      : state.stock.bus,
												property : "reset",
												call     : function (change) {
													if ( !change.new ) return;
													for ( var part in state.addresses[0] ) state.addresses[0][part] = "";
													for ( var part in state.account ) state.account[part] = preset.account[part];
													state.signed                       = false;
													state.stock.bus.print              = false;
													state.stock.bus.search             = false;
													state.stock.bus.searching          = false;
													state.stock.bus.done               = false;
													state.stock.bus.search_query       = "";
													state.stock.bus.add_book           = false;
													state.stock.bus.submit_expenses    = false;
													state.stock.bus.submiting_expenses = false;
													state.stock.bus.expenses_submited  = false;
													state.stock.bus.expenses           = [];
													state.stock.bus.add                = false;
													state.stock.bus.adding             = false;
													state.stock.bus.adding_books       = [];
													state.stock.bus.added_books        = false;
													state.stock.bus.submit             = false;
													state.stock.bus.print              = false;
													state.stock.bus.books              = [];
													state.stock.bus.total              = 0.00;
													state.stock.bus.cheque_spell       = "";
													state.stock.bus.reset              = false;
												}
											},
										]
									},
									self   : '<div class="stock_bus"></div>',
									branch : {
										notifications : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														var target = $(change.event.target);
														if ( target.attr("data-type-removable") ) {
															target.remove();
														}
													}
												},
												observers : [
													{
														who      : state.stock.bus,
														property : "search",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Searching for : '+ state.stock.bus.search_query +
															'</div>');
														}
													},
													{
														who      : state.stock.bus,
														property : "done",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Found book : '+ state.stock.bus.books[state.stock.bus.books.length-1].item_name +
															'</div>');
														}
													},
													{
														who      : state.stock.bus,
														property : "total",
														call     : function (change) {
															if ( isNaN(change.new) ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Total is now : '+ change.new.toFixed(2) +
															'</div>');
														}
													},
													{
														who      : state.stock.bus,
														property : "submit_expenses",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Preparing to submit how much we spent for these book/s'+
															'</div>');
														}
													},
													{
														who      : state.stock.bus,
														property : "submitting_expenses",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Submiting expenses to talbe'+
															'</div>');
														}
													},
													{
														who      : state.stock.bus,
														property : "submited_expenses",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Expenses submited total spent is : '+ state.stock.bus.total +
															'</div>');
														}
													},
													{
														who      : state.stock.bus,
														property : "add",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Preparing to get new quotes on books'+
															'</div>');
														}
													},
													{
														who      : state.stock.bus,
														property : "adding",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Getting new prices from amazon for the books'+
															'</div>');
														}
													},
													{
														who      : state.stock.bus,
														property : "added_books",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Got prices from amazon, now submiting books to book table'+
															'</div>');
														}
													},
													{
														who      : state.stock.bus,
														property : "submit",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Is safe to print now'+
															'</div>');
														}
													},
													{
														who      : state.stock.bus,
														property : "reset",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Everything has been reset, can start again now'+
															'</div>');
														}
													}
												]
											},
											self : '<div class="stock_notifications"></div>'
										},
										search : {
											self : '<div class="bus_control_slide"></div>',
											branch : {
												items  : {
													instructions : {
														on_events : [
															{
																the_event : "click",
																is_asslep : false,
																call      : function (change) {
																	if ( change.event.target.className !== "bus_control_remove" ) return;

																	$('#'+ change.event.target.id).parent().remove();
																	if ( change.event.target.id !== "remove" ) {
																		state.stock.bus.total = state.stock.bus.total - parseFloat( state.stock.bus.books[change.event.target.id-1].standard_price);
																		state.stock.bus.books[change.event.target.id-1] = null;
																	}
																}
															},
															{
																the_event : "keypress",
																is_asslep : false,
																call      : function (change) {
																	if ( change.event.keyCode === 13 ) {
																		var part, id, value, target = $(change.event.target);

																		if ( !target.attr("data-type-changeable") ) return;
																		target.blur();
																		value = target.val().trim();
																		id    = target.attr("data-type-book");
																		field = target.attr("data-type-field");

																		if ( field === "condition_type" ) {
																			state.stock.bus.books[id-1][field] = value;
																		}

																		if ( field === "standard_price" ) {
																			value = parseFloat( value );
																			if ( isNaN(value) ) {
																				target.val(state.stock.bus.books[id-1][field]);
																				return;
																			}
																			state.stock.bus.total = state.stock.bus.total - state.stock.bus.books[id-1][field];
																			state.stock.bus.total = state.stock.bus.total + value;
																			state.stock.bus.books[id-1][field] = value;
																		}
																	}
																}
															}
														],
														observers : [
															{
																who      : state.stock.bus,
																property : "search",
																call : function (change) {
																	if ( !change.new ) return;
																	state.stock.bus.searching = true;

																	var algorithm, amazon;

																	amazon    = new alpha.pure_amazon_search({
																		typed       : state.stock.bus.search_query,
																		filter_name : "sort"
																	}, function (book) {
																		algorithm = new alpha.algorithm
																		book      = algorithm.bus(book[0]);
																		state.stock.bus.books.push(book);
																		state.stock.bus.add_book  = book;
																		state.stock.bus.done      = true;
																		state.stock.bus.searching = false;
																	});
																}
															},
															{
																who      : state.stock.bus,
																property : "books",
																call     : function (change) {
																	if ( change.new.length > 0 ) return;
																	this.self.empty();
																}
															},
															{
																who      : state.stock.bus,
																property : "add_book",
																call     : function (change) {
																	if ( !change.new ) return;
																	var book_id = state.stock.bus.books.length;
																	$('<div class="bus_control_item">'+
																		'<div class="bus_control_item_isbn">'  + change.new.external_product_id     +'</div>'+
																		'<input data-type-changeable="true" data-type-book="'+ book_id +'" data-type-field="condition_type" maxlength="2" class="bus_control_item_condition" value="'+ change.new.condition_type +'">'+
																		'<div class="bus_control_item_title">' + change.new.item_name               +'</div>'+
																		'<input data-type-changeable="true" data-type-book="'+ book_id +'" data-type-field="standard_price" class="bus_control_item_total" maxlength="6" value="'+ change.new.standard_price +'">'+
																		'<div class="bus_control_remove" id="' + book_id +'">Remove</div>'+
																	'</div>').appendTo(this.self);
																}
															},
															{
																who      : state.stock.bus,
																property : "submit_expenses",
																call     : function (change) {
																	if ( !change.new ) return;
																	var index, book, get_date, date;

																	get_date = new Date();
																	date     = get_date.getFullYear() +"-"+ get_date.getMonth() +"-"+ get_date.getDay();

																	for (index = 0; index < state.stock.bus.books.length; index++) {
																		if ( state.stock.bus.books[index] === null ) {
																			state.stock.bus.books.splice(index,1);
																		}
																	};

																	for (index = 0; index < state.stock.bus.books.length; index++) {
																		book = state.stock.bus.books[index];
																		state.stock.bus.expenses.push({
																			book      : book.item_name,
																			book_asin : book.external_product_id,
																			amount    : book.standard_price,
																			date      : date
																		});
																	};
																	state.stock.bus.submiting_expenses = true;
																}
															},
															{
																who      : state.stock.bus,
																property : "submiting_expenses",
																call     : function (change) {
																	if ( !change.new ) return;

																	$.post(ajaxurl, {
																		action : "set_expense",
																		method : "rows",
																		paramaters : {
																			rows : state.stock.bus.expenses
																		}
																	}, function () {
																		state.stock.bus.submited_expenses = true;
																	}, "json");
																}
															},
															{
																who      : state.stock.bus,
																property : "submited_expenses",
																call     : function (change) {
																	if ( change.new ) state.stock.bus.add = true;
																}
															},
															{
																who      : state.stock.bus,
																property : "add",
																call     : function (change) {
																	if ( !change.new ) return;

																	var index, amazon, books;
																	
																	index                  = 0;
																	state.stock.bus.adding = true;
																	

																	for (; index < state.stock.bus.books.length; index++) {

																		amazon = new alpha.pure_amazon_search({
																			typed       : state.stock.bus.books[index].external_product_id,
																			filter_name : "sort"
																		}, function (book) {
																			book                = book[0];
																			if ( book.standard_price !== "0.00" ) book.standard_price = parseFloat(book.standard_price) - 0.1;
																			book.standard_price = book.standard_price.toFixed(2);
																			books               = state.stock.bus.adding_books;
																			books.push(book);
																			state.stock.bus.adding_books = books;

																			if ( index === state.stock.bus.adding_books.length ) {
																				state.stock.bus.adding      = false;
																				state.stock.bus.added_books = true;
																			}
																		}, "json");
																	};
																}	
															},
															{
																who      : state.stock.bus,
																property : "added_books",
																call     : function (change) {
																	if ( !change.new ) return;

																	$.post(ajaxurl, {
																		action     : "set_book",
																		method     : "books",
																		paramaters : {
																			books : state.stock.bus.adding_books
																		}
																	}, function () {
																		state.stock.bus.submit = true;
																	},"json");
																}
															}
														],
													},
													self : '<div class="bus_control_items"></div>'
												},
												total : {
													instructions : {
														observers : [
															{ 
																who      : state.stock.bus,
																property : "add_book",
																call     : function (change) {
																	state.stock.bus.total += parseFloat( change.new.standard_price );
																}
															},
															{ 
																who      : state.stock.bus,
																property : "total",
																call     : function (change) {
																	this.self.val(change.new.toFixed(2));
																}
															},
														],
														on : {
															the_event : "keypress",
															is_asslep : false,
															call      : function (change) {
																if ( change.event.keyCode === 13 ) {
																	change.self.blur();
																	var value = parseFloat( change.self.val().trim() );
																	if ( isNaN(value) ) {
																		change.self.val(state.stock.bus.total);
																		return;
																	}
																	state.stock.bus.total = value;
																}
															}
														}
													},
													self : '<input class="bus_control_total" maxlength="6" value="0.00">',
												},
												search : {
													instructions : {
														on : {
															the_event : "keypress",
															is_asslep : false,
															call      : function (change) {
																if ( change.event.keyCode === 13 ) {
																	state.stock.bus.search_query = change.self.val().trim();
																	state.stock.bus.search       = true;
																	change.self.val("");
																}
															}
														}	
													},
													self : '<input type="text" class="bus_search">'
												},
											}
										},
										register :{ 
											instructions : {
												observe : {
													who      : state.stock.bus,
													property : "send_email",
													call     : function (change) {
														if ( !change.new ) return;
														state.stock.bus.sending_email = true;
														$.post(ajaxurl, {
															action      : "set_email",
															method     : "email",
															paramaters : {
																name    : state.account.first_name,
																email   : state.account.email,
																subject : "Come back anytime",
																text    : "<p>Hey we just wanted to say thank you for using the Recyclabus, and we hope that you return to us one day if you have any more books to sell.</p><p>If you remember you gave us some info when you sold your books to us, we've made an account for you based on that information, don't worry its nothing big, now you can simply use our services online as well, if our bus doesn't happen to be in town.<p><p>You never have to use your account if you don't want to, but its there for you if you need it.</p><p>Your account name is"+ state.account.email +"(your email)</p><p>and your password is"+ state.account.password +"(we randomly generated it, you can change it when you sign in)</p>"
															}
														}, function (response) {
															state.stock.bus.sent_email = true;
														}, "json");
													}
												},
											},
											self : '<div class="bus_control_slide"></div>',
											branch : {
												first_name : {
													instructions : {
														on : {
															the_event : "keyup",
															is_asslep : false,
															call      : function (change) {
																state.account.first_name = change.self.val().trim();
															}
														},
														observe : {
															who      : state.account,
															property : "first_name",
															call     : function (change) {
																if ( state.stock.bus.reset ) this.self.val(change.new);
															}
														}
													},
													self : '<input maxlength="22" type="text" class="bus_control_input" placeholder="First Name">',
												},
												second_name : {
													instructions : {
														on : {
															the_event : "keyup",
															is_asslep : false,
															call      : function (change) {
																state.account.second_name = change.self.val().trim();
															}
														},
														observe : {
															who      : state.account,
															property : "second_name",
															call     : function (change) {
																if ( state.stock.bus.reset ) this.self.val(change.new);
															}
														}
													},
													self : '<input maxlength="22" type="text" class="bus_control_input" placeholder="Second Name">',
												},
												email : {
													instructions : {
														on : {
															the_event : "keyup",
															is_asslep : false,
															call      : function (change) {
																state.account.email = change.self.val().trim();
															}
														},
														observe : {
															who      : state.account,
															property : "email",
															call     : function (change) {
																if ( state.stock.bus.reset )  this.self.val(change.new);
															}
														}
													},
													self : '<input maxlength="30" type="text" class="bus_control_input" placeholder="Email">',
												},
												university : {
													instructions : {
														on : {
															the_event : "keyup",
															is_asslep : false,
															call      : function (change) {
																state.account.university = change.self.val().trim();
															}
														},
														observe : {
															who      : state.account,
															property : "university",
															call     : function (change) {
																if ( state.stock.bus.reset ) this.self.val(change.new);
															}
														}
													},
													self : '<input maxlength="55" type="text" class="bus_control_input" placeholder="University">',
												},
												year : {
													instructions : {
														on : {
															the_event : "keyup",
															is_asslep : false,
															call      : function (change) {
																state.account.year = change.self.val().trim();
															}
														},
														observe : {
															who      : state.account,
															property : "year",
															call     : function (change) {
																if ( state.stock.bus.reset ) this.self.val(change.new);
															}
														}
													},
													self : '<input maxlength="4" type="text" class="bus_control_input" placeholder="Year">',
												},
												subject : {
													instructions : {
														on : {
															the_event : "keyup",
															is_asslep : false,
															call      : function (change) {
																state.account.subject = change.self.val().trim();
															}
														},
														observe : {
															who      : state.account,
															property : "subject",
															call     : function (change) {
																if ( state.stock.bus.reset ) this.self.val(change.new);
															}
														}
													},
													self : '<input maxlength="30" type="text" class="bus_control_input" placeholder="Subject">',
												},
											}
										},
										donate : {
											self : '<div class="bus_control_slide"></div>',
											branch : {
												increment : {
													self : '<div class="bus_control_increment_wrap"></div>',
													branch : {
														value : {
															instructions : {
																observers : [
																	{
																		who      : state,
																		property : "withdraw",
																		call     : function (change) {
																			this.self.val("£"+ change.new);
																		}
																	},
																	{
																		who      : state.stock.bus,
																		property : "total",
																		call     : function (change) {
																			if ( change.new < parseFloat( state.withdraw ) ) {
																				state.withdraw = change.new.toFixed(2);
																			}
																		}
																	},
																]
															},
															self : '<input type="text" class="bus_control_increment_value" value="0.00" readonly>'
														},
														minus : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		var value = parseFloat(state.withdraw) - 0.5;
																			if ( value < 0.00 ) value = 0.00
																			value = value.toFixed(2);
																			state.withdraw = value;	
																	}
																}
															},
															self : '<div class="bus_control_increment_minus">-</div>'
														},
														plus : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		var value = parseFloat(state.withdraw) + 0.5;
																			if ( value > state.stock.bus.total ) value = parseFloat(state.stock.bus.total);
																			value = value.toFixed(2);
																			state.withdraw = value;
																	}
																}
															},
															self : '<div class="bus_control_increment_plus">+</div>'
														}
													}
												},
												total_reminder : {
													instructions : {
														observers : [
															{
																who      : state,
																property : "withdraw",
																call     : function (change) {
																	var total;
																	total = state.stock.bus.total - parseFloat( change.new );
																	total = total.toFixed(2);
																	state.stock.bus.final_total = total;
																}
															},
															{
																who      : state.stock.bus,
																property : "total",
																call     : function (change) {
																	var total;
																	total = change.new - parseFloat( state.withdraw );
																	total = total.toFixed(2);
																	state.stock.bus.final_total = total;
																}
															},
														 	{
																who      : state.stock.bus,
																property : "final_total",
																call     : function (change) {
																	this.self.val("£"+ change.new);
																}
															}
														]
													},
													self : '<input type="text" class="bus_control_spell_sum" value="0.00" readonly>'
												},
												spell_sum : {
													instructions : {
														on : {
															the_event : "keyup",
															is_asslep : false,
															call      : function (change) {
																state.stock.bus.cheque_spell = change.self.val();
															}
														},
														observe : {
															who      : state.stock.bus,
															property : "cheque_spell",
															call     : function (change) {
																this.self.val(change.new);
															}
														}
													},
													self : '<input type="text" class="bus_control_spell_sum" placeholder="Price text">'
												},
												controls : {
													self : '<div class="bus_control_progress"></div>',
													branch : {
														reset : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		if(confirm("Reset?")) state.stock.bus.reset = true;
																	}
																}
															},
															self : '<div class="bus_control_progress_text">Reset</div>',
														},
														print : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		state.stock.bus.print = true;
																	}
																}
															},
															self : '<div class="bus_control_progress_text">Print</div>',
														},
														submit : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		if (confirm("Ready to submit?") ) {
																			state.account.password          = Math.random().toFixed(7).slice(2);
																			state.process.send_email        = true;
																			state.process.false_register    = true;
																			state.stock.bus.submit_expenses = true;
																		}
																	}
																}
															},
															self : '<div class="bus_control_progress_text">Save&Submit</div>',
														},
													}
												}
											}
										},
										print : {
											instructions : {
												observe : {
													who      : state.stock.bus,
													property : "print",
													call     : function (change) {
														if ( change.new  ) {
															this.self.css({ display : "block" });
														} else { 
															this.self.css({ display : "none" });
														}
													}
												}
											},
											self : '<div class="bus_control_print"></div>',
											branch : { 
												print_controls : {
													self : '<div class="bus_control_print_controls"></div>',
													branch : {
														print : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		window.print();
																	}
																}
															},
															self : '<div class="bus_control_print_control">Print</div>'
														},
														back : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		state.stock.bus.print = false;
																	}
																}
															},
															self : '<div class="bus_control_print_control">Go Back</div>'
														},
														reset : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		if(confirm("Reset?")) state.stock.bus.reset = true;
																	}
																}
															},
															self : '<div class="bus_control_print_control">Reset everything & go back</div>'
														}
													}
												},
												name : {
													instructions : {
														observe : {
															who      : state.account,
															property : "first_name",
															call     : function (change) {
																this.self.text(change.new);
															}
														}
													},
													self : '<div class="bus_control_print_name"></div>'
												},
												books : {
													self : '<div class="bus_control_print_books"></div>'
												},
												cheque_name : {
													self : '<div class="bus_control_print_cheque_name"></div>',
													branch : {
														first_name : {
															instructions : {
																observe : {
																	who      : state.account,
																	property : "first_name",
																	call     : function (change) {
																		world.wrap.branch.stock.branch.bus.branch.print.branch.cheque_name.branch.first_name.self.text(change.new +" ");
																	}
																}
															},
															self : '<span></span>'
														},
														second_name : {
															instructions : {
																observe : {
																	who      : state.account,
																	property : "second_name",
																	call     : function (change) {
																		world.wrap.branch.stock.branch.bus.branch.print.branch.cheque_name.branch.second_name.self.text(change.new);
																	}
																}
															},
															self : '<span></span>'
														}
													}
												},
												cheque_sum_text : {
													instructions : {
														observe : {
															who      : state.stock.bus,
															property : "cheque_spell",
															call     : function (change) {
																this.self.text(change.new);
															}
														}
													},
													self : '<div class="bus_control_print_cheque_quote_text"></div>'
												},
												cheque_date : {
													instructions : {
														observe : {
															who      : state.stock.bus,
															property : "print",
															call     : function (change) {
																var date, today, month;
																date  = new Date();	
																month = parseInt( date.getMonth() ) + 1;
																today =  date.getDate() +"/"+ month +"/"+ date.getFullYear();
																this.self.text(today);
															}
														}
													},
													self : '<div class="bus_control_print_cheque_date"></div>'
												},
												cheque_sum : {
													instructions : {
														observe : {
															who      : state.stock.bus,
															property : "final_total",
															call     : function (change) {
																this.self.text("£"+ change.new);
															}
														}
													},
													self : '<div class="bus_control_print_cheque_quote"></div>'
												}
											}
										},
									}
								},
								post: {
									instructions : {
										observe : {
											who      : state.stock,
											property : "page",
											call     : function (change) {
												if ( change.new === "post" ) {
													this.self.css({ display : "block" });
												} else { 
													this.self.css({ display : "none" });
												}
											}
										}
									},
									self : '<div class="stock_post"></div>',
									branch : {
										notifications : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														var target = $(change.event.target);
														if ( target.attr("data-type-removable") ) {
															target.remove();
														}
													}
												},
												observers : [
													{
														who      : state.stock.post,
														property : "searching_user",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Searching for user : '+ state.stock.post.search_user_query +
															'</div>');
														}
													},
													{
														who      : state.stock.post,
														property : "found_user",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Found user : '+ state.stock.post.user.email +
															'</div>');
														}
													},
													{
														who      : state.stock.post,
														property : "searching_book",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Searching for book : '+ state.stock.post.search_book_query +
															'</div>');
														}
													},
													{
														who      : state.stock.post,
														property : "found_book",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Found book : '+ state.stock.post.books[state.stock.post.books.length-1].item_name +
															'</div>');
														}
													},
													{
														who      : state.stock.post,
														property : "price_promise_match",
														call     : function (change) {
															if ( change.new.length === 0 ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Found price promise for : '+ state.stock.post.price_promise_match[state.stock.post.price_promise_match.length-1] +
															'</div>');
														}
													},
													{
														who      : state.stock.post,
														property : "error",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																change.new +
															'</div>');
														}
													},
													{
														who      : state.stock.post,
														property : "total",
														call     : function (change) {
															if ( isNaN(change.new) ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Total is now : '+ change.new.toFixed(2) +
															'</div>');
														}
													},
													{
														who      : state.stock.post,
														property : "submit_book",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Submitting books to table'+
															'</div>');
														}
													},
													{
														who      : state.stock.post,
														property : "submited_book",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Submited books to table'+
															'</div>');
														}
													},
													{
														who      : state.stock.post,
														property : "submit_credit",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Incresing the users credit'+
															'</div>');
														}
													},
													{
														who      : state.stock.post,
														property : "submited_credit",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'The users credit has been increased'+
															'</div>');
														}
													},
													{
														who      : state.stock.post,
														property : "finished",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Credit and books are now being submited, '+ 
																'the user will gain a credit increase of : £'+ state.stock.post.total.toFixed(2) +
																', and '+ state.stock.post.books.length +' new books shall be added to the table; '+
																' to start again simply type in a new user id and begin a new session'+
															'</div>');
														}
													},
													{
														who      : state.stock.post,
														property : "sending_email",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'An email is being sent to '+ state.stock.post.user.email +
																' to inform them of their increased credit.'+
															'</div>');
														}
													},
													{
														who      : state.stock.post,
														property : "sent_email",
														call     : function (change) {
															if ( !change.new ) return;
															this.self.prepend('<div title="click to remove" data-type-removable="true" class="stock_notification">'+
																'Email sent'+
															'</div>');
														}
													},
												]
											},
											self : '<div class="stock_notifications"></div>'
										},
										search : {
											self : '<div class="post_search"></div>',
											branch : {
												user : {
													instructions : {
														observers : [
															{
																who      : state.stock.post,
																property : "search_user",
																call     : function (change) {
																	if ( !change.new ) return;
																	
																	state.stock.post.searching_user = true;

																	$.get(ajaxurl, {
																		action : "get_account",
																		method : "account_by_id",
																		paramaters : {
																			id : state.stock.post.search_user_query
																		}
																	}, function (response) {

																		if ( !response.return ) {
																			state.stock.post.error = "User not found, try something else";
																			return;
																		}

																		state.stock.post.user          = response.return;
																		state.stock.post.seaching_user = false;
																		state.stock.post.found_user    = true;
																	},"json");
																}
															},
															{
																who      : state.stock.post,
																property : "found_user",
																call     : function (change) {
																	if ( !change.new ) return;
																	state.stock.post.finished            = false;
																	state.stock.post.search_book_query   = "";
																	state.stock.post.search_book         = false;
																	state.stock.post.searching_book      = false;
																	state.stock.post.found_book          = false;
																	state.stock.post.books               = [];
																	state.stock.post.add_book            = false;
																	state.stock.post.price_promise_match = [];
																	state.stock.post.total               = 0;
																	state.stock.post.error               = "";
																	state.stock.post.submit_credit       = false;
																	state.stock.post.submiting_credit    = false;
																	state.stock.post.submited_credit     = false;
																	state.stock.post.submit_book         = false;
																	state.stock.post.submiting_book      = false;
																	state.stock.post.submited_book       = false;
																}
															},
															{
																who      : state.stock.post,
																property : "user",
																call     : function (change) {
																	this.self.empty();
																	this.self.append(
																	'<div class="post_user_id">'+ 
																		change.new.id 
																	+'</div>'+
																	'<div class="post_user_name">'+ 
																		change.new.first_name + change.new.second_name 
																	+'</div>'+
																	'<div class="post_user_email">'+
																		change.new.email
																	+'</div>');
																}
															},
															{
																who      : state.stock.post,
																property : "send_email",
																call     : function (change) {
																	if ( !change.new ) return;
																	state.stock.post.sending_email = true;
																	$.post(ajaxurl, {
																		action : "set_email",
																		method : "email",
																		paramaters : {
																			name    : state.stock.post.user.first_name,
																			email   : state.stock.post.user.email,
																			subject : "We have recieved your books",
																			text    : "<p>Hi there "+ state.stock.post.user.first_name + state.stock.post.user.second_name +"<p><p>Congratulations we have received your book(s).</p><p>Your credit has increased by £"+ state.stock.post.total +"</p><p>To get your money all you have to do is log into your account at Recyclabook.com and press withdraw amount, and we will send you your money</p><p>This is to make sure we send your money to the correct place.</p><p>Remember, you can donate the amount of your choice to your universities RAG campaign.</p><p>Thank you for using Recyclabook to sell your textbooks.</p>"
																		}
																	}, function (response) {
																		state.stock.post.sent_email = true;
																	}, "json");
																}
															},
														]
													},
													self   : '<div class="post_user"></div>'
												},
												items  : {
													instructions : {
														on_events : [
															{
																the_event : "click",
																is_asslep : false,
																call      : function (change) {
																	if ( change.event.target.className !== "post_book_remove" ) return;

																	$('#'+ change.event.target.id).parent().remove();
																	if ( change.event.target.id !== "remove" ) {
																		state.stock.post.total = state.stock.post.total - parseFloat( state.stock.post.books[change.event.target.id-1].standard_price);
																		state.stock.post.books[change.event.target.id-1] = null;
																	}
																}
															},
															{
																the_event : "keypress",
																is_asslep : false,
																call      : function (change) {
																	if ( change.event.keyCode === 13 ) {

																		var part, id, value, target = $(change.event.target);
																		if ( !target.attr("data-type-changeable") ) return;
																		target.blur();
																		value = target.val().trim();
																		id    = target.attr("data-type-book");
																		field = target.attr("data-type-field");

																		if ( field === "condition_type" ) {
																			state.stock.post.books[id-1][field] = value;
																		}

																		if ( field === "standard_price" ) {
																			value = parseFloat( value );
																			if ( isNaN(value) ) {
																				target.val(state.stock.post.books[id-1][field]);
																				return;
																			}
																			state.stock.post.total = state.stock.post.total - state.stock.post.books[id-1][field];
																			state.stock.post.total = state.stock.post.total + value;
																			state.stock.post.books[id-1][field] = value;
																		}
																	}
																}
															}
														],
														observers : [
															{
																who      : state.stock.post,
																property : "search_book",
																call : function (change) {
																	if ( !change.new ) return;

																	var algorithm, amazon, index, price_promise;

																	state.stock.post.searching_book = true;

																	amazon = new alpha.pure_amazon_search({
																		typed       : state.stock.post.search_book_query,
																		filter_name : "sort"
																	}, function (book) {
																		if ( book.length === 0 ) {
																			state.stock.post.error = "Nothing found, if you typed in a valid value search again"
																			return;
																		}

																		algorithm  = new alpha.algorithm
																		book       = algorithm.post(book[0]);

																		for (index = 0; index < state.stock.post.user.price_promise.length; index++) {

																			if ( book.external_product_id === state.stock.post.user.price_promise[index].asin ) {

																				book.standard_price = state.stock.post.user.price_promise[index].price;
																				price_promise       = state.stock.post.price_promise_match;
																				price_promise.push(book.item_name);
																				state.stock.post.price_promise_match = price_promise;
																				break;
																			}
																		};
																		state.stock.post.books.push(book);
																		state.stock.post.found_book     = true;
																		state.stock.post.searching_book = false;
																		state.stock.post.add_book 	    = book;
																	});
																}
															},
															{
																who      : state.stock.post,
																property : "books",
																call     : function (change) {
																	if ( change.new.length > 0 ) return;
																	this.self.empty();
																}
															},
															{
																who      : state.stock.post,
																property : "add_book",
																call     : function (change) {
																	if ( !change.new ) return;
																	var book_id = state.stock.post.books.length;
																	$('<div class="bus_control_item">'+
																		'<div class="bus_control_item_isbn">'  + change.new.external_product_id     +'</div>'+
																		'<input data-type-changeable="true" data-type-book="'+ book_id +'" data-type-field="condition_type" maxlength="2" class="bus_control_item_condition" value="'+ change.new.condition_type +'">'+
																		'<div class="bus_control_item_title">' + change.new.item_name               +'</div>'+
																		'<input data-type-changeable="true" data-type-book="'+ book_id +'" data-type-field="standard_price" class="bus_control_item_total" maxlength="6" value="'+ change.new.standard_price +'">'+
																		'<div class="post_book_remove" id="'   + book_id +'">Remove</div>'+
																	'</div>').appendTo(this.self);
																}
															},
															{
																who      : state.stock.post,
																property : "submit_book",
																call     : function (change) {
																	if ( !change.new ) return;

																	state.stock.post.submiting_book = true;

																	$.post(ajaxurl, {
																		action     : "set_book",
																		method     : "books",
																		paramaters : {
																			books : state.stock.post.books
																		}
																	}, function () {
																		state.stock.post.submited_book = true;
																	},"json");
																}
															},
															{
																who      : state.stock.post,
																property : "submit_credit",
																call     : function (change) {
																	if ( !change.new ) return;

																	state.stock.post.submiting_credit = true;

																	var credit = ( parseFloat( state.stock.post.user.credit ) + state.stock.post.total ).toFixed(2);

																	$.post(ajaxurl, {
																		action     : "set_account",
																		method     : "account_value",
																		paramaters : {
																			id         : state.stock.post.user.email,
																			value_name : "credit",
																			value      : credit
																		}
																	}, function () {
																		state.stock.post.submited_credit = true;
																	},"json");
																}
															}
														]
													},
													self : '<div class="post_books"></div>'
												},
												total : {
													instructions : {
														observers : [
															{ 
																who      : state.stock.post,
																property : "add_book",
																call     : function (change) {
																	state.stock.post.total += parseFloat( change.new.standard_price );
																}
															},
															{ 
																who      : state.stock.post,
																property : "total",
																call     : function (change) {
																	this.self.val(change.new.toFixed(2));
																}
															},
														],
														on : {
															the_event : "keypress",
															is_asslep : false,
															call      : function (change) {
																if ( change.event.keyCode === 13 ) {
																	change.self.blur();
																	var value = parseFloat( change.self.val().trim() );
																	if ( isNaN(value) ) {
																		change.self.val(state.stock.post.total);
																		return;
																	}
																	state.stock.post.total = value;
																}
															}
														}
													},
													self : '<input class="post_book_total" maxlength="6" value="0.00">',
												},
												user_search : {
													instructions : {
														on : {
															the_event : "keypress",
															is_asslep : false,
															call      : function (change) {
																if ( change.event.keyCode === 13 ) {
																	state.stock.post.search_user_query = change.self.val();
																	state.stock.post.search_user       = true;
																	change.self.next().focus();
																}
															}
														}
													},
													self : '<input type="text" class="post_user_search" placeholder="User">'
												},
												book_search : {
													instructions : {
														on : {
															the_event : "keypress",
															is_asslep : false,
															call      : function (change) {
																if ( change.event.keyCode === 13 ) {

																	if ( state.stock.post.finished ) {
																		state.stock.post.error = "This sessions and its books have been submited, to move onto the next user : type in a new user id in the user field";	
																		return;
																	}
																	if ( !state.stock.post.user.id ) {
																		state.stock.post.error = "User must be found before searching books"
																		return;
																	}
																	state.stock.post.search_book_query = change.self.val();
																	state.stock.post.search_book       = true;
																	change.self.val("");
																}
															}
														}
													},
													self : '<input type="text" class="post_book_search" placeholder="ISBN">'
												},
												submit : {
													instructions : {
														on : {
															the_event : "click",
															is_asslep : false,
															call      : function (change) {

																if ( !state.stock.post.user.id ) {
																	state.stock.post.error = "Find a user to submit to first";
																	return;
																}

																if ( state.stock.post.books.length === 0 ) {
																	state.stock.post.error = "There are no books to be paid for here";
																	return;
																}

																if ( state.stock.post.finished ) {
																	state.stock.post.error = "This sessions and its books have been submited, to move onto the next user : type in a new user id in the user field";
																	return;
																}

																if ( confirm("Ready to submit?") ) {
																	state.stock.post.finished      = true;
																	state.stock.post.submit_book   = true;
																	state.stock.post.send_email    = true;
																	state.stock.post.submit_credit = true;
																}
															}
														}
													},
													self : '<div class="post_submit_credit">Submit</div>'
												},
											}
										}
									}
								}
							}
						}
					}
				},
				footer : {
					self   : '<div class="footer"></div>',
					branch : { 
						wrap : {
							self : '<div class="footer_wrap"></div>',
							branch : {
								navigation : {
									self   : '<div class="footer_navigation"></div>',
									branch : {
										contact : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														animate.pop.outside = "contact";
													}
												}
											},
											self : '<div class="footer_text">Contact Us</div>'
										},
										media : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														animate.pop.outside = "media";
													}
												}
											},
											self : '<div class="footer_text">Media</div>'
										},
										word : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														animate.pop.outside = "word_from_us";
													}
												}
											},
											self : '<div class="footer_text">A Word From Us</div>'
										},
										terms : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														animate.pop.outside = "legal";
													}
												}
											},
											self : '<div class="footer_text">Terms & Conditions</div>'
										},
										advertising : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														animate.pop.outside = "advertising";
													}
												}
											},
											self : '<div class="footer_text">Advertising</div>'
										}
									}
								},
								logos : {
									self : '<div class="footer_logos"></div>',
									branch : {
										logos : {
											self : '<a href="stock"><img src="'+frameworkuri+'/CSS/Includes/works/footer_logos.png" class="footer_logo"></a>'
										}
									}
								}
							}
						}
					}
				}
			};

			world          = world.manifest($('body'));
			router.begin();
			state.begin    = true;		
		});									
	</script>

</head>
<body>