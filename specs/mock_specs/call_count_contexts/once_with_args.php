<?php
/* $Id: once_with_args.php 63 2007-03-26 00:03:34Z dreamscape $ */
/**
 * @package PackageName
 * @subpackage SubPackageName
 * @name name
 */



class call_count_once_with_args extends a_context
{

	public function setup()
	{
		$this->do_not_auto_verify_mocks();
		$this->mock = $this->mock('some_class');
		$this->mock->should_receive->a_call('1', 2, 3.3)->once;

		$this->not_implemented('argument constraints scheduled for alpha 2');
	}

	public function should_pass_when_method_is_called_with_specified_args()
	{
		$this->mock->a_call('1', 2, 3.3);

		$this->callback(create_function('$context', '
			$context->verify_mocks();
		'), $this)->should_not_throw('mocked_object_expectation_exception');
	}

	public function should_fail_when_method_is_called_with_wrong_args()
	{
		$this->mock->a_call('4', 5, 6.6);

		$this->callback(create_function('$context', '
			$context->verify_mocks();
		'), $this)->should_throw('mocked_object_expectation_exception');
	}

	public function should_fail_when_method_is_called_with_no_args()
	{
		$this->mock->a_call();

		$this->callback(create_function('$context', '
			$context->verify_mocks();
		'), $this)->should_throw('mocked_object_expectation_exception');
	}

}
