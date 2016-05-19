<?php
/**
 *
 * Footer
 * @since 1.0
 * @version 1.0
 *
 */
global $mevo;
if( $mevo['footer_style'] == 'modern' ) {
?>
	<footer id="footer-area" class="footer">
        <div class="container">
            <div class="map-block">
                <div id="map-canvas" data-lat="<?php print $mevo['footer_map_lat'];?>" data-lng="<?php print $mevo['footer_map_lng'];?>" data-zoom="11"></div>
                <div class="addresses-block">
                </div>
            </div>
            <div class="f-blackbox">
                <div class="blackbox-text">
                <?php 
                    $s = explode( '<br />', nl2br( $mevo['footer_black_section'] ) );
                    foreach ( $s as $string ) {
                        print '<p>' . $string . '</p>';
                    }
                ?>          
                </div>
            </div>
            <div class="f-bluebox">
                <div class="bluebox-text">
                    <?php print $mevo['footer_blue_section'];?>
                </div>
            </div>            
            <div class="copyright">
                <img class="copy-logo" src="<?php echo esc_attr( $mevo['footer_logo'] );?>" alt="">
                <div class="copy-text"><?php echo esc_html( $mevo['footer_copy'] );?></div>
            </div>
        </div>
    </footer>
<?php } else { ?>
    <footer id="footer-area" class="footer style-2">
        <div class="container">
            <?php if ( is_active_sidebar( 'first-footer-sidebar' ) || is_active_sidebar( 'second-footer-sidebar' ) || is_active_sidebar( 'third-footer-sidebar' ) || is_active_sidebar( 'fourth-footer-sidebar' ) ) { ?>
                <div class="footer-content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-3">
                            <div class="f-widget">
                                <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar('first-footer-sidebar') ); ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <div class="f-widget">
                                <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar('second-footer-sidebar') ); ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <div class="f-widget">
                                <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar('third-footer-sidebar') ); ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <div class="f-widget">
                                <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar('fourth-footer-sidebar') ); ?>
                            </div>
                        </div>                                                              
                    </div>
                </div>
            <?php } ?>
            <div class="footer-bottom clearfix">
                <div class="f_copy"><?php echo esc_html( $mevo['footer_copy'] );?></div>
                <?php if ( ! empty( $mevo['footer_social'] ) ) { ?>
                    <div class="f_social">
                        <?php foreach ( $mevo['footer_social'] as $link ) { ?>
                            <a href="<?php echo esc_url( $link['footer_social_link'] ); ?>" target="_blank"><i class="<?php echo esc_attr( $link['footer_social_icon'] ); ?>"></i></a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </footer>
<?php } ?>
<?php wp_footer(); ?>
</body>
</html>
