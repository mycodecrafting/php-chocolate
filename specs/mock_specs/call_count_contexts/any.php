<?php
/* $Id: any.php 62 2007-03-20 12:52:17Z dreamscape $ */
/**
 * @package PackageName
 * @subpackage SubPackageName
 * @name name
 */



class call_count_any extends a_context
{

	public function setup()
	{
		$this->do_not_auto_verify_mocks();
		$this->mock = $this->mock('some_class');
		$this->mock->should_receive->a_call();
	}

	public function should_pass_when_method_is_never_called()
	{
		$this->callback(create_function('$context', '
			$context->verify_mocks();
		'), $this)->should_not_throw('mocked_object_expectation_exception');
	}

	public function should_pass_when_method_is_called_once()
	{
		$this->mock->a_call();

		$this->callback(create_function('$context', '
			$context->verify_mocks();
		'), $this)->should_not_throw('mocked_object_expectation_exception');
	}

	public function should_pass_when_method_is_called_many_times()
	{
		for ($i=0; $i<12; ++$i)
		{
			$this->mock->a_call();
		}

		$this->callback(create_function('$context', '
			$context->verify_mocks();
		'), $this)->should_not_throw('mocked_object_expectation_exception');
	}

}
