## AcAssets

[![Build Status](https://travis-ci.org/acelaya/ZF2-AcAssets.svg?branch=master)](https://travis-ci.org/acelaya/ZF2-AcAssets)
[![Latest Stable Version](https://poser.pugx.org/acelaya/zf2-acassets/v/stable.png)](https://packagist.org/packages/acelaya/zf2-acassets)
[![Total Downloads](https://poser.pugx.org/acelaya/zf2-acassets/downloads.png)](https://packagist.org/packages/acelaya/zf2-acassets)
[![License](https://poser.pugx.org/acelaya/zf2-acassets/license.png)](https://packagist.org/packages/acelaya/zf2-acassets)

This module can be used to define assets (CSS / JS) in configuration files instead of defining them directly in a layout, injecting defined scripts and stylesheets in InlineScript, HeadScript and HeadLink.

This allows to take advantage of Zend Framework's configuration system, overriding global configurations with local configuration or even defining different configurations for each environment. Take a look at this [advanced configuration tricks](http://framework.zend.com/manual/2.2/en/tutorials/config.advanced.html).

It only works with existing assets in public directory. It does not minify or concatenate assets. For this purpose, please look at other modules like [AssetsManager](https://github.com/RWOverdijk/AssetManager) or [zf2-assetic-module](https://github.com/widmogrod/zf2-assetic-module).

### Installation

Install composer in your project.

```
curl -s http://getcomposer.org/installer | php
```

Define dependencies in your composer.json file

```json
{
    "require": {
        "acelaya/zf2-acassets": "2.0.*"
    }
}
```

Install dependencies

```
php composer.phar install
```

After installing the module, copy `vendor/acelaya/zf2-acassets/config/assets.global.php.dist` to `config/autoload/assets.global.php`. This will provide an empty configuration file that will be explained later.

Finally enable the module in your `application.config.php` file.

```php
'modules' => array(
    'AcAssets', // <-- Add this line
    'Application',
),
```

### Usage

This module is very easy to use. You only need to setup your assets configuration. If the module is enabled it will inject all configured asstes automatically at DISPATCH and DIPATCH_ERROR.

Then, you only need to print the headScript, inlineScript and headLink in your layout or view. They will be fully configured.

```php
<html>

    <head>
        <title>My web app</title>
        <?php
            echo $this->headLink();
            echo $this->headScript();
        ?>
    </head>

    <body>
        <h1>Hi!!</h1>

        <?php echo $this->inlineScript() ?>
    </body>

</html>
```

If there is some configuration you need to do that is not supported by this module, you can already append other files and stylesheets to any element in a regular way.

```php
[...]

<head>
    <title>My web app</title>
    <?php
        echo $this->headLink()->appendStylesheet('/assets/css/mi-styles.css', 'all'); // <-- This is compatible with this module
    ?>
</head>

[...]
```

### Configuration

An example of a configuration file could be this.

```php
<?php
return array(
    'css'   => array(
        'path'         => '/css',
        'stylesheets'  => array(
            'bootstrap'    => array(
                'name'     => 'bootstrap.min.css',
            ),
            'font.awesome'    => array(
                'name'     => 'fonts/font-awesome.min.css',
            ),
            'main'         => array(
                'name'     => 'main.min.css',
            ),
            'print'        => array(
                'name'     => 'print.min.css',
                'media'    => 'print'
            )
        )
    ),
    'js'    => array(
        'path'      => '/js',
        'inline'    => array(
            'bootstrap' => array(
                'name' => 'bootstrap.min.js',
                'priority' => 5
            ),
            'jquery' => array(
                'name' => 'jquery.min.js',
                'priority' => 10
            ),
            'main' => array(
                'name' => 'main.min.js',
            ),
        ),
        'head'      => array(
            'respond' => array(
                'name'     => 'respond.min.js',
                'options'  => array('conditional' => 'lt IE 9')
            ),
            'html5shiv' => array(
                'name'     => 'html5shiv.min.js',
                'options'  => array('conditional' => 'lt IE 9')
            ),
        )
    )
);
```

The `css` block wraps the stylesheets that will be included in the headLink element. The nested `path` is used to define a base path that will be prepended to each defined stylesheet. It will be "/" if not defined.

The `stylsheets` block is an array with all the stylsheets that need to be injected. It is an associative array to allow configuration overriding, but the key is just orientative. Each value has a `name` property, which is the filename relative to the `path` property. It can have an optional `media` property.

The `js` block wraps the files that will be included in headScript and inlineScript. It also has a nested `path` with the basepath of the scripts.

Both `inline` and `head` are associative arrays with the files that should be injected in the layout. As in `stylesheets`, the `name` property is the filename relative to `path`. It also has an `options` property which is the third param used when calling the method `appendFile`.

The scripts and stylesheets are appended in the order they are defined in `css/stylesheets`, `js/inline` and `js/head`, but a `priority` property can be defined in any of them to set the order in which they should be appended. It's 1 by default.

### TODO

Look at the [issues](https://github.com/acelaya/ZF2-AcAssets/issues) page to know what is planned to be included in the module.