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
	 * Global data we want passed to all views
	 */
	private $global_view_data;

	/**
	 * Initialize the Blade helper object
	 *
	 * @param $view_dir
	 * @param $cache_dir
	 * @param $custom_directives
	 * @param $global_view_data
	 */
	public function __construct($view_dir, $cache_dir, $custom_directives = array(), $global_view_data = array()) {

		$this->blade = new Blade($view_dir, $cache_dir);
		$this->custom_directives = $custom_directives;
		$this->global_view_data = $global_view_data;

	}

	/**
	 * render
	 *
	 * Makes and renders the view into a cached PHP file
	 * then echos and returns it.
	 *
	 * @param array $filenames
	 * @param array $context
	 *
	 * @return mixed
	 */
	public function render($filenames, $context = array()) {

		/**
		 * Add our default information to all views
		 */
		$this->blade->view()->share([
			'site'  =>  new CutlassSite()
		]);


		/**
		 * Add custom directives to Blade
		 */
		if ( !empty($this->custom_directives) )
			array_walk($this->custom_directives, array($this, 'addDirective'));

		/**
		 * Add global view data
		 */
		if( !empty($this->global_view_data) )
			$this->blade->view()->share($this->global_view_data);

		/**
		 * Add view-specific context
		 */
		if( !empty($context) )
			$this->blade->view()->share($context);

		/**
		 * Render the view
		 */
		if( is_string($filenames) ) {
			$output = $this->blade->view()->make($filenames)->render();

			echo $output;
			return $output;
		}

		foreach($filenames as $filename) {
			if($this->blade->view()->exists($filename)) {
				$output = $this->blade->view()->make($filename)->render();

				echo $output;
				return $output;
			}
		}

		throw new Exception("No view found");
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