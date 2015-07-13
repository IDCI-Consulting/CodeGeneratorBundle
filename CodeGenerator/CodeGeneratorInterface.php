<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\CodeGenerator;

use IDCI\Bundle\CodeGeneratorBundle\CodeGeneratorConfigurator\CodeGeneratorConfigurator;

interface CodeGeneratorInterface
{
    /**
     * Generate codes according to the given configuration
     *
     * @param CodeGeneratorConfigurator $configurator
     * @return string
     */
    public function generate(CodeGeneratorConfigurator $configurator);
}
