<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@gmail.com>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class CodeGeneratorCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('idci_code_generator.generator_registry')) {
            return;
        }

        $registryDefinition = $container->getDefinition('idci_code_generator.generator_registry');
        $taggedServices = $container->findTaggedServiceIds('code_generator');

        foreach ($taggedServices as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {
                $registryDefinition->addMethodCall(
                    'setCodeGenerator',
                    array(new Reference($id), $attributes["alias"])
                );
            }
        }
    }
}