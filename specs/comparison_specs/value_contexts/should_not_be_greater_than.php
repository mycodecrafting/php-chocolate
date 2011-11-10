<?php
/* $Id: should_not_be_greater_than.php 66 2007-10-28 19:50:20Z dreamscape $ */
/**
 * @package PackageName
 * @subpackage SubPackageName
 * @name name
 */


class value_should_not_be_greater_than extends a_context
{

	public function should_fail_when_actual_is_greater_than_expected()
	{
		$this->value(2.1)->should_not_be->greater_than(2.01)->should_fail;
	}

	public function should_pass_when_actual_is_equal_to_expected()
	{
		$this->value(2.1)->should_not_be->greater_than(2.1);
	}

	public function should_pass_when_actual_is_equal_to_expected_with_differing_precisions()
	{
		$this->value(9.9/3)->should_not_be->greater_than(3.3);
	}

	public function should_pass_when_actual_is_equal_to_expected_with_differing_precisions_switched()
	{
		$this->value(3.3)->should_not_be->greater_than(9.9/3);
	}

	public function should_pass_when_actual_is_less_than_expected()
	{
		$this->value(2.01)->should_not_be->greater_than(2.1);
	}

	public function should_provide_message_on_failure()
	{
		$context = $this->stub('a_context');
		$value = $context->value(2.1);
		$value->should_not_be->greater_than(2.01);
		$this->value($value->do_comparison())->should_be->exactly(
			'Did not expect <2.1> to be greater than <2.01>'
		);
	}

}
