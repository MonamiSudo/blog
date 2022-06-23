<?php
// 投稿画面 サムネイル設定
add_theme_support( 'post-thumbnails' );

// ============================================================================================
// パス
// ============================================================================================
// テーマファイルまでのパス
$theme_path = get_template_directory_uri();
$img_path = $theme_path . '/assets/images';

// ============================================================================================
// 管理画面メニュー表示
// ============================================================================================
register_nav_menus(array(
  'header' => 'ヘッダーナビゲーション',
  'footer' => 'フッターナビゲーション',
));

// ============================================================================================
// リライトルール
// ============================================================================================
add_action( 'init', function() {
  global $wp_rewrite;
  
  add_rewrite_rule( 'blog/([^/]+)/([^/]+)/?$', 'index.php?blog=$matches[2]', 'top' );
  add_rewrite_rule( 'blog/([^/]+)(/page/([0-9]+))?/?', 'index.php?genre=$matches[1]&paged=$matches[3]', 'top');
  // $wp_rewrite->flush_rules( false );
} );

add_filter( 'post_type_link', function( $permalink, $post, $leavename ) {
  if ( $post->post_type == 'blog' ) {
    $term = wp_get_post_terms( $post->ID, 'genre' )[0]->slug;
    return "/blog/" . $term . "/" . $post->post_name . "/";
  }
}, 10, 4 );