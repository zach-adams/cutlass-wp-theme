<!doctype html>
<html class="no-js" {{ language_attributes() }}>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ wp_title('|', true, 'right') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{ wp_head() }}

  <link rel="alternate" type="application/rss+xml" title="{{ get_bloginfo('name') }} Feed" href="{{ esc_url(get_feed_link()) }}">
</head>
