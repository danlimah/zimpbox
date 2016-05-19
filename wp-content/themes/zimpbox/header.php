<?php
/**
 *
 * The Header for our theme
 * @since 1.0.0
 * @version 1.0.0
 *
 */

global $mevo; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="format-detection" content="telephone=no" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no, minimal-ui"/>
  <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
    <link href="<?php echo esc_attr( $mevo['site_favicon'] );?>" rel="shortcut icon" />
  <?php } ?>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php if( $mevo['page_loader'] ) { ?>
        <!-- LOADER -->
        <div id="loading">
            <div id="loading-center">
                <div id="loading-center-absolute">
                    <div class="object" id="object_one"></div>
                    <div class="object" id="object_two"></div>
                    <div class="object" id="object_three"></div>
                    <div class="object" id="object_four"></div>
                </div>
            </div>
            <div id="loading-text"><?php esc_html_e( 'Abrindo Zimpbox . . .', 'mevo' ); ?></div>
        </div>
    <?php } ?>
    <!-- HEADER -->
    <header class="header <?php echo esc_attr( $mevo['header_style'] );?>">
        <div class="container">
            <div class="top-line">
                <a class="logo" href="<?php echo esc_url( home_url( '/' ) );?>">
                    <img class="main-logo" src="<?php echo esc_attr( $mevo['site_logo'] );?>" alt="">
                    <img class="alt-logo" src="<?php echo esc_attr( $mevo['second_site_logo'] );?>" alt="">
                </a>
            </div>
            <nav class="main-nav">
                <?php mevo_custom_menu(); ?>
            </nav>
            <button class="cmn-toggle-switch"><span></span></button>
        </div>
    </header>
