<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Tests\CodeGeneratorConfigurator;

use IDCI\Bundle\CodeGeneratorBundle\CodeGeneratorConfigurator\CodeGeneratorConfigurator;
use IDCI\Bundle\CodeGeneratorBundle\Model\GenerationConfiguration;
use IDCI\Bundle\CodeGeneratorBundle\Model\GenerationConfigurationIncludedCharacterSets;

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
            'uppercase' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
            'lowercase' => 'abcdefghijklmnopqrstuvwxyz',
            'digits' => '0123456789',
            'punctuation' => ',?!:;.',
            'brackets' => '{}[]()',
            'space' => ' ',
            'specialCharacters' => array()
        );
    }

    /**
     * Get the generationConfiguration
     *
     * @return GenerationConfiguration
     */
    private function getGenerationConfiguration()
    {
        $generationConfiguration = new GenerationConfiguration();

        $includedCharacterSets = new GenerationConfigurationIncludedCharacterSets();

        $includedCharacterSets
            ->setUppercase(true)
            ->setLowercase(true)
            ->setDigits(true)
            ->setBrackets(false)
            ->setExtraCharacters(array())
            ->setPunctuation(false)
            ->setSpace(false)
            ->setSpecialCharacters(false)
        ;

        $generationConfiguration
            ->setMinLength(5)
            ->setMaxLength(8)
            ->setQuantity(15000)
            ->setExcludedCharacterSets(array())
            ->setIncludedCharacterSets($includedCharacterSets)
        ;

        return $generationConfiguration;
    }

    /**
     * Test the getFullCharactersSet function
     */
    public function testGetFullCharactersSet()
    {
        $configurator = new CodeGeneratorConfigurator(
            $this->getGenerationConfiguration(),
            $this->getCharsets()
        );
        $characterSet = $configurator->getFullCharactersSet();

        $this->assertEquals(
            'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',
            $characterSet
        );
    }

    /**
     * Test the getRandomLength function
     */
    public function testGetRandomLength()
    {
        $configurator = new CodeGeneratorConfigurator(
            $this->getGenerationConfiguration(),
            $this->getCharsets()
        );
        $randomLength = $configurator->getRandomLength();

        $this->assertGreaterThanOrEqual(
            $this->getGenerationConfiguration()->getMinLength(),
            $randomLength
        );
        $this->assertLessThanOrEqual(
            $this->getGenerationConfiguration()->getMaxLength(),
            $randomLength
        );
    }

    /**
     * Test the getMaxQuantity function
     */
    public function testGetMaxQuantity()
    {
        $configuration = $this->getGenerationConfiguration();
        $configuration->setMinLength('3');
        $configuration->setMaxLength('6');
        $charset = array(
            'uppercase' => 'A',
            'lowercase' => 'a',
            'digits' => '0'
        );
        $configurator = new CodeGeneratorConfigurator(
            $configuration,
            $charset
        );

        $this->assertEquals('1080', $configurator->getMaxQuantity());
    }
}