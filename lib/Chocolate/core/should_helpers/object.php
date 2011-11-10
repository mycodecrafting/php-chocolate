<?php
/* $Id: object.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class should_object_helper extends should_helper
{

    /**
     * instance of comparision
     * [ $this->object($actual)->should_be->instance_of($interface) ]
     */
    public function should_be_instance_of($expected = null)
    {
        return $this->compare('instance_of', $expected);
    }


    /**
     * alias self::instance_of()
     * [ $this->object($actual)->should_be->an_instance_of($interface) ]
     */
    public function should_be_an_instance_of($expected = null)
    {
        return $this->instance_of($expected);
    }

    /**
     * alias self::instance_of()
     * [ $this->object($actual)->should_be->a($class) ]
     */
    public function should_be_a($expected = null)
    {
        return $this->instance_of($expected);
    }

    /**
     * alias self::instance_of()
     * [ $this->object($actual)->should_be->an($interface) ]
     */
    public function should_be_an($expected = null) {
        return $this->instance_of($expected);
    }

}
