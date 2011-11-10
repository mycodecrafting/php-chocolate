<?php
/* $Id: at_most_n.php 62 2007-03-20 12:52:17Z dreamscape $ */
/**
 * @package PackageName
 * @subpackage SubPackageName
 * @name name
 */



class call_count_at_most_n extends a_context
{

	protected $n = 7;

	public function setup()
	{
		$this->do_not_auto_verify_mocks();
		$this->mock = $this->mock('some_class');
		$this->mock->should_receive->a_call()->at_most($this->n)->times;
	}

	public function should_pass_when_method_is_never_called()
	{

		$this->callback(create_function('$context', '
			$context->verify_mocks();
		'), $this)->should_not_throw('mocked_object_expectation_exception');
	}

	public function should_pass_when_method_is_called_less_than_n_times()
	{
		for ($i=0; $i<($this->n - 1); ++$i)
		{
			$this->mock->a_call();
		}

		$this->callback(create_function('$context', '
			$context->verify_mocks();
		'), $this)->should_not_throw('mocked_object_expectation_exception');
	}

	public function should_pass_when_method_is_called_n_times()
	{
		for ($i=0; $i<$this->n; ++$i)
		{
			$this->mock->a_call();
		}

		$this->callback(create_function('$context', '
			$context->verify_mocks();
		'), $this)->should_not_throw('mocked_object_expectation_exception');
	}

	public function should_fail_when_method_is_called_more_than_n_times()
	{
		for ($i=0; $i<($this->n + 1); ++$i)
		{
			$this->mock->a_call();
		}

		$this->callback(create_function('$context', '
			$context->verify_mocks();
		'), $this)->should_throw('mocked_object_expectation_exception');
	}

}
