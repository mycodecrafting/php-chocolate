<?php
/* $Id: callback_specs.php 64 2007-10-28 19:29:17Z dreamscape $ */
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
	define('PHP_CHOCOLATE_MAIN', 'comparison_callback_specs');
}


/**
 * Setup some callbacks for the specs to use
 */
class expected_exception extends Exception
{
}

function throw_expected()
{
	throw new expected_exception('message');
}

function throw_unexpected()
{
	throw new Exception('message');
}

function throw_expected_with_unexpected_message()
{
	throw new expected_exception('wrong message');
}

function throw_none()
{
}


/**
 * Define our specs
 */
class comparison_callback_specs extends the_specs
{

	public function define_specs()
	{
		// import all files from "contexts/" as contexts
		foreach (scandir(dirname(__FILE__) . '/callback_contexts/') as $file)
		{
			if (substr($file, -4) !== '.php')
			{
				continue;
			}

			require_once(dirname(__FILE__) . '/callback_contexts/' . $file);
			$this->import->context->{'callback_' . substr($file, 0, -4)};
		}
	}

}


/**
 * Run the specs if the main specs are these specs
 */
if (PHP_CHOCOLATE_MAIN === 'comparison_callback_specs')
{
	php_chocolate::run();
}
