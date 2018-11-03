<?php

namespace App\Http\Controllers\Reports;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Models\Operation;
use App\Models\User;
use App\Models\Person;
use App\Models\Product;
use App\Models\Category;
use Auth;
use DB;
use Carbon\Carbon;


class ReporteController extends Controller
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
     * Display a listing of Product.
     *
     * @return \Illuminate\Http\Response
     */
    public function sellbyproduct()
    {
        $products2 = Product::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('inventario.reportes.products', compact('products2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getsellbyproduct(Request $request)
    {
        $this->validate($request, [
            'producto' => 'required',
            'ini' => 'required',
            'fin' => 'required',
        ]);
        // $products2 = Product::orderBy('name', 'ASC')->pluck('name', 'id');
        // $operations = Operation::Where('product_id', $request->input('producto'))
        //             ->where('created_at', '>=', date('Y-m-d', strtotime($request->input('ini'))))
        //             ->where('created_at', '<=', Carbon::parse($request->input('fin'))->addDays(1))
        //             ->get();


        return view('inventario.reportes.products');
    }

    /**
     * Display a listing of Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function sellbycategory()
    {
        $category2 = Category::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('inventario.reportes.categories', compact('category2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getsellbycategory(Request $request)
    {
        $this->validate($request, [
            'categoria' => 'required',
            'ini' => 'required',
            'fin' => 'required',
        ]);
        // $category2 = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        // $products = Product::Where('category_id', $request->input('categoria'))->get();
        // $operations = Operation::where('created_at', '>=', date('Y-m-d', strtotime($request->input('ini'))))
        //             ->where('created_at', '<=', Carbon::parse($request->input('fin'))->addDays(1))
        //             ->get();


        return view('inventario.reportes.categories');
    }

    /**
     * Display a listing of Sells.
     *
     * @return \Illuminate\Http\Response
     */
    public function sellbysells()
    {
        $cliente = Person::where('kind', 1)->orderBy('name', 'ASC')->pluck('name', 'id');
        $vendedor = User::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('inventario.reportes.sells', compact('cliente', 'vendedor'));
    }

    /**
     * Display a listing of Buys.
     *
     * @return \Illuminate\Http\Response
     */
    public function sellbybuys()
    {
        $proveedor = Person::where('kind', 2)->orderBy('name', 'ASC')->pluck('name', 'id');

        return view('inventario.reportes.buys', compact('proveedor'));
    }

    
}
