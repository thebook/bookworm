var alpha = (function ( alpha, $ ) {

	alpha.table = function (wake) {

		if ( wake.self.table ) return;

		var prototype;

		prototype = this;
		this.self = wake.self;
		wake.self.table = {};
		wake.self.table.wake = {
			visuals      : wake.visuals,
			max_row_load : wake.max_row_load,
			table_name   : wake.table_name,
			width        : wake.columns.length * wake.column_width,
			submit_field_callback : wake.submit_field_callback,
			columns      : wake.columns,
			column_width : wake.column_width,
			column_number: wake.column_number-1,
			row_height   : wake.row_height,
			class_names  : wake.class_names,
			length       : wake.column_number * wake.column_width,
			number_of_columns_that_can_show : Math.floor(wake.self.clientWidth/wake.column_width)-1,
			number_of_rows_that_can_show    : Math.floor(wake.table_height/wake.row_height)-1
		};
		wake.self.table.component = {
			box    : "",
			titles : ""
		};
		wake.self.table.visible = {
			column : {
				left  : 0,
				right : wake.self.table.wake.number_of_columns_that_can_show
			},
			row : {
				top    : 0,
				bottom : wake.self.table.wake.number_of_rows_that_can_show
			}
		};
		wake.self.table.change = {
			history : [],
			value   : {
				changeing : false,
				selected  : null,
				changing  : false,
				column    : 0,
				row       : 0,
				value     : ""
			}
		};
		wake.self.table.selected = {
			history: [],
			current: {
				column : 0,
				row    : 0
			}
		};
		wake.self.table.notification  = {
			current : {},
			history : []
		};
		wake.self.table.revealed_rows = wake.max_row_load;
		wake.self.table.selected_rows = [];

		wake.self.table.submision_column_names = wake.submision_column_names,
		wake.self.table.rows = [];

		this.self.style.height = wake.table_height + "px";

		this.self.insertAdjacentHTML("afterbegin",
			'<div class="'+ this.self.table.wake.class_names.option_wrap +'"></div>'+
			'<div style="width:'+ this.self.table.wake.width                   +'px;"'+
			'class="'+            this.self.table.wake.class_names.table_titles +'"></div>'+
			'<div style="width:685px; float:left; overflow:hidden; height:400px;">'+
				'<div style="width:'+ this.self.table.wake.width                  +'px;"'+
				'class="'+            this.self.table.wake.class_names.table_wrap +'"></div>'+
			'</div>');

		this.self.table.component.options     = this.self.children[0];
		this.self.table.component.titles      = this.self.children[1];
		this.self.table.component.box         = this.self.children[2].children[0];

		this.self.addEventListener("keydown", function (event) {
			prototype.keypress_handler(event);
		});

		this.self.addEventListener("click", function (event) {
			
			if ( event.target.tagName === "TEXTAREA" ) 
				prototype.field_selection_value_changer(event);
			if ( event.target.getAttribute("data-type-option-index") ) 
				prototype.call_method_for_clicked_option(event);
			if ( event.target.getAttribute("data-type-field") && prototype.self.table.change.value.selected !== event.target ) {
				prototype.come_out_of_field_editing();
			}
		});

		this.self.addEventListener("dblclick", function (event) {
			prototype.come_into_field_editing(event.target);
		});

		new alpha.observe({
			object   : this.self.table.selected,
			property : "current",
			observer : function (change) {
				prototype.field_selection_mover(change);
				prototype.visible_area_calculator(change);
			}
		});

		new alpha.observe({
			object   : this.self.table.visible,
			property : "column",
			observer : function (change) {
				console.log(prototype.self.table.visible.row)
				console.log(prototype.self.table.visible.column)
				prototype.move_visisble_area_by_x_axis(change);
			}
		});

		new alpha.observe({
			object   : this.self.table.visible,
			property : "row",
			observer : function (change) {
				prototype.move_visisble_area_by_y_axis(change);
			}
		});

		new alpha.observe({
			object   : this.self.table.change.value,
			property : "value",
			observer : function (change) {
				prototype.submit_changed_value(change);
			}
		});

		this.create_table_titles();
		this.create_table_options(wake.options);
	};

	alpha.table.prototype.set_rows = function (rows) {
		console.log(rows);
		this.self.table.rows = rows;
		this.popuplate_table_rows();
	};

	alpha.table.prototype.set_row = function (row) { 

		// var row_html, column_number, column_name;

		// row_html      = "";
		// column_number = 0;

		// for (column_name in row ) {
		// 	column_number++;
		// 	row_html += this.create_and_return_html_of_a_table_field({
		// 		column_number : column_number,
		// 		column_name   : column_name,
		// 		row           : this.self.table.rows.length,
		// 		value         : row[column_name]
		// 	});
		// }

		this.self.table.rows.push(row);
		this.self.table.visible.row.bottom++;
		// this.self.table.component.box.insertAdjacentHTML("beforeend", row_html );

	};

	alpha.table.prototype.remove_selected_rows = function () {

		var rows, index, row;

		selected_rows = this.self.table.selected_rows;
		rows          = [];
		index         = 0;

		for (; index < this.self.table.rows.length; index++) {
			if ( selected_rows.indexOf(index) < 0 ) {
				row = this.self.table.rows.slice(index, index+1);
				rows.push(row[0]);
			}
		};
		this.self.table.selected_rows = [];
		this.self.table.rows          = rows;
		this.popuplate_table_rows();
	};

	alpha.table.prototype.calculate_the_order_number_of_the_first_field_in_the_currently_selected_row = function () {

		return field_child_number = ( this.self.table.selected.current.row ) * ( this.self.table.wake.column_number + 1 );
	};

	alpha.table.prototype.get_the_first_field_of_a_selected_row = function () {
		return this.self.table.component.box.children[this.calculate_the_order_number_of_the_first_field_in_the_currently_selected_row()];
	};

	alpha.table.prototype.add_or_remove_the_currently_selected_row_to_selected_rows = function () {

		var current_rows_index_in_array = this.self.table.selected_rows.indexOf(this.self.table.selected.current.row);

		if ( current_rows_index_in_array === -1 ) {
			this.self.table.selected_rows.push(this.self.table.selected.current.row);
			return true;
		} else { 
			this.self.table.selected_rows.splice(current_rows_index_in_array, 1 );
			return false;
		};
	};

	alpha.table.prototype.select_or_unselect_all_rows = function () { 
		if ( this.self.table.selected_rows.length === this.self.table.rows.length ) { 
			this.unselect_all_rows();
			return false;
		} else { 
			this.select_all_rows();
			return true;
		}
	};

	alpha.table.prototype.select_all_rows = function () {

		this.self.table.selected_rows = [];

		for (var index = 0; index < this.self.table.rows.length; index++) {
			this.self.table.selected_rows.push(index);
		};
	};

	alpha.table.prototype.unselect_all_rows = function () {

		this.self.table.selected_rows = [];
	};

	alpha.table.prototype.get_selected_rows  = function () {
		
		var index, rows, row_number, row;

		index = 0;
		rows  = [];
		for (; index < this.self.table.selected_rows.length; index++) {
			row_number = this.self.table.selected_rows[index];
			row        = this.self.table.rows[row_number];
			rows.push(row);
		}

		return rows;
	};

	alpha.table.prototype.get_selected_rows_property  = function (property) {
		var rows, desired_properties, index;

		rows  = this.get_selected_rows();
		index = 0;
		desired_properties = [];

		for (; index < rows.length; index++ ) {
			if ( !rows[index][property] ) throw new Error("property does not exist in the row, aborting");
			desired_properties.push(rows[index][property]);
		}

		return desired_properties;
	};

	alpha.table.prototype.move_visisble_area_by_y_axis = function (change) {

		var shift_by_this_much;

		shift_by_this_much = 0 - ( this.self.table.wake.row_height * change.new.top );
		this.self.table.component.box.style.top = shift_by_this_much +"px";
	};

	alpha.table.prototype.move_visisble_area_by_x_axis = function (change) {

		var shift_by_this_much;

		shift_by_this_much = 0 - ( this.get_width_of_the_hidden_column() * change.new.left );
		this.self.table.component.box.style.left = shift_by_this_much +"px";
		this.self.table.component.titles.style.marginLeft = shift_by_this_much +"px";
	};

	alpha.table.prototype.get_width_of_the_hidden_column = function () { 

		var column_number = this.self.table.visible.column.right + this.self.table.visible.column.left - 1;
		console.log(column_number);
		// return this.self.table.component.box.children[column_number].clientWidth;
		return this.self.table.wake.column_width;
	};

	alpha.table.prototype.visible_area_calculator = function (change) {

		if ( change.new.column < this.self.table.visible.column.left ) { 
			this.self.table.visible.column = {
				left  : change.new.column,
				right : this.self.table.wake.number_of_columns_that_can_show+change.new.column
			};
		}

		if ( change.new.column > this.self.table.visible.column.right ) { 
			this.self.table.visible.column = {
				left  : change.new.column-this.self.table.wake.number_of_columns_that_can_show,
				right : change.new.column
			};
		}

		if ( change.new.row < this.self.table.visible.row.top ) { 
			this.self.table.visible.row = {
				top    : change.new.row,
				bottom : this.self.table.wake.number_of_rows_that_can_show+change.new.row
			};
		}

		if ( change.new.row > this.self.table.visible.row.bottom ) { 
			this.self.table.visible.row = {
				top    : change.new.row-this.self.table.wake.number_of_rows_that_can_show,
				bottom : change.new.row
			};
		}
	};

	alpha.table.prototype.field_selection_value_changer = function (event) {

		this.self.table.selected.current = {
			column : parseInt( event.target.getAttribute("data-type-column-number") ),
			row    : parseInt( event.target.getAttribute("data-type-row") )
		}
	};

	alpha.table.prototype.field_selection_mover = function (change) {

		if ( change.new.row === change.old.row && change.new.column === change.old.column ) return;

		var current_field, previous_field;

		this.reveal_rows(change.new);

		previous_field = this.get_a_field_node(change.old);
		current_field  = this.get_a_field_node(change.new);

		this.self.table.selected.history.unshift({
			row    : change.old.row,
			column : change.old.column
		});

		current_field.focus();

		this.apply_style_to_node(current_field, this.self.table.wake.visuals.on_field);
		this.apply_style_to_node(previous_field, this.self.table.wake.visuals.not_on_field);
	};

	alpha.table.prototype.get_a_field_node = function (position) { 
		return document.getElementById( this.self.table.wake.table_name +"_column_"+ position.column +"_row_"+ position.row )
	};

	alpha.table.prototype.apply_style_to_node = function (node, style) {

		var property;

		for (property in style ) node.style[property] = style[property];
	};

	alpha.table.prototype.keypress_handler = function (event) {

		// left 37, up 38, right 39, down 40, ctr 17, z 90, x 88, enter 13, escape 27
		
		if ( event.keyCode === 27 ) {
			if ( event.target.tagName !== "TEXTAREA"  ) return;
			this.come_out_of_field_editing();		
		}

		if ( this.self.table.change.value.changeing ) return;

		if ( event.keyCode === 37 ) this.change_selected_field_based_on_current_position("left");

		if ( event.keyCode === 38 ) this.change_selected_field_based_on_current_position("up");

		if ( event.keyCode === 39 ) this.change_selected_field_based_on_current_position("right");

		if ( event.keyCode === 40 ) this.change_selected_field_based_on_current_position("down");

		if ( event.keyCode === 13 ) {
			if ( event.target.tagName !== "TEXTAREA" ) return;
			this.come_into_field_editing(event.target);
		}
	};

	alpha.table.prototype.change_selected_field_based_on_current_position = function (direction) {

		var current = {
			row    : this.self.table.selected.current.row,
			column : this.self.table.selected.current.column 
		};

		if ( direction === "up" ) {
			var row = current.row-1;
			current.row = ( row < 0 ? 0 : row );
		}

		if ( direction === "down" ) {
			var row = current.row+1;
			current.row = ( row > this.self.table.rows.length-1 ? this.self.table.rows.length-1 : row );
		}

		if ( direction === "left" ) {
			var column = current.column-1;
			current.column = ( column < 0 ? 0 : column );
		}

		if ( direction === "right" ) {
			var column = current.column+1;
			current.column = ( column > this.self.table.wake.column_number ? this.self.table.wake.column_number : column );
		}

		this.self.table.selected.current = current;
	};

	alpha.table.prototype.come_into_field_editing = function (target) { 

		if ( this.self.table.change.value.changeing ) return;

		target.removeAttribute("readonly");
		this.self.table.change.value.selected  = target;
		this.self.table.change.value.column    = target.getAttribute("data-type-column");
		this.self.table.change.value.row       = target.getAttribute("data-type-row");
		this.self.table.change.value.changeing = true;
	};

	alpha.table.prototype.come_out_of_field_editing = function () { 

		if ( !this.self.table.change.value.changeing ) return;

		this.self.table.change.value.selected.setAttribute("readonly");
		this.self.table.change.value.value = this.self.table.change.value.selected.value;
		this.self.table.rows[this.self.table.change.value.row][this.self.table.change.value.column] = this.self.table.change.value.value;
		this.self.table.change.value.changeing = false;
		this.self.table.change.history.unshift({
			row    : this.self.table.change.value.row,
			column : this.self.table.change.value.column,
			value  : this.self.table.change.value.value,
		});
	};

	alpha.table.prototype.reveal_rows = function (rows) { 

		if ( rows.row !== this.self.table.revealed_rows-2 ) return;

		var rows_to_reveal, number_of_rows_to_reveal, number_of_rows_revealed, index, column_number, html_of_rows;

		html_of_rows                   = "";
		index                          = 0;
		number_of_rows_revealed        = this.self.table.revealed_rows;
		number_of_rows_to_reveal       = this.self.table.rows.length - number_of_rows_revealed;
		number_of_rows_to_reveal       = ( number_of_rows_to_reveal > this.self.table.wake.max_row_load ? this.self.table.wake.max_row_load : number_of_rows_to_reveal );
		rows_to_reveal                 = this.self.table.rows.slice( number_of_rows_revealed-1, ( number_of_rows_revealed + number_of_rows_to_reveal ) );
		this.self.table.revealed_rows += number_of_rows_to_reveal+1;
		
		for (; index < rows_to_reveal.length; index++) { 

			column_number = -1;

			for (column_name in rows_to_reveal[index] ) {
				column_number++;
				html_of_rows += this.create_and_return_html_of_a_table_field({
					column_number : column_number,
					column_name   : column_name,
					row           : ( number_of_rows_revealed + index ) -1,
					value         : rows_to_reveal[index][column_name]
				});
			}
		}

		this.self.table.component.box.insertAdjacentHTML("beforeend", html_of_rows );

	};

	alpha.table.prototype.submit_changed_value = function (change) { 

		if ( change.old === change.new ) return;

		this.self.table.wake.submit_field_callback({
			value       : change.new,
			row         : this.self.table.rows[this.self.table.selected.current.row],
			column_name : this.self.table.submision_column_names[this.self.table.selected.current.column],
		});
	};

	// Creating 

	alpha.table.prototype.create_and_return_html_of_a_table_field = function (wake) { 

		return '<textarea '+ 
			'placeholder="empty"'+
			'id="'+ this.self.table.wake.table_name +'_column_'+ wake.column_number +'_row_'+ wake.row +'" '+
			'data-type-field="true"'+ 
			'data-type-row="'+    wake.row +'" '+
			'data-type-column="'+ wake.column_name +'" '+
			'data-type-column-number="'+ wake.column_number +'" '+
			'class="'+ this.self.table.wake.class_names.field +'" readonly="true">'+
			wake.value +
		'</textarea>';
	};

	alpha.table.prototype.create_table_titles = function () { 

		var index, titles;

		index  = 0;
		titles = "";

		for (; index < this.self.table.wake.columns.length; index++) {
			titles += '<div class="'+ this.self.table.wake.class_names.title +'">'+ 
				this.self.table.wake.columns[index] +
			'</div>';
		};

		this.self.table.component.titles.insertAdjacentHTML("afterbegin", titles );
	};

	alpha.table.prototype.popuplate_table_rows = function () { 

		var column_number, rows, column_name;
		
		rows = "";

		this.empty(this.self.table.component.box);
		this.self.table.selected_rows = [];

		for (var index = 0; index < this.self.table.rows.length; index++) {

			if ( index < this.self.table.wake.max_row_load -1 ) {

				column_number = -1;

				for (column_name in this.self.table.rows[index] ) {
					column_number++;
					rows += this.create_and_return_html_of_a_table_field({
						column_number : column_number,
						column_name   : column_name,
						row           : index,
						value         : this.self.table.rows[index][column_name]
					});
				}
			}
		};

		this.self.table.component.box.insertAdjacentHTML("afterbegin", rows );
	};

	alpha.table.prototype.empty = function (what) {
		while ( what.firstChild ) what.removeChild(what.firstChild);
	};

	alpha.table.prototype.create_table_options = function (options) {

		var index, html;

		html  = "";
		index = 0;

		this.self.table.options = {
			data        : [],
			definition  : [],
			box         : {
				initialised_box : [],
				open            : false
			}
		};

		for (; index < options.length; index++ ) {
			
			this.self.table.options.data.push({});
			this.self.table.options.definition.push(options[index]);

			html += '<div '+
				'data-type-option-index="'+ index +'" '+
				'class="'+ this.self.table.wake.class_names.option.button +'">'+
					options[index].name +
			'</div>';
		}

		this.self.table.component.options.insertAdjacentHTML("afterbegin", html );
	};

	alpha.table.prototype.call_method_for_clicked_option = function (change) {
		
		var option, box, previous_box;

		option_index = change.target.getAttribute("data-type-option-index");
		option       = this.self.table.options.definition[option_index];
		option.type  = ( option.type.constructor === String ? this.options[option.type] : option.type );

		if ( option.type.constructor === Function ) option.type.call(this, change);
		
		if ( option.type.constructor === Array ) {

			option.index           = option_index;
			option.button          = change.target;
			previous_opened_option = this.self.table.options.box.open;
			
			if ( this.self.table.options.box.open !== false ) {
				previous_box                     = document.getElementById(this.self.table.wake.table_name +'_option_'+ previous_opened_option );
				previous_box.style.display       = "none"
				this.self.table.options.box.open = false;	
			}

			if ( previous_opened_option === option.index ) return;

			if ( this.self.table.options.box.initialised_box.indexOf(option.index) === -1 ) {

				this.construct_an_box_option(option);
				this.self.table.options.box.initialised_box.push(option.index);
			} else { 
				box               = document.getElementById(this.self.table.wake.table_name +'_option_'+ option.index);
				box.style.display = "block";
			}

			this.self.table.options.box.open = option.index;
		}			
	};

	alpha.table.prototype.construct_an_box_option = function (option) {

		var box, index, part;

		index = 0;
		box   = document.createElement("div");
		box.id        = this.self.table.wake.table_name +'_option_'+ option.index;
		box.className = this.self.table.wake.class_names.option.box;

		for (; index < option.type.length; index++ ) {

			option.type[index].instructions.index = option.index;

			part = this.option_box_parts[option.type[index].type].call(
				this, option.type[index].instructions
			);

			box.appendChild(part);
		}
		
		option.button.insertAdjacentElement("afterend", box);
	};

	alpha.table.prototype.make_node = function (define_node) {

		var node, property;

		node = document.createElement(define_node.type);
		for ( property in define_node.with ) node[property] = define_node.with[property];

		return node;
	};

	alpha.table.prototype.add_events_to_node = function (instructions) { 

		var index, events;
		index = 0;

		if ( instructions.events.constructor === Array ) {

			for (; index < instructions.events.length; index++ ) this.add_an_event_listener_to_an_option_part({
				index  : instructions.option_index,
				node   : instructions.node,
				event  : instructions.events[index].event,
				call   : instructions.events[index].call
			});
		}

		if ( instructions.events.constructor === Object ) {

			events = ( instructions.events.event.constructor === String ? instructions.events.event.replace(/[\s]+/g, "").split(",") : instructions.events.event );

			for (; index < events.length; index++ ) this.add_an_event_listener_to_an_option_part({
				index : instructions.option_index,
				node  : instructions.node,
				event : events[index],
				call  : instructions.events.call
			});
		}
	};

	alpha.table.prototype.add_an_event_listener_to_an_option_part = function (instructions) {

		var self = this;

		instructions.node.addEventListener(instructions.event, function (event) {
			
			instructions.call.call(self, {
				box            : document.getElementById(self.self.table.wake.table_name +'_option_'+ instructions.index),
				element        : instructions.node,
				box_data       : self.self.table.options.data[instructions.index],
				original_event : event
			});
		});
	};

	alpha.table.prototype.option_box_parts = {

		text : function (instructions) {

			return this.make_node({ 
				type : "div",
				with : {
					className   : this.self.table.wake.class_names.option.description,
					placeholder : instructions.placeholder,
					textContent : instructions.content
				}
			});
		},

		input : function (instructions) {

			var input = this.make_node({ 
				type : "input",
				with : {
					className   : this.self.table.wake.class_names.option.input,
					placeholder : instructions.placeholder
				}
			});

			if ( instructions.on ) this.add_events_to_node({
				option_index : instructions.index,
				node         : input,
				events       : instructions.on
			});

			return input;
		},

		button : function (instructions) {

			var button = this.make_node({
				type : "div",
				with : {
					className   : this.self.table.wake.class_names.option.button,
					textContent : instructions.text
				}
			});

			if ( instructions.on ) this.add_events_to_node({
				option_index : instructions.index,
				node         : button, 
				events       : instructions.on
			});

			return button;
		},

		audio : function (instructions) {

			var audio = this.make_node({
				type : "audio",
				with : {
					src : instructions.source
				}
			});

			return audio;					
		}
	};

	alpha.table.prototype.options = {

		un_select : function () {

			var row_field_index, last_row_field, selected, field;
			
			row_field_index = this.calculate_the_order_number_of_the_first_field_in_the_currently_selected_row();
			last_row_field  = row_field_index+this.self.table.wake.column_number+1;
			selected        = this.add_or_remove_the_currently_selected_row_to_selected_rows();

			for (; row_field_index < last_row_field; row_field_index++ ) {
				field = this.self.table.component.box.children[row_field_index];
				field.className = ( selected ? this.self.table.wake.class_names.selected_field : this.self.table.wake.class_names.field );
			}
		},

		remove : function () {

			if ( !confirm("Really Remove the rows?") ) return;

			var row_properties;
			row_properties = this.get_selected_rows_property("id");
			this.remove_selected_rows();
		},

		un_select_all : function () {

			var selected, index, fields_that_exist, field;

			selected          = this.select_or_unselect_all_rows();
			index             = 0;
			fields_that_exist = this.self.table.rows.length * ( this.self.table.wake.column_number + 1 );

			for (; index < fields_that_exist; index++ ) {
				field           = this.self.table.component.box.children[index];
				field.className = ( selected ? this.self.table.wake.class_names.selected_field : this.self.table.wake.class_names.field );
			}
		},
	};

	return alpha;

})(alpha || {}, jQuery );