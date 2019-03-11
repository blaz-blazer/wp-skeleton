# WP Skeleton 

Skeleton for building WordPress plugins with Gulp 4, PostCSS, Webpack and Babel. Based on [Devin Vinson's WordPress Plugin Boilerplate](https://github.com/DevinVinson/WordPress-Plugin-Boilerplate).

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Installing

Install the plugin directly into your plugins folder on localhost (for example in WAMP this could be www/wordpress/wp-content/plugins). Note that this plugin does not do anything on it's own. It's a template for building new plugins. 

Change proxy setting in gulpfile.js to match your development environment

```
function browser_sync() {
	browserSync.init({
		proxy: 'http://localhost/' //change if necessary - for example to http://localhost/wordpress/
	});
}
```

Navigate to the plugin folder and run npm install from command line:

```
npm install
```

Run gulp watch from command line to start browser sync 

```
gulp watch
```

Start coding. Javascript and CSS should be written in files in src folders as they get automatically compiled to files one directory below. 

To minify CSS and JS run gulp minify from command line: 

```
gulp minify 
```

To generate the distribution version run gulp build. The distribution version will be located in the dist folder in root of the plugin.  

```
gulp build 
```



