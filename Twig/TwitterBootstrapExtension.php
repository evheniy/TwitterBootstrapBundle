<?php

namespace Evheniy\TwitterBootstrapBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class TwitterBootstrapExtension
 *
 * @package Evheniy\TwitterBootstrapBundle\Twig
 */
class TwitterBootstrapExtension extends \Twig_Extension
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return array
     */
    public function getGlobals()
    {
        return array(
            'twitter_bootstrap' => $this->container->getParameter('twitter_bootstrap')
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'twitter_bootstrap';
    }
}
