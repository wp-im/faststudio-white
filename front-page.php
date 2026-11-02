<?php
/** Studio homepage. */
get_header();
$projects = faststudio_white_project_ids();
?>
<main id="primary" class="fsw-main">
	<div class="fsw-wrap">
		<header class="fsw-intro">
			<?php $kicker = get_theme_mod( 'fsw_kicker', '' ); if ( $kicker ) : ?><p class="fsw-kicker"><?php echo esc_html( $kicker ); ?></p><?php endif; ?>
			<h1><?php echo esc_html( get_theme_mod( 'fsw_title', '' ) ?: get_bloginfo( 'name' ) ); ?></h1>
			<?php $description = get_theme_mod( 'fsw_description', '' ); if ( $description ) : ?><p class="fsw-lede"><?php echo nl2br( esc_html( $description ) ); ?></p><?php endif; ?>
			<?php $label = get_theme_mod( 'fsw_cta_label', '' ); $url = get_theme_mod( 'fsw_cta_url', '' ); if ( $label && $url ) : ?><div class="fsw-actions"><a class="fsw-button" href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $label ); ?> <span aria-hidden="true">↗</span></a></div><?php endif; ?>
			<?php $status = get_theme_mod( 'fsw_status', '' ); if ( $status ) : ?><p class="fsw-kicker"><?php echo esc_html( $status ); ?></p><?php endif; ?>
		</header>
		<?php if ( $projects ) : ?>
			<section class="fsw-section" aria-labelledby="fsw-projects-heading"><div class="fsw-section-heading"><h2 id="fsw-projects-heading"><?php echo esc_html( get_theme_mod( 'fsw_projects_heading', __( '精选项目', 'faststudio-white' ) ) ); ?></h2></div>
				<div class="fsw-project-grid">
				<?php foreach ( $projects as $position => $id ) : ?><article class="fsw-project"><a href="<?php echo esc_url( get_permalink( $id ) ); ?>">
					<?php if ( has_post_thumbnail( $id ) ) { echo get_the_post_thumbnail( $id, 'faststudio-white-project', array( 'alt' => '', 'loading' => $position ? 'lazy' : 'eager', 'sizes' => $position ? '(max-width:760px) calc(100vw - 40px), 546px' : '(max-width:760px) calc(100vw - 40px), 1120px' ) ); } ?>
					<h3><?php echo esc_html( get_the_title( $id ) ); ?> <span aria-hidden="true">↗</span></h3></a>
					<?php if ( has_excerpt( $id ) ) : ?><p><?php echo esc_html( get_the_excerpt( $id ) ); ?></p><?php endif; ?>
				</article><?php endforeach; ?>
				</div></section>
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'home-intro' ) ) : ?><section class="fsw-section" aria-labelledby="fsw-services-heading"><div class="fsw-section-heading"><h2 id="fsw-services-heading"><?php echo esc_html( get_theme_mod( 'fsw_services_heading', __( '合作方向', 'faststudio-white' ) ) ); ?></h2></div><div class="fsw-widget-grid"><?php dynamic_sidebar( 'home-intro' ); ?></div></section><?php endif; ?>
		<?php if ( is_active_sidebar( 'home-notes' ) ) : ?><section class="fsw-section"><div class="fsw-widget-grid"><?php dynamic_sidebar( 'home-notes' ); ?></div></section><?php endif; ?>
		<?php if ( get_theme_mod( 'fsw_show_posts', true ) ) : $posts = new WP_Query( array( 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 3, 'no_found_rows' => true, 'ignore_sticky_posts' => true ) ); if ( $posts->have_posts() ) : ?>
			<section class="fsw-section" aria-labelledby="fsw-notes-heading"><div class="fsw-section-heading"><h2 id="fsw-notes-heading"><?php echo esc_html( get_theme_mod( 'fsw_posts_heading', __( '工作之外的观察', 'faststudio-white' ) ) ); ?></h2><?php if ( get_option( 'page_for_posts' ) ) : ?><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"><?php esc_html_e( '全部手记', 'faststudio-white' ); ?></a><?php endif; ?></div><div class="fsw-post-list"><?php while ( $posts->have_posts() ) : $posts->the_post(); get_template_part( 'template-parts/post-card' ); endwhile; ?></div></section>
		<?php endif; wp_reset_postdata(); endif; ?>
		<?php if ( is_active_sidebar( 'home-end' ) ) : ?><section class="fsw-section"><div class="fsw-widget-grid"><?php dynamic_sidebar( 'home-end' ); ?></div></section><?php endif; ?>
	</div>
</main>
<?php get_footer(); ?>
