<?php
/* $Id: mock_specs.php 62 2007-03-20 12:52:17Z dreamscape $ */
/**
 * @package PackageName
 * @subpackage SubPackageName
 * @name name
 */



/**
 * Include chocolate
 */
require_once dirname(__FILE__) . '/../lib/Chocolate/chocolate.php';


/**
 * Setup our main specs
 */
if (!defined('PHP_CHOCOLATE_MAIN'))
{
	define('PHP_CHOCOLATE_MAIN', 'mock_specs');
}


/**
 * Define our specs
 */
class mock_specs extends the_specs
{

	public function define_specs()
	{
		// import all files from "contexts/" as contexts
		foreach (scandir(dirname(__FILE__) . '/mock_specs/') as $file)
		{
			if (substr($file, -9) !== 'specs.php')
			{
				continue;
			}

			require_once(dirname(__FILE__) . '/mock_specs/' . $file);
			$this->import->specs->{'mock_' . substr($file, 0, -4)};
		}
	}

}


/**
 * Run the specs if the main specs are these specs
 */
if (PHP_CHOCOLATE_MAIN === 'mock_specs')
{
	php_chocolate::run();
}
