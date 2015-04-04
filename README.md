TwitterBootstrapBundle
=================

[![knpbundles.com](http://knpbundles.com/evheniy/TwitterBootstrapBundle/badge)](http://knpbundles.com/evheniy/TwitterBootstrapBundle)

This bundle provides TwitterBootstrap in Symfony2 from CDN maxcdn.bootstrapcdn.com

Documentation
-------------

You should set TwitterBootstrap local version (it helps if maxcdn doesn't work).
Those parameters are required:

    twitter_bootstrap:
        local_js: '@AppBundle/Resources/public/js/bootstrap.min.js'
        local_fonts_dir: '@AppBundle/Resources/public/fonts/'
        local_css: '@AppBundle/Resources/public/css/bootstrap.min.css'
        local_theme: '@AppBundle/Resources/public/css/bootstrap-theme.min.css'



You can change TwitterBootstrap version:

    twitter_bootstrap:
        version: 3.3.4

You can set local CDN:

    twitter_bootstrap:
        local_cdn: 'http://img.domain.com/'


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

    $ composer require evheniy/twitter-bootstrap-bundle "1.*"

Or add to composer.json

    "evheniy/twitter-bootstrap-bundle": "1.*"

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
    twitter_bootstrap:
        local_js: '@AppBundle/Resources/public/js/bootstrap.min.js'
        local_fonts_dir: '@AppBundle/Resources/public/fonts/'
        local_css: '@AppBundle/Resources/public/css/bootstrap.min.css'
        local_theme: '@AppBundle/Resources/public/css/bootstrap-theme.min.css'

    or

    #TwitterBootstrapBundle
    twitter_bootstrap:
        local_js: '@AppBundle/Resources/public/js/bootstrap.min.js'
        local_fonts_dir: '@AppBundle/Resources/public/fonts/'
        local_css: '@AppBundle/Resources/public/css/bootstrap.min.css'
        local_theme: '@AppBundle/Resources/public/css/bootstrap-theme.min.css'
        local_cdn: 'http://img.domain.com/'
        version: 3.3.4
        html5: true
        async: false

And Assetic Configuration in config.yml:

    #Assetic Configuration
    assetic:
        bundles: [ TwitterBootstrapBundle ]

Add this string to your layout (styles and js)

    <html>
        <head>
        ...

        {%- include "TwitterBootstrapBundle:TwitterBootstrap:css.html.twig" -%}
        </head>
        <body>
        ...

        {%- include "TwitterBootstrapBundle:TwitterBootstrap:js.html.twig" -%}
        </body>
    </html>
The last step

    app/console assetic:dump --env=prod --no-debug

License
-------

This bundle is under the [MIT][3] license.

[Документация на русском языке][1]

[TwitterBootstrap][2]

[1]:  http://makedev.org/articles/symfony/bundles/twitter_bootstrap_bundle.html
[2]:  http://getbootstrap.com/
[3]:  https://github.com/evheniy/TwitterBootstrapBundle/blob/master/Resources/meta/LICENSE
