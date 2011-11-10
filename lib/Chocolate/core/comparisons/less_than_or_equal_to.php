<?php
/* $Id: less_than_or_equal_to.php 64 2007-10-28 19:29:17Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class less_than_or_equal_to_comparison implements a_comparison
{

    public function compare($actual, $expected)
    {
        if (is_float($actual) && is_float($expected))
        {
            if (abs($actual - $expected) <= 9E-14)
            {
                return true;
            }
        }

        return ($actual <= $expected);
    }

    public function expected($actual, $expected)
    {
        return "Expected <{$actual}> to be less than or equal to <{$expected}>";
    }

    public function did_not_expect($actual, $expected)
    {
        return "Did not expect <{$actual}> to be less than or equal to <{$expected}>";
    }

}
