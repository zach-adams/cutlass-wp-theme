<?php
/**
 * Scripts and stylesheets
 */
function cutlass_scripts() {
  /**
   * The build task in Gulp renames production assets with a hash
   * Read the asset names from assets-manifest.json
   */
  if (WP_ENV === 'development') {
    $assets = array(
      'vendor-css'      => '/dist/css/vendor.css',
      'css'             => '/dist/css/main.css',
      'vendor-js'       => '/dist/js/vendor.js',
      'js'              => '/dist/js/main.js'
    );
  }

  wp_enqueue_style('cutlass_vendor_css', get_template_directory_uri() . $assets['vendor-css'], false, null);
  wp_enqueue_style('cutlass_css', get_template_directory_uri() . $assets['css'], false, null);
  wp_enqueue_script('cutlass_vendor_js', get_template_directory_uri() . $assets['vendor-js'], array(), null, true);
  wp_enqueue_script('cutlass_js', get_template_directory_uri() . $assets['js'], array(), null, true);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

}
add_action('wp_enqueue_scripts', 'cutlass_scripts', 100);

// http://wordpress.stackexchange.com/a/12450
function cutlass_jquery_local_fallback($src, $handle = null) {
  static $add_jquery_fallback = false;

  if ($add_jquery_fallback) {
    echo '<script>window.jQuery || document.write(\'<script src="' . get_template_directory_uri() . '/src/vendor/jquery/dist/jquery.min.js?1.11.1"><\/script>\')</script>' . "\n";
    $add_jquery_fallback = false;
  }

  if ($handle === 'jquery') {
    $add_jquery_fallback = true;
  }

  return $src;
}
add_action('wp_head', 'cutlass_jquery_local_fallback');