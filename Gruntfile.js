'use strict';

module.exports = function (grunt) {
    grunt.initConfig({
        cssmin: {
            target: {
                files: {
                    '../../public/css/app.min.css': [
                        'bower_components/Materialize/dist/css/materialize.css', 
                        'styles/app.css', 
                        'styles/global.css', 
                        'styles/helper.css', 
                        'styles/responsive.css', 
                    ],
                }
            }
        },
        concat: {
            dist: {
                files: {
                    'public/js/libs.min.js': [
                        'resources/assets/bower_components/jquery/dist/jquery.min.js',
                        'resources/assets/bower_components/Materialize/dist/js/materialize.min.js',
                        'resources/assets/bower_components/angular/angular.min.js',
                    ], 
                    'public/js/app.js': [
                        'resources/scripts/app.js',
                        'resources/scripts/services/*.js',
                        'resources/scripts/directives/*.js',
                        'resources/scripts/controllers/*.js',
                    ]
                }
            }
        },
        uglify: {
            my_target: {
                files: {
                    'public/js/app.min.js': [
                        'public/js/app.js'
                    ]
                }
            }
        }
    });
  
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
};