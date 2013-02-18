var alpha = (function ( alpha, $ ) {

	alpha.toggle_user_field = function ( current_click ) { 

		var close_box = current_click.element.nextAll(current_click.instructions.user_field_inner_box);

		if ( current_click.element.hasClass('open') ) {

			current_click.element.removeClass('open').addClass('close') 
			close_box.css({ display : "none"}).before('<div data-function-to-call="mover" class="user_profile_toggle">'+ current_click.instructions.what_to_say +'</div>');
		}
		else { 

		 	current_click.element.removeClass('close').addClass('open');
			close_box.prev().remove();
			close_box.css({ display : "block" });
		}
	};

	alpha.toggle_hide = function ( current_click ) { 

		var instructions = current_click.instructions,
			close_box 	 = current_click.element.closest(instructions.parent_of_the_element).children(instructions.element_to_hide);
			
			if ( current_click.element.hasClass('open') ) { 
				
				current_click.element.removeClass('open').addClass('close');	
				close_box.css({ display : "none" });
			}
			else if ( current_click.element.hasClass('close') ) {

				current_click.element.removeClass('close').addClass('open');
				close_box.css({ display : "block" });
			}
			else { 

				current_click.element.addClass('close');	
				close_box.css({ display : "none" });
			}
	};


	alpha.ajax_push = function ( json, callback ) { 

		$.post(
			ajaxurl,
			json,
			function (response) { 
				$.jGrowl(response.message, { speed: 400, sticky: true, header: response.header});
				if (typeof callback === 'function' ) { callback(response); }
			},
			'json'
		);
	};

	alpha._is_number = function (number) { 

  		return !isNaN(parseFloat(number)) && isFinite(number);
	};

	alpha.show_or_hide_element = function (current_click) { 

		var to_toggle = current_click.element.parent().find(current_click.instructions.elements_to_hide);

		if ( current_click.element.hasClass(current_click.instructions.class_to_mark_as_hidden) ) { 
			current_click.element.removeClass(current_click.instructions.class_to_mark_as_hidden);
			to_toggle.show(400);
		}
		else { 
			current_click.element.addClass(current_click.instructions.class_to_mark_as_hidden);
			to_toggle.hide(400);
		}
	};

	alpha.manifest = function (passed) { 

		var prototype = this.manifest.prototype;
			
			prototype.manifestor = function (thoughts_of_what_to_manifest, append_to) { 

				$.each( thoughts_of_what_to_manifest,
					function (name, body) { 

						body.self = $(body.self);

						append_to.append(body.self);

						if ( body.branch ) { 
													
							$.each( body.branch,
							function (branch_name, branch_body) { 

								if ( branch_body.constructor === String ) {

									branch_body 			 = $(branch_body);
									body.branch[branch_name] = $(branch_body);							
									body.self.append(branch_body);
								}
							});

							if ( body.branch.branch ) { 
								
								prototype.manifestor(body.branch.branch, body.self);
							}
						}
					});

				return thoughts_of_what_to_manifest;				
			};

			return prototype.manifestor(passed.what_to_manifest, passed.append_to_who);
	};

	return alpha;

})(alpha || {}, jQuery );