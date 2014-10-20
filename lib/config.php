<?php
/**
 * Enable theme features
 */
add_theme_support('bootstrap-gallery');     // Enable Bootstrap's thumbnails component on [gallery]
add_theme_support('jquery-cdn');            // Enable to load jQuery from the Google CDN

/**
 * Configuration values
 */

if (!defined('WP_ENV')) {
  define('WP_ENV', 'development');  // scripts.php checks for values 'production' or 'development'
}

/**
 * Add body class if sidebar is active
 */
function cutlass_sidebar_body_class($classes) {
  if (cutlass_display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }
  return $classes;
}
add_filter('body_class', 'cutlass_sidebar_body_class');

/**
 * $content_width is a global variable used by WordPress for max image upload sizes
 * and media embeds (in pixels).
 *
 * Example: If the content area is 640px wide, set $content_width = 620; so images and videos will not overflow.
 * Default: 1140px is the default Bootstrap container width.
 */
if (!isset($content_width)) { $content_width = 1140; }
