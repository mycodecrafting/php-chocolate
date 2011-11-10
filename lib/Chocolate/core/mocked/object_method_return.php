<?php
/* $Id: object_method_return.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class mocked_object_method_return
{

    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function to_code()
    {
        // var_export doesn't support circular references, but serialize does;
        // however serialize doesn't support internal classes, but var_export does
        if (is_object($this->value))
        {
            $object = new ReflectionObject($this->value);

            do
            {
                if ($object->isInternal() === true)
                {
                    return var_export($this->value, true);
                }
                $object = $object->getParentClass();
            }
            while (($object instanceof ReflectionClass) === true);

            return "unserialize('" . str_replace("'", "\'", serialize($this->value)) . "');";
        }

        return var_export($this->value, true);
    }

}
