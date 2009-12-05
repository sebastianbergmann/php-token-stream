PHP_TokenStream
===============

Installation
------------

PHP_TokenStream should be installed using the [PEAR Installer](http://pear.php.net/). This installer is the backbone of PEAR, which provides a distribution system for PHP packages, and is shipped with every release of PHP since version 4.3.0.

The PEAR channel (`pear.phpunit.de`) that is used to distribute PHP_TokenStream needs to be registered with the local PEAR environment:

    sb@ubuntu ~ % pear channel-discover pear.phpunit.de
    Adding Channel "pear.phpunit.de" succeeded
    Discovery of channel "pear.phpunit.de" succeeded

This has to be done only once. Now the PEAR Installer can be used to install packages from the PHPUnit channel:

    sb@ubuntu tokenstream % pear install phpunit/PHP_TokenStream-beta
    downloading PHP_TokenStream-0.9.1.tgz ...
    Starting to download PHP_TokenStream-0.9.1.tgz (5,113 bytes)
    ...done: 5,113 bytes
    install ok: channel://pear.phpunit.de/PHP_TokenStream-0.9.1

After the installation you can find the PHP_TokenStream source files inside your local PEAR directory; the path is usually `/usr/lib/php/PHP`.
