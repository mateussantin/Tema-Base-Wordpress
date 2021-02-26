<?php
    // CREATE POST BLOG
    //--------------------------------------
    add_action( 'init', 'register_blog_post_type' );

    function register_blog_post_type() {
        $labels = array(
            'name'               => __( 'Blog' ),
            'singular_name'      => __( 'Blog' ),
            'add_new'            => __( 'Adicionar Novo' ),
            'add_new_item'       => __( 'Adicionar Novo' ),
            'edit_item'          => __( 'Editar' ),
            'new_item'           => __( 'Novo Post' ),
            'all_items'          => __( 'Listar Todos' ),
            'view_item'          => __( 'Ver Post Anterior' ),
            'search_items'       => __( 'Buscar' ),
            'featured_image'     => 'Imagem Destacada',
            'set_featured_image' => 'Adicionar Imagem'
        );

        $args = array(
            'labels'            => $labels,
            'description'       => '',
            'public'            => true,
            'menu_position'     => 30,
            'supports'          => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
            'has_archive'       => true,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'menu_icon'         => 'dashicons-welcome-write-blog'
        );

        register_post_type( 'blog', $args );
    }

    // CREATE TAXONOMY CATEGORY BLOG
    //--------------------------------------
    function register_noticias_taxonomy() {
        register_taxonomy(
            'categoria_blog',
            'blog',
            array(
                'label' => __( 'Categorias' ),
                'rewrite' => array( 'slug' => 'categoria_blog' )
            )
        );
    }
    add_action( 'init', 'register_noticias_taxonomy', 10 );
