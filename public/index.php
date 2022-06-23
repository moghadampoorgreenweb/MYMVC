<?php

use Tracy\Debugger;

require __DIR__.'/../bootstrap/autoload.php';

        error_reporting(E_ALL);
        set_error_handler('Core\Erore::erorehandller');
        set_exception_handler('Core\Erore::exebtionhandler');

         Debugger::enable();


     $router= require_once __DIR__."/../App/Router.php";
     $router->dispatch( $_SERVER["QUERY_STRING"]);

