<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller;




class HomeController extends Controller
{
    
    public function index($param)
    {
        $user = new User();
        
       $users= $user->all();

        return $this->viewLayout('index','layout', ['users' => $users]);
    }
    public function create()
    {
        $user = new User();
        $user->ID = 1;
        dd($user);

    }
}
