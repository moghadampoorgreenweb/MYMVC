<?php

require '../bootstrap/autoload.php';

        error_reporting(E_ALL);
        set_error_handler('Core\Erore::erorehandller');
        set_exception_handler('Core\Erore::exebtionhandler');




     $router= require "../App/Router.php";
     $router->dispatch( $_SERVER["QUERY_STRING"]);

