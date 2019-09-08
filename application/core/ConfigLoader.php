<?php

namespace application\core;

/*interface ConfigLoaderInt
{
    public static function infoConfig();
    public static function dbConfig();                                    //Interface for read config.ini
    public static function apiConfig();
}*/

final class ConfigLoader
{
    public static $configPath = 'config.ini';
    public static $PDOrmPath  = 'application/config/PDOrm/prepare.ini';
    public static $aPanel = 'application/config/aPanel/ipaddrs.ini';

    public static function infoConfig()
    {
        return parse_ini_file(ConfigLoader::$configPath, true)['info-config'];
    }

    public static function ipaddrs()
    {
        return parse_ini_file(ConfigLoader::$aPanel, true)['owns'];
    }

    public static function dbConfig()
    {
        return parse_ini_file(ConfigLoader::$configPath, true)['db-config'];
    }

    public static function prepare($prepareType)
    {
        switch ($prepareType):
            case 'users':
                return require 'application/config/PDOrm/queries/ready/users.query.php';
                break;
            //TODO cases
        endswitch;
    }

    public static function apiConfig($apiName=null, $configType=null)
    {
        if( ($apiName == 'vk') && ($configType != null)  ){ //selector for type vkapi config
            switch ($configType):
                case 'responce':
                    return parse_ini_file(ConfigLoader::$configPath, true)['vkapi-config-responce'];
                    break;
                case 'access':
                    return parse_ini_file(ConfigLoader::$configPath, true)['vkapi-config-access'];
            endswitch;
        }elseif( ($apiName == 'vk') && ($configType === null) ){
            return parse_ini_file(ConfigLoader::$configPath, true)['vkapi-config-responce'];
        }else{
            return null;
        }
    }
}

?>