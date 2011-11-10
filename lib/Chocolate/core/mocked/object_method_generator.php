<?php
/* $Id: object_method_generator.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class mocked_object_method_generator
{

    protected static $count = array();

    public static function generate(mocked_object_method $method)
    {
        if (!isset(self::$count[$method->name]))
        {
            self::$count[$method->name] = 0;
        }
        $i = ++self::$count[$method->name];


        $class_name = "mock_method_{$method->name}_{$i}";

        $code = array();
        $code[] = "class {$class_name}";
        $code[] = '{';
        $code[] = '  protected $call_count = 0;';
        $code[] = '  public function get_call_count()';
        $code[] = '  {';
        $code[] = '    return $this->call_count;';
        $code[] = '  }';
        $code[] = '  public function run()';
        $code[] = '  {';
        $code[] = '    ++$this->call_count;';
        $code[] = '    switch (' . $method->params_to_code() . ')';
        $code[] = '    {';

        // method's return values
        $default = serialize(null);
        foreach ($method->get_returns() as $params => $value) {
            if ($params === 'default') {
                $default = $value->to_code();
                continue;
            }
            $code[] = "      case '{$params}':";
            $code[] = '        return ' . $value->to_code();
            $code[] = "        break;";
        }

        $code[] = "      default:";
        $code[] = "        return {$default};";
        $code[] = "        break;";
        $code[] = "    }";
        $code[] = "  }";
        $code[] = '}';

        eval(implode('', $code));

        $instance = new $class_name();
        $method->setInstance($instance);
        return $instance;
    }

}
