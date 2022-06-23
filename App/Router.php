<?php namespace App;

use Core\Router;

$router= new Router();
$router->add('/','HomeController@index');
$router->add('/t','HomeController@t');
$router->add('/tt',function (){

});
$router->add('series',['uses'=>'SeriesController@index' , 'key'=>'value']);
$router->add('series/{slug}','SeriesController@serie');
$router->add('series/{slug}','SeriesController@episode');
// $router->add('/series/{slug}/episode/{id}',['uses'=>'SeriesController@episode', 'namespace'=>'Admin']);
// $router->add('/series/{slug}/episode/{id}','Admin\SeriesController@episode');
$router->add('/series/{slug}/episode/{id}','SeriesController@episode');
return $router;
