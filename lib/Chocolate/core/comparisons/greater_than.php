<?php
/* $Id: greater_than.php 64 2007-10-28 19:29:17Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class greater_than_comparison implements a_comparison
{

    public function compare($actual, $expected)
    {
        if (is_float($actual) && is_float($expected))
        {
            if (abs($actual - $expected) <= 9E-14)
            {
                return false;
            }
        }

        return ($actual > $expected);
    }

    public function expected($actual, $expected)
    {
        return "Expected <{$actual}> to be greater than <{$expected}>";
    }

    public function did_not_expect($actual, $expected)
    {
        return "Did not expect <{$actual}> to be greater than <{$expected}>";
    }

}
