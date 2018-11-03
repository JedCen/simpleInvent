<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inventario.proveedor.index');
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
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'rfc' => 'required|max:25',
            'address1' => 'required',
            'phone1' => 'required|numeric',
            'email1' => 'required|email',
        ]);

        $proveedor = new Person();
        $proveedor->name = request('name');
        $proveedor->lastname = request('lastname');
        $proveedor->rfc = request('rfc');
        $proveedor->address1 = request('address1');
        $proveedor->phone1 = request('phone1');
        $proveedor->email1 = request('email1');
        $proveedor->slug = str_slug(request('name').'provider', '-');
        $proveedor->kind = 2;
        $proveedor->save();

        return response()->json([
            'proveedor' => $proveedor,
            'message' => 'Success'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'rfc' => 'required|max:25',
            'address1' => 'required',
            'phone1' => 'required|numeric',
            'email1' => 'required|email',
        ]);
        $proveedor = Person::findOrFail($id);
        $proveedor->name = request('name');
        $proveedor->lastname = request('lastname');
        $proveedor->rfc = request('rfc');
        $proveedor->address1 = request('address1');
        $proveedor->phone1 = request('phone1');
        $proveedor->email1 = request('email1');
        $proveedor->save();

        return response()->json([
            'message' => 'Proveedor actualizado correctamente!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedor = Person::findOrFail($id);
        $proveedor->delete();

        return response()->json([
            'message' => 'Proveedor eliminado correctamente!'
        ], 200);
    }

    public function list(Request $request)
    {
        $proveedor = Person::where('kind', 2)->paginate(2);
        return [
            'pagination' => [
                'total' => $proveedor->total(),
                'current_page' => $proveedor->currentPage(),
                'per_page' => $proveedor->perPage(),
                'last_page' => $proveedor->lastPage(),
                'from' => $proveedor->firstItem(),
                'to' => $proveedor->lastItem(),
            ],
            'proveedor' => $proveedor
        ];
    }

    public function searchproovedor(Request $request)
    {
        $q = $request->input('q');

        $proveedor = Person::where('name', 'LIKE', '%' . $q . '%')
            ->Where('kind', '=', 2)
            ->take(5)->get();

        return response()->json([
            'proveedor' => $proveedor
        ], 200);
    }

}
