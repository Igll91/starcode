module.exports = function (grunt) {

    // Project configuration.
    grunt.initConfig({
                         pkg:      grunt.file.readJSON('package.json'),
                         bower:    {
                             install: {
                                 options: {
                                     targetDir:      './vendor/bower/',
                                     layout:         'byType',
                                     install:        true,
                                     verbose:        false,
                                     cleanTargetDir: false,
                                     cleanBowerDir:  true,
                                     bowerOptions:   {}
                                 }
                             }
                         },
                         'min':    {
                             'dist': {
                                 'src':  ['./vendor/bower/jquery/jquery.js', './vendor/bower/bootstrap/bootstrap.js', './vendor/bower/sweetalert/sweetalert.min.js', '../public/js/sweetalert.js'],
                                 'dest': './public/js/main.min.js'
                             }
                         },
                         'cssmin': {
                             'dist': {
                                 'src':  ['./vendor/bower/bootstrap/bootstrap.css', './vendor/bower/sweetalert/sweetalert.css', './vendor/bower/font-awesome/font-awesome.css'],
                                 'dest': './public/css/main.min.css'
                             }
                         }
                     });

    // Load the plugin that provides the "uglify" task.
    grunt.loadNpmTasks('grunt-bower-task');
    grunt.loadNpmTasks('grunt-yui-compressor');

    // Default task(s).
    grunt.registerTask('default', ['bower', 'min', 'cssmin']);

};