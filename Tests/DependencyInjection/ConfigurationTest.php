<?php

namespace Evheniy\TwitterBootstrapBundle\Tests\DependencyInjection;

use Evheniy\TwitterBootstrapBundle\DependencyInjection\Configuration;

/**
 * Class ConfigurationTest
 *
 * @package Evheniy\TwitterBootstrapBundle\Tests\DependencyInjection
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test getConfigTreeBuilder()
     */
    public function testGetConfigTreeBuilder()
    {
        $configuration = new Configuration();
        $tree = $configuration->getConfigTreeBuilder();
        $this->assertInstanceOf(
            'Symfony\Component\Config\Definition\Builder\TreeBuilder',
            $tree
        );
        $this->assertInstanceOf(
            'Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition',
            $tree->root('twitter_bootstrap')
        );
        $tree = $tree->buildTree();
        $this->assertEquals('twitter_bootstrap', $tree->getName());
        $this->assertFalse($tree->hasDefaultValue());
        $this->assertFalse($tree->isRequired());
    }
} 