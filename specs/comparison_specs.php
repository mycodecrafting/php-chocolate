<?php
/* $Id: comparison_specs.php 55 2007-03-19 14:20:56Z dreamscape $ */
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
	define('PHP_CHOCOLATE_MAIN', 'comparison_specs');
}


/**
 * Define our specs
 */
class comparison_specs extends the_specs
{

	public function define_specs()
	{
		// import all files from "contexts/" as contexts
		foreach (scandir(dirname(__FILE__) . '/comparison_specs/') as $file)
		{
			if (substr($file, -9) !== 'specs.php')
			{
				continue;
			}

			require_once(dirname(__FILE__) . '/comparison_specs/' . $file);
			$this->import->specs->{'comparison_' . substr($file, 0, -4)};
		}
	}

}


/**
 * Run the specs if the main specs are these specs
 */
if (PHP_CHOCOLATE_MAIN === 'comparison_specs')
{
	php_chocolate::run();
}
