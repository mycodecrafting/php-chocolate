<?php
/* $Id: output.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



interface spec_reporter_output
{

    public function running();
    public function report_on(spec_reporter $reporter);
    public function spec_passed();
    public function spec_skipped();
    public function spec_failed();
    public function spec_not_implemented();

}
