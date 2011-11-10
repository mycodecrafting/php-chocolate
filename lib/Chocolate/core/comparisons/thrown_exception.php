<?php
/* $Id: thrown_exception.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class thrown_exception_comparison implements a_comparison
{

    public function compare($actual, $expected)
    {
        return ($actual instanceof $expected);
    }

    public function expected($actual, $expected)
    {
        if ($actual === null)
        {
            return "Expected an exception of \"$expected\" to be thrown; caught none";
        }

        return "Expected an exception of \"$expected\" to be thrown; caught one of \"" .
            get_class($actual) . '"';
    }

    public function did_not_expect($actual, $expected)
    {
        return "Did not expect an exception of \"$expected\" to be thrown";
    }

}
