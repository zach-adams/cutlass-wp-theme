# [Social Eyes Starter Theme](http://getsocialeyes.com/)

This is our new starter theme borrowed and rebuilt from [roots.io](http://roots.io/)

## Installation

1. Download the zip from Bitbucket and install it like a normal Wordpress theme
2. Go to the theme directory and run 'sudo npm install'
3. Run 'gulp dev' to begin development

## Commands
### gulp dev

* Compiles SASS in expanded form and autoprefixes it, the moves it to dist folder as main.css
* Copies main.js from src/ folder to dist folder without minifying it
* Copies the Development Vendor CSS and JS (selected from array in Gulpfile), concatinates them without minifying, and puts the into vendor.css and vendor.js in the dist/ folder
* Minifies images from src/img and copies the new minified images to the dist/img/ folder

### gulp build

* Compiles SASS in compressed form and autoprefixes it, the moves it to dist folder as main.css
* Copies main.js from src/ folder to dist folder after minifying it
* Copies the Production Vendor CSS and JS (selected from array in Gulpfile), concatinates them after minifying, and puts the into vendor.css and vendor.js in the dist/ folder
* Minifies images from src/img and copies the new minified images to the dist/img/ folder

### gulp watch

* Watches for changes in SASS, css, js, and images folder for changes and runs LiveReload if necessary

### gulp

* Runs 'gulp dev' then 'gulp watch'

## Directory
* src/ - Contains all the src files, including SASS, Javascript, and un-minified images. Also includes fonts, and Vendor packages
* lang/ - Language specific files
* lib/ - Some configuration files and support files necessary for making the Roots Theme work correctly
* dist/ - Contains all the src files after minification
* templates/ - Contains all templates that Wordpress needs

## Adding Vendor CSS and JS to vendor.css and vendor.js
In the Gulpfile.js there's 4 array's near the top called devvendorcss, devvendorjs, buildvendorcss, buildvendorjs. Bootstrap and jQuery are already added for your convience but you can remove them if you like. To add more just add the directory to the css and js files for each to the corresponding array.