var alpha = (function ( alpha, $ ) {

	alpha.thought = function () { 
		
		return { 
			manifest : function (where) {
				return alpha.thought.prototype.manifest.call(alpha.thought, { 
					what  : this.thought, 
					where : where
				});
			}
		};
	};

	alpha.thought.prototype.manifest = function (passed) {

		var prototype = this.prototype;

		return prototype.manifestor(passed.what, passed.where);

	};

	alpha.thought.prototype.instructions = function (parent, self, instructions) { 

		if ( instructions.on ) { 
			this.bind_event({
				to    	      : self, 
				for_the_event : instructions.on.the_event,
				is_slumbering : instructions.on.is_slumbering,
				call_function : instructions.on.call,
				paramaters    : instructions.on.with_instructions,
				parent	      : parent
			});
		}

		if ( instructions.on_events ) {
			for (var index = 0; index < instructions.on_events.length; index++) {
				this.bind_event({
					to    	      : self, 
					parent	      : parent,
					for_the_event : instructions.on_events[index].the_event,
					is_slumbering : instructions.on_events[index].is_slumbering,
					call_function : instructions.on_events[index].call,
					paramaters    : instructions.on_events[index].with_instructions,
				});
			}
		}

		if ( instructions.observe ) this.observe(parent, self, instructions.observe);

		if ( instructions.observers ) {
			for (var index = 0; index < instructions.observers.length; index++) this.observe(parent, self, instructions.observers[index]);
		}

		return instructions;
	};

	alpha.thought.prototype.observe = function (parent, self, instructions) { 
		var observer = new alpha.observe({
			self     : self,
			parent   : parent,
			object   : instructions.who,
			property : instructions.property,
			observer : instructions.call
		});
	};

	alpha.thought.prototype.bind_event = function (instructions) { 

		instructions.to.on(instructions.for_the_event, 
		function (event) {
			if ( !instructions.is_slumbering ) instructions.call_function.call(instructions.parent, { self : instructions.to, instructions : instructions.paramaters, "event" : event });
		});		
	};

	alpha.thought.prototype.manifestor = function (what, where) { 

		var prototype = this;

		$.each(what, function (name, body) { 

			var has_components_five_out_of = 0;

			if ( body.self ) { 
				
				body.self = $(body.self);				
				where.append(body.self);

				has_components_five_out_of++;
			}

			if ( body.instructions ) {
				
				body.instructions = prototype.instructions(what, body.self, body.instructions);

				has_components_five_out_of++;
			}

			if ( body.branch ) { 				
								
				alpha.thought.prototype.manifestor(body.branch, body.self);				

				has_components_five_out_of++;
			}

			if ( body.last_branch ) { 

				$.each(body.last_branch, function (name, leaf) { 
					
					body.last_branch[name] = $(leaf);
					if (body.self ) body.self.append($(leaf));
				});				

				has_components_five_out_of++;
			}

			if ( has_components_five_out_of === 0 ) {			
				alpha.thought.prototype.manifestor(body, where);
			}
		});
		
		return what;
		// $.each( thoughts_of_what_to_manifest, function (name, body) { 

		// 	body.self = $(body.self);

		// 	append_to.append(body.self);

		// 	if ( body.branch ) { 
														
		// 		$.each( body.branch, function (branch_name, branch_body) { 

		// 			if ( branch_body.constructor === String ) {

		// 				branch_body 			 = $(branch_body);
		// 				body.branch[branch_name] = $(branch_body);
		// 				body.self.append(branch_body);
		// 			}
		// 		});

		// 		if ( body.branch.branch ) prototype.manifestor(body.branch.branch, body.self);

		// 	}
		// });

		// return thoughts_of_what_to_manifest;				
	};



	return alpha;

})(alpha || {}, jQuery );