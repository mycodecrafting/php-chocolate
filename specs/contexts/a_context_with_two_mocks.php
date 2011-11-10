<?php
/* $Id: a_context_with_two_mocks.php 47 2007-03-19 06:28:49Z dreamscape $ */
/**
 * @package PackageName
 * @subpackage SubPackageName
 * @name name
 */


class a_context_with_two_mocks extends a_context
{

	public function setup()
	{
		$this->mock1 = $this->mock('mock_class');
		$this->mock2 = $this->mock('mock_class');
	}

	public function should_have_mock_count_of_2()
	{
		$this->value($this->num_mocks())->should_be(2);
	}

	public function should_have_mock_count_of_2_after_reset()
	{
		$this->mock('mock_class');
		$this->reset();
		$this->value($this->num_mocks())->should_be(2);
	}

}
