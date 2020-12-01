<?php
    // CREATE POST NOTICIAS
    //--------------------------------------
    add_action( 'init', 'register_noticias_post_type' );

    function register_noticias_post_type() {
        $labels = array(
            'name'               => __( 'Notícias' ),
            'singular_name'      => __( 'Notícias' ),
            'add_new'            => __( 'Adicionar Novo' ),
            'add_new_item'       => __( 'Adicionar Novo' ),
            'edit_item'          => __( 'Editar' ),
            'new_item'           => __( 'Nova Notícia' ),
            'all_items'          => __( 'Listar Todos' ),
            'view_item'          => __( 'Ver Notícia Anterior' ),
            'search_items'       => __( 'Buscar' ),
            'featured_image'     => 'Imagem Destacada',
            'set_featured_image' => 'Adicionar Imagem'
        );

        $args = array(
            'labels'            => $labels,
            'description'       => '',
            'public'            => true,
            'menu_position'     => 20,
            'supports'          => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
            'has_archive'       => true,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'menu_icon'         => 'dashicons-nametag'
        );

        register_post_type( 'noticias', $args );
    }

    // CREATE TAXONOMY CATEGORY NOTICIAS
    //--------------------------------------
    function register_noticias_taxonomy() {
        register_taxonomy(
            'categoria_noticias',
            'noticias',
            array(
                'label' => __( 'Categorias' ),
                'rewrite' => array( 'slug' => 'categoria_noticias' )
            )
        );
    }
    add_action( 'init', 'register_noticias_taxonomy', 10 );
