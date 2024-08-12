<?php

namespace App\Controllers;

use Core\Controller;



class HomeController extends Controller
{
    
    public function index($param)
    {

        return $this->view('index', ['name' => 'umut', 'param' => $param]);
    }
}
