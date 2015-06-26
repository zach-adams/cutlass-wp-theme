<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title></title>

	<link rel="stylesheet" href="{{ elixir('css/all.css') }}" />

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#"></a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li>
					<a href="/">Home</a>
				</li>
				<li>
					<a href="{{ url('allposts/testing/asdf#tester?all=test') }}">/r/All</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="/auth/register">Register</a></li>
				<li><a href="/auth/login">Login</a></li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">
	<div class="jumbotron">
		<h2>{{ $site->name }}</h2>
	</div>
	<div class="row">
		<div class="col-lg-8">
			@section('content')
			@show
		</div>
		<div class="col-lg-4">
			@section('sidebar')
				<h4>Make your own Subreddit!</h4>
				<a href="/subreddits/create" class="btn btn-primary">Create Subreddit</a>
			@show
		</div>
	</div>
	<!-- /.row -->

</div>
<!-- /.container -->

<script src="{{ elixir('js/all.js') }}"></script>
</body>
</html>