<?php

namespace application\lib\modules;

class ServerUrl
{
    private function __construct()
    {
        //BLOCKED
    }

    public static function get($getKey)
    {
        $getKey = "$getKey=";
        $getValue = mb_substr(
            $_SERVER['REQUEST_URI'], (mb_strpos($_SERVER['REQUEST_URI'], $getKey, 0) + mb_strlen($getKey)
        ));
        $getValue = mb_substr($getValue, 0, mb_strpos($getValue, '&'));
        return $getValue;
    }

    private function __clone()
    {
        //BLOCKED
    }

    private function __wakeup()
    {
        //BLOCKED
    }
}

?>