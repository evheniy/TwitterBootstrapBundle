<?php

namespace Evheniy\TwitterBootstrapBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Evheniy\TwitterBootstrapBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('twitter_bootstrap');
        $rootNode
            ->children()
                ->scalarNode('version')->defaultValue('3.3.4')->end()
                ->scalarNode('local_cdn')->defaultValue('')->end()
                ->scalarNode('local_js')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('local_fonts_dir')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('local_css')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('local_theme')->isRequired()->cannotBeEmpty()->end()
                ->booleanNode('html5')->defaultTrue()->end()
                ->booleanNode('async')->defaultFalse()->end()
            ->end();

        return $treeBuilder;
    }
}