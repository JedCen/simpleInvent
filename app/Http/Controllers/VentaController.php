<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Operation;
use App\Models\Sell;
use App\Models\Person;
use App\Models\Product;
use Auth;
use DB;
use Session;

class VentaController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __CONSTRUCT()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Sell::where('operation_type_id', '=', 2)->orderBy('created_at', 'desc')->get();

        return view('inventario.sells', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventario.create');
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
            $venta->operation_type_id = 2;
            $venta->total = $request->input('total');

            $venta->save();

            $detail = [];
            foreach ($request->input('detail') as $d) {
                $obj = new Operation();

                $obj->product_id = $d['id'];
                $obj->q = $d['quantity'];
                $obj->operation_type_id = 2;

                $detail[] = $obj;
            }

            $venta->operation()->saveMany($detail);
            $return->response = true;

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        Session::flash('ventaUP', $venta->id);
        return response()
            ->json($return);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $sells = Sell::find($id);
        $operations = Operation::where('operation.sell_id', '=', $id)
            ->where('operation_type_id', 2)
            ->get();
        $data = [
            'sells' => $sells,
            'operations' => $operations
        ];
        return view('inventario.detail')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function edit(Sell $sell)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sell $sell)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $operations = Operation::where('sell_id', $id);
        $sells = Sell::find($id);

        $operations->delete();
        $sells->delete();

        return Redirect::route('public.home');
    }
    ///---------/////

    public function searchClient(Request $request)
    {
        $q = $request->input('q');

        $results = array();

        $queries = Person::where('name', 'LIKE', '%' . $q . '%')
            ->Where('kind', '=', 1)
            ->take(5)->get();

        foreach ($queries as $query) {
            $results[] = [
                'id' => $query->id, 'name' => $query->name,
                'rfc' => $query->rfc, 'address1' => $query->address1
            ];
        }

        return response()->json([
            'cliente' => $results
        ], 200);
    }

    public function searchProductSell(Request $request)
    {
        $q = $request->input('q');

        $results = array();


        $queries = Product::where('is_active', '=', 1)
            ->where(function ($xd) use ($q) {
                $xd->where('barcode', 'LIKE', '%' . $q . '%')
                    ->orWhere('name', 'LIKE', '%' . $q . '%');
            })
            ->take(5)->get();

        foreach ($queries as $query) {
            $stock = Operation::getQYesF($query->id);
            $results[] = [
                'id' => $query->id, 'barcode' => $query->barcode,
                'name' => $query->name, 'price' => $query->price_out, 'stock' => $stock
            ];
        }

        return response()->json([
            'producto' => $results
        ], 200);
    }

    public function searchProduct(Request $request)
    {
        $q = $request->input('q');

        $results = array();


        $queries = Product::where(function ($xd) use ($q) {
            $xd->where('barcode', 'LIKE', '%' . $q . '%')
                ->orWhere('name', 'LIKE', '%' . $q . '%');
        })
            ->take(5)->get();

        foreach ($queries as $query) {
            $stock = Operation::getQYesF($query->id);
            $results[] = [
                'id' => $query->id, 'barcode' => $query->barcode, 'name' => $query->name,
                'price' => $query->price_out, 'stock' => $stock
            ];
        }

        return response()->json([
            'producto' => $results
        ], 200);
    }

    public function print(Request $request)
    {
        try {
            $connector = new CupsPrintConnector("XP_80");
            $printer = new Printer($connector);
            $printer->text("Hello World!\n");
            $printer->cut();

            $printer->close();
        } catch (Exception $e) {
            echo "Couldn't print to this printer: " . $e->getMessage() . "\n";
            $printer->close();
        }

        return redirect()->back();
    }
}
