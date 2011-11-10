<?php
/* $Id: object_method_expectations.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class mocked_object_method_expectations
{

    public function __construct($handler_name, mocked_object_method $method)
    {
        $this->handler_name = $handler_name;
        $this->method = $method;
    }

    public function do_comparison()
    {
        $expected_count = $this->method->expected_count;

        if ($expected_count !== null)
        {
            $expected_count_type = $this->method->expected_count_type;
            $actual_count = $this->method->instance()->get_call_count();

            $result = true;
            switch ($expected_count_type)
            {
                case 'eq':
                    $result = ($expected_count == $actual_count);
                    $type = 'exactly';
                    break;
                case 'lte':
                    $result = ($expected_count <= $actual_count);
                    $type = 'at least';
                    break;
                case 'gte':
                    $result = ($expected_count >= $actual_count);
                    $type = 'at most';
                    break;
            }

            if ($result === false)
            {
                return "Expected {$this->handler_name}::{$this->method->name}() to be called " .
                    "{$type} {$expected_count} time(s); was called {$actual_count} time(s)";
            }
        }

        return true;
    }

}
