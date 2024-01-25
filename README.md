"# phpcourse2" 


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