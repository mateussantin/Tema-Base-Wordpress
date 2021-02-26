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

	// CREATE FUNCTIONS BLOG
    //--------------------------------------
	include_once('functions-blog.php');


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
				register_sidebar(array(
					'name'          => 'Contatos Footer',
					'id'            => 'contatos_footer',
					'before_widget' => '<div>',
					'after_widget'  => '</div>',
					'before_title'  => '<h2 class="rounded">',
					'after_title'   => '</h2>',
				));
			}
			add_action( 'widgets_init', 'widgets_init' );


			// ADD SUPPORT FOR RESPONSIVE EMBEDDED CONTENT
			add_theme_support( 'responsive-embeds' );


			// ADD THUMBNAIL TO POST THEME
			add_theme_support( 'post-thumbnails' );
			add_image_size( 'post-thumb', 320, 190, true );
			add_image_size( 'blog-thumb', 370, 250, true );
		}
	endif;
	add_action( 'after_setup_theme', 'theme_setup' );


	// SCRIPTS AND STYLES
	//--------------------------------------
	function theme_scripts() {
		wp_enqueue_script('jquery-main', get_template_directory_uri() . '/assets/vendor/jquery/jquery-1.11.0.min.js', '1.0', true);

		// DOT DOT DOT
		wp_enqueue_script('js-dotdotdot', get_template_directory_uri() . '/assets/vendor/dotdotdot/jquery.dotdotdot.js', '1.0', true );

		// THEME
		wp_enqueue_style('css-main', get_template_directory_uri() . '/assets/css/style.min.css', wp_get_theme()->get( 'Version'));
		wp_enqueue_script('js-main', get_template_directory_uri() . '/assets/js/scripts.min.js', wp_get_theme()->get( 'Version'));

		// SLICK SLIDER
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


	// ACF PAGE OPTIONS
	//--------------------------------------
	if(function_exists('acf_add_options_page')){
		acf_add_options_page(array(
			'page_title' => 'SITE_NAME',
			'menu_title' => 'SITE_NAME',
			'menu_slug'  => 'site_name',
			'capability' => 'manage_options',
			'post_id'    => 'options',
			'position'   => 3,
			'redirect'	 => false
		));
	}


	// REMOVE POST TYPE (POST) TO ADMIN
	//--------------------------------------
	function wp_remove_plugin_admin_menu() {
		remove_menu_page('edit.php');
		remove_menu_page('edit-comments.php');
	}
	add_action( 'admin_menu', 'wp_remove_plugin_admin_menu', 9999 );


	// Opengraph
	function add_opengraph_doctype( $output ) {
		return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
	}
	add_filter('language_attributes', 'add_opengraph_doctype');


	// Social Share
	function insert_fb_in_head() {
		global $post;
		if ( !is_singular())
			return;

		echo '<meta property="og:title" content="' . get_the_title() . '"/>';
		echo '<meta property="og:type" content="article"/>';
		echo '<meta property="og:url" content="' . get_permalink() . '"/>';
		echo '<meta property="og:site_name" content="'. get_bloginfo() .'"/>';

		if(!has_post_thumbnail( $post->ID )) {
			$default_image = UrlBase() . '/screenshot.png';
			echo '<meta property="og:image" content="' . $default_image . '"/>';
		} else{
			$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'small' );
			echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
		}
	}
	add_action('wp_head', 'insert_fb_in_head', 5);
