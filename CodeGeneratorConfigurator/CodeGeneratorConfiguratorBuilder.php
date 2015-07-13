<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\CodeGeneratorConfigurator;

use IDCI\Bundle\CodeGeneratorBundle\Model\GenerationConfiguration;

class CodeGeneratorConfiguratorBuilder implements CodeGeneratorConfiguratorBuilderInterface
{
    /**
     * @var array
     */
    private $charsets;

    /**
     * Constructor
     *
     * @param array $charsets
     */
    public function __construct(array $charsets)
    {
        $this->charsets = $charsets;
    }

    /**
     * {@inheritDoc}
     */
    public function build(GenerationConfiguration $configuration)
    {
        return new CodeGeneratorConfigurator($configuration, $this->charsets);
    }
}