<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Tests\Generation;

use IDCI\Bundle\CodeGeneratorBundle\Generation\RandomCodeGenerator;
use IDCI\Bundle\CodeGeneratorBundle\Configuration\CodeGeneratorConfigurator;
use IDCI\Bundle\CodeGeneratorBundle\Model\GenerationConfiguration;

class RandomCodeGeneratorTest extends \PHPUnit_Framework_TestCase
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
     * Test the generate function
     */
    public function testGenerate()
    {
        $configuration = new GenerationConfiguration();
        $configurator = new CodeGeneratorConfigurator($configuration, $this->getCharsets());

        $generator = new RandomCodeGenerator();

        for ($i = 0; $i < 50; $i++) {
            $code = $generator->generate($configurator);

            $this->assertGreaterThanOrEqual(
                $configuration->getMinLength(),
                mb_strlen($code)
            );

            $this->assertLessThanOrEqual(
                $configuration->getMaxLength(),
                mb_strlen($code)
            );
        }
    }

    /**
     * Test the generate function with custom configuration
     */
    public function testGenerateNumber()
    {
        $configuration = new GenerationConfiguration();
        $configuration
            ->setMinLength(4)
            ->setMaxLength(4)
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

        $generator = new RandomCodeGenerator();

        for ($i = 0; $i < 50; $i++) {
            $code = $generator->generate($configurator);

            $this->assertEquals(4, mb_strlen($code));
            $this->assertEquals(true, is_numeric($code));
        }
    }
}