<?php
/* $Id: a_context.php 64 2007-10-28 19:29:17Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



abstract class a_context
{

    protected $actual;
    protected $expectations = array();
    protected $mocks = array();


    public function setup()
    {
    }

    protected function pass()
    {
        throw new spec_passed_exception();      
    }

    protected function skip($message = null)
    {
        throw new spec_skipped_exception($message);
    }

    protected function fail($message = null)
    {
        throw new spec_failed_exception($message);
    }

    protected function not_implemented($message = null)
    {
        throw new spec_not_implemented_exception($message);
    }

    protected function value($actual)
    {
        $helper = new should_value_helper($actual);
        $this->expectations[] = $helper;
        return $helper;
    }

    protected function string($string)
    {
        $helper = new should_string_helper($string);
        $this->expectations[] = $helper;
        return $helper;
    }

    protected function object($object)
    {
        $helper = new should_object_helper($object);
        $this->expectations[] = $helper;
        return $helper;
    }

    protected function callback($callback) {
        $args = array();

        if (func_num_args() > 1)
        {
            $args = func_get_args();
            array_shift($args);
        }

        $helper = new should_callback_helper($callback, $args);
        $this->expectations[] = $helper;
        return $helper;
    }

    protected function mock($class_name, $mock_name = false, array $constructor_args = array(), $partial = true)
    {
        $mock = mocked_object_generator::generate($class_name, $mock_name, $constructor_args, $partial);
        $this->mocks[] = $mock;
        return $mock;
    }


    protected $auto_verify_mocks = true;

    protected function do_not_auto_verify_mocks()
    {
        $this->auto_verify_mocks = false;
    }

    public function can_auto_verify_mocks() {
        return $this->auto_verify_mocks;
    }

    public function verify_mocks()
    {
        foreach ($this->mocks as $mock)
        {
            foreach ($mock->expectations() as $expectation)
            {
                $result = $expectation->do_comparison();

                if ($result !== true)
                {
                    throw new mocked_object_expectation_exception($result);
                }
            }
        }
    }

    public function mocks()
    {
        return $this->mocks;
    }

    public function num_mocks()
    {
        return count($this->mocks);
    }

    protected function stub($class_name, $mock_name = false, array $constructor_args = array(), $partial = true)
    {
        return mocked_object_stub_generator::generate($class_name, $mock_name, $constructor_args, $partial);
    }

    public function reset()
    {
        $this->should_fail = false;
        $this->expectations = array();
        $this->mocks = array();
        $this->setup();
    }

    public function run($method)
    {
        $this->$method();
    }

    protected $should_fail = false;

    public function should_fail()
    {
        $this->should_fail = true;
    }

    public function verify_expectations()
    {
        foreach ($this->expectations as $expectation)
        {
            $result = $expectation->do_comparison();

            if ($result !== true)
            {
                if ($this->should_fail === false)
                {
                    throw new spec_expectation_exception($result);
                }
            }
        }
    }

    public function expectations()
    {
        return $this->expectations;
    }

    public function __call($method, array $args)
    {
        throw new spec_call_exception(
            "Call to undefined method a_context::$method()"
        );
    }

}
