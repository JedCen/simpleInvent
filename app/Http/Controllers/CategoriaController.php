<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Validator;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('inventario.categoria.index', compact('categories')); 
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'        => 'required|max:255',
        ]);
        $slug = str_slug(request('name'), '-');
        
        $categories = new Category;
        $categories->name = request('name');
        $categories->slug = $slug;
        $categories->save();

        $notificacion = array(
            'message' => 'Exito! Se agrego correctamente.', 
            'alert-type' => 'success'
        );
 
        return redirect()->route('categorias.index')->with($notificacion);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'name'        => 'required|max:255',
        ]);
        
        
            $categories = Category::findOrFail($id);
                $categories->name = $request->name;
                $categories->save();
     
        $notificacion = array(
            'message' => 'Exito! Se actualizo correctamente.', 
            'alert-type' => 'success'
        );
 
        return redirect()->route('categorias.index')->with($notificacion);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     
    $categories = Category::find($id);
    $categories->delete();

     $notificacion = array(
            'message' => 'Exito! Se elimino correctamente.', 
            'alert-type' => 'warning'
        );
 
        return redirect()->route('categorias.index')->with($notificacion);   
    }
}
