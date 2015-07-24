<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Tests\Validation;

use IDCI\Bundle\CodeGeneratorBundle\Validation\ArrayCodeValidator;
use IDCI\Bundle\CodeGeneratorBundle\Validation\CodeValidatorContext;

class ArrayCodeValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the validate function
     */
    public function testValidate()
    {
        $validator = new ArrayCodeValidator();

        $true = $validator->validate('XhkJlm', new CodeValidatorContext(
            array('XhkJln', 'Xh6Jlm', 'HhkJlm')
        ));
        $this->assertTrue($true);

        $false = $validator->validate('XhkJlm', new CodeValidatorContext(
            array('XhkJln', 'Xh6Jlm', 'XhkJlm', 'HhkJlm')
        ));
        $this->assertFalse($false);
    }
}