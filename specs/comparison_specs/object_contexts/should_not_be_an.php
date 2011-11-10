<?php
/* $Id: should_not_be_an.php 64 2007-10-28 19:29:17Z dreamscape $ */
/**
 * @package PackageName
 * @subpackage SubPackageName
 * @name name
 */



class object_should_not_be_an extends a_context
{

	public function setup()
	{
		$this->object = $this->mock('instance_of_class');
	}

	public function should_pass_unless_actual_is_an_instance_of_expected()
	{
		$this->object(new php_chocolate)->should_not_be->an('instance_of_class');
	}

	public function should_fail_when_actual_is_an_instance_of_expected()
	{
		$this->object($this->object)->should_not_be->an('instance_of_class')->should_fail;
	}

	public function should_provide_message_on_failure()
	{
		$context = $this->stub('a_context');
		$object = $context->object(new stdClass);
		$object->should_not_be->an('stdClass');
		$this->value($object->do_comparison())->should_be->exactly(
			'Did not expect an instance of "stdClass"'
		);
	}

}
