<?php

namespace Evheniy\TwitterBootstrapBundle\Tests\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Evheniy\TwitterBootstrapBundle\DependencyInjection\TwitterBootstrapExtension;

/**
 * Class TwitterBootstrapExtensionTest
 *
 * @package Evheniy\TwitterBootstrapBundle\Tests\DependencyInjection
 */
class TwitterBootstrapExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TwitterBootstrapExtension
     */
    private $extension;
    /**
     * @var ContainerBuilder
     */
    private $container;

    /**
     *
     */
    protected function setUp()
    {
        $this->extension = new TwitterBootstrapExtension();

        $this->container = new ContainerBuilder();
        $this->container->registerExtension($this->extension);
    }

    /**
     * @param ContainerBuilder $container
     * @param string           $resource
     */
    protected function loadConfiguration(ContainerBuilder $container, $resource)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/Fixtures/'));
        $loader->load($resource . '.yml');
    }

    /**
     * Test empty config
     */
    public function testWithoutConfiguration()
    {
        $this->setExpectedException(
            'Symfony\Component\Config\Definition\Exception\InvalidConfigurationException',
            'The child node "local_js" at path "twitter_bootstrap" must be configured.'
        );

        $this->container->loadFromExtension($this->extension->getAlias());
        $this->container->compile();

        $this->assertFalse($this->container->hasParameter('twitter_bootstrap'));
    }

    /**
     * Test normal config
     */
    public function testWithLocal()
    {
        $this->loadConfiguration($this->container, 'withLocal');
        $this->container->compile();

        $this->assertTrue($this->container->hasParameter('twitter_bootstrap'));
        $this->assertTrue($this->container->hasParameter('twitter_bootstrap.local_js'));
        $this->assertTrue($this->container->hasParameter('twitter_bootstrap.local_fonts_dir'));
        $this->assertTrue($this->container->hasParameter('twitter_bootstrap.local_css'));
        $this->assertTrue($this->container->hasParameter('twitter_bootstrap.local_theme'));
        $this->assertEquals($this->container->getParameter('twitter_bootstrap')['local_js'], 'bootstrap.min.js');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_js'), 'bootstrap.min.js');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap')['local_fonts_dir'], 'fonts/');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_fonts_dir'), 'fonts/');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap')['local_css'], 'bootstrap.min.css');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_css'), 'bootstrap.min.css');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap')['local_theme'], 'bootstrap-theme.min.css');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_theme'), 'bootstrap-theme.min.css');
    }

    /**
     * Test normal config
     */
    public function testTest()
    {
        $this->loadConfiguration($this->container, 'test');
        $this->container->compile();

        $this->assertTrue($this->container->hasParameter('twitter_bootstrap'));
        $this->assertTrue($this->container->hasParameter('twitter_bootstrap.local_js'));
        $this->assertTrue($this->container->hasParameter('twitter_bootstrap.local_fonts_dir'));
        $this->assertTrue($this->container->hasParameter('twitter_bootstrap.local_css'));
        $this->assertTrue($this->container->hasParameter('twitter_bootstrap.local_theme'));
        $this->assertEquals($this->container->getParameter('twitter_bootstrap')['local_js'], 'bootstrap.min.js');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_js'), 'bootstrap.min.js');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap')['local_fonts_dir'], 'fonts/');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_fonts_dir'), 'fonts/');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap')['local_css'], 'bootstrap.min.css');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_css'), 'bootstrap.min.css');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap')['local_theme'], 'bootstrap-theme.min.css');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_theme'), 'bootstrap-theme.min.css');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap')['local_cdn'], '/');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap')['version'], '3.3.0');
        $this->assertFalse($this->container->getParameter('twitter_bootstrap')['html5']);
        $this->assertTrue($this->container->getParameter('twitter_bootstrap')['async']);
    }

    /**
     * Test wrong config
     */
    public function testWithOutLocalJs()
    {
        $this->setExpectedException(
            'Symfony\Component\Config\Definition\Exception\InvalidConfigurationException',
            'The child node "local_js" at path "twitter_bootstrap" must be configured.'
        );

        $this->loadConfiguration($this->container, 'withOutLocalJs');
        $this->container->compile();
        $this->assertFalse($this->container->hasParameter('twitter_bootstrap'));
    }

    /**
     * Test wrong config
     */
    public function testWithOutLocalFontsDir()
    {
        $this->setExpectedException(
            'Symfony\Component\Config\Definition\Exception\InvalidConfigurationException',
            'The child node "local_fonts_dir" at path "twitter_bootstrap" must be configured.'
        );

        $this->loadConfiguration($this->container, 'withOutLocalFontsDir');
        $this->container->compile();
        $this->assertFalse($this->container->hasParameter('twitter_bootstrap'));
    }

    /**
     * Test wrong config
     */
    public function testWithOutLocalCss()
    {
        $this->setExpectedException(
            'Symfony\Component\Config\Definition\Exception\InvalidConfigurationException',
            'The child node "local_css" at path "twitter_bootstrap" must be configured.'
        );

        $this->loadConfiguration($this->container, 'withOutLocalCss');
        $this->container->compile();
        $this->assertFalse($this->container->hasParameter('twitter_bootstrap'));
    }

    /**
     * Test wrong config
     */
    public function testWithOutLocalTheme()
    {
        $this->setExpectedException(
            'Symfony\Component\Config\Definition\Exception\InvalidConfigurationException',
            'The child node "local_theme" at path "twitter_bootstrap" must be configured.'
        );

        $this->loadConfiguration($this->container, 'withOutLocalTheme');
        $this->container->compile();
        $this->assertFalse($this->container->hasParameter('twitter_bootstrap'));
    }
} 
