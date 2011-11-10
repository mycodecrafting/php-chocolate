<?php
/* $Id: context.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class spec_reporter_context
{

    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function get_name()
    {
        return $this->name;
    }

    protected $specs = array();

    public function add_spec($name)
    {
        $spec = new spec_reporter_context_spec($name);
        $this->specs[] = $spec;
        return $spec;
    }

    public function get_specs()
    {
        return $this->specs;
    }

}
