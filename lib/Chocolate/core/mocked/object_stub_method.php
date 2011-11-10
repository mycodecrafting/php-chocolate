<?php
/* $Id: object_stub_method.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class mocked_object_stub_method extends mocked_object_method
{

    public function returns($value)
    {
        return $this->and_return($value);
    }

}
