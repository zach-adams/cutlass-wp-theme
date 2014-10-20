<?php
/**
 * Clean up the_excerpt()
 */
function cutlass_excerpt_more($more) {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'cutlass') . '</a>';
}
add_filter('excerpt_more', 'cutlass_excerpt_more');

/**
 * Manage output of wp_title()
 */
function cutlass_wp_title($title) {
  if (is_feed()) {
    return $title;
  }

  $title .= get_bloginfo('name');

  return $title;
}
add_filter('wp_title', 'cutlass_wp_title', 10);
