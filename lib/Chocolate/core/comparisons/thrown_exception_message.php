<?php
/* $Id: thrown_exception_message.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class thrown_exception_message_comparison extends identical_to_comparison
{

    public function expected($actual, $expected)
    {
        return "Expected the message \"$expected\" to be thrown; caught \"$actual\"";
    }

    public function did_not_expect($actual, $expected)
    {
        return "Did not expect the message \"$expected\" to be thrown";
    }

}
