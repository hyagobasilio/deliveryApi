<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use Illuminate\Http\Request;
use Image;

class ProdutosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
            $produtos = Product::where('name', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('price', 'LIKE', "%$keyword%")
                ->orWhere('photo', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $produtos = Product::paginate($perPage);
        }

        return view('produtos.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('produtos.create');
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
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image = $request->file('photo');
        $filename  = time() . '.' . $image->getClientOriginalExtension();

        $path = public_path('images/produtos/' . $filename);
        $path_mini = public_path('images/produtos-mini/' . $filename);

    
        Image::make($image->getRealPath())->resize(800, 600)->save($path);
        Image::make($image->getRealPath())->resize(200, 200)->save($path_mini);
        $requestData['photo'] = $filename;
       }
        
        
        Product::create($requestData);

        return redirect('produtos')->with('flash_message', 'Produto added!');
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
        $produto = Product::findOrFail($id);

        return view('produtos.show', compact('produto'));
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
        $produto = Product::findOrFail($id);

        return view('produtos.edit', compact('produto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Product $produto)
    {
        
        $requestData = $request->all();
        if($request->file())
        {
         $this->validate($request, [
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image = $request->file('photo');
        $filename  = time() . '.' . $image->getClientOriginalExtension();

        $path = public_path('images/produtos/' . $filename);
        $path_mini = public_path('images/produtos-mini/' . $filename);

    
        Image::make($image->getRealPath())->resize(800, 600)->save($path);
        Image::make($image->getRealPath())->resize(200, 200)->save($path_mini);
        $requestData['photo'] = $filename;
       }
        $produto->update($requestData);

        return redirect('produtos')->with('flash_message', 'Produto updated!');
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
        Product::destroy($id);

        return redirect('produtos')->with('flash_message', 'Produto deleted!');
    }
}
