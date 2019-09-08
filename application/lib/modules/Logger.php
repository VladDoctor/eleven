<?php
/**
 * Created by PhpStorm.
 * User: RGB_Boss
 * Date: 12.08.2019
 * Time: 22:05
 */

namespace application\lib\modules;
use application\lib\modules\FileManager;
use application\lib\modules\cUrl;
use application\core\ConfigLoader;

final class Logger
{
    public static function adminLog()
    {
       /* $ipaddrs = ConfigLoader::ipaddrs();
        if( in_array($_SERVER['REMOTE_ADDR'], $ipaddrs) ):
            //2ip
            $data = cUrl::reviewParser([
                'url' => 'https://api.2ip.ua/geo.json?ip='.$_SERVER['REMOTE_ADDR'],
                'setting' => true
            ]);
            var_dump($data);
            FileManager::append(
                'application/logs/persons/admin.log.json', true, json_decode($data, true)
            );
        else:
            //TODO
        endif;*/
    }

    public static function userLog()
    {
        //Что-то
    }

}