<?php
/* $Id: an_object.php 62 2007-03-20 12:52:17Z dreamscape $ */
/**
 * @package PackageName
 * @subpackage SubPackageName
 * @name name
 */



class an_object_argument_constraint extends a_context
{

	public function setup()
	{
		$this->do_not_auto_verify_mocks();
		$this->mock = $this->mock('some_class');
		$this->mock->should_receive('a_call')->with(an_object);

		$this->not_implemented('argument constraints scheduled for alpha 2');
	}

	public function should_fail_when_a_string_is_passed()
	{
		$this->mock->a_call('string');

		$this->callback(create_function('$context', '
			$context->verify_mocks();
		'), $this)->should_throw('mocked_object_expectation_exception');
	}

	public function should_fail_when_a_float_is_passed()
	{
		$this->mock->a_call(1.5);

		$this->callback(create_function('$context', '
			$context->verify_mocks();
		'), $this)->should_throw('mocked_object_expectation_exception');
	}

	public function should_fail_when_an_array_is_passed()
	{
		$this->mock->a_call(array(new stdClass));

		$this->callback(create_function('$context', '
			$context->verify_mocks();
		'), $this)->should_throw('mocked_object_expectation_exception');
	}

	public function should_fail_when_an_integer_is_passed()
	{
		$this->mock->a_call(2);

		$this->callback(create_function('$context', '
			$context->verify_mocks();
		'), $this)->should_throw('mocked_object_expectation_exception');
	}

	public function should_pass_when_an_object_is_passed()
	{
		$this->mock->a_call(new stdClass);

		$this->callback(create_function('$context', '
			$context->verify_mocks();
		'), $this)->should_not_throw('mocked_object_expectation_exception');
	}

	public function should_fail_when_true_is_passed()
	{
		$this->mock->a_call(true);

		$this->callback(create_function('$context', '
			$context->verify_mocks();
		'), $this)->should_throw('mocked_object_expectation_exception');
	}

	public function should_fail_when_false_is_passed()
	{
		$this->mock->a_call(false);

		$this->callback(create_function('$context', '
			$context->verify_mocks();
		'), $this)->should_throw('mocked_object_expectation_exception');
	}

	public function should_fail_when_null_is_passed()
	{
		$this->mock->a_call(null);

		$this->callback(create_function('$context', '
			$context->verify_mocks();
		'), $this)->should_throw('mocked_object_expectation_exception');
	}

	public function should_fail_when_nothing_is_passed()
	{
		$this->mock->a_call();

		$this->callback(create_function('$context', '
			$context->verify_mocks();
		'), $this)->should_throw('mocked_object_expectation_exception');
	}

}
