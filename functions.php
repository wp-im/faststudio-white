<?php
/** FastStudio White classic theme. */
define( 'FASTSTUDIO_WHITE_VERSION', '1.0.0' );

function faststudio_white_setup() {
	load_theme_textdomain( 'faststudio-white', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'custom-logo', array( 'height' => 100, 'width' => 320, 'flex-height' => true, 'flex-width' => true ) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_post_type_support( 'page', 'excerpt' );
	add_editor_style( 'assets/css/editor.css' );
	add_image_size( 'faststudio-white-project', 1440, 960, false );
	register_nav_menus( array( 'primary' => __( '主导航', 'faststudio-white' ), 'footer' => __( '页脚导航', 'faststudio-white' ), 'social' => __( '社交链接', 'faststudio-white' ) ) );
}
add_action( 'after_setup_theme', 'faststudio_white_setup' );

function faststudio_white_widgets() {
	$areas = array(
		'home-intro' => __( '首页：服务与能力', 'faststudio-white' ),
		'home-notes' => __( '首页：工作室与流程', 'faststudio-white' ),
		'home-end' => __( '首页：合作邀请', 'faststudio-white' ),
		'footer-1' => __( '页脚：工作室介绍', 'faststudio-white' ),
		'footer-2' => __( '页脚：联系与链接', 'faststudio-white' ),
	);
	foreach ( $areas as $id => $name ) {
		register_sidebar( array( 'name' => $name, 'id' => $id, 'before_widget' => '<section id="%1$s" class="fsw-widget %2$s">', 'after_widget' => '</section>', 'before_title' => '<h2>', 'after_title' => '</h2>' ) );
	}
}
add_action( 'widgets_init', 'faststudio_white_widgets' );

function faststudio_white_assets() {
	wp_enqueue_style( 'faststudio-white', get_stylesheet_uri(), array(), FASTSTUDIO_WHITE_VERSION );
	wp_enqueue_script( 'faststudio-white-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), FASTSTUDIO_WHITE_VERSION, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_action( 'wp_enqueue_scripts', 'faststudio_white_assets' );

function faststudio_white_customize( $customize ) {
	$customize->add_section( 'faststudio_white_home', array( 'title' => __( 'FastStudio White：工作室首页', 'faststudio-white' ), 'priority' => 30 ) );
	$fields = array(
		'fsw_kicker' => array( __( '首页眉题', 'faststudio-white' ), 'text', '' ),
		'fsw_title' => array( __( '首页标题', 'faststudio-white' ), 'text', '' ),
		'fsw_description' => array( __( '首页介绍', 'faststudio-white' ), 'textarea', '' ),
		'fsw_status' => array( __( '工作室状态说明', 'faststudio-white' ), 'text', '' ),
		'fsw_cta_label' => array( __( '顶部行动按钮文字', 'faststudio-white' ), 'text', '' ),
		'fsw_cta_url' => array( __( '顶部行动按钮链接', 'faststudio-white' ), 'url', '' ),
		'fsw_projects_heading' => array( __( '项目区标题', 'faststudio-white' ), 'text', __( '精选项目', 'faststudio-white' ) ),
		'fsw_services_heading' => array( __( '服务区标题', 'faststudio-white' ), 'text', __( '合作方向', 'faststudio-white' ) ),
		'fsw_posts_heading' => array( __( '手记区标题', 'faststudio-white' ), 'text', __( '工作之外的观察', 'faststudio-white' ) ),
		'fsw_show_posts' => array( __( '显示最新手记', 'faststudio-white' ), 'checkbox', true ),
		'fsw_dark' => array( __( '使用深色外观', 'faststudio-white' ), 'checkbox', false ),
		'fsw_footer_credit' => array( __( '页脚文字', 'faststudio-white' ), 'text', '' ),
	);
	for ( $i = 1; $i <= 3; $i++ ) { $fields[ 'fsw_project_' . $i ] = array( sprintf( __( '精选项目 %d', 'faststudio-white' ), $i ), 'select', 0 ); }
	$pages = array( 0 => __( '未选择', 'faststudio-white' ) );
	foreach ( get_pages( array( 'post_status' => 'publish', 'number' => 200 ) ) as $page ) { $pages[ $page->ID ] = $page->post_title; }
	foreach ( $fields as $id => $field ) {
		$type = $field[1];
		$sanitize = 'textarea' === $type ? 'sanitize_textarea_field' : ( 'checkbox' === $type ? 'faststudio_white_bool' : ( 'select' === $type ? 'absint' : ( 'url' === $type ? 'esc_url_raw' : 'sanitize_text_field' ) ) );
		$customize->add_setting( $id, array( 'default' => $field[2], 'sanitize_callback' => $sanitize ) );
		$control = array( 'label' => $field[0], 'section' => 'faststudio_white_home', 'type' => $type );
		if ( 'select' === $type ) { $control['choices'] = $pages; }
		$customize->add_control( $id, $control );
	}
}
add_action( 'customize_register', 'faststudio_white_customize' );

function faststudio_white_bool( $value ) { return (bool) $value; }
function faststudio_white_body_class( $classes ) { if ( get_theme_mod( 'fsw_dark', false ) ) { $classes[] = 'fsw-dark'; } return $classes; }
add_filter( 'body_class', 'faststudio_white_body_class' );

function faststudio_white_project_ids() {
	$ids = array();
	for ( $slot = 1; $slot <= 3; $slot++ ) { $id = absint( get_theme_mod( 'fsw_project_' . $slot, 0 ) ); if ( $id && 'publish' === get_post_status( $id ) && 'page' === get_post_type( $id ) && get_the_ID() !== $id ) { $ids[] = $id; } }
	return array_unique( $ids );
}
