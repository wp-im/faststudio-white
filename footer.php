<?php /** Site footer. */ ?>
<footer class="fsw-footer">
	<div class="fsw-wrap fsw-footer-widgets">
		<?php foreach ( array( 'footer-1', 'footer-2' ) as $area ) : if ( is_active_sidebar( $area ) ) : ?><div><?php dynamic_sidebar( $area ); ?></div><?php endif; endforeach; ?>
	</div>
	<div class="fsw-wrap fsw-footer-bottom">
		<nav class="fsw-footer-nav" aria-label="<?php esc_attr_e( '页脚导航', 'faststudio-white' ); ?>"><?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'fallback_cb' => false, 'depth' => 1 ) ); ?></nav>
		<?php $credit = get_theme_mod( 'fsw_footer_credit', '' ); if ( $credit ) : ?><p class="fsw-footer-credit"><?php echo esc_html( $credit ); ?></p><?php endif; ?>
	</div>
</footer>
<?php wp_footer(); ?></body></html>
