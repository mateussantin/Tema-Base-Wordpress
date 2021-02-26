<?php get_header(); ?>

    <?php if (is_post_type_archive('POST_NAME')): ?>
        <!-- conteudo -->
    <?php endif; ?>

    <?php if (is_taxonomy('TAXONOMY_NAME') && !is_post_type_archive()): ?>
        <!-- conteudo -->
    <?php endif; ?>

    <h2>Pagina de arquivos</h2>

<?php get_footer(); ?>
