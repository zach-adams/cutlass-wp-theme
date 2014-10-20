<?php
/**
 * Use Bootstrap's media object for listing comments
 *
 * @link http://getbootstrap.com/components/#media
 */
class cutlass_Walker_Comment extends Walker_Comment {
  function start_lvl(&$output, $depth = 0, $args = array()) {
    $GLOBALS['comment_depth'] = $depth + 1; ?>
    <ul <?php comment_class('media list-unstyled comment-' . get_comment_ID()); ?>>
    <?php
  }

  function end_lvl(&$output, $depth = 0, $args = array()) {
    $GLOBALS['comment_depth'] = $depth + 1;
    echo '</ul>';
  }

  function start_el(&$output, $comment, $depth = 0, $args = array(), $id = 0) {
    $depth++;
    $GLOBALS['comment_depth'] = $depth;
    $GLOBALS['comment'] = $comment;

    if (!empty($args['callback'])) {
      call_user_func($args['callback'], $comment, $args, $depth);
      return;
    }

    extract($args, EXTR_SKIP); ?>

  <li id="comment-<?php comment_ID(); ?>" <?php comment_class('media comment-' . get_comment_ID()); ?>>
    <?php echo get_avatar($comment, $size = '64'); ?>
    <div class="media-body">
    <h4 class="media-heading"><?php echo get_comment_author_link(); ?></h4>
    <time datetime="<?php echo get_comment_date('c'); ?>"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>"><?php printf(__('%1$s', 'cutlass'), get_comment_date(),  get_comment_time()); ?></a></time>
    <?php edit_comment_link(__('(Edit)', 'cutlass'), '', ''); ?>

    <?php if ($comment->comment_approved == '0') : ?>
      <div class="alert alert-info">
        <?php _e('Your comment is awaiting moderation.', 'cutlass'); ?>
      </div>
    <?php endif; ?>

    <?php comment_text(); ?>
    <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>

  <?php
  }

  function end_el(&$output, $comment, $depth = 0, $args = array()) {
    if (!empty($args['end-callback'])) {
      call_user_func($args['end-callback'], $comment, $args, $depth);
      return;
    }
    // Close ".media-body" <div> located in templates/comment.php, and then the comment's <li>
    echo "</div></li>\n";
  }
}

function cutlass_get_avatar($avatar, $type) {
  if (!is_object($type)) { return $avatar; }

  $avatar = str_replace("class='avatar", "class='avatar pull-left media-object", $avatar);
  return $avatar;
}
add_filter('get_avatar', 'cutlass_get_avatar', 10, 2);
