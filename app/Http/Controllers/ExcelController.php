<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Excel;

class ExcelController extends Controller
{
    public function ExportClients()
    {
    	Excel::create('clients', function($excel){
    		$excel->sheet('clients', function($sheet){
    			$sheet->loadView('ExportClients');
    		});
    	})->export('xlsx');
    }

    public function upload()
    {
    	return view('upload');	
    }

    public function ImportClients(){

    	$file = Input::file('file');
    	$file_name = $file->getClientOriginalName();
    	$file->move('files', $file_name);
    	$results = Excel::load($file_name, function($reader))
    	{
    		$reader->all();
    	})->get();

    	return view('clients', ['clients' -> $results]);
    }

    public function exportUsers() //exporta la tabla usuarios
    {
    	Excel::create('Users', function($excel) {
				$users = User::all();
    			$excel->sheet('Users', function($sheet) use($users) 
    				{

    					$sheet->fromArray($users);

					});

			})->export('xls');
    }
}
