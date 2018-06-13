/* global module, require */
'use strict';

module.exports = function( grunt ) {
	grunt.initConfig( {

		// Watch task config
		watch: {
			styles: {
				files: 'src/sass/**/*.scss',
				tasks: ['sass', 'postcss']
			},
			javascript: {
				files: ['src/js/*.js'],
				tasks: ['uglify']
			},
			svg: {
				files: 'src/img/**/*.svg',
				tasks: ['svgmin'],
			},
		},
		sass: {
			dist: {
				options: {
					style: 'compressed'
				},
				files: {
					'assets/css/style.min.css': 'src/sass/**/style.scss'
				}
			}
		},
		postcss: {
			options: {
				map: {
					inline: false,
					annotation: 'assets/css/'
				},

				processors: [
					require( 'pixrem' )(), // add fallbacks for rem units
					require( 'autoprefixer' )( { browsers: 'last 2 versions' } ), // add vendor prefixes
					require( 'cssnano' )() // minify the result
				]
			},
			dist: {
				src: 'assets/css/*.css'
			}
		},
		svgmin: {
			options: {
				plugins: [
					{ removeViewBox: false },
					{ removeUselessStrokeAndFill: false },
				]
			},
			images: {
				files: [{
					expand: true,
					cwd: 'src/img/svg/',
					src: '*.svg',
					dest: 'dist/img/svg/',
				}],
			},
		},
		uglify: {
			custom: {
				files: {
					'assets/js/customizer.min.js': ['src/js/customizer.js'],
					'assets/js/navigation.min.js': ['src/js/navigation.js'],
					'assets/js/skip-link-focus-fix.min.js': ['src/js/skip-link-focus-fix.js']
				}
			}
		},
		browserSync: {
			dev: {
				bsFiles: {
					src: ['**/*.css', '**/*.php', '**/*.js', '!node_modules']
				},
				options: {
					watchTask: true,
					proxy: 'https://ghc.dev',
					open: 'external',
					host: 'andrews-macbook-pro.local',
					https: {
						key: '/Users/andrew/github/dotfiles/local-dev.key',
						cert: '/Users/andrew/github/dotfiles/local-dev.crt'
					}
				}
			}
		}
	} );

	grunt.loadNpmTasks( 'grunt-contrib-sass' );
	grunt.loadNpmTasks( 'grunt-svgmin' );
	grunt.loadNpmTasks( 'grunt-contrib-uglify' );
	grunt.loadNpmTasks( 'grunt-postcss' );
	grunt.loadNpmTasks( 'grunt-contrib-watch' );
	grunt.loadNpmTasks( 'grunt-browser-sync' );
	grunt.registerTask( 'default', [
		'browserSync',
		'watch'
	] );
};
