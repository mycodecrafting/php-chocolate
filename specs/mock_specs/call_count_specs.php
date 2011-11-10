<?php
/* $Id: call_count_specs.php 62 2007-03-20 12:52:17Z dreamscape $ */
/**
 * @package PackageName
 * @subpackage SubPackageName
 * @name name
 */



/**
 * Include chocolate
 */
require_once dirname(__FILE__) . '/../../lib/Chocolate/chocolate.php';


/**
 * Setup our main specs
 */
if (!defined('PHP_CHOCOLATE_MAIN'))
{
	define('PHP_CHOCOLATE_MAIN', 'mock_call_count_specs');
}


/**
 * Define our specs
 */
class mock_call_count_specs extends the_specs
{

	public function define_specs()
	{
		// import all files from "mock_contexts/" as contexts
		foreach (scandir(dirname(__FILE__) . '/call_count_contexts/') as $file)
		{
			if (substr($file, -4) !== '.php')
			{
				continue;
			}

			require_once(dirname(__FILE__) . '/call_count_contexts/' . $file);
			$this->import->context->{'call_count_' . substr($file, 0, -4)};
		}
	}

}


/**
 * Run the specs if the main specs are these specs
 */
if (PHP_CHOCOLATE_MAIN === 'mock_call_count_specs')
{
	php_chocolate::run();
}
