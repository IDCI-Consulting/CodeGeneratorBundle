<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Tests\Configuration;

use IDCI\Bundle\CodeGeneratorBundle\Configuration\CodeGeneratorConfigurator;
use IDCI\Bundle\CodeGeneratorBundle\Model\GenerationConfiguration;

class CodeGeneratorConfiguratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Get the charsets
     *
     * @return array
     */
    private function getCharsets()
    {
        return array(
            'brackets'          => '{}[]()',
            'digits'            => '0123456789',
            'lowercase'         => 'abcdefghijklmnopqrstuvwxyz',
            'punctuation'       => ',?!:;.',
            'uppercase'         => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
            'space'             => ' ',
            'specialCharacters' => array(),
        );
    }

    /**
     * Test the getDefaultFullCharactersSet function
     */
    public function testGetDefaultFullCharactersSet()
    {
        $configuration = new GenerationConfiguration();
        $configurator = new CodeGeneratorConfigurator($configuration, $this->getCharsets());

        $this->assertEquals(
            '0123456789abcdefghijklmnopqrstuvwxyz,?!:;.ABCDEFGHIJKLMNOPQRSTUVWXYZ',
            $configurator->getFullCharactersSet()
        );
    }

    /**
     * Test the getCustomFullCharactersSet function
     */
    public function testGetCustomFullCharactersSet()
    {
        $configuration = new GenerationConfiguration();
        $configuration->setPunctuation(false);

        $configurator = new CodeGeneratorConfigurator($configuration, $this->getCharsets());
        $this->assertEquals(
            '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            $configurator->getFullCharactersSet()
        );

        $configuration->setUppercase(false);
        $configurator = new CodeGeneratorConfigurator($configuration, $this->getCharsets());

        $this->assertEquals(
            '0123456789abcdefghijklmnopqrstuvwxyz',
            $configurator->getFullCharactersSet()
        );

        $configuration->setLowercase(false);
        $configurator = new CodeGeneratorConfigurator($configuration, $this->getCharsets());

        $this->assertEquals(
            '0123456789',
            $configurator->getFullCharactersSet()
        );
    }

    /**
     * Test the getRandomLength function
     */
    public function testGetRandomLength()
    {
        $configuration = new GenerationConfiguration();
        $configuration
            ->setMinLength('4')
            ->setMaxLength('10')
        ;
        $configurator = new CodeGeneratorConfigurator($configuration, $this->getCharsets());

        for ($i = 0; $i < 50; $i++) {
            $this->assertGreaterThanOrEqual(
                $configuration->getMinLength(),
                $configurator->getRandomLength()
            );
            $this->assertLessThanOrEqual(
                $configuration->getMaxLength(),
                $configurator->getRandomLength()
            );
        }
    }

    /**
     * Test the getMaxQuantity function
     */
    public function testGetMaxQuantity()
    {
        $configuration = new GenerationConfiguration();
        $configuration
            ->setMinLength(4)
            ->setMaxLength(6)
            ->setLowercase(false)
            ->setUppercase(false)
            ->setDigits(true)
            ->setPunctuation(false)
            ->setBrackets(false)
            ->setSpace(false)
            ->setSpecialCharacters(false)
            ->setExtraCharacters(array())
            ->setExcludedCharacters(array())
        ;
        $configurator = new CodeGeneratorConfigurator($configuration, $this->getCharsets());

        $this->assertEquals('1110000', $configurator->getMaxQuantity());
    }
}