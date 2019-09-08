<?php

namespace application\lib\modules;

interface AutoloaderInt
{
    public static function autoRegister();
}

final class Autoloader
{
    public static function autoRegister()
    {
        return spl_autoload_register(function($class) //new objects
        {
            $path = str_replace('\\', '/', "$class.php");
            if(file_exists($path)):
                require_once $path;
            endif;
        });
    }
}

?>