<?php
/* $Id: html.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class spec_reporter_output_html implements spec_reporter_output
{

    public function report_on(spec_reporter $reporter)
    {
        $specs_output = '';
        foreach ($reporter->get_specs() as $specs)
        {
            $specs_output .= $this->report_on_specs($specs);
        }

        ob_start();
        require(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR . 'report.tpl');
        echo ob_get_clean();
    }

    private function report_on_specs(spec_reporter_specs $specs)
    {
        header('Content-Type: text/html; charset=utf-8');

        ob_start();
        require(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR . 'specs_report.tpl');
        return ob_get_clean();
    }

}
