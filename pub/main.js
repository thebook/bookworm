define(function () {

	var app = function (thought, components, parts) {
		// console.log(thought);
		// console.log(components);
		console.log(parts);
		// console.log(parts);

		world = new thought({
			parts   : {
				dependancy : "some_dependancy"
			},
			thought : {
				header : parts.header,
				main   : parts.landing
				// bar : {
				// 	self : ".stuff@This be some bar and text son"
				// },
				// animation : {
					// instructions : {
					// 	extend : {
					// 		into : "tailor",
					// 	}
					// },
					// self : ".tailor"
				//}
			}
		});

		world.manifest(document.body);
		// console.log(thought.prototype)
	};

	return app;
});