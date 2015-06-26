<?php

if (!function_exists('app')) {
	function app($make = null, $parameters = [])
	{
		global $cutlass;

		$container = $cutlass->getBlade()->getContainer();

		if (is_null($make)) {
			return $container;
		}
		return $container->make($make, $parameters);
	}
}