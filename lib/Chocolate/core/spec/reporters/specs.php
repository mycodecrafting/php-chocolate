<?php
/* $Id: specs.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class spec_reporter_specs
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

    protected $contexts = array();

    public function add_context($name)
    {
        $context = new spec_reporter_context($name);
        $this->contexts[] = $context;
        return $context;
    }

    public function get_contexts()
    {
        return $this->contexts;
    }

    protected $specs = array();

    public function add_specs($name)
    {
        $specs = new spec_reporter_specs($name);

        $this->specs[] = $specs;

        return $specs;
    }

    public function get_specs()
    {
        return $this->specs;
    }

}
