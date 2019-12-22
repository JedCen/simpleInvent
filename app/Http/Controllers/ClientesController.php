<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;

class ClientesController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('inventario.clientes.index');
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
            'lastname'    => 'required|max:255',
            'rfc'        => 'required|max:25',
            'address1'    => 'required',
            'phone1'        => 'required|numeric',
            'email1'    => 'required|email',
        ]);

        $post = new Person();
        $post->name = request('name');
        $post->lastname = request('lastname');
        $post->rfc = request('rfc');
        $post->address1 = request('address1');
        $post->phone1 = request('phone1');
        $post->email1 = request('email1');
        $post->slug = str_slug(request('name') . 'cliente', '-');
        $post->kind = 1;
        $post->save();

        return response()->json([
            'post'    => $post,
            'message' => 'Success'
        ], 200);
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
            'lastname'    => 'required|max:255',
            'rfc'        => 'required|max:25',
            'address1'    => 'required',
            'phone1'        => 'required|numeric',
            'email1'    => 'required|email',
        ]);
        $post = Person::findOrFail($id);
        $post->name = request('name');
        $post->lastname = request('lastname');
        $post->rfc = request('rfc');
        $post->address1 = request('address1');
        $post->phone1 = request('phone1');
        $post->email1 = request('email1');
        $post->save();

        return response()->json([
            'message' => 'Cliente actualizado correctamente!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Person::findOrFail($id);

        $post->delete();

        return response()->json([
            'message' => 'Cliente eliminado correctamente!'
        ], 200);
    }

    public function list(Request $request)
    {
        $posts = Person::where('kind', 1)->paginate(2);
        return [
            'pagination' => [
                'total'               => $posts->total(),
                'current_page' => $posts->currentPage(),
                'per_page'       => $posts->perPage(),
                'last_page'       => $posts->lastPage(),
                'from'              => $posts->firstItem(),
                'to'                   => $posts->lastItem(),
            ],
            'posts' => $posts
        ];
    }
}
