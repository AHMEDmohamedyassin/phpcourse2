"# phpcourse2" 

/// video number 30 is very important 

xampp config file : C:\xampp\apache\conf\httpd.conf
xampp virtual host file config : C:\xampp\apache\conf\extra\httpd-vhosts.conf
windows hosts file to add local domain : C:\windows\system32\drivers\etc\hosts




// uris

coding standerd : https://www.php-fig.org/psr/psr-1/

namespace manual : https://www.php.net/manual/en/language.namespaces.rules.php


/////////////////////////////////////////////////
in composer.json file to make composer autoload works then run : composer dump-autoload , to recreate autoload file , preferable to run : composer dump-autoload -o , to optimize autoload file  , video : 39

    "autoload": {
        "psr-4": {
            "Classes\\":"Classes/"
        }
    }
///////////////////////////////////////////////




// .env
to create .env environment this repo is required : https://github.com/vlucas/phpdotenv