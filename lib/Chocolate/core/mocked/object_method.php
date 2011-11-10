<?php
/* $Id: object_method.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class mocked_object_method
{

    protected $name;
    protected $returns = array();
    protected $params = 'default';


    public function __construct($name)
    {
        $this->name = $name;
    }


    protected $instance = null;

    public function instance()
    {
        if ($this->instance === null)
        {
            $this->instance = mocked_object_method_generator::generate($this);
        }

        return $this->instance;
    }

    public function setInstance($instance)
    {
        $this->instance = $instance;
    }


    public function with()
    {
        if (func_num_args() === 0)
        {
            $this->params = 'default';
        }
        else
        {
            $this->params = md5(serialize(func_get_args()));
        }

        return $this;
    }


    public function and_return($value)
    {
        $this->returns[$this->params] = new mocked_object_method_return($value);
        return $this;
    }


    protected $expected_count;
    protected $expected_count_type = 'eq';

    public function exactly($n)
    {
        $this->expected_count = $n;
        $this->expected_count_type = 'eq';
        return $this;
    }


    public function at_most($n)
    {
        $this->expected_count = $n;
        $this->expected_count_type = 'gte';
        return $this;
    }


    public function at_least($n)
    {
        $this->expected_count = $n;
        $this->expected_count_type = 'lte';
        return $this;
    }


    public function params_to_code()
    {
        return 'md5(serialize(func_get_args()))';
    }


    public function get_returns()
    {
        if (sizeof($this->returns) < 1)
        {
            return array('default' => new mocked_object_method_return(null));
        }

        return $this->returns;
    }


    public function __get($property)
    {
        switch ($property)
        {
            case 'name':
            case 'expected_count':
            case 'expected_count_type':
                return $this->$property;
                break;

            case 'at_most':
                $this->expected_count_type = 'gte';
                break;

            case 'at_least':
                $this->expected_count_type = 'lte';
                break;

            case 'times':
                break;

            case 'once':
                $this->expected_count = 1;
                break;

            case 'twice':
                $this->expected_count = 2;
                break;
        }

        return $this;
    }


}


/*

$mockObject->should_receive('update')->with('something')->once;
$mockObject->should_receive('update')->with('something')->twice;
$mockObject->should_receive('update')->with('something')->exactly(n)->times;
$mockObject->should_receive('update')->with('something')->at_least->once;
$mockObject->should_receive('update')->with('something')->at_least->twice;
$mockObject->should_receive('update')->with('something')->at_least(n)->times;
$mockObject->should_receive('update')->with('something')->at_most->once;
$mockObject->should_receive('update')->with('something')->at_most->twice;
$mockObject->should_receive('update')->with('something')->at_most(n)->times;

$mockObject->should_receive->update('something')->once;
$mockObject->should_receive->update('something')->twice;
$mockObject->should_receive->update('something')->exactly(n)->times;
$mockObject->should_receive->update('something')->at_least->once;
$mockObject->should_receive->update('something')->at_least->twice;
$mockObject->should_receive->update('something')->at_least(n)->times;
$mockObject->should_receive->update('something')->at_most->once;
$mockObject->should_receive->update('something')->at_most->twice;
$mockObject->should_receive->update('something')->at_most(n)->times;

$mockObject->should_receive('update')->with('something')->exactly(n)->times->and_return($value);
$mockObject->should_receive('update')->with('something')->exactly(n)->times->and_return($value-1, .. $value-n);


*/
