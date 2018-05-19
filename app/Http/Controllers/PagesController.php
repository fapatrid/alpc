<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function home()
    {
    	return view ('home');
    }


    public function saludo($nombre = "Invitado")
    {
 	
 		$consolas = [
		"Play Station 4",
		"Xbox One",
		"Wii U"
		];	   

    	return view('saludo', compact('nombre', 'consolas'));
    }
}
