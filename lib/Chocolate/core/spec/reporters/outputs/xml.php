<?php
/* $Id: xml.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class spec_reporter_output_xml implements spec_reporter_output
{

    private $dom;

    public function __construct()
    {
        $this->dom = new DOMDocument('1.0', 'utf-8');
    }

    public function report_on(spec_reporter $reporter)
    {
        header('Content-Type: text/xml; charset=utf-8');

        $root = $this->dom->createElement('chocolate');
        $root->setAttribute('version', php_chocolate_version::get_version_with_date());
        $root->setAttribute('num_total', $reporter->num_total());
        $root->setAttribute('num_passed', $reporter->num_passed());
        $root->setAttribute('num_failed', $reporter->num_failed());
        $root->setAttribute('num_skipped', $reporter->num_skipped());
        $root->setAttribute('num_not_implemented', $reporter->num_incomplete());

        foreach ($reporter->get_specs() as $specs)
        {
            $this->report_on_specs($specs, $root);
        }

        $this->dom->appendChild($root);
        $this->dom->formatOutput = true;
        echo $this->dom->saveXML();
    }

    private function report_on_specs(spec_reporter_specs $specs, DOMNode $root)
    {
        $element = $this->dom->createElement('specs');
        $element->setAttribute('name', $specs->get_name());
        $root->appendChild($element);

        foreach ($specs->get_contexts() as $context)
        {
            $this->report_on_context($context, $element);
        }

        foreach ($specs->get_specs() as $spec)
        {
            $this->report_on_specs($spec, $element);
        }
    }

    private function report_on_context(spec_reporter_context $context, DOMNode $root)
    {
        $element = $this->dom->createElement('context');
        $element->setAttribute('name', $context->get_name());
        $root->appendChild($element);

        foreach ($context->get_specs() as $spec)
        {
            $this->report_on_context_spec($spec, $element);
        }
    }

    private function report_on_context_spec(spec_reporter_context_spec $spec, DOMNode $root)
    {
        $element = $this->dom->createElement('spec');
        $element->setAttribute('name', $spec->get_name());

        if ($spec->has_failed())
        {
            $element->setAttribute('failed', 'yes');
            $element->setAttribute('message', implode(' | ', $spec->get_messages()));
        }
        else
        {
            if ($spec->is_skipped())
            {
                $element->setAttribute('skipped', 'yes');
                $element->setAttribute('message', implode(' | ', $spec->get_messages()));
            }

            if ($spec->is_incomplete())
            {
                $element->setAttribute('not_implemented', 'yes');
                $element->setAttribute('message', implode(' | ', $spec->get_messages()));
            }
        }

        $root->appendChild($element);
    }

}
