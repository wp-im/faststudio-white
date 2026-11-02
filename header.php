<?php
/** Site header. */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head><meta charset="<?php bloginfo( 'charset' ); ?>"><meta name="viewport" content="width=device-width, initial-scale=1"><?php wp_head(); ?></head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="fsw-skip" href="#primary"><?php esc_html_e( '跳至正文', 'faststudio-white' ); ?></a>
<header class="fsw-header"><div class="fsw-wrap fsw-header-inner">
	<div class="fsw-branding"><a class="fsw-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php if ( has_custom_logo() ) { the_custom_logo(); } else { bloginfo( 'name' ); } ?></a></div>
	<button class="fsw-nav-toggle" type="button" hidden aria-expanded="false" aria-controls="fsw-primary-nav" data-open-label="<?php esc_attr_e( '打开菜单', 'faststudio-white' ); ?>" data-close-label="<?php esc_attr_e( '关闭菜单', 'faststudio-white' ); ?>" aria-label="<?php esc_attr_e( '打开菜单', 'faststudio-white' ); ?>"><span aria-hidden="true">☰</span></button>
	<nav class="fsw-nav" id="fsw-primary-nav" aria-label="<?php esc_attr_e( '主导航', 'faststudio-white' ); ?>"><?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'fallback_cb' => false ) ); ?></nav>
</div></header>
