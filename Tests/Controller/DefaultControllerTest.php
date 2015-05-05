<?php
namespace Evheniy\TwitterBootstrapBundle\Tests\Controller;

use Assetic\Extension\Twig\AsseticExtension;
use Assetic\Factory\AssetFactory;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Evheniy\TwitterBootstrapBundle\Twig\TwitterBootstrapExtension;
use Evheniy\TwitterBootstrapBundle\DependencyInjection\TwitterBootstrapExtension as TwitterBootstrapExtensionDI;

/**
 * Class DefaultControllerTest
 *
 * @package Evheniy\TwitterBootstrapBundle\Tests\Controller
 */
class DefaultControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    protected function getTwig(array $data)
    {
        $twig = new \Twig_Environment(
            new \Twig_Loader_Array(
                array('TwitterBootstrapBundle:TwitterBootstrap:js.html.twig' => file_get_contents(dirname(__FILE__) . '/../../Resources/views/TwitterBootstrap/js.html.twig'))
            )
        );
        $container = new ContainerBuilder();
        $extension = new TwitterBootstrapExtensionDI();
        $extension->load($data, $container);
        $twig ->addExtension(new AsseticExtension(new AssetFactory(dirname(__FILE__) . '/')));
        $twig ->addExtension(new TwitterBootstrapExtension($container));

        return $twig;
    }

    /**
     *
     */
    public function testWithCdn()
    {
        $html = $this->getTwig(array(array('local_cdn' => 'cdn.site.com')))->render('TwitterBootstrapBundle:TwitterBootstrap:js.html.twig');
        $this->assertRegExp('/href\=\"\/\/cdn\.site\.comcss\/bootstrap\.css\"/', $html);
        $this->assertRegExp('/src\=\"\/\/cdn\.site\.comjs\/bootstrap.js\"/', $html);
    }

    /**
     *
     */
    public function testWithOutCdn()
    {
        $html = $this->getTwig(array(array()))->render('TwitterBootstrapBundle:TwitterBootstrap:js.html.twig');
        $this->assertRegExp('/href\=\"css\/bootstrap\.css\"/', $html);
        $this->assertRegExp('/src\=\"js\/bootstrap.js\"/', $html);
    }
}