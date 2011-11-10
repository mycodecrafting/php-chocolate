<?php
/* $Id: should_not_throw_with.php 66 2007-10-28 19:50:20Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */



class callback_should_not_throw_with extends a_context
{

    public function should_fail_when_callback_throws_expected_with_expected_message()
    {
        $this->callback('throw_expected')
            ->should_not_throw('expected_exception')->with('message');
        $this->should_fail();
    }

    public function should_pass_when_callback_throws_expected_with_unexpected_message()
    {
        $this->callback('throw_expected_with_unexpected_message')
          ->should_not_throw('expected_exception')->with('message');
    }

    public function should_pass_when_callback_throws_unexpected_with_expected_message()
    {
        $this->callback('throw_unexpected')
            ->should_not_throw('expected_exception')->with('message');
    }

    public function should_pass_when_callback_does_not_throw_any()
    {
        $this->callback('throw_none')
            ->should_not_throw('expected_exception')->with('message');
    }

    public function should_provide_message_on_failure()
    {
        $context = $this->stub('a_context');
        $callback = $context->callback('throw_expected');
        $callback->should_not_throw('expected_exception')->with('message');
        $this->value($callback->do_comparison())->should_be->exactly(
            'Did not expect the message "message" to be thrown'
        );
    }

}
