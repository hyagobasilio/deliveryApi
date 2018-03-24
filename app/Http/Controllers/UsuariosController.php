<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Validator;
class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $usuarios = User::where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('telefone', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $usuarios = User::paginate($perPage);
        }

        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        User::create($requestData);

        return redirect('usuarios')->with('flash_message', 'Usuário added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show(User $usuario)
    {
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(User $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, User $usuario)
    {
        
        //$requestData = $request->all();
        $data = $request->all();
        $regras = [
        'name' => 'required|string|max:150',
        'email' => 'required|string|email|max:255|unique:users,id,'.$request->id,
        'telefone' => 'required',
        ];
        if(!empty($request->password)) {
            $regras['password'] = 'min:6';
        }
        $validator = Validator::make($data, $regras,
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
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->telefone = $request->telefone;
        if(!empty($request->password)) {
            $usuario->password = bcrypt($request->password);
        }
        $usuario->update();

        
        //$usuario->update($requestData);

        return redirect('usuarios')->with('flash_message', 'Usuário updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(User $usuario)
    {
        $usuario->delete();
        return redirect('usuarios')->with('flash_message', 'Usuário deleted!');
    }
}
