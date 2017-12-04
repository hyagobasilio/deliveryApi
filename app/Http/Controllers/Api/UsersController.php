<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
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
    	$validator = Validator::make($data, [
            'name' => 'required|string|max:150',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'telefone' => 'required',
        ],
        [
            'name.required' => 'O campo nome é obrigatório.',
        	'telefone.required' => 'O campo telefone é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
        	'email.unique' => 'Email já cadastrado!',
        	'password.required' => 'O campo Senha é obrigatório.',
        	'password.min' => 'A senha deve ter no mínimo 6 digitos.',
        ]
    	);
    	if ($validator->fails())
	    {
	        return response()->json($validator->errors(), 400);
	    }
        $data['password'] = bcrypt($data['password']);

    	return User::create($data);
    }
}
