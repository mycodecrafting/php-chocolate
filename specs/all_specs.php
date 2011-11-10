<?php
/* $Id: all_specs.php 55 2007-03-19 14:20:56Z dreamscape $ */
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
	define('PHP_CHOCOLATE_MAIN', 'chocolate_specs');
}


/**
 * Define our specs
 */
class chocolate_specs extends the_specs
{

	public function define_specs()
	{
		// import all files from "contexts/" as contexts
		foreach (scandir(dirname(__FILE__) . '/contexts/') as $file)
		{
			if (substr($file, -4) !== '.php')
			{
				continue;
			}

			require_once(dirname(__FILE__) . '/contexts/' . $file);
			$this->import->context->{substr($file, 0, -4)};
		}

		// import all "_specs.php" files as specs
		foreach (scandir(dirname(__FILE__) ) as $file)
		{
			if ((substr($file, -10) !== '_specs.php') ||
				($file === 'all_specs.php')
			   )
			{
				continue;
			}

			require_once(dirname(__FILE__) . '/' . $file);
			$this->import->specs->{substr($file, 0, -4)};
		}
	}

}


/**
 * Run the specs if the main specs are these specs
 */
if (PHP_CHOCOLATE_MAIN === 'chocolate_specs')
{
	php_chocolate::run();
}
