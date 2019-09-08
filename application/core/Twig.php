<?php

namespace application\core;
use \Twig\Loader\ArrayLoader;
use \Twig\Environment;

final class Twig
{
    private function __construct($cache)
    {
    }

    public static function tempLoad($tempName)
    {
        if (isset($tempName)):
            $loader = new ArrayLoader([
                'index' => 'Hello {{ name }}',
            ]);
            $twig = new Environment($loader);
        else:
            //TODO
        endif;
        return $twig->render('index', ['name' => 'Fabien']);
    }

    public function templateLoader($tempName, $tempArray)
    {
        global $twig;
        echo $twig->render($tempName, $tempArray);
    }

    private function __wakeup()
    {
        // TODO: Implement __wakeup() method.
    }

    private function __sleep()
    {
        // TODO: Implement __sleep() method.
    }

    private function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}


?>