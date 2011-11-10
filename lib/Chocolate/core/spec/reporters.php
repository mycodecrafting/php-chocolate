<?php
/* $Id: reporters.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class spec_reporters
{

    protected $reporters;

    public function __construct(array $reporters)
    {
        foreach ($reporters as $reporter)
        {
            if (($reporter instanceof spec_reporter_output) === false)
            {
                throw new Exception('reporter should be a spec_reporter_output');
            }

            $this->reporters[] = $reporter;
        }
    }

    public function __call($method, $args)
    {
        foreach ($this->reporters as $reporter)
        {
            call_user_func_array(array($reporter, $method), $args);
        }
    }

}
