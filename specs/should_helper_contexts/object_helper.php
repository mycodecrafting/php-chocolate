<?php
/* $Id: object_helper.php 47 2007-03-19 06:28:49Z dreamscape $ */
/**
 * @package PackageName
 * @subpackage SubPackageName
 * @name name
 */



class a_should_object_helper extends a_context
{

	public function setup()
	{
		$this->helper = new should_object_helper(new stdClass);
	}

	/**
	 * callback helpers (should respond to none)
	 * {{{
	 */
	public function should_not_respond_to_should_throw()
	{
		$this->callback(array($this->helper, 'should_throw'), 'Exception')
			->should_throw('spec_call_exception')
			->with('Call to undefined method should_object_helper::should_throw()');
	}

	public function should_not_respond_to_should_not_throw()
	{
		$this->callback(array($this->helper, 'should_not_throw'), 'Exception')
			->should_throw('spec_call_exception')
			->with('Call to undefined method should_object_helper::should_not_throw()');
	}
	/**
	 * }}}
	 */

	/**
	 * string helpers (should respond to none)
	 * {{{
	 */
	public function should_not_respond_to_should_contain()
	{
		$this->callback(array($this->helper, 'should_contain'), 'needle')
			->should_throw('spec_call_exception')
			->with('Call to undefined method should_object_helper::should_contain()');
	}

	public function should_not_respond_to_should_not_contain()
	{
		$this->callback(array($this->helper, 'should_not_contain'), 'needle')
			->should_throw('spec_call_exception')
			->with('Call to undefined method should_object_helper::should_not_contain()');
	}

	public function should_not_respond_to_should_match()
	{
		$this->callback(array($this->helper, 'should_match'), '/.+/')
			->should_throw('spec_call_exception')
			->with('Call to undefined method should_object_helper::should_match()');
	}

	public function should_not_respond_to_should_not_match()
	{
		$this->callback(array($this->helper, 'should_not_match'), '/.+/')
			->should_throw('spec_call_exception')
			->with('Call to undefined method should_object_helper::should_not_match()');
	}
	/**
	 * }}}
	 */

	/**
	 * object helpers (should respond to all and return self)
	 * {{{
	 */
	public function should_respond_to_should_be_instance_of()
	{
		$this->callback(array($this->helper->should_be, 'instance_of'), 'stdClass')
			->should_not_throw('spec_call_exception');
	}

	public function should_respond_to_should_be_an_instance_of()
	{
		$this->callback(array($this->helper->should_be, 'an_instance_of'), 'stdClass')
			->should_not_throw('spec_call_exception');
	}

	public function should_respond_to_should_be_a()
	{
		$this->callback(array($this->helper->should_be, 'a'), 'stdClass')
			->should_not_throw('spec_call_exception');
	}

	public function should_respond_to_should_be_an()
	{
		$this->callback(array($this->helper->should_be, 'an'), 'stdClass')
			->should_not_throw('spec_call_exception');
	}

	public function should_respond_to_should_not_be_instance_of()
	{
		$this->callback(array($this->helper->should_not_be, 'instance_of'), 'wrong_class')
			->should_not_throw('spec_call_exception');
	}

	public function should_respond_to_should_not_be_an_instance_of()
	{
		$this->callback(array($this->helper->should_not_be, 'an_instance_of'), 'wrong_class')
			->should_not_throw('spec_call_exception');
	}

	public function should_respond_to_should_not_be_a()
	{
		$this->callback(array($this->helper->should_not_be, 'a'), 'wrong_class')
			->should_not_throw('spec_call_exception');
	}

	public function should_respond_to_should_not_be_an()
	{
		$this->callback(array($this->helper->should_not_be, 'an'), 'wrong_class')
			->should_not_throw('spec_call_exception');
	}

	public function should_return_self_when_you_call_should_be_instance_of()
	{
		$this->value($this->helper->should_be->instance_of('stdClass'))
			->should_be->identical_to($this->helper);
	}

	public function should_return_self_when_you_call_should_be_an_instance_of()
	{
		$this->value($this->helper->should_be->an_instance_of('stdClass'))
			->should_be->identical_to($this->helper);
	}

	public function should_return_self_when_you_call_should_be_a()
	{
		$this->value($this->helper->should_be->a('stdClass'))
			->should_be->identical_to($this->helper);
	}

	public function should_return_self_when_you_call_should_be_an()
	{
		$this->value($this->helper->should_be->an('stdClass'))
			->should_be->identical_to($this->helper);
	}

	public function should_return_self_when_you_call_should_not_be_instance_of()
	{
		$this->value($this->helper->should_not_be->instance_of('stdClass'))
			->should_be->identical_to($this->helper);
	}

	public function should_return_self_when_you_call_should_not_be_an_instance_of()
	{
		$this->value($this->helper->should_not_be->an_instance_of('stdClass'))
			->should_be->identical_to($this->helper);
	}

	public function should_return_self_when_you_call_should_not_be_a()
	{
		$this->value($this->helper->should_not_be->a('stdClass'))
			->should_be->identical_to($this->helper);
	}

	public function should_return_self_when_you_call_should_not_be_an()
	{
		$this->value($this->helper->should_not_be->an('stdClass'))
			->should_be->identical_to($this->helper);
	}
	/**
	 * }}}
	 */

	/**
	 * value helpers (should respond to none)
	 * {{{
	 */
	public function should_not_respond_to_should_be()
	{
		$this->callback(array($this->helper, 'should_be'), 'value')
			->should_throw('spec_call_exception')
			->with('Call to undefined method should_object_helper::should_be()');
	}

	public function should_not_respond_to_should_be_a_string()
	{
		$this->callback(create_function('$helper', '
			return $helper->should_be->a_string;
		'), $this->helper)
			->should_throw('spec_call_exception')
			->with('Call to undefined property should_object_helper::$a_string');
	}

	public function should_not_respond_to_should_be_a_float()
	{
		$this->callback(create_function('$helper', '
			return $helper->should_be->a_float;
		'), $this->helper)
			->should_throw('spec_call_exception')
			->with('Call to undefined property should_object_helper::$a_float');
	}

	public function should_not_respond_to_should_be_an_array()
	{
		$this->callback(create_function('$helper', '
			return $helper->should_be->an_array;
		'), $this->helper)
			->should_throw('spec_call_exception')
			->with('Call to undefined property should_object_helper::$an_array');
	}

	public function should_not_respond_to_should_be_an_integer()
	{
		$this->callback(create_function('$helper', '
			return $helper->should_be->an_integer;
		'), $this->helper)
			->should_throw('spec_call_exception')
			->with('Call to undefined property should_object_helper::$an_integer');
	}

	public function should_not_respond_to_should_be_an_object()
	{
		$this->callback(create_function('$helper', '
			return $helper->should_be->an_object;
		'), $this->helper)
			->should_throw('spec_call_exception')
			->with('Call to undefined property should_object_helper::$an_object');
	}

	public function should_not_respond_to_should_be_boolean()
	{
		$this->callback(create_function('$helper', '
			return $helper->should_be->boolean;
		'), $this->helper)
			->should_throw('spec_call_exception')
			->with('Call to undefined property should_object_helper::$boolean');
	}

	public function should_not_respond_to_should_be_true()
	{
		$this->callback(create_function('$helper', '
			return $helper->should_be->true;
		'), $this->helper)
			->should_throw('spec_call_exception')
			->with('Call to undefined property should_object_helper::$true');
	}

	public function should_not_respond_to_should_be_false()
	{
		$this->callback(create_function('$helper', '
			return $helper->should_be->false;
		'), $this->helper)
			->should_throw('spec_call_exception')
			->with('Call to undefined property should_object_helper::$false');
	}

	public function should_not_respond_to_should_be_null()
	{
		$this->callback(create_function('$helper', '
			return $helper->should_be->null;
		'), $this->helper)
			->should_throw('spec_call_exception')
			->with('Call to undefined property should_object_helper::$null');
	}

	public function should_not_respond_to_should_be_exactly()
	{
		$this->callback(array($this->helper->should_be, 'exactly'), 'value')
			->should_throw('spec_call_exception')
			->with('Call to undefined method should_object_helper::should_be_exactly()');
	}

	public function should_not_respond_to_should_be_identical_to()
	{
		$this->callback(array($this->helper->should_be, 'identical_to'), 'value')
			->should_throw('spec_call_exception')
			->with('Call to undefined method should_object_helper::should_be_identical_to()');
	}

	public function should_not_respond_to_should_be_greater_than()
	{
		$this->callback(array($this->helper->should_be, 'greater_than'), 'value')
			->should_throw('spec_call_exception')
			->with('Call to undefined method should_object_helper::should_be_greater_than()');
	}

	public function should_not_respond_to_should_be_less_than()
	{
		$this->callback(array($this->helper->should_be, 'less_than'), 'value')
			->should_throw('spec_call_exception')
			->with('Call to undefined method should_object_helper::should_be_less_than()');
	}

	public function should_not_respond_to_should_equal()
	{
		$this->callback(array($this->helper, 'should_equal'), 'value')
			->should_throw('spec_call_exception')
			->with('Call to undefined method should_object_helper::should_equal()');
	}

	public function should_not_respond_to_should_not_be()
	{
		$this->callback(array($this->helper, 'should_not_be'), 'value')
			->should_throw('spec_call_exception')
			->with('Call to undefined method should_object_helper::should_not_be()');
	}

	public function should_not_respond_to_should_not_be_a_string()
	{
		$this->callback(create_function('$helper', '
			return $helper->should_not_be->a_string;
		'), $this->helper)
			->should_throw('spec_call_exception')
			->with('Call to undefined property should_object_helper::$a_string');
	}

	public function should_not_respond_to_should_not_be_a_float()
	{
		$this->callback(create_function('$helper', '
			return $helper->should_not_be->a_float;
		'), $this->helper)
			->should_throw('spec_call_exception')
			->with('Call to undefined property should_object_helper::$a_float');
	}

	public function should_not_respond_to_should_not_be_an_array()
	{
		$this->callback(create_function('$helper', '
			return $helper->should_not_be->an_array;
		'), $this->helper)
			->should_throw('spec_call_exception')
			->with('Call to undefined property should_object_helper::$an_array');
	}

	public function should_not_respond_to_should_not_be_an_integer()
	{
		$this->callback(create_function('$helper', '
			return $helper->should_not_be->an_integer;
		'), $this->helper)
			->should_throw('spec_call_exception')
			->with('Call to undefined property should_object_helper::$an_integer');
	}

	public function should_not_respond_to_should_not_be_an_object()
	{
		$this->callback(create_function('$helper', '
			return $helper->should_not_be->an_object;
		'), $this->helper)
			->should_throw('spec_call_exception')
			->with('Call to undefined property should_object_helper::$an_object');
	}

	public function should_not_respond_to_should_not_be_boolean()
	{
		$this->callback(create_function('$helper', '
			return $helper->should_not_be->boolean;
		'), $this->helper)
			->should_throw('spec_call_exception')
			->with('Call to undefined property should_object_helper::$boolean');
	}

	public function should_not_respond_to_should_not_be_true()
	{
		$this->callback(create_function('$helper', '
			return $helper->should_not_be->true;
		'), $this->helper)
			->should_throw('spec_call_exception')
			->with('Call to undefined property should_object_helper::$true');
	}

	public function should_not_respond_to_should_not_be_false()
	{
		$this->callback(create_function('$helper', '
			return $helper->should_not_be->false;
		'), $this->helper)
			->should_throw('spec_call_exception')
			->with('Call to undefined property should_object_helper::$false');
	}

	public function should_not_respond_to_should_not_be_null()
	{
		$this->callback(create_function('$helper', '
			return $helper->should_not_be->null;
		'), $this->helper)
			->should_throw('spec_call_exception')
			->with('Call to undefined property should_object_helper::$null');
	}

	public function should_not_respond_to_should_not_be_exactly()
	{
		$this->callback(array($this->helper->should_not_be, 'exactly'), 'value')
			->should_throw('spec_call_exception')
			->with('Call to undefined method should_object_helper::should_be_exactly()');
	}

	public function should_not_respond_to_should_not_be_identical_to()
	{
		$this->callback(array($this->helper->should_not_be, 'identical_to'), 'value')
			->should_throw('spec_call_exception')
			->with('Call to undefined method should_object_helper::should_be_identical_to()');
	}

	public function should_not_respond_to_should_not_be_greater_than()
	{
		$this->callback(array($this->helper->should_not_be, 'greater_than'), 'value')
			->should_throw('spec_call_exception')
			->with('Call to undefined method should_object_helper::should_be_greater_than()');
	}

	public function should_not_respond_to_should_not_be_less_than()
	{
		$this->callback(array($this->helper->should_not_be, 'less_than'), 'value')
			->should_throw('spec_call_exception')
			->with('Call to undefined method should_object_helper::should_be_less_than()');
	}

	public function should_not_respond_to_should_not_equal()
	{
		$this->callback(array($this->helper, 'should_not_equal'), 'value')
			->should_throw('spec_call_exception')
			->with('Call to undefined method should_object_helper::should_not_equal()');
	}
	/**
	 * }}}
	 */

}
