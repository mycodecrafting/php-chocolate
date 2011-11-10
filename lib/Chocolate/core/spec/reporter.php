<?php
/* $Id: reporter.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class spec_reporter
{

    protected $specs;

    public function reset()
    {
        $this->specs = new spec_reporter_specs('Chocolate (for PHP)');
        $this->current_specs = $this->specs;
    }

    public function running_specs($name, spec_reporter_specs $current = null)
    {
        if ($current === null)
        {
            $this->current_specs = $this->current_specs->add_specs($name);
        }
        else
        {
            $this->current_specs = $current->add_specs($name);
        }

        return $this->current_specs;
    }

    public function running_context($name)
    {
        $this->current_context = $this->current_specs->add_context($name);
    }

    public function running_specification($name)
    {
        ++$this->num_total;
        $this->current_spec = $this->current_context->add_spec($name);
    }

    public function expectation_failed($name, $message = '')
    {
        if ($this->current_spec->has_failed() === false)
        {
            ++$this->num_failed;
        }

        if ($message === '')
        {
            $message = 'Failed';
        }

        $this->current_spec->mark_as_failed($message);
    }

    public function skipping_specification($name, $message = '')
    {
        ++$this->num_skipped;

        if ($message === '')
        {
            $message = 'Skipped';
        }

        $this->current_spec->mark_as_skipped($message);
    }

    public function no_expectations($name, $message = '')
    {
        ++$this->num_incomplete;

        if ($message === '')
        {
            $message = 'Not Implemented';
        }

        $this->current_spec->mark_as_incomplete($message);
    }

    public function get_specs()
    {
        return $this->specs->get_specs();
    }

    protected $num_total = 0;

    public function num_total()
    {
        return $this->num_total;
    }

    protected $num_failed = 0;

    public function num_failed()
    {
        return $this->num_failed;
    }

    protected $num_skipped = 0;

    public function num_skipped()
    {
        return $this->num_skipped;
    }

    protected $num_incomplete = 0;

    public function num_incomplete()
    {
        return $this->num_incomplete;
    }

    public function num_passed()
    {
        return ($this->num_total - $this->num_failed - $this->num_skipped - $this->num_incomplete);
    }

}
