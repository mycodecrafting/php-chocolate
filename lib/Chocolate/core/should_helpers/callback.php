<?php
/* $Id: callback.php 64 2007-10-28 19:29:17Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class should_callback_helper extends should_helper
{

    protected $callback;
    protected $callback_args;

    public function __construct($callback, array $callback_args = array())
    {
        $this->callback = $callback;
        $this->callback_args = $callback_args;
    }

    /**
     * thrown exception comparison
     * [ $this->callback($callback [, $args...])->should_throw($exception) ]
     */
    public function should_throw($expected)
    {
        return $this->compare('thrown_exception', $expected);
    }

    /**
     * negate the comparision
     * [ $this->callback($callback [, $args...])->should_not_throw($exception) ]
     */
    public function should_not_throw($expected)
    {
        $this->negated = true;
        return $this->should_throw($expected);
    }


    protected $message = null;

    /**
     * thrown message exception comparison
     * [ $this->callback($callback [, $args...])->should_throw($exception)->with($message) ]
     */
    public function with($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * run the comparision
     */
    public function do_comparison()
    {
        if ($this->comparison instanceof thrown_exception_comparison)
        {
            return $this->do_exception_comparision();
        }

        $this->actual = call_user_func_array($this->callback, $this->callback_args);

        return parent::do_comparison();
    }


    protected function do_exception_comparision() {
        try
        {
            call_user_func_array($this->callback, $this->callback_args);
        }
        catch (Exception $e)
        {
            $this->actual = $e;

            $result = parent::do_comparison();

            // compare messages
            if ($this->message !== null)
            {
                if (($this->negated === true) && ($result === true))
                {
                    $this->negated = false;
                }

                $this->comparison = new thrown_exception_message_comparison();
                $this->actual = $e->getMessage();
                $this->expected = $this->message;

                $result = parent::do_comparison();
            }

            return $result;
        }

        $this->actual = null;
        return parent::do_comparison();
    }

}
