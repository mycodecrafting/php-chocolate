<?php
/* $Id: equal_to.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class equal_to_comparison implements a_comparison
{

    public function compare($actual, $expected)
    {
        // cannot directly compare float values
        if (is_float($actual) && is_float($expected))
        {
            return (abs($actual - $expected) <= 9E-14);
        }

        return ($actual == $expected);
    }

    public function expected($actual, $expected)
    {
        return "Expected <" . gettype($expected) . ":{$expected}>; got <" .
            gettype($actual) . ":{$actual}>";
    }

    public function did_not_expect($actual, $expected)
    {
        return "Did not expect <" . gettype($expected) . ":{$expected}>";
    }

}
