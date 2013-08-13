define(function () {
	return {
		self   : ".homepage_body_wrap pages",
		children : { 
			home : { 
				self   :".homepage_body_inner_wrap",
				children : {
					info_title : { 
						self   : ".homepage_how_it_works_option_title_wrap",
						children : {
							scrible : { 
								self :".homepage_how_it_works_option_title_scrible@1st option",
							},
							title : {
								self   : ".homepage_how_it_works_option_title",
								children : {
									part_one : {
										self : "span.homepage_how_it_works_option_title_part_one@Free",
									},
									part_two : {
										self : "span.homepage_how_it_works_option_title_part_two@post",
									}
								}
							}
						}
					},
					info_numbers : {
						self : ".homepage_how_it_works_boxes_numbers_wrap",
						children : {
							one : {
								self : ".with-icon-homepage-how-it-works-box-number-one",
							},
							two : {
								self : ".with-icon-homepage-how-it-works-box-number-two",
							},
							three : {
								self : ".with-icon-homepage-how-it-works-box-number-three"
							}
						}
					},
					info_boxes : {
						self   : ".homepage_how_it_works_boxes_wrap",
						children : {
							first : {
								self   : ".homepage_how_it_works_box_wrap_first",
								children : {
									content : {
										self   : ".homepage_how_it_works_box homepage_how_it_works_box_first",
										children : {
											text : {
												self   : ".homepage_how_it_works_box_text_wrap",
												children : {
													title : {
														self : ".homepage_how_it_works_box_title@Find Your Books",
													},
													text : {
														self : ".homepage_how_it_works_text@find your books and add them to your sell basket"
													}
												}
											},
											image : {
												self : "img.homepage_how_it_works_box_first_image#src=type.png"
											}
										}
									},
									arrows : {
										self   : ".homepage_arrows_warp",
										children : {
											part_one   : {
												self : ".with-icon-homepage-how-it-works-box-left-blue-arrow",
											},
											part_two   : {
												self : ".with-icon-homepage-how-it-works-box-right-arrow"
											},
											part_three : {
												self : ".with-icon-homepage-how-it-works-box-left-arrow"
											}
										}
									}
								}
							},
							second : {
								self   : ".homepage_how_it_works_box_wrap_second",
								children : {
									content : {
										self   :".homepage_how_it_works_box_second",
										children : {
											text : {
												self   : ".homepage_how_it_works_box_text_wrap",
												children : {
													title : {
														self : ".homepage_how_it_works_box_title@Freepost<br/>Your Books",
													},
													text : {
														self : ".homepage_how_it_works_text@we send you a freepost pack and you send us your books"
													}
												}
											},
											image : {
												self : "img.homepage_how_it_works_box_second_image#src=letter.png"
											}
										}
									},
									arrows : {
										self   : ".homepage_arrows_warp",
										children : {
											part_one   : {
												self : ".with-icon-homepage-how-it-works-box-left-blue-arrow",
											},
											part_two   : {
												self : ".with-icon-homepage-how-it-works-box-right-arrow",
											},
											part_three : {
												self : ".with-icon-homepage-how-it-works-box-left-arrow"
											}
										}
									}
								}
							},
							third : {
								self   : ".homepage_how_it_works_box_wrap_last",
								children : {
									content : {
										self   : ".homepage_how_it_works_box homepage_how_it_works_box_last",
										children : {
											text : {
												self   : ".homepage_how_it_works_box_text_wrap",
												children : {
													title : {
														self : ".homepage_how_it_works_box_title@<br/>Get Paid",
													},
													text  : {
														self : ".homepage_how_it_works_text@we send you a cheque the same day we receive your books"
													}
												}
											},
											image : {
												self : "img.homepage_how_it_works_box_third_image#src=check.png"
											}
										}
									}
								}
							}
						}
					},
					info_buttons : {
						self   : ".homepage_how_it_works_boxes_buttons_wrap",
						children : { 	
							button_one : {
								self   :  ".homepage_how_it_works_box_first_button_wrap",
								children : { 
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
										self : ".homepage_how_it_works_box_button#where_is_my_isbn_trigger@Where is My ISBN",
										children : {
											arrow : {
												self : "span.with-icon-down-arrow-for-how-it-works-button#where_is_my_isbn_trigger"
											}
										}
									},
									text_box  : {
										self :  "#where_is_my_isbn_toggle.homepage_how_it_works_box_button_expanded",
										children : {
											image : {
												self : "img.homepage_how_it_works_box_button_expanded_image#src=where_is_my_isbn.png#alt=how it works",
											},
											paragraph : {
												self : ".homepage_how_it_works_box_button_expanded_text@Just look at the back of your book and find the 13 or 9 digit number bellow"
											}
										}
									}
								}
							},
							button_two : {
								self : ".homepage_how_it_works_box_second_button_wrap",
								children : { 
									trigger : {
										// instructions : {
										// 	on : {
										// 		the_event : "click",
										// 		is_asslep : false,
										// 		call      : function (change) {
										// 			if ( this.trigger.instructions.open ) {
										// 				this.trigger.instructions.open = false;
										// 				this.text_box.self.css({ display : "none" });
										// 			} else { 
										// 				this.trigger.instructions.open = true;
										// 				this.text_box.self.css({ display : "block" });
										// 			}
										// 		}
										// 	}
										// },
										self : '#freepost_trigger#data-function-to-call=front.prototype.toggle_popup_boxes.homepage_how_it_works_box_button@Freepost Options',
										children : {
											arrow : {
												self : "span#freepost_trigger.with-icon-down-arrow-for-how-it-works-button"
											}
										}
									},
									text_box  : {
										self :  "#freepost_toggle.homepage_how_it_works_box_button_expanded",
										children : {
											paragraph_one   :  {
												self : ".homepage_how_it_works_box_button_expanded_text@We\'ll send you a postage pack. You\'ll get a <strong>mailing bag</strong> with our freepost address sticker attached, so you won’t pay a penny to post your books to Recyclabook",
											},
											paragraph_two   :  {
												self : ".homepage_how_it_works_box_button_expanded_text_highlight@or",
											},
											paragraph_three :  {
												self : ".homepage_how_it_works_box_button_expanded_text@If you have your own <strong>packaging</strong>, you can print off our own packaging label from this website. <strong>This will reduce the turnaround time of the order to give you peace of mind, while ensuring you get your payment even faster!</strong>",
											},
											image           :  {
												self : "img#src=freepost_options.png#alt=how it works.homepage_how_it_works_box_button_expanded_image"
											}
										}
									}
								}
							},
							button_three : {
								self   :  ".homepage_how_it_works_box_third_button_wrap",
								children : { 
									trigger : {
										// instructions : {
										// 	on : {
										// 		the_event : "click",
										// 		is_asslep : false,
										// 		call      : function (change) {
										// 			if ( this.trigger.instructions.open ) {
										// 				this.trigger.instructions.open = false;
										// 				this.text_box.self.css({ display : "none" });
										// 			} else { 
										// 				this.trigger.instructions.open = true;
										// 				this.text_box.self.css({ display : "block" });
										// 			}
										// 		}
										// 	}
										// },
										self : "#id=paid_trigger.homepage_how_it_works_last_box_button@How Am I Being Paid?",
										children : {
											arrow : {
												self : "span#id=paid_trigger.with-icon-down-arrow-for-how-it-works-button"
											}
										}
									},
									text_box  : {
										self : "#paid_toggle.homepage_how_it_works_box_button_expanded",
										children : {
											paragraph : {
												self : ".homepage_how_it_works_box_button_expanded_text@<strong>Don’t</strong> worry about filling in your bank details. We\'ll send you a cheque on the same day we receive your books"
											}
										}
									}
								}
							}
						}
					},
					recyclabus_sticker : {
						self : ".with-icon-or-sticker-recyclabus"
					},
					recyclabus : {
						self   : ".homepage_recyclabus_box_wrap",
						children : {
							scrible : {
								self :".homepage_recyclabus_box_title_scrible@2nd option"
							},
							title : {
								self : ".homepage_recyclabus_box_title@Recycla<span class=\"homepage_recyclabus_box_title_color\">Bus</span>"
							},
							text_wrap : {
								self   : ".homepage_recyclabus_box_text_wrap",
								children : {
									paragraph_one : {
										self : ".homepage_recyclabus_box_point",
										children : {
											leaf : {
												self : ".with-icon-recyclabus-point-leaf"
											},
											text : {
												self : ".homepage_recyclabus_box_point_text@Our bus is touring Universities all over the country, come along and get paid instantly"
											}
										}
									},
									paragraph_two : {
										self : ".homepage_recyclabus_box_point",
										children : {
											leaf : {
												self : ".with-icon-recyclabus-point-leaf"
											},
											text : {
												self : ".homepage_recyclabus_box_point_text@You get paid <strong>20% extra</strong> when using the RecyclaBus"
											}
										}
									},
									paragraph_three : {
										self : ".homepage_recyclabus_box_point",
										children : {
											leaf : {
												self : ".with-icon-recyclabus-point-leaf",
											},
											text : {
												self : ".homepage_recyclabus_box_point_text@No need to fill in any details <strong>just turn up on the day</strong>"
											}
										}
									}
								}
							},
							find_out_more : {
								self : "a#href=recyclabus.homepage_recyclabus_box_button_wrap",
								children : {
									text  : {
										self : "span.homepage_recyclabus_box_button_text@Find Out More",
									},
									arrow : {
										self : "span.with-icon-recyclabus-find-out-more-arrow"
									}
								},
							},
							recyclabus_image : {
								self : "img.homepage_recyclabus_box_image#src=recyclabus.png"
							}
						}
					}
				}
			}
		}
	};
});