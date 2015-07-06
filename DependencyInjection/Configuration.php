<?php

namespace Xidea\Bundle\PersonBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

use Xidea\Bundle\BaseBundle\DependencyInjection\AbstractConfiguration;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration extends AbstractConfiguration
{
    public function __construct($alias)
    {
        parent::__construct($alias);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = parent::getConfigTreeBuilder();
        $rootNode = $treeBuilder->root($this->alias);
        
        $this->addPersonSection($rootNode);
        $this->addTemplateSection($rootNode);

        return $treeBuilder;
    }
    
    protected function addPersonSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('person')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('code')->defaultValue('xidea_person')->end()
                        ->scalarNode('class')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('configuration')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('factory')->defaultValue('xidea_person.person.factory.default')->end()
                        ->scalarNode('manager')->defaultValue('xidea_person.person.manager.default')->end()
                        ->scalarNode('loader')->defaultValue('xidea_person.person.loader.default')->end()
                        ->arrayNode('form')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->arrayNode('person')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('factory')->defaultValue('xidea_person.person.form.factory.default')->end()
                                        ->scalarNode('handler')->defaultValue('xidea_person.person.form.handler.default')->end()
                                        ->scalarNode('type')->defaultValue('xidea_person')->end()
                                        ->scalarNode('name')->defaultValue('person')->end()
                                        ->arrayNode('validation_groups')
                                            ->prototype('scalar')->end()
                                            ->defaultValue(array())
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
