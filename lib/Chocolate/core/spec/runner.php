<?php
/* $Id: runner.php 64 2007-10-28 19:29:17Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class spec_runner {

    protected $specs;
    protected $reporter;
    protected $reporters;

    static $level = -1;

    public function __construct(the_specs $specs, $reporters, spec_reporter $reporter = null)
    {
        $this->specs = $specs;
        $this->specs->define_specs();
        $this->setup_reporters($reporters, $reporter);
    }


    protected function setup_reporters($reporters, $reporter)
    {
        if ($reporters instanceof spec_reporters)
        {
            $this->reporters = $reporters;
        }
        else
        {
            if (!is_array($reporters))
            {
                $reporters = array($reporters);
            }
            $this->reporters = new spec_reporters($reporters);  
        }

        if ($reporter === null)
        {
            $this->reporter = new spec_reporter();
        }
        else
        {
            $this->reporter = $reporter;
        }
    }


    public function run()
    {
        $this->reporters->running();
        $this->reporter->reset();
        $this->run_specs();
        $this->reporters->report_on($this->reporter);
    }


    protected function run_specs($cur_specs = null)
    {
        $cur_specs = $this->reporter->running_specs($this->get_class_name($this->specs), $cur_specs);

        // run each context
        foreach ($this->specs->contexts() as $context)
        {
            $this->run_context($context);
        }


        // run any sub-specs
        foreach ($this->specs->specs() as $spec)
        {
            $runner = new spec_runner($spec, $this->reporters, $this->reporter);
            $runner->run_specs($cur_specs);
        }
    }


    protected function run_context(a_context $context)
    {
        $this->reporter->running_context($this->get_class_name($context));

        // run each context's should_* methods
        $methods = get_class_methods($context);

        foreach ($methods as $method)
        {
            if ($method === 'should_fail')
            {
                continue;
            }

            if (!preg_match('/^should_([A-z0-9_]+)/', $method))
            {
                continue;
            }

            $this->reporter->running_specification($this->get_name($method));

            // run expectations
            try
            {
                // (re)setup this context
                $context->reset();

                $context->run($method);

                $this->reporters->spec_passed();
            }

            // manually marked as passed
            catch (spec_passed_exception $e)
            {
                $this->reporters->spec_passed();
                continue;
            }

            // skipped
            catch (spec_skipped_exception $e)
            {
                $this->reporter->skipping_specification($this->get_name($method), $e->getMessage());
                $this->reporters->spec_skipped();
                continue;
            }

            // manually marked as failed
            catch (spec_failed_exception $e)
            {
                $this->reporter->expectation_failed($this->get_name($method), $e->getMessage());
                $this->reporters->spec_failed();
                continue;
            }

            // manually marked as not implemented
            catch (spec_not_implemented_exception $e)
            {
                $this->reporter->no_expectations($this->get_name($method), $e->getMessage());
                $this->reporters->spec_not_implemented();
                continue;
            }

            // some other exception
            catch (Exception $e)
            {
                $this->reporter->expectation_failed($this->get_name($method), $e->getMessage());
                $this->reporters->spec_failed();
                continue;
            }


            // check mock expectations
            try
            {
                if ($context->can_auto_verify_mocks())
                {
                    $context->verify_mocks();
                }
            }
            catch (mocked_object_expectation_exception $e)
            {
                $this->reporter->expectation_failed($this->get_name($method), $e->getMessage());
                $this->reporters->spec_failed();
                continue;
            }


            // check general expectations
            try
            {
                $context->verify_expectations();
            }
            catch (spec_expectation_exception $e)
            {
                $this->reporter->expectation_failed($this->get_name($method), $e->getMessage());
                $this->reporters->spec_failed();
                continue;
            }


            if (!sizeof($context->expectations()) && !sizeof($context->mocks()))
            {
                $this->reporter->no_expectations($this->get_name($method));
                $this->reporters->spec_not_implemented();
            }
        }
    }


    protected function get_class_name($object)
    {
        return $this->get_name(get_class($object));
    }


    protected function get_name($name)
    {
        return str_replace('_', ' ', $name);
    }

}
