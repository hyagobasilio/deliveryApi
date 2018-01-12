<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TipoProduto;
use Illuminate\Http\Request;
use Image;

class TipoProdutoController extends Controller
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
            $tipoproduto = TipoProduto::where('name', 'LIKE', "%$keyword%")
            ->paginate($perPage);
        } else {
            $tipoproduto = TipoProduto::paginate($perPage);
        }

        return view('tipo-produto.index', compact('tipoproduto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('tipo-produto.create');
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

        if($request->file())
        {
           $this->validate($request, [
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
           $image = $request->file('foto');
           $filename  = time() . '.' . $image->getClientOriginalExtension();

           $path = public_path('images/produtos/' . $filename);
           $path_mini = public_path('images/produtos-mini/' . $filename);


           Image::make($image->getRealPath())->resize(800, 600)->save($path);
           Image::make($image->getRealPath())->resize(250, 200)->save($path_mini);
           $requestData['foto'] = $filename;
       }

       TipoProduto::create($requestData);

       return redirect('tipo-produto')->with('flash_message', 'TipoProduto added!');
   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $tipoproduto = TipoProduto::findOrFail($id);

        return view('tipo-produto.show', compact('tipoproduto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $tipoproduto = TipoProduto::findOrFail($id);

        return view('tipo-produto.edit', compact('tipoproduto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $tipoproduto = TipoProduto::find($id);
        if($request->file())
        {
            $this->validate($request, [
                'foto'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'nome'         => 'required',

            ]);

            $image = $request->file('foto');
            $filename  = time() . '.' . $image->getClientOriginalExtension();

            $path = public_path('images/produtos/' . $filename);
            $path_mini = public_path('images/produtos-mini/' . $filename);


            Image::make($image->getRealPath())->resize(800, 600)->save($path);
            Image::make($image->getRealPath())->resize(250, 200)->save($path_mini);
            $requestData['foto'] = $filename;
        }
        $tipoproduto->update($requestData);
        return redirect('tipo-produto')->with('flash_message', 'TipoProduto updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        TipoProduto::destroy($id);

        return redirect('tipo-produto')->with('flash_message', 'TipoProduto deleted!');
    }
}
