<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\CodeGenerator;

use IDCI\Bundle\CodeGeneratorBundle\Model\GenerationConfiguration;

class CodeGeneratorConfigurator implements CodeGeneratorConfiguratorInterface
{
    /**
     * @var GenerationConfiguration
     */
    private $configuration;

    /**
     * @var array
     */
    private $charsets;

    /**
     * Constructor
     *
     * @param GenerationConfiguration $configuration
     * @param array $charsets
     */
    public function __construct(GenerationConfiguration $configuration, array $charsets)
    {
        $this->configuration = $configuration;
        $this->charsets = $charsets;
    }

    /**
     * {@inheritDoc}
     */
    public function getFullCharactersSet()
    {

    }
};