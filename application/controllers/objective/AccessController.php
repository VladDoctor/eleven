<?php

namespace application\controllers\objective;
use application\core\ConfigLoader;
use application\lib\modules\cUrl;
use application\lib\modules\Requirement;
use application\lib\modules\ServerUrl;
use application\models\User;

final class AccessController
{
     /**
     * AccessController constructor.
     **/
    public function __construct()
    {
        $this->uri = 'https://oauth.vk.com/access_token?';
        $this->dataApiHttp = ConfigLoader::apiConfig('vk', 'access');
        $this->dataApiHttp['code'] = ServerUrl::get('code');
        $this->dataApiHttp = http_build_query($this->dataApiHttp);
        $this->getAccessToken();
        $this->guestData();
        User::userData(); //Здесь можно добавить статус FactoryModel. Но делать я этого, конечно, не буду.
    }

    protected function getAccessToken()
    {
        $this->userData = cUrl::reviewParser(cUrl::parserData(
            $this->uri.$this->dataApiHttp, true
        ));
    }

    public function guestData() //takes data - Vk Methods //TODO переместить в модель User
    {
        $_SESSION['guest']['userData'] = array(
            'user_id'      => $this->userData->user_id,
            'access_token' => $this->userData->access_token,
            'v'            => '5.52'                          //for requests
        );
    }
}

$tokennedGuest = new AccessController() or die('Guest error');

?>