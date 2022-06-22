<?php


use App\Config;
use \Illuminate\Database\Capsule\Manager as Capsule;
$capsule=new Capsule();
//var_dump(getenv('DB_HOST'));
//var_dump(envh('SHOW_DEBUG'));die;
 $capsule->addConnection([
    'driver'=>'mysql',
    'host'=> getenv('DB_HOST'),
    'port'=> Config::DB_PORT,
    'database'=>Config::DB_DATABASE,
    'username'=>envh('DB_USERNAME'),
    'password'=>Config::DB_PASSWORD,
    'charset'=>'utf8',
    'collation'=>'utf8_unicode_ci'
]);
$capsule->bootEloquent();











