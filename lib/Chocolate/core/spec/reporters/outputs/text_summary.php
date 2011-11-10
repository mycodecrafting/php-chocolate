<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */



class spec_reporter_output_text_summary implements spec_reporter_output
{

    private $messages = array();
    private $message_num = 0;

    public function running()
    {
        header('Content-Type: text/plain; charset=utf-8');

        $this->out();
        $this->out(php_chocolate_version::get_version_with_date());
        $this->out();
        $this->out('running specs');
        $this->out();
    }

    public function report_on(spec_reporter $reporter)
    {
        $this->out();

        foreach ($reporter->get_specs() as $specs)
        {
            $this->report_on_specs($specs);
        }

        $this->out();
        $this->out(sprintf(
            '%s Total, %s Implemented, %s Failed, %s Skipped, %s Not Implemented',
            number_format($reporter->num_total()),
            number_format($reporter->num_passed()),
            number_format($reporter->num_failed()),
            number_format($reporter->num_skipped()),
            number_format($reporter->num_incomplete())
        ));
        $this->out();
    }

    public function spec_passed()
    {
        $this->spec_out(".");
    }

    public function spec_skipped()
    {
        $this->spec_out("S");
    }

    public function spec_failed()
    {
        $this->spec_out("F");
    }

    public function spec_not_implemented()
    {
        if (!$this->skip_incomplete())
        {
            $this->spec_out("N");
        }
    }

    private $count = 0;

    private function spec_out($what)
    {
        if ($this->count >= 80)
        {
            echo "\n";
            $this->count = 0;
        }
        echo $what;
        ++$this->count;
    }

    private function report_on_specs(spec_reporter_specs $specs)
    {
        foreach ($specs->get_contexts() as $context)
        {
            foreach ($context->get_specs() as $spec)
            {
                if ($spec->has_failed())
                {
                    $this->out();
                    $this->out('  FAILED (' . $specs->get_name() . ')');
                    $this->out('  --------------------------');
                    $this->out('    ' . $context->get_name() . ',');
                    $this->out('    ' . $spec->get_name());
                    $this->out('      - ' . implode('', $spec->get_messages()));
                }
                else
                {
                    if ($spec->is_skipped())
                    {
                        $this->out();
                        $this->out('  SKIPPED (' . $specs->get_name() . ')');
                        $this->out('  --------------------------');
                        $this->out('    ' . $context->get_name() . ',');
                        $this->out('    ' . $spec->get_name());
                        $this->out('      - ' . implode('', $spec->get_messages()));
                    }

                    if ($spec->is_incomplete() && !$this->skip_incomplete())
                    {
                        $this->out();
                        $this->out('  NOT IMPLEMENTED (' . $specs->get_name() . ')');
                        $this->out('  --------------------------');
                        $this->out('    ' . $context->get_name() . ',');
                        $this->out('    ' . $spec->get_name());
                        $this->out('      - ' . implode('', $spec->get_messages()));
                    }
                }
            }
        }

        foreach ($specs->get_specs() as $spec)
        {
            $this->report_on_specs($spec);
        }
    }

    private function skip_incomplete()
    {
        return in_array('--skip-incomplete', $GLOBALS['argv']);
    }

    private function out($message = '')
    {
        echo $message, "\n";
    }

}
