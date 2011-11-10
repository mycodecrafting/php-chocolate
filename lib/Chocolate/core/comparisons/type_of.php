<?php
/* $Id: type_of.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class type_of_comparison implements a_comparison
{

    public function compare($actual, $expected)
    {
        switch ($expected)
        {
            case 'string':
                return is_string($actual);
                break;

            case 'array':
                return is_array($actual);
                break;

            case 'integer':
                return is_int($actual);
                break;

            case 'float':
                return is_float($actual);
                break;

            case 'boolean':
                return is_bool($actual);
                break;

            case 'object':
                return is_object($actual);
                break;

            case 'null':
                return is_null($actual);
                break;

            case 'true':
                return ($actual === true);
                break;

            case 'false':
                return ($actual === false);
                break;
        }
    }

    public function expected($actual, $expected)
    {
        $type = strtolower(gettype($actual) === 'double' ? 'float' : gettype($actual));

        switch ($expected)
        {
            case 'string':
            case 'array':
            case 'integer':
            case 'float':
            case 'boolean':
            case 'object':
            case 'null':
                return "Expected type $expected; got $type";
                break;

            case 'true':
                if (gettype($actual) !== 'boolean')
                {
                    return "Expected type boolean $expected; got $type";
                }
                return "Expected type boolean true; got boolean false";
                break;

            case 'false':
                if (gettype($actual) !== 'boolean')
                {
                    return "Expected type boolean $expected; got $type";
                }
                return "Expected type boolean false; got boolean true";
                break;
        }
    }

    public function did_not_expect($actual, $expected)
    {
        switch ($expected)
        {
            case 'string':
            case 'array':
            case 'integer':
            case 'float':
            case 'boolean':
            case 'object':
            case 'null':
                return "Did not expect type $expected";
                break;

            case 'true':
            case 'false':
                return "Did not expect type boolean $expected";
                break;
        }
    }

}
