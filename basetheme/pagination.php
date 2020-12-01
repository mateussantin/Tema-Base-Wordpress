<?php
	the_posts_pagination( array(
		'prev_text'          => __( 'Página anterior', '<' ),
		'next_text'          => __( 'Próxima página', '>' ),
		'screen_reader_text' => __( ' ' ),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( '', 'cm' ) . ' </span>',
	 ) );
?>
