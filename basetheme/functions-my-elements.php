<?php
    // LOGO TYPE
    //--------------------------------------
    function Logo() {
        $out = '';
        if (function_exists('the_custom_logo')) {
            $out .= the_custom_logo();
        }
        return $out;
    }


    // PAGE TITLE
    //--------------------------------------
    function PageTitle() {
        $out = '';

        if (is_category()) {
            $title = single_cat_title( '', false );
        } elseif (is_tag()) {
            $title = single_tag_title( '', false );
        } elseif (is_author()) {
            $title = get_the_author();
        } elseif (is_post_type_archive()) {
            $title = post_type_archive_title('', false);
        } elseif (is_tax()) {
            $title = single_term_title('', false);
        } elseif (is_page()) {
            $title = get_the_title('', false);
        } else {
            $title = 'Erro ao retornar o Título';
        }

        // title blog
        if(get_post_type() == 'blog') $title = 'BLOG';

        $out .= '<div class="page-title">';
            $out .= '<h1>'. $title .'</h1>';
        $out .= '</div>';

        return $out;
    }


    // MENU PRINCIPAL
    //--------------------------------------
    function MenuPrincipal() {
        $out = '';
        $menuitems = wp_get_nav_menu_items(2);
        $count = 0;

        if($menuitems):
            $out .= '<nav>';
                foreach ($menuitems as $item) :
                    $link = $item->url;
                    $title = $item->title;

                    if (!$item->menu_item_parent) :
                        $parent_id = $item->ID;
                        $out .= '<li><a href="'. $link .'" title="'. $title .'">'. $title .'</a></li>';
                    endif;

                    $count++;
                endforeach;
            $out .= '</nav>';
        endif;

        return $out;
    }


    // URL BASE
    //--------------------------------------
    function UrlBase() {
        $out = '';
        $out .= get_template_directory_uri();
        return $out;
    }


    // URL BASE IMAGE
    //--------------------------------------
    function UrlBaseImage() {
        $out = '';
        $out .= get_template_directory_uri() . '/assets/images';
        return $out;
    }


    // CLEAR NUMBER PHONE - TEL:number
    //--------------------------------------
    function ClearPhone($valor){
        $valor = trim($valor);
        $valor = str_replace("(", "", $valor);
        $valor = str_replace(")", "", $valor);
        $valor = str_replace(" ", "", $valor);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace("/", "", $valor);

        return $valor;
    }


    // FORMAT CONTENT POSTS
    //--------------------------------------
    function ContentFormatting($more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
        $content = get_the_content($more_link_text, $stripteaser, $more_file);
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        return $content;
    }


    // SLIDER HOME AND BANNER PAGES INTERNAL
    //--------------------------------------
    function SliderAndBannerInternal() {
        $out = '';

        $slider = '';
        if($slider == '') return;

        $slider = get_field('slider');

        if(is_home()):
            // Slider
            if($slider):
                $out .= '<div class="slick-slider slider-home">';
                    foreach( $slider as $item ):
                        $image = $item['imagem'];
                        $link = $item['link'];
                        $link = ($link) ? 'href="'. $link .'" target="_blank"' : '';

                        $out .= '<a '. $link .'><img src="'. $image .'" alt="Slider"></a>';
                    endforeach;
                $out .= '</div>';
            endif;
        elseif(is_page() && !is_home()):
            $out .= '<div class="banner-internal"><div class="wrapper-content">'. PageTitle() .'</div></div>';
        else:
            $out .= '<div class="banner-internal"><div class="wrapper-content">'. PageTitle() .'</div></div>';
        endif;

        return $out;
    }


    // LIST POST EXAMPLE
    //--------------------------------------
    function ListCustomPostType() {
        global $post;
        $out = '';

        $args = array(
            'post_type'      => 'POST',
            'posts_per_page' => 4,
            'orderby'        => 'id',
            'order'          => 'DESC',
            'post_status'    => 'publish',
        );

        $listPost = new WP_Query( $args );

        if ( $listPost->have_posts() ) :
            while ( $listPost->have_posts() ) : $listPost->the_post();

                $title = get_the_title();
                $description = get_the_content();
                $image = get_the_post_thumbnail_url( get_the_ID(), 'post-thumb' );
                $url = get_the_permalink();

                $out .= '<div>';
                $out .= '</div>';

            endwhile;
        else:
            $out .= '<div class="msg-box is-info">Nenhum item cadastrado neste post!</div>';
        endif;

        wp_reset_postdata();
        return $out;
    }


    // LIST TAXONOMY CATEGORY
    //--------------------------------------
    function ListTaxonomyCategory() {
        global $post;
        $out = '';

        $post_name = '';
        $taxonomy_name = '';

        $terms = get_terms(
            array(
                'post_type'  => $post_name,
                'taxonomy'   => $taxonomy_name,
                'orderby'    => 'name',
                'order'      => 'ASC',
                'hide_empty' => false,
            )
        );

        if (! empty($terms) && is_array($terms)) {
            $out .= '<nav class="categories">';
                foreach ( $terms as $term ) {
                    $id = $term->term_id;
                    $title = $term->name;
                    $slug = '/'. $post_name .'/' . $term->slug;

                    $out .= '<li><a href="'. $slug .'" title="'. $title .'">'. $title .'</a></li>';
                }
            $out .= '</nav>';
        }

        wp_reset_postdata();
        return $out;
    }
