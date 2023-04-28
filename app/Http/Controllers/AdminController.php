<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function index(){
    //  return $data;
        $users = [];
        return view('backend.index', compact('users'));
    }

    
}
