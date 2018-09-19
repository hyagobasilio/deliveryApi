<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Usuario;
use App\Santinho;
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

    public function postDeleteSantinho(Request $request)
    {
        try {
            $santinho = Santinho::findOrFail($request->id);
            $usuario = $santinho->usuario;
            $santinho->delete();

            return ['success' => 'Removido com sucesso!',
            'santinhos' => $usuario->santinhos ];
        } catch(\Exception $e) {
            return ['error' => $e->getMessage()];
        }

    }

    public function getSantinhos(Request $request)
    {
        try {
            $santinho = Usuario::findOrFail($request->id);
            return $santinho->santinhos;

        } catch(\Exception $e) {
            return ['error' => $e->getMessage()];
        }

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

    public function getLogin(Request $request) {
        //return $request->all();
        $usuario = Usuario::whereUsuario($request->usuario)
        ->whereSenha($request->senha)
        ->with('santinhos')
        ->get();
        if($usuario->count()) {
            return $usuario->first();
        }
        return [ 'id' => 0];
    }

    public function postSalvarSantinho(Request $request)
    {   
        $dados = $request->all();
        try {

            if ($request->has('foto')) {

                $image = $request->foto;  // your base64 encoded
                $image = str_replace('data:image/jpeg;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = str_random(10).'.'.'jpg';
                \File::put(public_path(). '/' . $imageName, base64_decode($image));
                $dados['foto'] = $imageName;
                $dados['base64'] = $request->foto;
            }

            $santinho = Santinho::create($dados);
            $usuario = $santinho->usuario;
            return ['success' => 'Cadastrado com sucesso', 'santinhos' => $usuario->santinhos];

        }catch(\Exception $e) {
            return $e->getMessage();
        }
        return response()->json(['status' => 200]);
    }

    public function getSantinho($id)
    {   
        
        try {

            $santinho = Santinho::findOrFail($id);
            return ['success' => 'Cadastrado com sucesso', 'santinho' => $santinho];

        }catch(\Exception $e) {
            return ['error' => $e->getMessage()];
        }
       
    }
}
