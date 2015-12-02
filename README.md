TwitterBootstrapBundle
=================

[![knpbundles.com](http://knpbundles.com/evheniy/TwitterBootstrapBundle/badge)](http://knpbundles.com/evheniy/TwitterBootstrapBundle)

[![Latest Stable Version](https://poser.pugx.org/evheniy/twitter-bootstrap-bundle/v/stable.svg)](https://packagist.org/packages/evheniy/twitter-bootstrap-bundle) [![Total Downloads](https://poser.pugx.org/evheniy/twitter-bootstrap-bundle/downloads.svg)](https://packagist.org/packages/evheniy/twitter-bootstrap-bundle) [![Latest Unstable Version](https://poser.pugx.org/evheniy/twitter-bootstrap-bundle/v/unstable.svg)](https://packagist.org/packages/evheniy/twitter-bootstrap-bundle) [![License](https://poser.pugx.org/evheniy/twitter-bootstrap-bundle/license.svg)](https://packagist.org/packages/evheniy/twitter-bootstrap-bundle)

[![Build Status](https://travis-ci.org/evheniy/TwitterBootstrapBundle.svg?branch=master)](https://travis-ci.org/evheniy/TwitterBootstrapBundle)
[![Coverage Status](https://coveralls.io/repos/evheniy/TwitterBootstrapBundle/badge.svg?branch=master&service=github)](https://coveralls.io/github/evheniy/TwitterBootstrapBundle?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/evheniy/TwitterBootstrapBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/evheniy/TwitterBootstrapBundle/?branch=master) [![Build Status](https://scrutinizer-ci.com/g/evheniy/TwitterBootstrapBundle/badges/build.png?b=master)](https://scrutinizer-ci.com/g/evheniy/TwitterBootstrapBundle/build-status/master)

This bundle provides TwitterBootstrap in Symfony2 from CDN maxcdn.bootstrapcdn.com

Documentation
-------------

You can change TwitterBootstrap version:

    twitter_bootstrap:
        version: 3.3.4
        
You can set TwitterBootstrap local version (it helps if maxcdn doesn't work).

    twitter_bootstrap:
        local_js: '@AppBundle/Resources/public/js/bootstrap.min.js'

Default value: '@TwitterBootstrapBundle/Resources/public/js/bootstrap.min.js'

    twitter_bootstrap:
        local_fonts_dir: '@AppBundle/Resources/public/fonts/'

Default value: '@TwitterBootstrapBundle/Resources/public/fonts/' 
 
    twitter_bootstrap:
        local_css: '@AppBundle/Resources/public/css/bootstrap.min.css'

Default value: '@TwitterBootstrapBundle/Resources/public/css/bootstrap.min.css'

    twitter_bootstrap:
        local_theme: '@AppBundle/Resources/public/css/bootstrap-theme.min.css'

Default value: '@TwitterBootstrapBundle/Resources/public/css/bootstrap-theme.min.css'
        

You can set local CDN:

    twitter_bootstrap:
        local_cdn: 'cdn.domain.com'


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
    twitter_bootstrap: ~

    or

    #TwitterBootstrapBundle
    twitter_bootstrap:
        local_js: '@AppBundle/Resources/public/js/bootstrap.min.js'
        local_fonts_dir: '@AppBundle/Resources/public/fonts/'
        local_css: '@AppBundle/Resources/public/css/bootstrap.min.css'
        local_theme: '@AppBundle/Resources/public/css/bootstrap-theme.min.css'
        local_cdn: 'cdn.domain.com'
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
