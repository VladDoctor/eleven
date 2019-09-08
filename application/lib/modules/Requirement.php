<?php

namespace application\lib\modules;
use application\lib\modules\system\sender\Sender;
use application\lib\modules\system\sender\Email;

interface RequirementInt
{
    public static function except($exceptionCode);
    public static function view($viewFile);
    public static function controllerObjective($controllerName);
    public static function controllerStatic($controllerName, $controllerMethod);
    public static function mvcException($exceptionCode, $problemObject);
}

class Requirement implements RequirementInt
{
    public static function except($exceptionCode)
    {
        switch ($exceptionCode):
            case 404:
                require 'application/views/templates/excepts/404.mway.php';
                break;
            case 500:
                require 'application/views/templates/excepts/500.mway.php';
                break;
            case 200:
                require 'application/views/templates/excepts/200.mway.php';
                break;
        endswitch;
    }

    public static function view($viewFile)
    {
        require "application/views/templates/public/$viewFile";
    }

    public static function controllerObjective($controllerName)
    {
        require "application/controllers/objective/$controllerName";
    }

    public static function controllerStatic($controllerName, $controllerMethod)
    {
        require "application/controllers/static/$controllerName.php";
        $controllerName::$controllerMethod();
    }

    public static function mvcException($exceptionCode, $problemObject)
    {
        switch ($exceptionCode):
            case 600:
                var_dump("$problemObject - controller is not founded");
                break;
            case 700:
                var_dump("$problemObject - model is not founded");
                break;
         endswitch;
    }
}

?>