module.exports = function(grunt) {
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-coffee');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-cssmin');

  grunt.initConfig({
    coffee: {
      compile: {
        files: {
          'Zephir/public/js/app.js': ['Zephir/public/coffee/*.coffee', 'Zephir/public/coffee/pages/*.coffee', 'Zephir/public/coffee/core/*.coffee']
        }
      }
    },
    uglify: {
      options: {
        separator: ';'
      },
      compile: {
        src: 'Zephir/public/js/app.js',
        dest: 'Zephir/public/js/app.min.js'
      }
    },
    less: {
        dist: {
          files: {
            "Zephir/public/css/app.css": ["Zephir/public/less/*.less"]
          }
        }
    },
    cssmin: {
        combine: {
          files: {
            'Zephir/public/css/app.min.css': ['Zephir/public/css/app.css']
          }
        }
    },
    watch: {
      scripts: {
        files: '**/*.coffee',
        tasks: ['coffee:compile', 'uglify:compile']
      },

      styles: {
        files: '**/*.less',
        tasks: ['less:dist', 'cssmin:combine']
      }
    }
  });

  grunt.registerTask('default', ['coffee', 'uglify', 'less', 'cssmin', 'watch']);
};
