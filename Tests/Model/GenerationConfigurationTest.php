<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Tests\Configuration;

use IDCI\Bundle\CodeGeneratorBundle\Model\GenerationConfiguration;
use IDCI\Bundle\CodeGeneratorBundle\Model\ConfigurationCharacterSet;

class GenerationConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the constructor function
     */
    public function testConstructor()
    {
        $configuration = new GenerationConfiguration();

        $this->assertEquals(4,     $configuration->getMinLength());
        $this->assertEquals(8,     $configuration->getMaxLength());
        $this->assertEquals(true,  $configuration->isLowercase());
        $this->assertEquals(true,  $configuration->isUppercase());
        $this->assertEquals(true,  $configuration->isDigits());
        $this->assertEquals(true,  $configuration->isPunctuation());
        $this->assertEquals(false, $configuration->isBrackets());
        $this->assertEquals(false, $configuration->isSpace());
        $this->assertEquals(false, $configuration->isSpecialCharacters());
        $this->assertEquals(null,  $configuration->getExtraCharacters());
    }
}