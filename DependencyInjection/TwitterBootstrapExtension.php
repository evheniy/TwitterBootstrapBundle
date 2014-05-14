<?php

namespace Evheniy\TwitterBootstrapBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

/**
 * Class TwitterBootstrapExtension
 *
 * @package Evheniy\TwitterBootstrapBundle\DependencyInjection
 */
class TwitterBootstrapExtension extends Extension
{
    /**
     * @see Symfony\Component\DependencyInjection\Extension.ExtensionInterface::load()
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        if (isset($configs[0]['version'])) {
            $container->setParameter('twitter_bootstrap.version', $configs[0]['version']);
        } else {
            $container->setParameter('twitter_bootstrap.version', '3.1.1');
        }
        if (isset($configs[0]['html5']) && empty($configs[0]['html5'])) {
            $container->setParameter('twitter_bootstrap.html5', false);
        } else {
            $container->setParameter('twitter_bootstrap.html5', true);
        }
        if (!empty($configs[0]['async'])) {
            $container->setParameter('twitter_bootstrap.async', true);
        } else {
            $container->setParameter('twitter_bootstrap.async', false);
        }
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
    }

    /**
     * @see Symfony\Component\DependencyInjection\Extension.ExtensionInterface::getAlias()
     * @codeCoverageIgnore
     */
    public function getAlias()
    {
        return 'twitter_bootstrap';
    }
}
