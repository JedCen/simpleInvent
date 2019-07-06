<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use Auth;
use jeremykenedy\Uuid\Uuid;
use App\Models\Operation;
use App\Models\Category;
use App\Models\Sell;
use App\Models\Box;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
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

    public function show()
    {
        
        $sells = Sell::where('operation_type_id', 2)->where('box_id', null)->get();
        $operats = Operation::whereNotNull('sell_id')->where('operation_type_id', 2)->get();
        $categorias = Category::all();

        return view('inventario.caja.caja', compact('sells', 'operats', 'categorias'));
    }

    public function process()
    {
        $return = (object)[
            'response' => false
        ];

        try {
            DB::beginTransaction();

            $sells = Sell::where('operation_type_id', 2)->where('box_id', null)->get();

            if (count($sells)) {
                $box = new Box();
                $box->slug = Uuid::generate(5, 'corte', Uuid::NS_DNS);
                $box->save();
                foreach ($sells as $sell) {
                    $sell->box_id = $box->id;
                    $sell->save();
                }
                $return->response = true;
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        if ($return->response = true) {
            return redirect()->route('caja.index');
        }
    }
    
    public function history()
    {
        $operats = Operation::whereNotNull('sell_id')->where('operation_type_id', 2)->get();
        $boxes = Box::all();
        $sells = Sell::where('operation_type_id', 2)->get();

        return view('inventario.caja.history', compact('sells', 'operats', 'boxes'));
    }

    public function detailone($id)
    {
        
        $sells = Sell::where('operation_type_id', 2)->where('box_id', $id)->get();
        $id = $id;

        return view('inventario.caja.historyone', compact('sells', 'id'));
    }
}
