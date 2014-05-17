TwitterBootstrapBundle
=================

This bundle provides [Twitter Bootstrap][1] in Symfony2 from CDN netdna.bootstrapcdn.com

Documentation
-------------

You can change Twitter Bootstrap version:

    twitter_bootstrap:
        version: 3.1.1

You can use old html version:

    twitter_bootstrap:
        html5: false

Default value: true. If false script will be with type="text/javascript"

You can use async loading:

    twitter_bootstrap:
        async: true

Default value: false. If true script will be with async="async"

Installation
------------

    AppKernel:
        public function registerBundles()
            {
                $bundles = array(
                    ...
                    new Evheniy\TwitterBootstrapBundle\TwitterBootstrapBundle(),
                );
                ...

    config.yml:
        #TwitterBootstrapBundle
        twitter_bootstrap: ~

        or

        #TwitterBootstrapBundle
        twitter_bootstrap:
            version: 3.1.1
            html5: true
            async: false


    {% include "TwitterBootstrapBundle:TwitterBootstrap:css.html.twig" %}
    {% include "TwitterBootstrapBundle:TwitterBootstrap:js.html.twig" %}

License
-------

This bundle is under the MIT license. See the complete license in the bundle:

    Resources/meta/LICENSE
    
    [MakeDev.org][2]

[1]:  http://getbootstrap.com/
[2]:  http://makedev.org/
