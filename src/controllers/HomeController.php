<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller;




class HomeController extends Controller
{
    
    public function index($param)
    {
        $user = new User();
        
       $users= $user->findById(1);

        return $this->view('index', ['name' => 'umut', 'users' => $users]);
    }
}
