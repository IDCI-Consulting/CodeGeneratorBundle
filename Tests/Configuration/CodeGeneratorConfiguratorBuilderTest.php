<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Tests\Configuration;

use IDCI\Bundle\CodeGeneratorBundle\Configuration\CodeGeneratorConfigurator;
use IDCI\Bundle\CodeGeneratorBundle\Configuration\CodeGeneratorConfiguratorBuilder;
use IDCI\Bundle\CodeGeneratorBundle\Model\GenerationConfiguration;

class CodeGeneratorConfiguratorBuilderTest extends \PHPUnit_Framework_TestCase
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
     * Test the build function
     */
    public function testBuild()
    {
        $configuration = new GenerationConfiguration();
        $configurator  = new CodeGeneratorConfigurator($configuration, $this->getCharsets());
        $builder       = new CodeGeneratorConfiguratorBuilder($this->getCharsets());

        $this->assertEquals(
            $configurator->getFullCharactersSet(),
            $builder->build($configuration)->getFullCharactersSet()
        );
    }
}