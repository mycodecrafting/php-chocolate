<?php
/* $Id: should_not_equal.php 66 2007-10-28 19:50:20Z dreamscape $ */
/**
 * @package PackageName
 * @subpackage SubPackageName
 * @name name
 */


class value_should_not_equal extends a_context
{

	public function should_pass_unless_actual_equal_expected()
	{
		$this->value(1)->should_not_equal(2);
	}

	public function should_fail_when_actual_equal_expected()
	{
		$this->value(1)->should_not_equal(1)->should_fail;
	}

	public function should_fail_when_types_are_different_but_values_are_same()
	{
		$this->value('1')->should_not_equal(1.0)->should_fail;
	}

	public function should_provide_message_on_failure()
	{
		$context = $this->stub('a_context');
		$value = $context->value(1);
		$value->should_not_equal(1);
		$this->value($value->do_comparison())->should_be->exactly(
            'Did not expect <integer:1>'
        );
	}

}
