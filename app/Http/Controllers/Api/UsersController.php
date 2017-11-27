<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Validator;
class UsersController extends Controller
{
    public function logado()
    {
      return response()->json(request()->user());
    }


    public function register(Request $request)
    {
    	
    	$data = $request->all();
        return $request->all();
    	$validator = Validator::make($data, [
            'name' => 'required|string|max:150',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ],
        [
        	'name.required' => 'O campo nome é obrigatório.',
        	'email.required' => 'O campo email é obrigatório.',
        	'password.required' => 'O campo Senha é obrigatório.',
        	'password.min' => 'A senha deve ter no mínimo 6 digitos.',
        ]
    	);
    	if ($validator->fails())
	    {
	        return response()->json($validator->errors(), 400);
	    }

        $fileNameCustom = null;
        if($request->hasFile('foto')) {
            $file           = $request->file('documento');
            $storagePath    = public_path().'/foto/'.$userId;
            $fileName       = $file->getClientOriginalName();
            $fileNameCustom = date('dmY-his'). str_random(4).$fileName;
            $file->move($storagePath, $fileNameCustom);
        }
        
    	return \App\User::create([
            'name' => $data['name'],
            'foto' => $fileNameCustom,
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
