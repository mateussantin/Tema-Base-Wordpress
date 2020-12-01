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


    // MENU PRINCIPAL
    //--------------------------------------
    function MenuPrincipal() {
        $out = '';
        $menuitems = wp_get_nav_menu_items(2);
        $count = 0;

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

        return $out;
    }


    // SOCIAL MEDIA
    //--------------------------------------
    function SocialMedia() {
        $out = '';

        if( get_field('redes_sociais', 'options') ):
            $out .= '<div class="social-media-header">';
                while( has_sub_field('redes_sociais', 'options') ):
                    $facebook = get_sub_field('facebook', 'options');
                    $instagram = get_sub_field('instagram', 'options');

                    if($facebook) {
                        $out .= '<a href="'. $facebook .'" target="_blank"><img src="'. UrlBaseImage() .'/icons/icon-facebook.png" alt="Icon facebook"></a>';
                    }

                    if($instagram) {
                        $out .= '<a href="'. $instagram .'" target="_blank"><img src="'. UrlBaseImage() .'/icons/icon-instagram.png" alt="Icon instagram"></a>';
                    }
                endwhile;
            $out .= '</div>';
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


    // SLIDER HOME AND BANNER PAGES INTERNAL
    //--------------------------------------
    function SliderAndBannerInternal() {
        $out = '';
        $pageId = 12;
        $slider = get_field('slider', $pageId);

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
            // Banner Internal
            $image = get_field('banner_header', get_the_ID());
            if($image):
                $out .= '<div class="banner-internal"><img src="'. $image .'" alt="Banner"></div>';
            else:
                $out .= '<div class="banner-internal"><img src="'.  UrlBaseImage() .'/banner-page-default.png" alt="Banner Default"></div>';
            endif;
        else:
            // Default
			$out .= '<div class="banner-internal"><img src="'.  UrlBaseImage() .'/banner-page-default.png" alt="Banner Default"></div>';
        endif;

        return $out;
    }


    // NEWS PAGE HOME
    //--------------------------------------
    function NoticiasListHome() {
        global $post;
        $out = '';

        $args = array(
            'post_type'      => 'noticias',
            'posts_per_page' => 4,
            'orderby'        => 'id',
            'order'          => 'DESC',
            'post_status'    => 'publish',
        );

        $newsHome = new WP_Query( $args );

        if ( $newsHome->have_posts() ) :
            while ( $newsHome->have_posts() ) : $newsHome->the_post();

                $title = get_the_title();
                $description = get_the_content();
                $image = get_the_post_thumbnail_url( get_the_ID(), 'noticias-thumb' );
                $url = get_the_permalink();

                if(strlen($description) > 95) {
                    $description = substr($description, 0, 95) . '...';
                }

                if(strlen($title) > 90) {
                    $titlePrev = substr($title, 0, 90) . '...';
                } else {
                    $titlePrev = $title;
                }

                $out .= '<div class="news-item">';
                    $out .= '<a href="'. $url .'" title="'. $title .'"><img class="cover-news" src="'. $image .'" alt="Capa notícia"></a>';
                    $out .= '<h1 class="title-news"><a href="'. $url .'" title="'. $title .'">'. $titlePrev .'</a></h1>';
                    $out .= '<p class="description-news">'. ucfirst($description) .'</p>';
                    $out .= '<a class="link-news" href="'. $url .'" title="Continuar lendo">Continuar lendo</a>';
                $out .= '</div>';

            endwhile;
        else:
            $out .= '<div class="msg-box is-info">Nenhum item cadastrado neste post!</div>';
        endif;

        wp_reset_postdata();
        return $out;
    }


    // SEARCH NEWS RESULTS
    //--------------------------------------
    function ResultSearch() {
        global $post;
        $out = '';

        $args = array(
            'post_type'      => 'noticias',
            'posts_per_page' => -1,
            'orderby'        => 'id',
            'order'          => 'DESC',
            'post_status'    => 'publish',
			's'              => $_GET['s'],
        );

        $results_search_news = new WP_Query( $args );

        if ( $results_search_news->have_posts() ) :
            while ( $results_search_news->have_posts() ) : $results_search_news->the_post();

                $title = get_the_title();
                $description = get_the_content();
                $image = get_the_post_thumbnail_url( get_the_ID(), 'noticias-thumb' );
                $url = get_the_permalink();

                if(strlen($description) > 95) {
                    $description = substr($description, 0, 95) . '...';
                }

                if(strlen($title) > 90) {
                    $titlePrev = substr($title, 0, 90) . '...';
                } else {
                    $titlePrev = $title;
                }

                $out .= '<div class="news-item">';
                    $out .= '<a href="'. $url .'" title="'. $title .'"><img class="cover-news" src="'. $image .'" alt="Capa notícia"></a>';
                    $out .= '<h1 class="title-news"><a href="'. $url .'" title="'. $title .'">'. $titlePrev .'</a></h1>';
                    $out .= '<p class="description-news">'. ucfirst($description) .'</p>';
                    $out .= '<a class="link-news" href="'. $url .'" title="Continuar lendo">Continuar lendo</a>';
                $out .= '</div>';

            endwhile;
        else:
            $out .= '<div class="msg-box is-info">Nenhum resultado encontrado!</div>';
        endif;

        wp_reset_postdata();
        return $out;
    }


    // LIST TAXONOMY CATEGORY ESPECIALIDADES
    //--------------------------------------
    function ListTaxonomyCategoryEspecialidades() {
        global $post;
        $out = '';

        $terms = get_terms(
            array(
                'post_type' => 'especialidades',
                'taxonomy'   => 'categoria_especialidades',
                'orderby' => 'name',
                'order'   => 'ASC',
                'hide_empty' => false,
            )
        );

        if (! empty($terms) && is_array($terms)) {
            $i = 0;
            $out .= '<nav id="categories-especialidades" class="categories">';
                foreach ( $terms as $term ) {
                    $id = $term->term_id;
                    $title = $term->name;
                    $url = is_home() ? '/especialidades/?id='.$id : '';

                    $out .= '<li><a href="'. $url .'" data-id="'. $id .'" title="'. $title .'">'. $title .'</a></li>';

                    // break
                    if (++$i == 20 && is_home()) break;
                }
            $out .= '</nav>';
        }

        wp_reset_postdata();
        return $out;
    }


