<?php
/**
 * 404 Page
 *
 * @package mevo
 * @since 1.0
 *
 */
global $mevo;
get_header();?>
<div id="content-wrapper" class="inner-page">
	<div class="container">
	  <div class="page-404">
	    <h1><?php esc_html_e( 'Erro 404. Conteúdo Indisponível.', 'mevo' ); ?></h1>
	    <h2><?php echo esc_html( $mevo['error_title'] ); ?></h2>
	    <h2><?php echo esc_html( $mevo['error_message'] ); ?></h2>
	    <h3><?php echo esc_html( $mevo['error_secondary_message'] ); ?></h3>
	    <a href="<?php echo esc_url(home_url('/')); ?>">
	      <?php echo esc_html( $mevo['error_link_text'] ); ?>
	    </a>
	  </div>
	</div>
	<br><br><br><br><br><br>
</div>
<?php get_footer(); ?>
