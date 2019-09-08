<?php
/**
 * Created by PhpStorm.
 * User: RGB_Boss
 * Date: 14.08.2019
 * Time: 23:38
 */
namespace application\lib\modules\system\sender;
use application\lib\modules\system\sender\Sender;

final class Email extends Sender
{
    public function __construct($senderData)
    {
        $this->senderData = $senderData;
        $this->sending($this->senderData);
    }

    public function sending(&$sendData)
    {
        if( is_string($sendData['emailTo']) && (is_string($sendData['emailTheme']) && (is_string($sendData['emailMessage']))) ){
            var_dump(mail(
                $sendData['emailTo'], $sendData['emailTheme'], $sendData['emailMessage']
            ));
        }else{
            die();
        }
    }

}