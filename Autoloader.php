<?php


class Autoloader
{
    public static function register()
    {
       /* spl_autoload_register(function ($class) {
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
            if (file_exists($file)) {
                require $file;
                return true;
            }
            return false;
        });*/
        spl_autoload_extensions('.php');
        spl_autoload_register(function  ($className)
        {
            $extension =  spl_autoload_extensions();
            $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
            $filename = __DIR__ . DIRECTORY_SEPARATOR . $className . $extension;
            if (is_readable($filename)) {
                require_once($filename);
            } else {
                die("Classe ($filename) non trouvée");
            }
        });
    }

    public static function MyAutoload($className)
    {
        $extension =  spl_autoload_extensions();
        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        $filename = __DIR__ . DIRECTORY_SEPARATOR . $className . $extension;
        if (is_readable($filename)) {
            require_once($filename);
        } else {
            die("Not Found Class ($filename)");
        }
    }


}