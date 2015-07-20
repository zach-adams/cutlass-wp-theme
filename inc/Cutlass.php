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
	public $blade;

	/**
	 * Custom directives that we want to add to Blade views
	 */
	private $custom_directives;

	/**
	 * Global data we want passed to all views
	 */
	private $global_view_data;

	/**
	 * Misc settings applied in config/Cutlass.php
	 */
	public $misc_settings;


	/**
	 * Initialize the Blade helper object
	 *
	 * @param $view_dir
	 * @param $cache_dir
	 * @param $custom_directives
	 * @param $global_view_data
	 * @param $misc_settings
	 */
	public function __construct($view_dir, $cache_dir, $custom_directives = array(), $global_view_data = array(), $misc_settings = array()) {

		$this->blade = new Blade($view_dir, $cache_dir);
		$this->custom_directives = $custom_directives;
		$this->global_view_data = $global_view_data;
		$this->misc_settings = $misc_settings;

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
	 * @throws Exception
	 */
	public function render($filenames, $context = array()) {

		$output = '';

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
			foreach($this->custom_directives as $key => $directive)
				$this->directive($key, $directive);

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
		 * Render the view (if it exists)
		 * Check to see if it's a single filename, else check to see if
		 * there's an array of filenames
		 */
		if( is_string($filenames) && $this->blade->view()->exists($filenames) ) {
			$output = $this->blade->view()->make($filenames)->render();
		} elseif(is_array($filenames)) {
			foreach($filenames as $filename) {
				if($this->blade->view()->exists($filename)) {
					$output = $this->blade->view()->make($filename)->render();
				}
			}
		}

		echo $output;
		return $output;

	}

	/**
	 * directive
	 *
	 * Adds the directive to our compiler
	 *
	 * @param string $key
	 * @param string $directive
	 */
	public function directive( $key, $directive ) {

		if(is_callable($directive)) {
			$this->blade->getCompiler()->directive($key, $directive);
			return;
		}

		$this->blade->getCompiler()->directive($key, function($expression) use ($directive) {
			/**
			 * Replace expression string with directive variable
			 */
			return str_replace('{expression}', $expression, $directive);

		});

	}

	/**
	 * context
	 *
	 * Adds items to the view's context
	 *
	 * @param string|array $context
	 * @return bool
	 */
	public function context( $context ) {

		if(!empty($context))
			return $this->blade->view()->share($context);

		return false;

	}
}