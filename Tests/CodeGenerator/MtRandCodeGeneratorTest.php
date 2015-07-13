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

class CodeGeneratorTest extends \PHPUnit_Framework_TestCase
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
    public function testGenerate()
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
}