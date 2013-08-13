var alpha = (function ( alpha, $ ) {

	alpha.track_events_on_this = function (track_events_on, events_to_track) { 

		var thought_of_this = this.track_events_on_this.prototype;
		$(track_events_on)
		.on(events_to_track, function (event) { 

			var current_click = thought_of_this.create_current_click_object(event),
				invoke        = alpha.invoke(current_click.function_call);

			if (current_click.has_a_function_call && typeof invoke === 'function' && !thought_of_this.is_asleep(current_click.function_call) ) { 
				
				invoke.call(invoke, current_click);
			}
		});
	};

	alpha.track_events_on_this.prototype.create_current_click_object = function (the_event) {
		
		var current_click = new Object;

			current_click.element = $(the_event.target);
			current_click.function_call = current_click.element.attr('data-function-to-call');
			current_click.has_a_function_call = ( current_click.function_call? true : false );
			current_click.instructions = ( current_click.element.attr('data-function-instructions')? JSON.parse(current_click.element.attr('data-function-instructions').replace(/[']/g, "\"")) : false );
			current_click.the_event = the_event;

			return current_click;
	};

	alpha.track_events_on_this.prototype.is_asleep = function (slumberer) { 

		return alpha.invoke(slumberer).prototype.sleeping = alpha.invoke(slumberer).prototype.sleeping || false;

	};

	alpha.track_events_on_this.prototype.hibrenate = function (slumberers) { 

		$.each(slumberers, 
		function (order, slumberer) { 

			alpha.invoke(slumberer).prototype.sleeping = true;

		});
	};

	alpha.track_events_on_this.prototype.awaken = function (slumberers) { 

		$.each(slumberers, 
		function (order, slumberer) { 

			alpha.invoke(slumberer).prototype.sleeping = false;

		});		
	};

	alpha.create_instruction_variable = function (instruction_name, variable_name, variable_value) { 

		alpha[instruction_name].instructions = alpha[instruction_name].instructions || new Object;

		alpha[instruction_name].instructions[variable_name] = alpha[instruction_name].instructions[variable_name] || variable_value;
	};

	alpha.detect_side = function (event, element, detection_side) { 

		detection_side  = detection_side || 1;
    	var self        = new Object;
            self.parent = new Object;
            self.is     = new Object;
            self.element        = $(element);
            self.parent.self    = self.element.parent();
            self.parent.width   = Math.round(self.parent.self.width());
            self.parent.height  = Math.round(self.parent.self.height());
    		self.height         = Math.round(self.element.height());
    		self.width          = Math.round(self.element.width());
    		self.offset         = self.element.offset();
    		self.offset.left    = Math.round(self.offset.left);
    		self.offset.top     = Math.round(self.offset.top);

            self.padding_left   = Math.round(self.element.css("padding-left").replace("px", "") );
            self.padding_right  = Math.round(self.element.css("padding-right").replace("px", "") );
            self.margin_left    = Math.round(self.element.css("margin-left").replace("px", "") );
    		self.margin_right   = Math.round(self.element.css("margin-right").replace("px", "") );
            self.padding_top    = Math.round(self.element.css("padding-top").replace("px", ""));
            self.padding_bottom = Math.round(self.element.css("padding-bottom").replace("px", ""));
            self.margin_top     = Math.round(self.element.css("margin-top").replace("px", ""));
    		self.margin_bottom  = Math.round(self.element.css("margin-bottom").replace("px", ""));
            self.full_width     = ( self.width + self.padding_left + self.padding_right + self.margin_right + self.margin_left );
            self.full_height    = ( self.height + self.padding_top + self.padding_bottom + self.margin_right + self.margin_left );
			self.left_side      = ((event.pageX - self.offset.left ) - self.padding_left < 0 + ( self.width / detection_side ));
			self.right_side     = ((event.pageX - self.offset.left ) - self.padding_left > self.width - ( self.width / detection_side ) );
			self.top_side       = ((event.pageY - self.offset.top  ) - self.padding_top  < 0 + ( self.height / detection_side ) );
			self.bottom_side    = ((event.pageY - self.offset.top  ) - self.padding_top  > self.height - ( self.height / detection_side ) );
            self.is.as_wide_as_parent = ( self.full_width  > self.parent.width  - 5 );
			self.is.as_tall_as_parent = ( self.full_height > self.parent.height - 10 );

            return self; 		
    };

    alpha.invoke = function (tree_to_subject_of_invokation) { 

    	if ( tree_to_subject_of_invokation !== undefined ) { 
	    	var group_of_branches, path_to_return;

	    	subject_to_invoke = alpha;
	    	tree_to_subject_of_invokation = tree_to_subject_of_invokation.replace(/\[(\w+)\]/g, '.$1');
	    	tree_to_subject_of_invokation = tree_to_subject_of_invokation.replace(/^\./, '');

	    	group_of_branches = tree_to_subject_of_invokation.split('.');

	    	while ( group_of_branches.length ) { 

	    		var branch_name = group_of_branches.shift();

	    			if ( branch_name in subject_to_invoke ) { 
	    				subject_to_invoke = subject_to_invoke[branch_name]
	    			}
	    			else { 
	    				return;
	    			}
	    	}
	    	
	    	return subject_to_invoke;
	    }
    };

    alpha.replace_placeholders_with_values_in_text = function (placeholders_to_values_guide, text) { 

		text = text.replace(/[^\{\(]+(?=\)\})/g, function (match) {;
			return placeholders_to_values_guide[match];
		});
		text = text.replace(/\{\(|\)\}/g, '');
		
		return text;
	};

    alpha.load_scripts_asynchronously_with_callback = function (array_of_paths_to_load, callback_function_to_call_when_all_scripts_are_loaded) { 

		var number_of_scripts_left_to_load = array_of_paths_to_load.length;

    		$.map(array_of_paths_to_load,
    		function (path, index_in_array) {

    			$.getScript(path,
    			function () { 
    				
    				number_of_scripts_left_to_load--;    				

    				if ( number_of_scripts_left_to_load < 1 )
    					callback_function_to_call_when_all_scripts_are_loaded();
    			});
    		});
    };

        
	alpha.string_to_object = function (path, object) {

		if ( path.constructor === String ) path = path.split('.');
		if ( path.constructor === Array ) {
			while ( path.length ) {
		    	var path_branch = path.shift();
		    	if ( path_branch in object ) { 
		    		object = object[path_branch];
		    	}
		    	else { 
		    		return;
		    	}
		    }
		    return object;
		}
		else { 
			throw new Error("the path is not an array or a string");
		}
	};


	return alpha;

})(alpha || {}, jQuery );