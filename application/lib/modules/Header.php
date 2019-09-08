<?php

namespace application\lib\modules;

abstract class HeaderAbstr
{
    public static function deleteHeader()
    {
        @header_remove();
    }

    abstract public static function information();
    abstract public static function ok();
    abstract public static function redirect($redirectUrl);
    abstract public static function guestException();
    abstract public static function serverException();
}

final class Header extends HeaderAbstr
{
    public static function information()
    {
        //code-checker if-elseif-else.
        http_response_code(100);
    }

    public static function ok()
    {
        http_response_code(200);
    }

    public static function redirect($redirectUrl)
    {
        self::deleteHeader();
        @header("Location: $redirectUrl");
    }

    public static function guestException()
    {
        http_response_code(400);
    }

    public static function serverException()
    {
        http_response_code(500);
    }
}

?>