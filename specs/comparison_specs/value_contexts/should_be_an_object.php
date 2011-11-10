<?php
/* $Id: should_be_an_object.php 66 2007-10-28 19:50:20Z dreamscape $ */
/**
 * @package PackageName
 * @subpackage SubPackageName
 * @name name
 */



class value_should_be_an_object extends a_context
{

	public function should_pass_when_actual_is_an_object()
	{
		$this->value(new stdClass)->should_be->an_object;
	}

	public function should_fail_when_actual_is_a_string()
	{
		$this->value('stdClass')->should_be->an_object->should_fail;
	}

	public function should_fail_when_actual_is_a_float()
	{
		$this->value(1.5)->should_be->an_object->should_fail;
	}

	public function should_fail_when_actual_is_an_array()
	{
		$this->value(array(new stdClass))->should_be->an_object->should_fail;
	}

	public function should_fail_when_actual_is_an_integer()
	{
		$this->value(1)->should_be->an_object->should_fail;
	}

	public function should_fail_when_actual_is_null()
	{
		$this->value(null)->should_be->an_object->should_fail;
	}

	public function should_fail_when_actual_is_true()
	{
		$this->value(true)->should_be->an_object->should_fail;
	}

	public function should_fail_when_actual_is_false()
	{
		$this->value(false)->should_be->an_object->should_fail;
	}

	public function should_provide_message_on_failure()
	{
		$context = $this->stub('a_context');
		$value = $context->value(1.5);
		$value->should_be->an_object;
		$this->value($value->do_comparison())->should_be->exactly(
			'Expected type object; got float'
		);
	}

}
