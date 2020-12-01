<?php
	/**
	 * @author Mateus Santin Junior
	 * @package Minha Empresa
	 * @subpackage Meu Site
	 * @since 1.0.0
	*/


	// CREATE POSTS
	//--------------------------------------
	include_once('functions-create-post.php');

    // CREATE MY ELEMENTS
    //--------------------------------------
	include_once('functions-my-elements.php');


	// SETUP INITIAL
	//--------------------------------------
	if ( ! function_exists( 'theme_setup' ) ) :
		function theme_setup() {
			// LOGO
			add_theme_support(
				'custom-logo',
				array(
					'flex-width'  => false,
					'flex-height' => false,
				)
			);

			// BACKGROUND IMAGE
			$defaults = array(
				'default-color'          => 'ffffff',
				'default-repeat'         => 'no-repeat',
				'default-position-x'     => 'center',
				'default-attachment'     => 'fixed',
			);
			add_theme_support( 'custom-background', $defaults );

			// REGISTER MENUS
            function menus_init() {
				register_nav_menu('menu-principal',__('Menu principal'));
				register_nav_menu('menu-rodape',__('Menu Rodape'));
            }
			add_action('init', 'menus_init');

			// REGISTER WIDGET
			function widgets_init() {

				register_sidebar( array(
					'name'          => 'Contatos Footer',
					'id'            => 'contatos_footer',
					'before_widget' => '<div>',
					'after_widget'  => '</div>',
					'before_title'  => '<h2 class="rounded">',
					'after_title'   => '</h2>',
				) );

			}
			add_action( 'widgets_init', 'widgets_init' );

			// ADD SUPPORT FOR RESPONSIVE EMBEDDED CONTENT
			add_theme_support( 'responsive-embeds' );

			// ADD THUMBNAIL TO POST THEME
			add_theme_support( 'post-thumbnails' );
			add_image_size( 'noticias-thumb', 320, 190, true );
		}
	endif;
	add_action( 'after_setup_theme', 'theme_setup' );


	// SCRIPTS AND STYLES
	//--------------------------------------
	function theme_scripts() {
		wp_enqueue_script('jquery-main', get_template_directory_uri() . '/assets/vendor/jquery/jquery-1.11.0.min.js', '1.0', true);

		// THEME
		wp_enqueue_style('css-main', get_template_directory_uri() . '/assets/css/style.min.css', wp_get_theme()->get( 'Version'));
		wp_enqueue_script('js-main', get_template_directory_uri() . '/assets/js/scripts.min.js', wp_get_theme()->get( 'Version'));

		// SLICK SLIDER SOMENTE NA PAGINA INICIAL
		if(is_home()){
			wp_enqueue_style('css-slick', get_template_directory_uri() . '/assets/vendor/slick/slick.css', '1.0', true);
			wp_enqueue_script('js-slick', get_template_directory_uri() . '/assets/vendor/slick/slick.min.js', '1.0', true);
			wp_enqueue_script('js-slider-home', get_template_directory_uri() . '/assets/js/slider-home.min.js', wp_get_theme()->get( 'Version'));
		}

		// FORMS
		if(is_page() == 'contato'){
			wp_enqueue_script('js-mask', get_template_directory_uri() . '/assets/vendor/jquery/jquery.mask.min.js', '1.0', true );
			wp_enqueue_script('js-forms', get_template_directory_uri() . '/assets/js/forms.min.js', wp_get_theme()->get( 'Version'));
		}
	}
	add_action( 'wp_enqueue_scripts', 'theme_scripts' );
