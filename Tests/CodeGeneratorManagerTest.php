<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Tests\Configuration;

use IDCI\Bundle\CodeGeneratorBundle\Model\GenerationConfiguration;
use IDCI\Bundle\CodeGeneratorBundle\Configuration\CodeGeneratorConfiguratorBuilder;
use IDCI\Bundle\CodeGeneratorBundle\Generation\CodeGeneratorRegistry;
use IDCI\Bundle\CodeGeneratorBundle\Generation\RandomCodeGenerator;
use IDCI\Bundle\CodeGeneratorBundle\Validation\CodeValidatorRegistry;
use IDCI\Bundle\CodeGeneratorBundle\CodeGeneratorManager;
use IDCI\Bundle\CodeGeneratorBundle\Exception\InvalidConfigurationException;

class CodeGeneratorManagerTest extends \PHPUnit_Framework_TestCase
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
        $builder       = new CodeGeneratorConfiguratorBuilder($this->getCharsets());

        $generatorRegistry = new CodeGeneratorRegistry();
        $generatorRegistry->setCodeGenerator(new RandomCodeGenerator(), 'random');

        $validatorRegistry = new CodeValidatorRegistry();

        $codeManager = new CodeGeneratorManager(
            $builder,
            $generatorRegistry,
            $validatorRegistry
        );

        $codes = $codeManager->generate(10000);

        $this->assertEquals(10000, count($codes));
    }

    /**
     * Test the generate function (invalid generation)
     */
    public function testInvalidGeneration()
    {
        $configuration = new GenerationConfiguration();
        $configuration
            ->setMaxLength(4)
            ->setMinLength(4)
        ;

        $builder = new CodeGeneratorConfiguratorBuilder(array('lowercase' => 'ab'));

        $generatorRegistry = new CodeGeneratorRegistry();
        $generatorRegistry->setCodeGenerator(new RandomCodeGenerator(), 'random');

        $validatorRegistry = new CodeValidatorRegistry();

        $codeManager = new CodeGeneratorManager(
            $builder,
            $generatorRegistry,
            $validatorRegistry
        );

        try {
            $codeManager->generate(17, $configuration);
            $this->fail("Expected exception invalid configuration not thrown");
        } catch (InvalidConfigurationException $e) {
            $this->assertTrue(true);
        }
    }
}