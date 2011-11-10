<?php
/* $Id: should_match.php 49 2007-03-19 06:34:17Z dreamscape $ */
/**
 * @package PackageName
 * @subpackage SubPackageName
 * @name name
 */



class string_should_match extends a_context
{

	public function should_pass_when_string_does_match_expression()
	{
		$this->string('string')->should_match('/^[a-z]+$/');
	}

	public function should_fail_when_string_does_not_match_expression()
	{
		$this->string('a string')->should_match('/^[a-z]+$/')->should_fail;
	}

	public function should_provide_message_on_failure()
	{
		$context = $this->stub('a_context');
		$string = $context->string('a string');
		$string->should_match('/^[a-z]+$/');
		$this->value($string->do_comparison())->should_be->exactly(
			'Expected <string:a string> to match <expression:/^[a-z]+$/>'
		);
	}

}
