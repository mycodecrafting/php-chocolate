<?php
/* $Id: text.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class spec_reporter_output_text implements spec_reporter_output
{

    private $messages = array();
    private $message_num = 0;

    public function report_on(spec_reporter $reporter)
    {
        header('Content-Type: text/plain; charset=utf-8');

        $this->out();
        $this->out(php_chocolate_version::get_version_with_date());
        $this->out('  Text Report');
        $this->out();

        foreach ($reporter->get_specs() as $specs)
        {
            $this->report_on_specs($specs, '');
        }

        $this->out();
        $this->out();
        $this->out();
        $this->out('  *** Messages');
        $this->out(str_repeat('-', 48));

        foreach ($this->messages as $num => $message)
        {
            $this->out("  $num) $message");
            $this->out();
        }

        $this->out();
        $this->out();
        $this->out('  Specifications Summary');
        $this->out('--------------------------');
        $this->out('            Total: ' . $reporter->num_total());
        $this->out('      Implemented: ' . $reporter->num_passed());
        $this->out('           Failed: ' . $reporter->num_failed());
        $this->out('          Skipped: ' . $reporter->num_skipped());
        $this->out('  Not Implemented: ' . $reporter->num_incomplete());
        $this->out();
        $this->out();
    }

    private function report_on_specs(spec_reporter_specs $specs, $indent)
    {
        $this->out();
        $this->out($indent . $specs->get_name() . ' (Specifications)');
        $this->out($indent . str_repeat('=', 48));

        foreach ($specs->get_contexts() as $context)
        {
            $this->report_on_context($context, $indent . '  ');
        }

        foreach ($specs->get_specs() as $spec)
        {
            $this->report_on_specs($spec, $indent . '  ');
        }
    }

    private function report_on_context(spec_reporter_context $context, $indent)
    {
        $this->out();
        $this->out($indent . $context->get_name() . ' (Context)');
        $this->out($indent . str_repeat('-', 48));

        foreach ($context->get_specs() as $spec)
        {
            $this->report_on_context_spec($spec, $indent . '  ');
        }
    }


    private function report_on_context_spec(spec_reporter_context_spec $spec, $indent)
    {
        $this->out($indent . '- ' . $spec->get_name());

        if ($spec->has_failed())
        {
            ++$this->message_num;
            $this->out($indent . '  [!!! FAILED] ***' . $this->message_num);
            $this->messages[$this->message_num] = implode('', $spec->get_messages());
        }
        else
        {
            if ($spec->is_skipped())
            {
                ++$this->message_num;
                $this->out($indent . '  [! SKIPPED] ***' . $this->message_num);
                $this->messages[$this->message_num] = implode('', $spec->get_messages());
            }

            if ($spec->is_incomplete())
            {
                ++$this->message_num;
                $this->out($indent . '  [!! NOT IMPLEMENTED] ***' . $this->message_num);
                $this->messages[$this->message_num] = implode('', $spec->get_messages());
            }
        }
    }


    private function out($message = '')
    {
        echo $message, "\n";
    }

}
