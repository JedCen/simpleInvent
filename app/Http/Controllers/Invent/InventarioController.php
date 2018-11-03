<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Operation;
use App\Models\Sell;
use App\Models\Person;
use App\Models\Product;
use Auth;
use DB;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('inventario.inventario.index')->with(['products' => $products]);
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
        $return = (object)[
            'response' => false
        ];

        try {
            DB::beginTransaction();

            $venta = new Sell();
            $venta->person_id = $request->input('proveedor_id');
            $venta->user_id = Auth::user()->id;
            $venta->operation_type_id = 1;
            $venta->total = $request->input('total');

            $venta->save();

            $detail = [];
            foreach ($request->input('detail') as $d) {
                $obj = new Operation;

                $obj->product_id = $d['id'];
                $obj->q = $d['quantity'];
                $obj->operation_type_id = 1;

                $detail[] = $obj;
            }

            $venta->operation()->saveMany($detail);
            $return->response = true;

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return response()
            ->json($return);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sells = Sell::find($id);
        $operations = Operation::where('operation.sell_id', '=', $id)
            ->where('operation_type_id', 1)
            ->get();
        $data = [
            'sells' => $sells,
            'operations' => $operations
        ];

        return view('inventario.inventario.abastecer.abast')->with($data);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function invlist()
    {
        return view('inventario.inventario.abastecer');
    }
    public function abastecerlist()
    {
        $products = Sell::where('operation_type_id', 1)->orderBy('created_at', 'desc')->get();

        return view(' inventario.inventario.reabastecer')->with(['products' => $products]);
    }

    public function history(Request $request, $id)
    {
        $product = Product::find($id);
        $operations = Operation::where('product_id', $id)
            ->get();
            $operentrada= Operation::where('product_id', $id)->where('operation_type_id', 1)->get();
            $opersalida= Operation::where('product_id', $id)->where('operation_type_id', 2)->get();
        
        return view('inventario.inventario.abastecer.history')->with(['product' => $product, 'operations' => $operations, 'operentrada' => $operentrada, 'opersalida' => $opersalida]);
    }
}
