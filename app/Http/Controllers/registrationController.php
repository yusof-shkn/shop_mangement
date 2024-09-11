<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class registrationController extends Controller
{
    public function registration(request $request){
        $role = $request->role;
        if($role == "service_manager"){
            return view('auth/register_service_manager');
        }
        if($role == "inventory_manager"){
            return view('auth/register_inventory_manager');
        }
    }
}
