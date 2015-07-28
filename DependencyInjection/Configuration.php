<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('idci_code_generator');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('charsets')
                    ->children()
                        ->scalarNode('uppercase')->defaultValue('ABCDEFGHIJKLMNOPQRSTUVWXYZ')->cannotBeEmpty()->end()
                        ->scalarNode('lowercase')->defaultValue('abcdefghijklmnopqrstuvwxyz')->cannotBeEmpty()->end()
                        ->scalarNode('digits')->defaultValue('0123456789')->cannotBeEmpty()->end()
                        ->scalarNode('punctuation')->defaultValue(',?!:;.')->cannotBeEmpty()->end()
                        ->scalarNode('brackets')->defaultValue('{}[]()')->cannotBeEmpty()->end()
                        ->scalarNode('space')->defaultValue(' ')->cannotBeEmpty()->end()
                        ->scalarNode('special_characters')->defaultValue('')->end()
                        ->scalarNode('extra_characters')->defaultValue('')->end()
                        ->scalarNode('excluded_characters')->defaultValue('')->end()
                    ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}