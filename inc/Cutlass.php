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

	public function render($filename, $context = false) {
		$this->blade->view()->share([
			'site'  =>  new CutlassSite(),
		]);

		$this->addDirectives();

		$output = $this->blade->view()->make($filename)->render();
		echo $output;
		return $output;
	}

	private function addDirectives() {

		if ( empty($this->custom_directives) )
			return;

		array_walk($this->custom_directives, array($this, 'addDirective'));

	}

	private function addDirective( $directive, $key ) {

		$this->blade->getCompiler()->directive($key, function($expression) use ($directive) {
			return str_replace('{expression}', $expression, $directive);
		});

	}

	public function getBlade() {

		return $this->blade;

	}
}