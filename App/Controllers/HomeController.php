<?php namespace App\Controllers;


use App\Models\Article;
use App\Models\User;
use Core\Controller;


class HomeController extends Controller
{
    public function index()
    {
     //   echo View::rendertemplate("index");

       var_dump(User::find(1)->fullname);
    }

}