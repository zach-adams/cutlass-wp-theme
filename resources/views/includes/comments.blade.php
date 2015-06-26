@if(post_password_required())
  return;
@endif

<?php
  global $postid;
  $postid = get_the_ID();
  $comments = get_comments(array(
    'post_id' => $postid,
    'status' => 'approve'
  ));
?>



<section id="comments">
  @if ($comments)
    <h3><?php printf(_n('One Response to &ldquo;%2$s&rdquo;', '%1$s Responses to &ldquo;%2$s&rdquo;', get_comments_number(), 'cutlass'), number_format_i18n(get_comments_number()), get_the_title()) ?></h3>

    <ol class="media-list">
      {{ wp_list_comments(array('walker' => new cutlass_Walker_Comment), $comments) }}
    </ol>

    @if(get_comment_pages_count() > 1 && get_option('page_comments'))
      <nav>
        <ul class="pager">
          @if (get_previous_comments_link())
            <li class="previous">{{ previous_comments_link(__('&larr; Older comments', 'cutlass')) }}</li>
          @endif
          @if (get_next_comments_link())
            <li class="next">{{ next_comments_link(__('Newer comments &rarr;', 'cutlass')) }}</li>
          @endif
        </ul>
      </nav>
    @endif

    @if(!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments'))
      <div class="alert alert-warning">
        {{ _e('Comments are closed.', 'cutlass') }}
      </div>
    @endif
  @elseif(!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments'))
    <div class="alert alert-warning">
      {{ _e('Comments are closed.', 'cutlass') }}
    </div>
  @endif
</section><!-- /#comments -->

<section id="respond">
  @if (comments_open())
    <h3>{{ comment_form_title(__('Leave a Reply', 'cutlass'), __('Leave a Reply to %s', 'cutlass')) }}</h3>
    <p class="cancel-comment-reply">{{ cancel_comment_reply_link() }}</p>
    @if (get_option('comment_registration') && !is_user_logged_in())
      <p>You must be <a href="{{ wp_login_url(get_permalink()) }}">logged in</a> to post a comment.</p>
    @else
      <form action="{{ get_option('siteurl') }}/wp-comments-post.php" method="post" id="commentform">
        @if (is_user_logged_in())
          <p>
            Logged in as <a href="{{ get_option('siteurl') }}/wp-admin/profile.php">{{ $user_identity }}</a>
            <a href="{{ wp_logout_url(get_permalink()) }}" title="{{ _e('Log out of this account', 'cutlass') }}">{{ _e('Log out &raquo;', 'cutlass') }}</a>
          </p>
        @else
          @define $req = get_option('require_name_email')
          <div class="form-group">
            <label for="author">{{ _e('Name', 'cutlass'); if ($req) _e(' (required)', 'cutlass') }}</label>
            <input type="text" class="form-control" name="author" id="author" size="22" @if($req) echo 'aria-required="true"'; @endif>
          </div>
          <div class="form-group">
            <label for="email">{{ _e('Email (will not be published)', 'cutlass'); if ($req) _e(' (required)', 'cutlass') }}</label>
            <input type="email" class="form-control" name="email" id="email" size="22" @if ($req) echo 'aria-required="true"'; @endif>
          </div>
          <div class="form-group">
            <label for="url">{{ _e('Website', 'cutlass') }}</label>
            <input type="url" class="form-control" name="url" id="url" size="22">
          </div>
        @endif
        <div class="form-group">
          <label for="comment">{{ _e('Comment', 'cutlass') }}</label>
          <textarea name="comment" id="comment" class="form-control" rows="5" aria-required="true"></textarea>
        </div>
        <p><input name="submit" class="btn btn-primary" type="submit" id="submit" value="{{ _e('Submit Comment', 'cutlass') }}"></p>
        {{ comment_id_fields() }}
        {{ do_action('comment_form', $post->ID) }}
      </form>
    @endif
  @endif
</section><!-- /#respond -->
