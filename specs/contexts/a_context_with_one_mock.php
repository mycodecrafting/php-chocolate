<?php
/* $Id: a_context_with_one_mock.php 47 2007-03-19 06:28:49Z dreamscape $ */
/**
 * @package PackageName
 * @subpackage SubPackageName
 * @name name
 */


class a_context_with_one_mock extends a_context
{

	public function setup()
	{
		$this->mock = $this->mock('mock_class');
	}

	public function should_have_mock_count_of_1()
	{
		$this->value($this->num_mocks())->should_be(1);
	}

	public function should_have_mock_count_of_1_after_reset()
	{
		$this->mock('mock_class');
		$this->reset();
		$this->value($this->num_mocks())->should_be(1);
	}

}
