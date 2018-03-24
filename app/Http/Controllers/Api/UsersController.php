<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use Image;
class UsersController extends Controller
{
    public function index() {
        
        return User::all();
    }

    public function logado() {
        return response()->json(request()->user());
    }


    public function register(Request $request) {

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
        'email.email' => 'Email inválido',
        'email.unique' => 'Email já cadastrado!',
        'password.required' => 'O campo Senha é obrigatório.',
        'password.min' => 'A senha deve ter no mínimo 6 digitos.',
        ]
        );
        if ($validator->fails()) {
         return response()->json($validator->errors(), 400);
        }
        $data['password'] = bcrypt($data['password']);

        return User::create($data);
    }

    public function update(Request $request) {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name'      => 'required|string|max:150',
            'email'     => 'required|string|email|max:255|unique:users,email,'.$request->id,
            'telefone'  => 'required',
        ],
        [
            'name.required'     => 'O campo nome é obrigatório.',
            'telefone.required' => 'O campo telefone é obrigatório.',
            'email.required'    => 'O campo email é obrigatório.',
            'email.email'       => 'Email inválido',
            'email.unique'      => 'Email já cadastrado!',
            'password.required' => 'O campo Senha é obrigatório.',
            'password.min'      => 'A senha deve ter no mínimo 6 digitos.',
        ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $userId = request()->user()->id;
        $user = User::findOrFail($userId);

        $user->update($data);
        return $user; 

    }

    public function uploadImage(Request $request) {
        $requestData = $request->all();
        if($request->file()) {
             $this->validate($request, [
                'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $image = $request->file('file');
            $filename  = time() . '.' . $image->getClientOriginalExtension();

            $path = public_path('images/fotos/' . $filename);

            Image::make($image->getRealPath())->save($path);
            $requestData['photo'] = $filename;
        }

        $userId = request()->user()->id;
        $user = User::findOrFail($userId);

        $user->foto = $requestData['photo'];
        $user->save();
        return $user;

    }
}
