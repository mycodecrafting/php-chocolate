<?php
/* $Id: context_spec.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class spec_reporter_context_spec
{

    protected $name;
    protected $messages = array();
    protected $skipped = false;
    protected $failed = false;
    protected $incomplete = false;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function get_name()
    {
        return $this->name;
    }

    public function get_messages()
    {
        return $this->messages;
    }

    public function mark_as_skipped($message)
    {
        $this->skipped = true;
        $this->messages[] = $message;
    }

    public function is_skipped()
    {
        return $this->skipped;
    }

    public function mark_as_failed($message)
    {
        $this->failed = true;
        $this->messages[] = $message;
    }

    public function has_failed()
    {
        return $this->failed;
    }

    public function mark_as_incomplete($message)
    {
        $this->incomplete = true;
        $this->messages[] = $message;
    }

    public function is_incomplete()
    {
        return $this->incomplete;
    }

}
