<?php
/* $Id: should_helper.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class should_helper
{

    protected $actual;
    protected $expected;
    protected $negated = false;
    protected $comparison;


    public function __construct($actual)
    {
        $this->actual = $actual;
    }

    /**
     * negate negated
     */
    public function should_fail()
    {
        $this->negated = ($this->negated === false ? true : false);
        return $this;
    }


    /**
     * run the comparision
     */
    public function do_comparison()
    {
        if (($this->comparison instanceof a_comparison) === false)
        {
            return true;
        }

        $result = $this->comparison->compare($this->actual, $this->expected);

        if ($this->negated === true)
        {
            $result = ($result === true ? false : true);
        }

        if ($result === false)
        {
            if ($this->negated === true)
            {
                return $this->comparison->did_not_expect($this->actual, $this->expected);
            }

            return $this->comparison->expected($this->actual, $this->expected);
        }

        return true;
    }


    /**
     * setup this comparision
     */
    protected function compare($comparison, $expected = null)
    {
        if ($expected !== null)
        {
            $this->expected = $expected;
        }

        $comparison = $comparison . '_comparison';
        $this->comparison = new $comparison();

        if (($this->comparison instanceof a_comparison) === false)
        {
            throw new Exception('A comparison must implement a_comparison');
        }

        return $this;
    }


    protected $should_be = false;


    public function __get($property)
    {
        switch ($property)
        {

            /**
             * Add sugar to allow "should_be->*"
             */
            case 'should_be':
                $this->should_be = true;
                return $this;

            /**
             * Add sugar to allow "should_not_be->*"
             * negate the comparision
             */
            case 'should_not_be':
                $this->negated = true;
                $this->should_be = true;
                return $this;
                break;

            /**
             * Add sugar to map "should_fail" to "should_fail()"
             */
            case 'should_fail':
                return $this->should_fail();
                break;
        }

        throw new spec_call_exception(
            'Call to undefined property ' . get_class($this) . "::\$$property"
        );
    }

    /**
     * Add sugar to map "should_be->something()" to "should_be_something()"
     */
    public function __call($method, array $args)
    {
        if ($this->should_be === true)
        {
            $method = "should_be_$method";

            if (method_exists($this, $method))
            {
                return call_user_func_array(array($this, $method), $args);
            }
        }

        throw new spec_call_exception(
            'Call to undefined method ' . get_class($this) . "::$method()"
        );
    }

}
