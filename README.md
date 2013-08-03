# PHP_TokenStream

## Installation

You can use [Composer](http://getcomposer.org/) or the [PEAR Installer](http://pear.php.net/manual/en/guide.users.commandline.cli.php) to download and install this package as well as its dependencies.

### Composer

To add this package as a local, per-project dependency to your project, simply add a dependency on `phpunit/php-token-stream` to your project's `composer.json` file. Here is a minimal example of a `composer.json` file that just defines a dependency on PHP_TokenStream:

    {
        "require": {
            "phpunit/php-token-stream": "*"
        }
    }

### PEAR Installer

The following two commands (which you may have to run as `root`) are all that is required to install this package using the PEAR Installer:

    pear config-set auto_discover 1
    pear install pear.phpunit.de/PHP_TokenStream
