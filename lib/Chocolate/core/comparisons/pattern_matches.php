<?php
/* $Id: pattern_matches.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class pattern_matches_comparison implements a_comparison
{

    public function compare($actual, $expected)
    {
        return (preg_match($expected, $actual) > 0);
    }

    public function expected($actual, $expected)
    {
        return "Expected <string:$actual> to match <expression:$expected>";
    }

    public function did_not_expect($actual, $expected)
    {
        return "Did not expect <string:$actual> to match <expression:$expected>";
    }

}
