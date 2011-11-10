<?php
/* $Id: a_context_with_n_mocks.php 47 2007-03-19 06:28:49Z dreamscape $ */
/**
 * @package PackageName
 * @subpackage SubPackageName
 * @name name
 */


class a_context_with_n_mocks extends a_context
{

	protected $n = 11;
	public function setup()
	{
		for ($i=0; $i<$this->n; ++$i)
		{
			$this->{'mock' . $i} = $this->mock('mock_class');
		}
	}

	public function should_have_mock_count_of_n()
	{
		$this->value($this->num_mocks())->should_be($this->n);
	}

	public function should_have_mock_count_of_n_after_reset()
	{
		$this->mock('mock_class');
		$this->reset();
		$this->value($this->num_mocks())->should_be($this->n);
	}

}
