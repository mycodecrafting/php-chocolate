<?php
/* $Id: string.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



class should_string_helper extends should_helper
{

    /**
     * string contains comparision
     * [ $this->string($actual)->should_contain($string) ]
     */
    public function should_contain($expected = null)
    {
        return $this->compare('string_contains', $expected);
    }

    /**
     * negate string contains comparision
     * [ $this->string($actual)->should_not_contain($string) ]
     */
    public function should_not_contain($expected = null)
    {
        $this->negated = true;
        return $this->should_contain($expected);
    }

    /**
     * pattern match comparison
     * [ $this->string($actual)->should_match($pattern) ]
     */
    public function should_match($expected = null)
    {
        return $this->compare('pattern_matches', $expected);
    }

    /**
     * negate pattern match comparison
     * [ $this->string($actual)->should_match($pattern) ]
     */
    public function should_not_match($expected = null)
    {
        $this->negated = true;
        return $this->should_match($expected);
    }

}
