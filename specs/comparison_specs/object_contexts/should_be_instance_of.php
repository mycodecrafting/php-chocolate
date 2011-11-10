<?php
/* $Id: should_be_instance_of.php 49 2007-03-19 06:34:17Z dreamscape $ */
/**
 * @package PackageName
 * @subpackage SubPackageName
 * @name name
 */



class object_should_be_instance_of extends a_context
{

	public function should_pass_when_actual_is_an_instance_of_expected()
	{
		$this->object(new stdClass)->should_be->instance_of('stdClass');
	}

	public function should_fail_when_actual_is_not_an_instance_of_expected()
	{
		$this->object(new php_chocolate)->should_be->instance_of('stdClass')->should_fail;
	}

	public function should_provide_message_on_failure()
	{
		$context = $this->stub('a_context');
		$object = $context->object(new php_chocolate);
		$object->should_be->instance_of('stdClass');
		$this->value($object->do_comparison())->should_be->exactly(
			'Expected an instance of "stdClass"; got one of "php_chocolate"'
		);
	}

}
