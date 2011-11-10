<?php
/* $Id: should_equal.php 66 2007-10-28 19:50:20Z dreamscape $ */
/**
 * @package PackageName
 * @subpackage SubPackageName
 * @name name
 */


class value_should_equal extends a_context
{

	public function should_pass_when_actual_is_equal_to_expected()
	{
		$this->value(1)->should_equal(1);
	}

	public function should_pass_when_actual_is_equal_to_expected_with_differing_precisions()
	{
		$this->value(9.9/3)->should_equal(3.3);
	}

	public function should_pass_when_actual_is_equal_to_expected_with_differing_types()
	{
		$this->value('1')->should_equal(1.0);
	}

	public function should_fail_when_actual_is_not_equal_to_expected()
	{
		$this->value(1)->should_equal(2)->should_fail;
	}

	public function should_provide_message_on_failure()
	{
		$context = $this->stub('a_context');
		$value = $context->value(1);
		$value->should_equal(2);
		$this->value($value->do_comparison())->should_be->exactly(
            'Expected <integer:2>; got <integer:1>'
        );
	}

}
