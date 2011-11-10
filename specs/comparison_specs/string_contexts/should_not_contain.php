<?php
/* $Id: should_not_contain.php 49 2007-03-19 06:34:17Z dreamscape $ */
/**
 * @package PackageName
 * @subpackage SubPackageName
 * @name name
 */



class string_should_not_contain extends a_context
{

	public function should_pass_unless_string_contains_needle()
	{
		$this->string('my string')->should_not_contain('ystr');
	}

	public function should_fail_when_string_contains_needle()
	{
		$this->string('my string')->should_not_contain('y str')->should_fail;
	}

	public function should_provide_message_on_failure()
	{
		$context = $this->stub('a_context');
		$string = $context->string('my string');
		$string->should_not_contain('y str');
		$this->value($string->do_comparison())->should_be->exactly(
			'Did not expect <string:my string> to contain <string:y str>'
		);
	}

}
