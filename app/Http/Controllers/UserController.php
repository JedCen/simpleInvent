<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Product;
use App\Models\Operation;
use App\Models\Sell;
use App\Models\Person;
use DB;

class UserController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $products = Product::all();
        $clientes = Person::where('kind', 1);
        $sells = Sell::where('operation_type_id', 2)
                ->whereMonth('created_at', '=', DB::raw('MONTH(CURDATE())'))
                ->whereYear('created_at', '=', DB::raw('YEAR(CURDATE())'))
                ->get();

        $product5 = Product::latest()
                ->take(5)
                ->get();

        if ($user->isAdmin()) {
            return view('pages.admin.home', compact('products', 'clientes', 'sells', 'product5'));
        }

        return view('pages.user.home');
    }

    public function chart()
    {
        $result = Sell::where('operation_type_id', '=', '2')
            ->whereMonth('created_at', '=', DB::raw('MONTH(CURDATE())'))
            ->whereYear('created_at', '=', DB::raw('YEAR(CURDATE())'))
            ->orderBy('id', 'ASC')
            ->get();
        return response()->json($result);
    }
}
