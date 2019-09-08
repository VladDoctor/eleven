<?php

namespace application\controllers\objective;
use application\lib\modules\Header;

final class ExitController
{
    public function __construct()
    {
        $this->sessionExplode();
        Header::redirect('http://u0742966.isp.regruhosting.ru');
    }

    private function sessionExplode()
    {
        $_SESSION = array();
        @setcookie('PHPSESSID', '', time() - 3600);
        session_destroy();
    }
}

$exit = new ExitController();

?>