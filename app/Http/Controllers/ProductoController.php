<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Operation;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Inventario\ProductoUpdateRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Barryvdh\DomPDF\Facade as PDF;
use Image;
use File;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('inventario.producto.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        $products = Product::orderBy('name', 'ASC')->get();
        return view('inventario.producto.create', compact('categorias', 'products'));
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
            'barcode' => 'required|integer',
            'user_id' => 'required|integer',
            'name' => 'required',
            'category_id' => 'required|integer',
            'description' => 'required',
            'price_in' => 'required|numeric',
            'price_out' => 'required|numeric',
            'q' => 'required|numeric',
            'unit' => 'required',
            'presentation' => 'required',
            'inventary_min' => 'required|numeric',
        ]);

        $products = new Product();
        $products->fill($request->all())->save();

        // //IMAGE
        // if ($request->file('image')) {
        //     $file = $request->file('image');
        //     $path = public_path() . '/images/products/';
        //     $fileName = uniqid() . $file->getClientOriginalName();
        //     $public_path = '/images/products/' . $fileName;

        //     $file->move($path, $fileName);
        //     $products->fill(['image' => asset($public_path)])->save();
        // }

        if ($request->Input('category_id')) {
            $products->category_id = $request->Input('category_id');
            $products->save();
        }

        if ($request->Input('q')) {
            $obj = new Operation();
            $obj->product_id = $products->id;
            $obj->q = $request->Input('q');
            $obj->operation_type_id = 1;
            $obj->save();
        }


        return redirect()->route('producto.index')->with('info', 'Entrada actualizada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorias = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        $products = Product::where('id', $id)->first();
        return view('inventario.producto.edit', compact('categorias', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductoUpdateRequest $request, $id)
    {
        //dd($request->Select('category_id'));
        $products = Product::find($id);
        $products->fill($request->all())->save();

        // //IMAGE
        // if ($request->file('image')) {
        //     $file = $request->file('image');
        //     $path = public_path() . '/images/products/';
        //     $fileName = uniqid() . $file->getClientOriginalName();
        //     $public_path = '/images/products/' . $fileName;

        //     $file->move($path, $fileName);
        //     $products->fill(['image' => asset($public_path)])->save();
        // }

        if ($request->Input('category_id')) {
            $products->category_id = $request->Input('category_id');
            $products->save();
        }


        return redirect()->route('producto.edit', $products->id)->with('info', 'Entrada actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $operations = Operation::where('product_id', $id);
        $products = Product::find($id);

        $operations->delete();
        $products->delete();

        return Redirect::route('producto.index');
    }

    /**
     * Show image product.
     *
     * @param $id
     * @param $image
     *
     * @return string
     */
    public function imageProduct($id, $image)
    {
        return Image::make(storage_path().'/products/id/'.$id.'/uploads/images/product/'.$image)->response();
    }

     /**
     * Upload and Update image config.
     *
     * @param $file
     *
     * @return mixed
     */
    public function upload($id)
    {
        if (Input::hasFile('file')) {
            $product = Product::find($id);
            $avatar = Input::file('file');
            $filename = 'product.'.$avatar->getClientOriginalExtension();
            $save_path = storage_path().'/products/id/'.$product->id.'/uploads/images/product/';
            $path = $save_path.$filename;
            $public_path = '/images/products/'.$product->id.'/product/'.$filename;

            // Make the user a folder and set permissions
            File::makeDirectory($save_path, $mode = 0755, true, true);

            // Save the file to the server
            Image::make($avatar)->resize(300, 300)->save($save_path.$filename);

            // Save the public image path
            $product->image = $public_path;
            $product->save();

            return response()->json(['path' => $path], 200);
        } else {
            return response()->json(false, 200);
        }
    }

    public function pdf()
    {
        /**
         * toma en cuenta que para ver los mismos
         * datos debemos hacer la misma consulta
         **/
        $products = Product::all();

        $pdf = PDF::loadView('inventario.producto.pdf', compact('products'));

        return $pdf->download('listado.pdf');
    }
}
