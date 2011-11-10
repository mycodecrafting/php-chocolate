<?php
/* $Id: object_stub_handler.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class mocked_object_stub_handler
{

    protected $name;
    protected $methods = array();

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function method($method)
    {
        if (!isset($this->methods[$method]))
        {
            $this->methods[$method] = new mocked_object_stub_method($method);
        }

        return $this->methods[$method];
    }


    public function methods()
    {
        return $this->methods;
    }


    public function name()
    {
        return $this->name;
    }


    public function is_valid($method)
    {
        if (isset($this->methods[$method]) ||
            ($method === 'method')
           )
        {
            return true;
        }

        return false;
    }


    public function __call($method, $args)
    {
        if (isset($this->methods[$method]))
        {
            $method = $this->methods[$method]->instance();
            return call_user_func_array(array($method, 'run'), $args);
        }
    }

}
