<?php

$router->get('/', 'index.mway.php', 'ResponceController.php');
$router->get('/responce', 'responce.mway.php', 'ResponceController.php');
$router->get('/exit', 'exit.mway.php', 'ExitController.php');
$router->get('/access', 'access.mway.php', 'AccessController.php');

?>