<?php

header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__ . '/application/lib/modules/Autoloader.php';
//require __DIR__ . '/phar://application/lib/vendor/yandex-vendor/yandex-php-library_0.2.1.phar/vendor/autoload.php';
require __DIR__ . '/application/lib/vendor/autoload.php';
require __DIR__ . '/application/lib/vendor/twig/autoload.php';
require __DIR__ . '/application/lib/modules/system/sender/Sender.php';

use application\core\Router;
use application\core\DataBase;
use application\lib\modules\Autoloader;
use application\core\interfaces\ModelInt;
use application\lib\modules;
use application\core\Twig;
use \Twig\Loader\ArrayLoader;
use \Twig\Environment;
use application\models\User;
use application\models\Admin;
use application\lib\modules\system\sender\Sender;
use application\lib\modules\system\sender\Email;
//use \Workerman\Worker;

Autoloader::autoRegister(); //spl_autoload_register
//Twig_Autoloader::register();

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/application/views/templates/public/');
$router = new Router();
//$worker = new Worker('websocket://0.0.0.0:8001');

$twig = new \Twig\Environment($loader, [
    'cache' => __DIR__ . '/application/core/memory/cache/twig'
]);

//if( isset($_SESSION['guest']) ):
//    //$worker->count = 4;
//    $dBase = DataBase::connection();
//    $dBase->getInfo();
//
//    /*$worker->onConnect = function ($connection)
//    {
//      $connection->send('message');              only run in command line mode. TODO BLYAT`
//    };
//
//    \Workerman\Worker::runAll();*/
//endif;

///////////////////////////////////////////////////////
///////////////////Router region///////////////////////
///////////////////////////////////////////////////////

/*$router->get('/', function (){
    return Twig::load('index.mway.php');
});*/

/*function view($tempName, $tempArray){
    global $twig;
    echo $twig->render($tempName, $tempArray);
};*/

/*$router->get('/', [
    'index.mway.php', [
        'name' => 'Vlad',
    ]
]);
$router->get('/a', 'index.mway.php','CheckController@hello');
$router->get('/responce', view(
    'responce.mway.php', []
), 'ResponceController.php');
$router->get('/exit', 'exit.mway.php', 'ExitController.php');
$router->get('/access', view(
    'access.mway.php', []
), 'AccessController.php');*/


/*$router->get('/', 'index.mway.php');*/

require __DIR__ . '/application/routes/web.php';
require __DIR__ . '/application/routes/admin.php';

var_dump($_SESSION['guest']);
$router->guestRouteCheck();

?>