<?php namespace App\Controllers;


use Core\Controller;
use Core\View;

class SeriesController extends Controller
{

//   public function before()
//    {
//        echo "series before .<br>";
//        return true;
//    }

    public function index()
    {
        return "index page";
    }

    public function serie($slug)
    {
       return "serie Page";
    }

    public function episode($slug , $id)
    {
        //return $slug;
//        return View::rendertemplate("series/episode"  , [
//            'slug'=>$slug,
//            'id'=>$id
//        ]);
        $users=['ali','naghi','hasan','hasan'];
        return View::rendertemplate("series/episode"  , [
           'users'=>$users
        ]);
        //return var_dump($_GET) ." episode page ".$slug." id: ".$id;
    }

}