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
        $twitterBootstrap = $this->assertTwitterBootstrap(1);
        $this->assertNotEmpty($twitterBootstrap['local_js']);
        $this->assertEquals($twitterBootstrap['local_js'], '@TwitterBootstrapBundle/Resources/public/js/bootstrap.min.js');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_js'), '@TwitterBootstrapBundle/Resources/public/js/bootstrap.min.js');
        $this->assertNotEmpty($twitterBootstrap['local_fonts_dir']);
        $this->assertEquals($twitterBootstrap['local_fonts_dir'], '@TwitterBootstrapBundle/Resources/public/fonts/');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_fonts_dir'), '@TwitterBootstrapBundle/Resources/public/fonts/');
        $this->assertNotEmpty($twitterBootstrap['local_css']);
        $this->assertEquals($twitterBootstrap['local_css'], '@TwitterBootstrapBundle/Resources/public/css/bootstrap.min.css');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_css'), '@TwitterBootstrapBundle/Resources/public/css/bootstrap.min.css');
        $this->assertNotEmpty($twitterBootstrap['local_theme']);
        $this->assertEquals($twitterBootstrap['local_theme'], '@TwitterBootstrapBundle/Resources/public/css/bootstrap-theme.min.css');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_theme'), '@TwitterBootstrapBundle/Resources/public/css/bootstrap-theme.min.css');
        $this->assertEmpty($twitterBootstrap['local_cdn']);
        $this->assertEquals($twitterBootstrap['local_cdn'], '');
        $this->assertNotEmpty($twitterBootstrap['version']);
        $this->assertEquals($twitterBootstrap['version'], '3.3.4');
        $this->assertNotEmpty($twitterBootstrap['html5']);
        $this->assertTrue($twitterBootstrap['html5']);
        $this->assertEmpty($twitterBootstrap['async']);
        $this->assertFalse($twitterBootstrap['async']);
    }

    /**
     * @return array
     */
    protected function assertTwitterBootstrap()
    {
        $this->assertTrue($this->container->hasParameter('twitter_bootstrap'));
        $this->assertTrue($this->container->hasParameter('twitter_bootstrap.local_js'));
        $this->assertTrue($this->container->hasParameter('twitter_bootstrap.local_fonts_dir'));
        $this->assertTrue($this->container->hasParameter('twitter_bootstrap.local_css'));
        $this->assertTrue($this->container->hasParameter('twitter_bootstrap.local_theme'));
        $twitterBootstrap = $this->container->getParameter('twitter_bootstrap');
        $this->assertNotEmpty($twitterBootstrap);
        $this->assertTrue(is_array($twitterBootstrap));

        return $twitterBootstrap;
    }

    /**
     * Test normal config
     */
    public function testWithLocal()
    {
        $this->loadConfiguration($this->container, 'withLocal')->compile();
        $twitterBootstrap = $this->assertTwitterBootstrap(2);
        $this->assertNotEmpty($twitterBootstrap['local_js']);
        $this->assertEquals($twitterBootstrap['local_js'], 'bootstrap.min.js');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_js'), 'bootstrap.min.js');
        $this->assertNotEmpty($twitterBootstrap['local_fonts_dir']);
        $this->assertEquals($twitterBootstrap['local_fonts_dir'], 'fonts/');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_fonts_dir'), 'fonts/');
        $this->assertNotEmpty($twitterBootstrap['local_css']);
        $this->assertEquals($twitterBootstrap['local_css'], 'bootstrap.min.css');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_css'), 'bootstrap.min.css');
        $this->assertNotEmpty($twitterBootstrap['local_theme']);
        $this->assertEquals($twitterBootstrap['local_theme'], 'bootstrap-theme.min.css');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_theme'), 'bootstrap-theme.min.css');
    }

    /**
     * Test normal config
     */
    public function testTest()
    {
        $this->loadConfiguration($this->container, 'test')->compile();
        $twitterBootstrap = $this->assertTwitterBootstrap(3);
        $this->assertNotEmpty($twitterBootstrap['local_js']);
        $this->assertEquals($twitterBootstrap['local_js'], 'bootstrap.min.js');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_js'), 'bootstrap.min.js');
        $this->assertNotEmpty($twitterBootstrap['local_fonts_dir']);
        $this->assertEquals($twitterBootstrap['local_fonts_dir'], 'fonts/');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_fonts_dir'), 'fonts/');
        $this->assertNotEmpty($twitterBootstrap['local_css']);
        $this->assertEquals($twitterBootstrap['local_css'], 'bootstrap.min.css');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_css'), 'bootstrap.min.css');
        $this->assertNotEmpty($twitterBootstrap['local_theme']);
        $this->assertEquals($twitterBootstrap['local_theme'], 'bootstrap-theme.min.css');
        $this->assertEquals($this->container->getParameter('twitter_bootstrap.local_theme'), 'bootstrap-theme.min.css');
        $this->assertEmpty($twitterBootstrap['local_cdn']);
        $this->assertEquals($twitterBootstrap['local_cdn'], '');
        $this->assertNotEmpty($twitterBootstrap['version']);
        $this->assertEquals($twitterBootstrap['version'], '3.3.0');
        $this->assertEmpty($twitterBootstrap['html5']);
        $this->assertFalse($twitterBootstrap['html5']);
        $this->assertNotEmpty($twitterBootstrap['async']);
        $this->assertTrue($twitterBootstrap['async']);
    }

    /**
     * Test filterCdn method
     */
    public function testFilterCdn()
    {
        $reflectionClass = new \ReflectionClass('\Evheniy\TwitterBootstrapBundle\DependencyInjection\TwitterBootstrapExtension');
        $method = $reflectionClass->getMethod('filterCdn');
        $method->setAccessible(true);
        $this->assertEquals($method->invoke($this->extension, ''), '');
        $this->assertEquals($method->invoke($this->extension, 'cdn.site.com'), 'cdn.site.com');
        $this->assertEquals($method->invoke($this->extension, '//cdn.site.com'), 'cdn.site.com');
        $this->assertEquals($method->invoke($this->extension, 'http://cdn.site.com'), 'cdn.site.com');
        $this->assertEquals($method->invoke($this->extension, 'http://cdn.site.com/'), 'cdn.site.com');
        $this->assertEquals($method->invoke($this->extension, 'https://cdn.site.com'), 'cdn.site.com');
        $this->assertEquals($method->invoke($this->extension, 'https://cdn.site.com/'), 'cdn.site.com');
    }
}