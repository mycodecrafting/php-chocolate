<?php
/* $Id: generator.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



abstract class mocked_generator
{

    protected $prefix = 'mock';
    protected $handler = 'mocked_handler';
    protected $count = array();

    protected function get_class_name($class_name, $mocked_name = false)
    {
        if ($mocked_name !== false)
        {
            return $mocked_name;
        }

        if (!isset($this->count[$class_name]))
        {
            $this->count[$class_name] = 0;
        }

        $i = ++$this->count[$class_name];

        return "{$this->prefix}_{$class_name}_{$i}";
    }

    protected static function generate_class($class_name)
    {
        eval("class {$class_name} { }");
    }

    protected static function generate_abstract_methods_for(ReflectionClass $class)
    {
        $code = array();

        foreach ($class->getMethods() as $method)
        {
            if ($method->isAbstract() === false)
            {
                continue;
            }

            $visibility = self::get_method_visibility($method);
            $method_name = $method->getName();
            $method_params = self::get_method_params($method);

            $code[] = "  {$visibility} function {$method_name}({$method_params})";
            $code[] = "  {";
            $code[] = "  }";
        }

        return implode('', $code);
    }

    protected static function get_method_visibility(ReflectionMethod $method)
    {
        if ($method->isPublic() === true)
        {
            return 'public';
        }

        if ($method->isProtected() === true)
        {
            return 'protected';
        }

        if ($method->isPrivate() === true)
        {
            return 'private';
        }
    }

    protected static function get_method_params(ReflectionMethod $method)
    {
        $parameters = array();

        foreach ($method->getParameters() as $parameter)
        {
            $type_hint = '';
            if ($parameter->getClass() !== null)
            {
                $type_hint = $parameter->getClass()->getName() . ' ';
            }

            if ($parameter->isArray() === true)
            {
                $type_hint = 'array ';
            }

            $ref = ($parameter->isPassedByReference() ? '&' : '');

            $value = '';
            if ($parameter->isDefaultValueAvailable() === true)
            {
                $value = ' = ' . var_export($parameter->getDefaultValue(), true);
            }

            $param = $parameter->getName();

            $parameters[] = "{$type_hint}{$ref}{$param}{$value}";
        }

        return implode(', ', $parameters);
    }

    public static function invoke($class_name, array $constructor_args = array())
    {
        $class = new ReflectionClass($class_name);

        if ($class->isAbstract() === true)
        {
            if (!class_exists('mock_inner_' . $class_name))
            {
                $code[] = "class mock_inner_{$class_name} extends {$class_name}";
                $code[] = '{';
                $code[] = self::generate_abstract_methods_for($class);
                $code[] = '}';
                eval(implode('', $code));
            }

            $class = new ReflectionClass('mock_inner_' . $class_name);
        }

        if ($class->getConstructor() === null) {
            return $class->newInstance();
        }

        return $class->newInstanceArgs($constructor_args);
    }

    protected function generate_mock($class_name, $mocked_name = false,
        array $constructor_args = array(), $partial = true)
    {
        $mocked_class_name = $this->get_class_name($class_name, $mocked_name);

        if (class_exists($mocked_class_name))
        {
            return self::invoke($mocked_class_name, $constructor_args);
        }

        $code = array();

        if ($partial === true)
        {
            if (!class_exists($class_name))
            {
                self::generate_class($class_name);
            }

            $code[] = "class {$mocked_class_name} extends {$class_name}";
            $code[] = '{';

            $class = new ReflectionClass($class_name);

            if (($class->isAbstract() === true) || ($class->isInterface() === true))
            {
                $code[] = self::generate_abstract_methods_for($class);
            }
        }
        else
        {
            $code[] = "class {$mocked_class_name}";
            $code[] = '{';
        }

        $code[] = '  private $___handler = null;';
        $code[] = '  private function ___handler()';
        $code[] = '  {';
        $code[] = '    if ($this->___handler === null)';
        $code[] = '    {';
        $code[] = "        \$this->___handler = new {$this->handler}('$mocked_class_name');";
        $code[] = '    }';
        $code[] = '    return $this->___handler;';
        $code[] = '  }';

        if ($partial === true) {
            $code[] = '  private $___inner_class = null;';
            $code[] = '  private function ___inner_class()';
            $code[] = '  {';
            $code[] = '    if ($this->___inner_class === null)';
            $code[] = '    {';
            $code[] = '        $this->___inner_class = mocked_generator::invoke("' .
                $class_name . '", unserialize(\'' .
                str_replace("'", "\'", serialize($constructor_args)) . '\'));';
            $code[] = '    }';
            $code[] = '    return $this->___inner_class;';
            $code[] = '  }';
        }

        $code[] = '  public function __call($method, array $args)';
        $code[] = '  {';
        $code[] = '    if ($this->___handler()->is_valid($method))';
        $code[] = '    {';
        $code[] = '        return call_user_func_array(array($this->___handler(), $method), $args);';
        $code[] = '    }';
        if ($partial === true) {
            $code[] = '    return call_user_func_array(array($this->___inner_class(), $method), $args);';
        }
        $code[] = '  }';


        $code[] = '  public function __get($property)';
        $code[] = '  {';
        $code[] = '    if ($this->___handler()->is_valid_property($property))';
        $code[] = '    {';
        $code[] = '        return $this->___handler()->$property;';
        $code[] = '    }';
        if ($partial === true) {
            $code[] = '    return $this->___inner_class()->$property;';
        }
        $code[] = '  }';


        if ($partial === true) {
            $code[] = '  public function __set($property, $value)';
            $code[] = '  {';
            $code[] = '    $this->___inner_class()->$property = $value;';
            $code[] = '  }';
        }

        $code[] = '}';

        eval(implode('', $code));

        return self::invoke($mocked_class_name, $constructor_args);
    }

}
