module.exports = function (grunt) {
  	grunt.initConfig({
    	trimtrailingspaces : {
      		main: {
        		src: ['public/dg.js'],
        		filter: 'isFile',
        		encoding: 'utf8'
      		}
    	},
    	jshint : {
      		options : {
        		eqeqeq   : true,
        		forin    : true, 
        		immed    : true, 
        		latedef  : true, 
        		nonew    : true,
        		undef    : true,
        		unused   : true,
        		trailing : true,
        		asi      : true,
        		reporter : './node_modules/jshint-path-reporter',
        		globals  : {
          			"document" : true,
          			"window"   : true,
          			"jQuery"   : true,
          			"define"   : true
        		}
      		},
      		files : [],
		},
    	concat : {
      		options : {
        		seperator : ";"
      		},
      		production : {
        		src : [],
        		dest: ""
      		},
    	},
    	uglify : {
      		options : {
        		mangle : true,
        		banner : "",
      		},
      		target : {},
    	},
    	karma : {
      		options : {
        		// configFile : "karma.conf.js",
      		}
    	}
	});
   
  	grunt.loadNpmTasks("grunt-trimtrailingspaces");
  	grunt.loadNpmTasks("grunt-contrib-uglify");
  	grunt.loadNpmTasks("grunt-contrib-jshint");
  	grunt.loadNpmTasks("grunt-contrib-concat");
  	grunt.loadNpmTasks("grunt-karma");
};