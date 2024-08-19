<?php

namespace App\Controllers;

use App\Models\Patient;
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

        // $user = new User();
        
        // $user->name = "Ali";
        // $user->lastname = "Veli";
        // $user->create();
        $pt=new Patient() ;
        $pt->name="ali";
        $pt->lastName="şahin"; 
        
        $pt->create();
      
    }
    public  function users()
    {
        
        $user = new User();

        $users= $user->all();
        return $this->jsonResult($users);
    }
}
