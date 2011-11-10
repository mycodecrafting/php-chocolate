<?php
/* $Id: object_handler.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class mocked_object_handler
{


    protected $name;
    protected $methods = array();


    public function __construct($name)
    {
        $this->name = $name;
    }


    public function should_receive($method)
    {
        if (!isset($this->methods[$method]))
        {
            $this->methods[$method] = new mocked_object_method($method);
        }

        return $this->methods[$method];
    }


    public function should_not_receive($method)
    {
        if (!isset($this->methods[$method]))
        {
            $this->methods[$method] = new mocked_object_method($method);
            $this->methods[$method]->exactly(0)->times;
        }

        return $this->methods[$method];
    }


    public function expectations()
    {
        return new mocked_object_expectations($this);
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
            ($method === 'should_receive') ||
            ($method === 'should_not_receive') ||
            ($method === 'expectations')
           )
        {
            return true;
        }

        return false;
    }


    public function is_valid_property($property)
    {
        if (($property === 'should_receive') ||
            ($property === 'should_not_receive')
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

        if ($this->is_receiving !== false)
        {
            $method = call_user_func_array(array($this, $this->is_receiving), array($method));

            $this->is_receiving = false;

            if (count($args))
            {
                return $method->with($args);
            }

            return $method;
        }
    }

    protected $is_receiving = false;

    public function __get($property) {
        switch ($property)
        {
            case 'should_receive':
            case 'should_not_receive':
                $this->is_receiving = $property;
                return $this;
                break;
        }
    }

}
