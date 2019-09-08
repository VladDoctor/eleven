<?php

namespace application\lib\modules;
use application\models\User;
use application\models\Admin;

class FactoryModel
{
    public static function selectType($classType)
    {
        if( class_exists($classType) ):
            return new $classType;
        else:
            echo 'null';
            return null; //http_respoce_code()
        endif;
    }
}

?>