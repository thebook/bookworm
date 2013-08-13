var alpha = (function ( alpha, $ ) {
// 
	alpha.scroll_bar = function (wake) {
		var prototype = this;
		this.self = wake.self;
		this.self.observers              = {};
		this.self.self.scrolling         = 0;
		this.self.self.scroll            = {};
		this.self.self.scroll.height     = wake.height || 200;
		this.self.self.style.height      = this.self.self.scroll.height + "px";
		this.self.branch.holder.self.style.height         = this.self.self.style.height;
		this.self.branch.holder.branch.inner.self.scroll  = {}
		this.calculate_scroll_data();

		this.bind_mousewheel_observer(this.self.self, function (event) {
			this.scrolling = event.deltaY;
		});
		alpha.observe({
			self     : this.self.branch.scroll.branch.handle.self,
			object   : this.self.self,
			property : "scrolling",
			observer : function (change) {
				var move = ( change.new > 0? this.self.scroll.upper_percent - 5 : this.self.scroll.upper_percent + 5 );

				if ( move > this.self.scroll.invisible_percent ) move = this.self.scroll.invisible_percent;
				if ( move < 0 )  move          = 0;
				this.self.scroll.upper_percent = move;
				this.self.scroll.lower_percent = this.self.scroll.invisible_percent - move;
				this.self.style.top            = this.self.scroll.upper_percent+"%";
				// console.log(this.self.scroll);
				if ( move < 0 || move >= this.self.scroll.invisible_percent ) return false;
			}	
		});
		alpha.observe({
			self     : this.self.branch.holder.branch.inner.self,
			object   : this.self.self,
			property : "scrolling",
			observer : function (change) {
				this.self.style.bottom = ( this.self.scroll.upper_percent * this.self.scroll.multiplier ) +"%";
			}	
		});

		this.self.observers.insert_element = new MutationObserver(function (change) {
			console.log("mutation");
			prototype.calculate_scroll_data();
		});
		this.self.observers.insert_element.observe(
			this.self.branch.holder.branch.inner.self, {
			childList : true,
		});
	};

	alpha.scroll_bar.prototype.calculate_scroll_data = function () {
		
		this.self.branch.holder.branch.inner.self.scroll.multiplier      = (
			this.self.branch.holder.branch.inner.self.offsetHeight / 
			this.self.self.scroll.height
		);

		this.self.branch.holder.branch.inner.self.scroll.visible_percent = parseFloat(
			(   this.self.self.scroll.height /	
				this.self.branch.holder.branch.inner.self.offsetHeight 
			).toFixed(2) * 100
		);

		if ( this.self.branch.holder.branch.inner.self.scroll.visible_percent > 100 )
			this.self.branch.holder.branch.inner.self.scroll.visible_percent = 100;

		this.self.branch.holder.branch.inner.self.scroll.invisible_percent = (
			100 - this.self.branch.holder.branch.inner.self.scroll.visible_percent
		);

		this.self.branch.holder.branch.inner.self.scroll.upper_percent = this.self.branch.holder.branch.inner.self.scroll.upper_percent || 0;
		
		if ( this.self.branch.holder.branch.inner.self.scroll.upper_percent > 
			 this.self.branch.holder.branch.inner.self.scroll.invisible_percent )
			this.self.branch.holder.branch.inner.self.scroll.upper_percent = this.self.branch.holder.branch.inner.self.scroll.invisible_percent;

		this.self.branch.holder.branch.inner.self.scroll.lower_percent = this.self.branch.holder.branch.inner.self.scroll.invisible_percent;
		this.self.branch.holder.branch.inner.self.scroll.lower_percent = this.self.branch.holder.branch.inner.self.scroll.invisible_percent;
		this.self.branch.scroll.branch.handle.self.style.height        = this.self.branch.holder.branch.inner.self.scroll.visible_percent +"%";
		this.self.branch.scroll.branch.handle.self.scroll              = this.self.branch.holder.branch.inner.self.scroll;
		this.self.self.scrolling = this.self.self.scrolling;
		console.log(this.self.branch.scroll.branch.handle.self.scroll);
	};

	alpha.scroll_bar.prototype.bind_mousewheel_observer = function (object, observer) {

		var binders            = ( "onwheel" in document || document.documentMode >= 9 ? ["wheel"] : ["mousewheel", "DomMouseScroll", "MozMousePixelScroll"] );
		var observer_enveloper = function (event) {
			var mousewheel = {
				altKey           : event.altKey,
				bubbles          : event.bubbles,
				button           : event.button,
				cancelBubble     : event.cancelBubble,
				cancelable       : event.cancelable,
				clientX          : event.clientX,
				clientY          : event.clientY,
				ctrlKey          : event.ctrlKey,
				currentTarget    : event.currentTarget,
				defaultPrevented : event.defaultPrevented,
				deltaMode        : event.deltaMode,
				detail           : event.detail,
				eventPhase       : event.eventPhase,
				layerX           : event.layerX,
				layerY           : event.layerY,
				metaKey          : event.metaKey,
				pageX            : event.pageX,
				pageY            : event.pageY,
				relatedTarget    : event.relatedTarget,
				screenX          : event.screenX,
				screenY          : event.screenY,
				shiftKey         : event.shiftKey,
				target           : event.target,
				timeStamp        : event.timeStamp,
				type             : event.type,
				view             : event.view,
				which            : event.which
			};
			if ( event.mozMovementX    || event.mozMovementX    === 0 ) mousewheel.movementX = event.mozMovementX;
			if ( event.mozMovementY    || event.mozMovementY    === 0 ) mousewheel.movementY = event.mozMovementY; 
			if ( event.webkitMovementX || event.webkitMovementX === 0 ) mousewheel.movementX = event.webkitMovementX;
			if ( event.webkitMovementY || event.webkitMovementY === 0 ) mousewheel.movementY = event.webkitMovementY;
			if ( event.deltaY )      mousewheel.deltaY = ( event.deltaY > 0? -1 : 1 );
			if ( event.deltaX )      mousewheel.deltaX = ( event.deltaX > 0? -1 : 1 );
			if ( event.wheelDeltaY ) mousewheel.deltaY = ( event.wheelDeltaY > 0? 1 : -1 );
			if ( event.wheelDeltaX ) mousewheel.deltaX = ( event.wheelDeltaX > 0? 1 : -1 );			
			event.preventDefault();
			observer.call(object, mousewheel);
		};

		if ( object.addEventListener ) {
			for (var index = binders.length - 1; index >= 0; --index) {
				object.addEventListener(binders[index], observer_enveloper, true);
			}
		} else { 
			object.onmousewheel = observer_enveloper;
		}
	};

	return alpha;

})( alpha || {}, jQuery );