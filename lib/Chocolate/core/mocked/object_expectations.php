<?php
/* $Id: object_expectations.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class mocked_object_expectations implements IteratorAggregate
{

    protected $handler;

    public function __construct(mocked_object_handler $handler)
    {
        $this->handler = $handler;
    }

    public function getIterator()
    {
        $method_expectations = array();

        foreach ($this->handler->methods() as $method)
        {
            $method_expectations[] = new mocked_object_method_expectations(
                $this->handler->name(), $method
            );
        }

        return new ArrayIterator($method_expectations);
    }

}
