<?php

use application\lib\modules\system\sender\Sender;
use application\models\Admin;
use application\lib\modules\system\sender\Email;
use application\core\Twig;
use \Twig\Loader\ArrayLoader;
use \Twig\Environment;
use application\core\ConfigLoader;
use application\lib\modules\FactoryModel;

class AdminController
{
    public static function access()
    {
        $ipaddrs = ConfigLoader::ipaddrs();
        if( in_array($_SERVER['REMOTE_ADDR'], $ipaddrs) ):
            $mail = Sender::sendMessage(
                'application\lib\modules\system\sender\Email',
                [
                    'emailTo' => null,
                    'emailTheme' => null,
                    'emailMessage' => null
                ]
            );
            var_dump($mail);
            AdminController::adminInstance($_SERVER['REMOTE_ADDR']);
            Twig::templateLoader('admin-panel/apanel.html', [
                'dir' => 'application/views/templates/public/admin-panel/',
                'ipaddr'  => $_SERVER['REMOTE_ADDR']
            ]);
        else:
            //TODO permission error.
        endif;
    }

    public static function adminInstance($ipaddr)
    {
        $admin = FactoryModel::selectType('application\models\Admin');
    }
}

?>