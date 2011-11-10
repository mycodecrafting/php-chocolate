<?php
/* $Id: should_throw.php 66 2007-10-28 19:50:20Z dreamscape $ */
/**
 * @package PackageName
 * @subpackage SubPackageName
 * @name name
 */



class callback_should_throw extends a_context
{

	public function should_pass_when_callback_throws_expected()
	{
		$this->callback('throw_expected')->should_throw('expected_exception');
	}

	public function should_fail_when_callback_throws_unexpected()
	{
		$this->callback('throw_unexpected')->should_throw('expected_exception');
		$this->should_fail();
	}

	public function should_fail_when_callback_does_not_throw_any()
	{
		$this->callback('throw_none')->should_throw('expected_exception');
		$this->should_fail();
	}

	public function should_provide_message_on_failure()
	{
		$context = $this->stub('a_context');
		$callback = $context->callback('throw_unexpected');
		$callback->should_throw('expected_exception');
		$this->value($callback->do_comparison())->should_be->exactly(
			'Expected an exception of "expected_exception" to be thrown; caught one of "Exception"'
		);
	}

}
