<?php namespace Core;

//use Philo\Blade\Blade;
use Philo\Blade\Blade;

class View
{
    public static function  render($view , $arg=[])
    {
        extract($arg , EXTR_SKIP);
        $file="../App/Views/{$view}.php";
      //  var_dump(is_readable($file));die;
        if (is_readable($file)){
            require $file;
        }else{
            throw new \Exception("{$file} not found. ");
        }
    }

    public static function rendertemplate($template ,$arg=[])
    {
        $view=realpath(__DIR__ . '/../App/Views');
        $cath=realpath(__DIR__.'/../Storage/Views');
       $blade= new Blade($view ,$cath);
        return  $blade->view()->make($template ,$arg)->render();
    }
}