<?php
/* $Id: standard_specs.php 63 2007-03-26 00:03:34Z dreamscape $ */
/**
 * @package PackageName
 * @subpackage SubPackageName
 * @name name
 */



class standard_specs extends a_context
{

	public function setup()
	{
		$this->specs = $this->stub('the_specs', 'some_specs');
	}

	public function should_import_a_context()
	{
		$this->stub('a_context', 'a_new_context');

        $this->callback(function($specs)
            {
                $specs->import->context->a_new_context;
            }, $this->specs
        )->should_not_throw('spec_import_context_exception');
	}

	public function should_import_specs()
	{
		$this->stub('the_specs', 'some_more_specs');

        $this->callback(function($specs)
            {
                $specs->import->specs->some_more_specs;
            }, $this->specs
        )->should_not_throw('spec_import_specs_exception');
	}

	public function should_not_import_a_context_that_is_not_an_instance_of_a_context()
	{
		$this->stub('stdClass', 'not_a_context');

        $this->callback(function($specs)
            {
                $specs->import->context->not_a_context;
            }, $this->specs
        )->should_throw('spec_import_context_exception');
	}

	public function should_not_import_specs_that_are_not_an_instance_of_the_specs()
	{
		$this->stub('stdClass', 'not_the_specs');

        $this->callback(function($specs)
            {
                $specs->import->specs->not_a_context;
            }, $this->specs
        )->should_throw('spec_import_specs_exception');
	}

}
