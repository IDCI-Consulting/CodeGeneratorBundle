<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\CodeGenerator;

interface CodeGeneratorInterface
{
    /**
     * Generate codes according to the given configuration
     *
     * @param CodeGeneratorConfiguratorInterface $configurator
     * @return array()
     */
    public function generate(CodeGeneratorConfiguratorInterface $configurator);
}
