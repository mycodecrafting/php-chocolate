<?php
/* $Id: autoload.php 63 2007-03-26 00:03:34Z dreamscape $ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * @copyright Copyright &copy; 2007 JD Productions, LLC
 * @license http://www.opensource.org/osi3.0/licenses/gpl-license.php GNU General Public License
 * @package Chocolate
 */



function php_chocolate_autoload($class)
{
    switch ($class)
    {
        case 'a_comparison':
        case 'a_context':
        case 'the_specs':
        case 'should_helper':
            php_chocolate::load_core($class);
            return true;
            break;

        default:

            // comparisons
            if (preg_match('/^([a-z0-9_]+)_comparison$/', $class, $matches))
            {
                php_chocolate::load_core('comparisons::' . $matches[1]);
                return true;
            }

            // mocks & stubs
            if (preg_match('/^mocked_([a-z0-9_]+)$/', $class, $matches))
            {
                php_chocolate::load_core('mocked::' . $matches[1]);
                return true;
            }

            // should helpers
            if (preg_match('/^should_([a-z0-9_]+)_helper$/', $class, $matches))
            {
                php_chocolate::load_core('should_helpers::' . $matches[1]);
                return true;
            }

            // spec exceptions
            if (preg_match('/^spec_([a-z0-9_]+)_exception$/', $class, $matches))
            {
                php_chocolate::load_core('spec::exceptions::' . $matches[1]);
                return true;
            }

            // spec reporter outputs
            if (preg_match('/^spec_reporter_output_([a-z0-9_]+)$/', $class, $matches))
            {
                php_chocolate::load_core('spec::reporters::outputs::' . $matches[1]);
                return true;
            }

            // spec reporters
            if (preg_match('/^spec_reporter_([a-z0-9_]+)$/', $class, $matches))
            {
                php_chocolate::load_core('spec::reporters::' . $matches[1]);
                return true;
            }

            if (preg_match('/^spec_([a-z0-9_]+)$/', $class, $matches))
            {
                php_chocolate::load_core('spec::' . $matches[1]);
                return true;
            }

            return false;
            break;
    }
}

spl_autoload_register('php_chocolate_autoload');
