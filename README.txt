Flooer Framework
Version 0.6.2


PROJECT INFORMATION
-------------------

Flooer Framework is a web application framework for a simple webapps.

LANGUAGE:       PHP

REQUIREMENTS:   PHP 5.2 or later

LICENSE:        BSD License (2 Clause)
                http://www.freebsd.org/copyright/freebsd-license.html

AUTHOR:         Akira Ohgaki <akiraohgaki@gmail.com>

PROJECT'S PAGE: https://github.com/akiraohgaki/flooer


INSTALLATION
------------

Download and extract the archive of Flooer Framework
from https://github.com/akiraohgaki/flooer
then place the library directory to your web server.


DIRECTORY STRUCTURE
-------------------

Recommended directory structure:

project/
    library/
        Flooer/
    application/
        controllers/
            Index.php
            Error.php
        views/
            layout.html
            index/
                index.html
            error/
                error.html
        models/
            model.php
        configs/
            config.ini
        locales/
            en_US/
                LC_MESSAGES/
                    messages.mo
        logs/
            error.log
    public/
        .htaccess
        index.php


URI MAPPING
-----------

Flooer Framework have a URI mapping feature and using with
URI rewriting is recommended.

If your web server is Apache, please create a mod_rewrite
rules as a .htaccess file into your website root directory.

Example of the mod_rewrite rules:

# [.htaccess]
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]


BUILD WEBAPP WITH FRAMEWORK
---------------------------

Please see the source code of example app in example directory.
