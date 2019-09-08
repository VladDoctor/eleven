<?php

namespace application\models;
//use application\core\interfaces\ModelInt;
use application\core\ConfigLoader;
use application\lib\modules\Logger;

final class Admin
{
    public function __construct()
    {
        $this->ipaddrs = ConfigLoader::ipaddrs();
        $this->ipaddr = $_SERVER['REMOTE_ADDR'];
        $this->name = array_search($this->ipaddr, $this->ipaddrs);
        $this->logSeance();
        Logger::adminLog();
    }

    public function logSeance()
    {

    }
}

?>