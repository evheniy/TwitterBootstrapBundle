<?php

namespace Evheniy\TwitterBootstrapBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Definition\Processor;
use Evheniy\JqueryBundle\Helper\CdnHelper;

/**
 * Class TwitterBootstrapExtension
 *
 * @package Evheniy\TwitterBootstrapBundle\DependencyInjection
 */
class TwitterBootstrapExtension extends Extension
{
    /**
     * @param array            $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);
        $config['local_cdn'] = CdnHelper::createInstance()->filterCdn($config['local_cdn']);
        $container->setParameter('twitter_bootstrap', $config);
        $container->setParameter('twitter_bootstrap.local_js', $config['local_js']);
        $container->setParameter('twitter_bootstrap.local_fonts_dir', $config['local_fonts_dir']);
        $container->setParameter('twitter_bootstrap.local_css', $config['local_css']);
        $container->setParameter('twitter_bootstrap.local_theme', $config['local_theme']);
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return 'twitter_bootstrap';
    }
}
