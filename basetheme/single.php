<?php get_header(); ?>

<section>

    <?php if (is_single() && get_queried_object()->post_type === 'produto') :

        get_template_part('pages/products/products', 'detail');

    endif; ?>

    <?php if (is_single() && get_queried_object()->post_type === 'obra') :

        get_template_part('pages/obras-realizadas/obras', 'detail');

    endif; ?>

    <article class="content">

        <!-- DEPOIMENTOS  -->
        <?php get_template_part('components/depoimentos/depoimentos', 'all'); ?>

    </article>

</section>

<?php get_footer(); ?>