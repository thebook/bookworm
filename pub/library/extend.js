define(function () {

	var extend = function (paramaters, element_to_extend) {

		var extension;
		paramaters.pass = paramaters.pass || false;

		if ( !paramaters.into )                                          throw new Error("the \"into\" paramater for the extend component has not been specified");
		if ( !paramaters.into.replace(/^\s+|\s+$/, "") )                 throw new Error("the \"into\" paramater for the extend component is empty");
		if ( !this.components[paramaters.into] )                         throw new Error("the \""+ paramaters.into +"\" extension does not exist, try checking if you have spelt it right or included it in the manifest.define");
		if ( this.components[paramaters.into].constructor !== Function ) throw new Error(" the \""+ paramaters.into +"\" extension is not a function as such it can not be used, extensions can only be functions");

		extension = new this.components[paramaters.into](paramaters.pass);
		element_to_extend.appendChild(extension);
	};

	extend.prototype.components = {};

	return extend;

});