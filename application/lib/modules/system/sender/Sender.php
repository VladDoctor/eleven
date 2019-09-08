<?php
/**
 * Created by PhpStorm.
 * User: RGB_Boss
 * Date: 14.08.2019
 * Time: 23:39
 */

namespace application\lib\modules\system\sender;

abstract class Sender
{
    public static $instance = null;
    public static $senderData;

    public static function sendMessage($senderType, $senderData=null)
    {
        if( (self::$instance == NULL) && (class_exists($senderType)) ):
            self::$instance = new $senderType($senderData);         //This is provider for upload messange.
            self::$senderData = $senderData;
        endif;

        return self::$instance;
    }

    abstract public function sending(&$sendData);
}

?>