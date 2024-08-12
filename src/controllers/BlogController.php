<?php
namespace App\Controllers;
use Core\Controller;

class BlogController extends Controller
{
    

    public function index( )
    {
        $this->viewLayout('index', 'layout');
    }
}