<?php

namespace application\controllers\objective;
//use application\core\interfaces\ControllerInt;
use application\lib\modules\FactoryModel;

final class ResponceController
{
    public function __construct()
    {
        $this->newBranch = FactoryModel::selectType('application\models\User');
        return $this->newBranch;
    }

    public static function hello()
    {
        echo "Hello world";
    }
}

$responce = new ResponceController();

?>