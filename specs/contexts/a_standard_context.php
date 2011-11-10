<?php
/* $Id: a_standard_context.php 63 2007-03-26 00:03:34Z dreamscape $ */
/**
 * @package PackageName
 * @subpackage SubPackageName
 * @name name
 */


class a_standard_context extends a_context
{

	public function setup()
	{
		$this->context = $this->mock('a_context');
	}

	public function should_be_able_to_be_manually_passed()
	{
		try
		{
			$this->context->pass();
		}
		catch (spec_passed_exception $e)
		{
			$this->value(true)->should_be->true;
			return;
		}

		$this->fail('Failed to be marked as passed');
	}

	public function should_be_able_to_be_skipped()
	{
		try
		{
			$this->context->skip('with message');
		}
		catch (spec_skipped_exception $e)
		{
			$this->value($e->getMessage())->should_be('with message');
			return;
		}

		$this->fail('Failed to be marked as skipped');
	}

	public function should_be_able_to_be_marked_as_failed()
	{
		try
		{
			$this->context->fail('with message');
		}
		catch (spec_failed_exception $e)
		{
			$this->value($e->getMessage())->should_be('with message');
			return;
		}

		$this->fail('Failed to be marked as failed');
	}

	public function should_be_able_to_be_marked_as_not_implemented()
	{
		try
		{
			$this->context->not_implemented('with message');
		}
		catch (spec_not_implemented_exception $e)
		{
			$this->value($e->getMessage())->should_be('with message');
			return;
		}

		$this->fail('Failed to be marked as not implemented');
	}

	public function should_return_a_should_value_helper_when_you_call_value()
	{
		$value = $this->context->value(1);
		$this->object($value)->should_be->a('should_value_helper');
	}

	public function should_return_a_should_string_helper_when_you_call_string()
	{
		$string = $this->context->string('string');
		$this->object($string)->should_be->a('should_string_helper');
	}

	public function should_return_a_should_object_helper_when_you_call_object()
	{
		$object = $this->context->object(new stdClass);
		$this->object($object)->should_be->a('should_object_helper');
	}

	public function should_return_a_should_callback_helper_when_you_call_callback()
	{
		$callback = $this->context->callback('phpversion');
		$this->object($callback)->should_be->a('should_callback_helper');
	}

	public function should_return_an_instance_of_class_when_you_stub_class()
	{
		$object = $this->context->stub('stub_class');
		$this->object($object)->should_be->instance_of('stub_class');
	}

	public function should_return_an_instance_of_class_when_you_mock_class()
	{
		$object = $this->context->mock('mock_class');
		$this->object($object)->should_be->instance_of('mock_class');
	}

	public function should_throw_an_exception_when_you_call_an_undefined_method()
	{
		$this->callback(array($this->context, 'undefined_method'))->should_throw('spec_call_exception');
	}

}
