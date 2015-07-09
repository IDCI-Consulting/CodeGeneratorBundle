<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\CodeGenerator;

use IDCI\Bundle\CodeGeneratorBundle\Model\GenerationConfiguration;

interface CodeGeneratorConfiguratorBuilderInterface
{
    /**
     * Build a code configurator
     *
     * @param GenerationConfiguration $configuration
     * @return CodeGeneratorConfiguratorInterface
     */
    public function build(GenerationConfiguration $configuration);
}