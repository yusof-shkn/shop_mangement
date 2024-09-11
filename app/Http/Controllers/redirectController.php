<?php

namespace App\Http\Controllers;

class redirectController extends Controller
{   
    public function redirectUser(){
        if(auth()->user()->role == 1){
            return redirect()->route('admin.dashboard');
        };
        if(auth()->user()->role == 2){
            return redirect()->route('inventory_manager.dashboard');
        };
        if(auth()->user()->role == 3){
            return redirect()->route('service_manager.dashboard');
        };
    }
}
