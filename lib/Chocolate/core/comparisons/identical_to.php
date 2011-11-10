<?php
/* $Id: identical_to.php 64 2007-10-28 19:29:17Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class identical_to_comparison implements a_comparison
{

    public function compare($actual, $expected)
    {
        return ($actual === $expected);
    }

    public function expected($actual, $expected)
    {
        return "Expected <" . var_export($expected, true) . ">; got <" .
            var_export($actual, true) . ">";
    }

    public function did_not_expect($actual, $expected)
    {
        return "Did not expect <" . gettype($expected) . ":{$expected}>";
    }

}
