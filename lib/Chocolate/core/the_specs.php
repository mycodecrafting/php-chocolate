<?php
/* $Id: the_specs.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



abstract class the_specs
{

    private $specs;
    private $contexts;
    private $importing;

    public function __construct()
    {
        $this->specs = new spec_collection();
        $this->contexts = new context_collection();
    }


    abstract public function define_specs();


    public function contexts()
    {
        return $this->contexts;
    }


    public function specs()
    {
        return $this->specs;
    }


    protected function importContext($context)
    {
        $context = new $context();

        if (($context instanceof a_context) === false)
        {
            throw new spec_import_context_exception(
                'A context must be an instance of a_context'
            );
        }

        $this->contexts->push($context);
    }


    protected function importSpecs($specs)
    {
        $specs = new $specs();

        if (($specs instanceof the_specs) === false)
        {
            throw new spec_import_specs_exception(
                'A spec must be an instance of the_specs'
            );
        }

        $this->specs->push($specs);
    }


    public function __get($property)
    {
        switch ($property)
        {
            case 'import':
                $this->importing = true;
                break;

            case 'context':
                if ($this->importing !== true)
                {
                    break;
                }
                $this->importing = 'context';
                break;

            case 'specs':
                if ($this->importing !== true)
                {
                    break;
                }
                $this->importing = 'specs';
                break;

            default:
                switch ($this->importing)
                {
                    case 'context':
                        $this->importContext($property);
                        break;
                    case 'specs':
                        $this->importSpecs($property);
                        break;
                }
                $this->importing = false;
                break;
        }

        return $this;
    }

}



class generic_collection implements ArrayAccess, IteratorAggregate
{

    protected $stack = array();

    public function push($item)
    {
        $this->stack[] = $item;
    }


    /**
     * for IteratorAggregate
     */
    public function getIterator()
    {
        return new ArrayIterator($this->stack);
    }


    /**
     * for ArrayAccess
     */
    public function offsetExists($offset)
    {
        if (isset($this->stack[$offset]))
        {
            return true;
        }
        return false;
    }

    public function offsetGet($offset)
    {
        return $this->stack[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->stack[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->stack[$offset]);
    }

}


class context_collection extends generic_collection
{
}

class spec_collection extends generic_collection
{
}
