<?php get_header(); ?>

    <div class="wrapper-content">
        <div class="row">
            <div class="page-default">

                <div class="col12">
                    <div class="title">
                        <h4>Resultados da pesquisa para: <?php echo $_GET['s']; ?></h4>
                    </div>
                </div>

                <div class="col12">
                    <?php echo ResultSearch(); ?>
                </div>

            </div>
        </div>
    </div>

<?php get_footer(); ?>
