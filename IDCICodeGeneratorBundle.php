<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle;

use IDCI\Bundle\CodeGeneratorBundle\DependencyInjection\Compiler\CodeGeneratorCompilerPass;
use IDCI\Bundle\CodeGeneratorBundle\DependencyInjection\Compiler\CodeValidatorCompilerPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class IDCICodeGeneratorBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new CodeGeneratorCompilerPass());
        $container->addCompilerPass(new CodeValidatorCompilerPass());
    }
}