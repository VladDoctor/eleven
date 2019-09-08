<?php

namespace application\models;
//use application\core\interfaces\ModelInt;
use application\core\ConfigLoader;
use application\lib\modules\Header;
use application\lib\Requirement;
use application\lib\modules\cUrl;
use application\core\DataBase;
use application\lib\modules\system\encryption\TokenManager;
use application\lib\modules\Logger;

final class User
{
    public function __construct()
    {
        $this->serviceUserData = array();
        $this->dataApiHttp = http_build_query(ConfigLoader::apiConfig('vk', 'responce'));
        $this->authorization();
        $this->token = $_SESSION['guest']["serviceUserData"]["response"][0]->token;

        $this->checkUserSession('first_name', false)->first_name = $_SESSION['guest']["serviceUserData"]["response"][0]->first_name;
        $this->checkUserSession('second_name', false)->second_name = $_SESSION['guest']["serviceUserData"]["response"][0]->first_surname;
        $this->checkUserSession('game_level', true)->game_level = $_SESSION['guest']["serviceUserData"]["response"][0]->game_level;
        $this->checkUserSession('skin', true)->skin = $_SESSION['guest']["serviceUserData"]["response"][0]->skin;
        $this->checkUserSession('coins', true)->coins = $_SESSION['guest']["serviceUserData"]["response"][0]->coins;

        Logger::userLog();
    }
    //Тут я просто захотел написать как можно больше, возможно, неоптимизированного кода.
    protected function checkUserSession($sessionAtr, $tokenManager=false)
    {
        switch($sessionAtr):
            case 'first_name':
                if( isset($_SESSION['guest']["serviceUserData"]["response"][0]->first_name) ){
                    return $this;
                }else{
                    //TODO error
                }
                break;

            case 'second_name':
                if( isset($_SESSION['guest']["serviceUserData"]["response"][0]->second_name) ){
                    return $this;
                }else{
                    //TODO error
                }
                break;

            case 'game_level':
                if( isset($_SESSION['guest']["serviceUserData"]["response"][0]->game_level) ){
                    return $this;
                }else{
                    $_SESSION['guest']["serviceUserData"]["response"][0]->game_level = TokenManager::getLevel($this->token);
                }
                break;

            case 'skin':
                if( isset($_SESSION['guest']["serviceUserData"]["response"][0]->skin) ){
                    return $this;
                }else{
                    $_SESSION['guest']["serviceUserData"]["response"][0]->skin = TokenManager::getSkin($this->token);
                }
                break;

            case 'coins':
                if( isset($_SESSION['guest']["serviceUserData"]["response"][0]->coins) ){
                    return $this;
                }else{
                    $_SESSION['guest']["serviceUserData"]["response"][0]->coins = TokenManager::getCoins($this->token);
                }
                break;
        endswitch;
    }

    protected function authorization()
    {
        Header::redirect("https://oauth.vk.com/authorize?$this->dataApiHttp");
    }

    public static function userData()
    {
        if (isset($_SESSION['guest']['userData'])):
            $curlOutput = cUrl::reviewParser(cUrl::parserData(
                'https://api.vk.com/method/users.get?' . http_build_query($_SESSION['guest']['userData']), true
            ));
            $_SESSION['guest']['serviceUserData'] = (array)$curlOutput;
            self::userDB();
        else:
            Requirement::except(404);
        endif;
    }

    public static function userDB()
    {
        $dBase = DataBase::connection();
        $_SESSION['guest']["serviceUserData"]["response"][0]->first_name;
        $dBase->review('users', $_SESSION['guest']["serviceUserData"]["response"][0]->id)->insert(
            'insert into users (name, surname, token, level) values (:name, :surname, :token, :level
         )', [
            ':name'    =>  $_SESSION['guest']["serviceUserData"]["response"][0]->first_name,
            ':surname' =>  $_SESSION['guest']["serviceUserData"]["response"][0]->last_name,
            ':token'   =>  $_SESSION['guest']["serviceUserData"]["response"][0]->id,
            ':level'   => 0
        ], false);
    }
}

?>