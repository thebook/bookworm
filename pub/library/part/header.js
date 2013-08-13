define(function () {
	return {
		self : "header",
		children : {
			wrap : {
				self : ".header_wrap",
				children : {
					invisible_box : {
						self : ".header_invisible_box",
						children : {
							logo : {
								self : "a#href=/",
								children : {
									image : {
										self : "img.header_invisible_box_image_title#src=header_logo"
									}
								}
							},
							text : {
								self : ".header_invisible_box_text_wrap",
								children : { 
									title : {
										self : ".header_invisible_box_text_title",
									},
									text  : {
										self : ".header_invisible_box_text@Recyclabook accepts over a million different titles, you can easily sell your book and get paid quickly and safely."
									}
								}
							}
						}	
					},
					search_box : {
						self : ".header_text_box",
						children : {
							title  : {
								self : ".header_text_box_title@How <span class=\"header_text_box_title_highlight\">much</span> is <br/><span class=\"header_text_box_title_highlight\">your</span> book <span class=\"header_text_box_title_highlight\">worth?</span>"
							},
							search : { 
								self   : ".header_text_box_input",
								children : {
									input_wrap : {
										self   : ".header_field_for_input",
										children : {
											input : {
												// instructions : {
												// 	on_events : [
												// 		{
												// 			the_event : "keyup",
												// 			is_asslep : false,
												// 			call      : function (change) {
												// 				state.text.search = change.self.val();
												// 			}
												// 		},
												// 		{
												// 			the_event : "keypress",
												// 			is_asslep : false,
												// 			call      : function (change) {
												// 				if ( change.event.keyCode === 13 ) state.process.search = true;
												// 			}
												// 		}
												// 	]
												// },
												self  : "input#type=text#placeholder=please enter your ISBN here.header_input_block_for_search.block_for_search",
											}
										}
									},
									search_button : {
										// instructions : {
										// 	on : {
										// 		the_event : "click",
										// 		is_asslep : false,
										// 		call      : function () {
										// 			state.process.search = true;
										// 		}
										// 	}
										// },
										self : "span.with-icon-header-search"
									}
								}
							}
						}
					},
					search_box_arrow : { 
						self : ".with-icon-header-text-box-arrow",
					}
				}
			},
			header_image_wrap : {
				self : ".header_image_wrap",
				children : { 
					image : {
						self : "img.header_image#src=jhonc.png"
					}
				}
			}
		}
	};
});