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
     *
     * @return ContainerBuilder
     */
    protected function loadConfiguration(ContainerBuilder $container, $resource)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/Fixtures/'));
        $loader->load($resource . '.yml');

        return $container;
    }

    /**
     * Test empty config
     */
    public function testWithoutConfiguration()
    {
        $this->container->loadFromExtension($this->extension->getAlias())->compile();

        $twitterBootstrap = $this->container->getParameter('twitter_bootstrap');
        $this->assertEquals($twitterBootstrap['local_js'], '@TwitterBootstrapBundle/Resources/public/js/bootstrap.min.js');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_js'), '@TwitterBootstrapBundle/Resources/public/js/bootstrap.min.js');
        $this->assertEquals($twitterBootstrap['local_fonts_dir'], '@TwitterBootstrapBundle/Resources/public/fonts/');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_fonts_dir'), '@TwitterBootstrapBundle/Resources/public/fonts/');
        $this->assertEquals($twitterBootstrap['local_css'], '@TwitterBootstrapBundle/Resources/public/css/bootstrap.min.css');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_css'), '@TwitterBootstrapBundle/Resources/public/css/bootstrap.min.css');
        $this->assertEquals($twitterBootstrap['local_theme'], '@TwitterBootstrapBundle/Resources/public/css/bootstrap-theme.min.css');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_theme'), '@TwitterBootstrapBundle/Resources/public/css/bootstrap-theme.min.css');
        $this->assertEmpty($twitterBootstrap['local_cdn']);
        $this->assertEquals($twitterBootstrap['local_cdn'], '');
        $this->assertEquals($twitterBootstrap['version'], '3.3.4');
        $this->assertNotEmpty($twitterBootstrap['html5']);
        $this->assertTrue($twitterBootstrap['html5']);
        $this->assertEmpty($twitterBootstrap['async']);
        $this->assertFalse($twitterBootstrap['async']);
    }

    /**
     * Test normal config
     */
    public function testTest()
    {
        $this->loadConfiguration($this->container, 'test')->compile();
        $this->assertTrue($this->container->hasParameter('twitter_bootstrap'));
        $this->assertTrue($this->container->hasParameter('twitter_bootstrap.local_js'));
        $twitterBootstrap = $this->container->getParameter('twitter_bootstrap');
        $this->assertEquals($twitterBootstrap['local_js'], $this->container->getParameter('twitter_bootstrap.local_js'));
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_js'), 'bootstrap.min.js');
        $this->assertEquals($twitterBootstrap['local_fonts_dir'], $this->container->getParameter('twitter_bootstrap.local_fonts_dir'));
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_fonts_dir'), 'fonts/');
        $this->assertEquals($twitterBootstrap['local_css'], $this->container->getParameter('twitter_bootstrap.local_css'));
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_css'), 'bootstrap.min.css');
        $this->assertEquals($twitterBootstrap['local_theme'], $this->container->getParameter('twitter_bootstrap.local_theme'));
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_theme'), 'bootstrap-theme.min.css');
        $this->assertNotEmpty($twitterBootstrap['local_cdn']);
        $this->assertEquals($twitterBootstrap['local_cdn'], '//cdn.site.com');
        $this->assertEquals($twitterBootstrap['version'], '3.3.0');
        $this->assertEmpty($twitterBootstrap['html5']);
        $this->assertFalse($twitterBootstrap['html5']);
        $this->assertNotEmpty($twitterBootstrap['async']);
        $this->assertTrue($twitterBootstrap['async']);
    }
}