<?php
/* $Id: should_be_null.php 66 2007-10-28 19:50:20Z dreamscape $ */
/**
 * @package PackageName
 * @subpackage SubPackageName
 * @name name
 */



class value_should_be_null extends a_context
{

	public function should_pass_when_actual_is_null()
	{
		$this->value(null)->should_be->null;
	}

	public function should_fail_when_actual_is_a_string()
	{
		$this->value('')->should_be->null->should_fail;
	}

	public function should_fail_when_actual_is_a_float()
	{
		$this->value(0.0)->should_be->null->should_fail;
	}

	public function should_fail_when_actual_is_an_array()
	{
		$this->value(array(null))->should_be->null->should_fail;
	}

	public function should_fail_when_actual_is_an_integer()
	{
		$this->value(0)->should_be->null->should_fail;
	}

	public function should_fail_when_actual_is_an_object()
	{
		$this->value(new stdClass)->should_be->null->should_fail;
	}

	public function should_fail_when_actual_is_true()
	{
		$this->value(true)->should_be->null->should_fail;
	}

	public function should_fail_when_actual_is_false()
	{
		$this->value(false)->should_be->null->should_fail;
	}

	public function should_provide_message_on_failure()
	{
		$context = $this->stub('a_context');
		$value = $context->value(true);
		$value->should_be->null;
		$this->value($value->do_comparison())->should_be->exactly(
			'Expected type null; got boolean'
		);
	}

}
