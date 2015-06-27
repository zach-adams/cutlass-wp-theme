<?php
use Philo\Blade\Blade;

/**
 * The core Cutlass class
 *
 * Used to initialize the Blade templating engine
 */
class Cutlass {

	/**
	 * The Blade helper object which gives us access to the Blade
	 * configuration and all the cool methods Blade has.
	 *
	 * @var Blade
	 */
	private $blade;

	/**
	 * Custom directives that we want to add to Blade views
	 */
	private $custom_directives;

	/**
	 * Initialize the Blade helper object
	 *
	 * @param $view_dir
	 * @param $cache_dir
	 * @param $custom_directives
	 */
	public function __construct($view_dir, $cache_dir, $custom_directives = array()) {

		$this->blade = new Blade($view_dir, $cache_dir);
		$this->custom_directives = $custom_directives;

	}

	/**
	 * render
	 *
	 * Makes and renders the view into a cached PHP file
	 * then echos and returns it.
	 *
	 * @param string $filename
	 * @param array $context
	 *
	 * @return mixed
	 */
	public function render($filename, $context = array()) {

		/**
		 * Add our default information to all views
		 */
		$this->blade->view()->share([
			'site'  =>  new CutlassSite(),
			'posts' =>  CutlassHelper::get_posts()
		]);

		/**
		 * Add extra content
		 */
		if( !empty($context) )
			$this->blade->view()->share($context);

		/**
		 * Add custom directives to Blade
		 */
		if ( !empty($this->custom_directives) )
			array_walk($this->custom_directives, array($this, 'addDirective'));

		/**
		 * Render the view
		 */
		$output = $this->blade->view()->make($filename)->render();

		echo $output;
		return $output;

	}

	/**
	 * addDirective
	 *
	 * Adds the directive to our compiler
	 *
	 * @param string $directive
	 * @param string $key
	 */
	private function addDirective( $directive, $key ) {

		$this->blade->getCompiler()->directive($key, function($expression) use ($directive) {
			/**
			 * Replace expression string with directive variable
			 */
			return str_replace('{expression}', $expression, $directive);

		});

	}

	/**
	 * getBlade
	 *
	 * Returns instance of our Blade object
	 *
	 * @return Blade;
	 */
	public function getBlade() {

		return $this->blade;

	}
}