<?php namespace Cutlass;
use Philo\Blade\Blade;
use Laravel\Lumen\Application;

/**
 * The core Cutlass class
 *
 * Used to initialize the Blade templating engine
 */
class Cutlass extends Application {

	/**
	 * Create a new Lumen application instance.
	 *
	 * @param  string|null  $basePath
	 * @return void
	 */
	public function __construct($basePath = null)
	{
		parent::__construct($basePath);
	}

	/**
	 * Run the application and send the response.
	 *
	 * @param  SymfonyRequest|null  $request
	 * @return void
	 */
	public function run($request = null)
	{
		$response = $this->dispatch($request);

		if ($response instanceof SymfonyResponse) {
			$response->sendContent();
			die("hi");
		} else {
			echo (string) $response;
		}

		if (count($this->middleware) > 0) {
			$this->callTerminableMiddleware($response);
		}
	}
}