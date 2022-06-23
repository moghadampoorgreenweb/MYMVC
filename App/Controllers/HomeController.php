<?php namespace App\Controllers;


use App\Models\Article;
use App\Models\User;
use Core\Controller;
use Core\View;


class HomeController extends Controller
{
    public function index()
    {
        echo View::rendertemplate("index");
        dd('taghi');
    }
    public function t()
    {
        dd('test');
    }

}