module.exports = function(grunt) {
    
    grunt.initConfig({
        concat: {
            default: {
                files: {
                    '../js/portal.js': [
                        'js/functions.js',
                        'js/transition.js',
//                         'js/alert.js',
                        'js/button.js',
//                         'js/carousel.js',
                        'js/collapse.js',
                        'js/dropdown.js',
                        'js/modal.js',
                        'js/tooltip.js',
//                         'js/popover.js',
//                         'js/scrollspy.js',
                        'js/tab.js',
//                         'js/affix.js',
                     
                        'js/moment.js',
                        'js/drawer.js',
                        'js/autofocus.js',
//                         'js/bootbox.js',
//                         'js/btn-confirm.js',
//                         'js/file-picker.js',
//                         'js/data-filler.js',
//                         'js/autofill.js',
//                         'js/bootstrap-tokenfield.js',
                        'js/bootstrap-select.js',
                        'js/bootstrap-select-ajax.js',
//                         'js/tinymce.js',
                        'js/bootstrap-datetimepicker.js',
                        'js/bootstrap3-typeahead.js',
//                         'js/Chart.js',
                        'js/main.js'
                    ]
                }
            }
        },
        
        less: {
            default: {
                files: {
                    '../css/style.css': 'less/bootstrap.less'
                }
            },
            dist: {
                files: {
                    '../css/style.min.css': 'less/bootstrap.less'
                },
                options: {
                    compress: true
                }
            }
        },
        
        watch: {
            files: ['js/*.js', 'less/*.less', 'less/mixins/*.less', 'less/*/*.less'],
            tasks: ['concat', 'less']
        },
        
        uglify: {
            dist: {
                files: {
                    '../js/portal.min.js': '../js/portal.js'
                },
                options: {
                    compress: true,
                    report: 'gzip',
                    preserveComments: false
                }
            }
        }
    });
    
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    
    
    grunt.registerTask('dist', [
        'less:default',
        'less:dist',
        'concat:default',
        'uglify:dist'
    ]);
}