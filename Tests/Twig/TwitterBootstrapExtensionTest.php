<?php

namespace Evheniy\TwitterBootstrap\Tests\Twig;

use Evheniy\TwitterBootstrapBundle\Twig\TwitterBootstrapExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class TwitterBootstrapExtensionTest
 *
 * @package Evheniy\TwitterBootstrapBundle\Tests\Twig
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
        $this->container = new ContainerBuilder();
        $this->extension = new TwitterBootstrapExtension($this->container);
    }

    /**
     * Test normal config
     */
    public function testWithId()
    {
        $this->container->setParameter('twitter_bootstrap', array('local_js' => 'test'));

        $this->assertTrue($this->container->hasParameter('twitter_bootstrap'));
        $this->assertEquals($this->container->getParameter('twitter_bootstrap')['local_js'], 'test');
        $this->assertEquals($this->extension->getGlobals()['twitter_bootstrap']['local_js'], 'test');
    }

    /**
     * Test empty config
     */
    public function testWithOutLocal()
    {
        $this->assertFalse($this->container->hasParameter('twitter_bootstrap'));
        $this->setExpectedException(
            'Exception',
            'You have requested a non-existent parameter "twitter_bootstrap".'
        );
        $this->assertTrue(empty($this->extension->getGlobals()));
    }

    /**
     * Test getName()
     */
    public function testGetName()
    {
        $this->assertEquals($this->extension->getName(), 'twitter_bootstrap');
    }
} 