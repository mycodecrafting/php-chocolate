<?php
/* $Id: value.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class should_value_helper extends should_helper
{

    /**
     * equal to comparision
     * [ $this->value($actual)->should_be($expected) ]
     */
    public function should_be($expected = null)
    {
        return $this->compare('equal_to', $expected);
    }

    /**
     * alias self::should_be()
     * [ $this->value($actual)->should_equal($expected) ]
     */
    public function should_equal($expected = null)
    {
        return $this->should_be($expected);
    }

    /**
     * negate equal to comparision
     * [ $this->value($actual)->should_not_be($expected) ]
     */
    public function should_not_be($expected = null)
    {
        $this->negated = true;
        return $this->should_be($expected);
    }

    /**
     * alias self::should_not_be()
     * [ $this->value($actual)->should_not_equal($expected) ]
     */
    public function should_not_equal($expected = null)
    {
        return $this->should_not_be($expected);
    }

    /**
     * identical to comparison
     * [ $this->value($actual)->should_be->identical_to($expected) ]
     */
    public function should_be_identical_to($expected = null)
    {
        return $this->compare('identical_to', $expected);
    }

    /**
     * alias self::should_be_identical_to()
     * [ $this->value($actual)->should_be->exactly($expected) ]
     */
    public function should_be_exactly($expected = null)
    {
        return $this->should_be_identical_to($expected);
    }

    /**
     * type of comparision
     * [ $this->value($actual)->should_be->a_string ]
     * [ $this->value($actual)->should_be->a_float ]
     * [ $this->value($actual)->should_be->an_array ]
     * [ $this->value($actual)->should_be->an_integer ]
     * [ $this->value($actual)->should_be->an_object ]
     * [ $this->value($actual)->should_be->null ]
     * [ $this->value($actual)->should_be->boolean ]
     * [ $this->value($actual)->should_be->true ]
     * [ $this->value($actual)->should_be->false ]
     */
    public function should_be_type_of($expected = null)
    {
        switch ($expected)
        {
            case 'string':
            case 'float':
            case 'array':
            case 'integer':
            case 'object':
            case 'boolean':
            case 'true':
            case 'false':
            case 'null':
                return $this->compare('type_of', $expected);
                break;
        }
    }

    /**
     * greater than comparison
     * [ $this->value($actual)->should_be->greater_than($expected) ]
     */
    public function should_be_greater_than($expected = null)
    {
        return $this->compare('greater_than', $expected);
    }

    /**
     * less than comparison
     * [ $this->value($actual)->should_be->less_than($expected) ]
     */
    public function should_be_less_than($expected = null)
    {
        return $this->compare('less_than', $expected);
    }

    /**
     * greater than or equal to comparison
     * [ $this->value($actual)->should_be->greater_than->or_equal_to($expected) ]
     */
    public function should_be_greater_than_or_equal_to($expected = null)
    {
        return $this->compare('greater_than_or_equal_to', $expected);
    }

    /**
     * less than or equal to comparison
     * [ $this->value($actual)->should_be->less_than->or_equal_to($expected) ]
     */
    public function should_be_less_than_or_equal_to($expected = null)
    {
        return $this->compare('less_than_or_equal_to', $expected);
    }

    public function __get($property)
    {
        switch ($property)
        {
            /**
             * Add sugar to map "should_be->a_type" to "should_be_type_of(type)"
             */
            case 'a_string':
            case 'a_float':
                return $this->should_be_type_of(substr($property, 2));
                break;

            /**
             * Add sugar to map "should_be->an_type" to "should_be_type_of(type)"
             */
            case 'an_array':
            case 'an_integer':
            case 'an_object':
                return $this->should_be_type_of(substr($property, 3));
                break;

            /**
             * Add sugar to map "should_be->type" to "should_be_type_of(type)"
             */
            case 'boolean':
            case 'true':
            case 'false':
            case 'null':
                return $this->should_be_type_of($property);
                break;

            /**
             * Add sugar to map "should_be->greater_than->or_equal_to" to "should_be_greater_than_or_equal_to"
             */
            case 'greater_than':
                $this->should_be = 'greater_than';
                return $this;
                break;

            /**
             * Add sugar to map "should_be->less_than->or_equal_to" to "should_be_less_than_or_equal_to"
             */
            case 'less_than':
                $this->should_be = 'less_than';
                return $this;
                break;
        }

        return parent::__get($property);
    }

    public function __call($method, array $args)
    {
        if ($method === 'or_equal_to')
        {
            if ($this->should_be === 'greater_than')
            {
                return call_user_func_array(array($this, 'should_be_greater_than_or_equal_to'), $args);
            }

            if ($this->should_be === 'less_than')
            {
                return call_user_func_array(array($this, 'should_be_less_than_or_equal_to'), $args);
            }
        }

        return parent::__call($method, $args);
    }

}
