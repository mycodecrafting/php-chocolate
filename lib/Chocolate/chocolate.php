<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */



/**
 * Turn up error reporting
 */
error_reporting(E_ALL | E_STRICT);

/**
 * define root chocolate directory
 */
define('PHP_CHOCOLATE_ROOT', dirname(__FILE__));

/**
 * Require version class
 */
require PHP_CHOCOLATE_ROOT . DIRECTORY_SEPARATOR . 'chocolate_version.php';

final class php_chocolate
{

    public static function run()
    {
        if (defined('PHP_CHOCOLATE_MAIN'))
        {
            $specs = PHP_CHOCOLATE_MAIN;
            $reporter = 'spec_reporter_output_' . self::get_default_report();
            $runner = new spec_runner(new $specs(), new $reporter());
            $runner->run(); 
        }
    }

    public static function load_core($data_path)
    {
        $data_path = implode(DIRECTORY_SEPARATOR, explode('::', $data_path)) . '.php';
        require_once(
            PHP_CHOCOLATE_ROOT . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . $data_path
        );
    }

    private static function get_default_report()
    {
        if (defined('PHP_CHOCOLATE_REPORT'))
        {
            return PHP_CHOCOLATE_REPORT;
        }

        switch (true)
        {
            case (PHP_SAPI === 'cli'):
            case (isset($_REQUEST['print_text'])):
                return in_array('--summary', $GLOBALS['argv']) ? 'text_summary' : 'text';
                break;
            case (isset($_REQUEST['print_xml'])):
                return 'xml';
                break;
            default:
                return 'html';
                break;
        }
    }

}


/**
 * require Chocolate core autoload function
 */
php_chocolate::load_core('autoload');


/**
 * Mock method call argument expectation comparisons
 * @todo Scheduled for Alpha 2
 */
define('anything', 'mocked_call_arg_expected_to_be_anything');
define('a_string', 'mocked_call_arg_expected_to_be_a_string');
define('a_float', 'mocked_call_arg_expected_to_be_a_float');
define('an_array', 'mocked_call_arg_expected_to_be_an_array');
define('an_integer', 'mocked_call_arg_expected_to_be_an_integer');
define('an_object', 'mocked_call_arg_expected_to_be_an_object');
define('a_boolean', 'mocked_call_arg_expected_to_be_boolean');

function an_instance_of($interface)
{
}

function a_string_containing($needle)
{
}

function a_string_matching($pattern)
{
}
