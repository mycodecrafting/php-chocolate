<?php
/* $Id: object_stub_generator.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class mocked_object_stub_generator extends mocked_generator
{

    protected $prefix = 'stub';
    protected $handler = 'mocked_object_stub_handler';

    public static function generate($class_name, $mock_name = false,
        array $constructor_args = array(), $partial = true)
    {
        return self::instance()->generate_mock($class_name, $mock_name, $constructor_args, $partial);
    }

    static $instance = null;

    private static function instance()
    {
        if (self::$instance === null)
        {
            self::$instance = new self();
        }

        return self::$instance;
    }

}
