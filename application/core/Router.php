<?php

namespace application\core;
use application\lib\modules\Header;
use application\lib\modules\Requirement;
use application\core\Twig;
use application\lib\modules\system\sender\Sender;
use application\lib\modules\system\sender\Email;

interface RouterInt
{
    public function get($guestRoute, $guestView, $serverController);
    public function guestRouteCheck();
    public function post();
}

class Router implements RouterInt
{
    public $routeArray = array();

    public function __construct()
    {
        $this->path = '/'.$_GET['route'];
    }

    public function guestRouteCheck()
    {
        if(!in_array($this->path, $this->routeArray)){
            Requirement::except(404);
            die();
        }
    }

    public function get($guestRoute, $guestView=NULL, $serverController=NULL)
    {
       // echo $guestView; //TODO
        $this->routeArray[] = $guestRoute;

        if( ($guestRoute == $this->path) && (!is_string($guestView)) ){
            if( is_null($guestView) ) {
                if (mb_strrpos($serverController, '@')):
                    $serverController = explode('@', $serverController);
                    if( file_exists("application/controllers/static/$serverController[0].php") ):
                        Requirement::controllerStatic($serverController[0], $serverController[1]); //TODO $serverController[1]
                    else:
                        //TODO
                    endif;
                else:
                    if( file_exists("application/controllers/objective/$serverController.php")):
                        Requirement::controllerObjective($serverController);
                    else:
                        //TODO
                    endif;
                endif;
            }else{
                Twig::templateLoader($guestView[0], $guestView[1]);
            }
        }else{
            if( $guestRoute == $this->path ){
                if( file_exists("application/views/templates/public/$guestView") && ($serverController == NULL) ):
                    Requirement::view($guestView);
                elseif( file_exists("application/views/templates/public/$guestView") && ($serverController != NULL) ):
                    try{
                        if( is_string($serverController) && (mb_strrpos($serverController, '@') || mb_strrpos($serverController, '@')) ) {
                            if( mb_strrpos($serverController, '@') ):
                                $serverController = explode('@', $serverController);
                                if( file_exists("application/controllers/static/$serverController[0].php") ):
                                    Requirement::controllerStatic($serverController[0], $serverController[1]); //TODO $serverController[1]
                                else:
                                    //TODO
                                endif;
                            else:
                                if( file_exists("application/controllers/objective/$serverController.зрз") ):
                                    Requirement::controllerObjective($serverController);
                                else:
                                    //TODO
                                endif;
                            endif;
                        }
                        if( file_exists("application/controllers/objective/$serverController") ):
                            Requirement::controllerObjective($serverController);
                            Requirement::view($guestView);
                        else:
                            throw new \Exception($serverController);
                        endif;
                    }catch (\Exception $exception){
                        Requirement::mvcException(600, $exception->getMessage());
                    }
                else:
                    Requirement::except(404);
                endif;
            }else{
                // TODO: 500
            }
        }
    }             //ВЫНЕСТИ ПРОВЕРКУ и ПОДКЛЮЧЕНИЕ ПРЕДСТАВЛЕНИЯ

    public function post()
    {
        // TODO: Implement post() method.
    }
}

?>