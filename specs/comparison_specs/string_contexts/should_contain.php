<?php
/* $Id: should_contain.php 49 2007-03-19 06:34:17Z dreamscape $ */
/**
 * @package PackageName
 * @subpackage SubPackageName
 * @name name
 */



class string_should_contain extends a_context
{

	public function should_pass_when_string_does_contain_needle()
	{
		$this->string('my string')->should_contain('y str');
	}

	public function should_fail_when_string_does_not_contain_needle()
	{
		$this->string('my string')->should_contain('ystr')->should_fail;
	}

	public function should_provide_message_on_failure()
	{
		$context = $this->stub('a_context');
		$string = $context->string('my string');
		$string->should_contain('ystr');
		$this->value($string->do_comparison())->should_be->exactly(
			'Expected <string:my string> to contain <string:ystr>'
		);
	}

}
