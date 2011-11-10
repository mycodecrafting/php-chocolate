<?php
/* $Id: a_comparison.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



interface a_comparison
{
    public function compare($actual, $expected);
    public function expected($actual, $expected);
    public function did_not_expect($actual, $expected);
}
