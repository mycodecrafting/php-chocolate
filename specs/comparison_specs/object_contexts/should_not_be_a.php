<?php
/* $Id: should_not_be_a.php 64 2007-10-28 19:29:17Z dreamscape $ */
/**
 * @package PackageName
 * @subpackage SubPackageName
 * @name name
 */



class object_should_not_be_a extends a_context
{

	public function should_pass_unless_actual_is_an_instance_of_expected()
	{
		$this->object(new php_chocolate)->should_not_be->a('stdClass');
	}

	public function should_fail_when_actual_is_an_instance_of_expected()
	{
		$this->object(new stdClass)->should_not_be->a('stdClass')->should_fail;
	}

	public function should_provide_message_on_failure()
	{
		$context = $this->stub('a_context');
		$object = $context->object(new stdClass);
		$object->should_not_be->a('stdClass');
		$this->value($object->do_comparison())->should_be->exactly(
			'Did not expect an instance of "stdClass"'
		);
	}

}
