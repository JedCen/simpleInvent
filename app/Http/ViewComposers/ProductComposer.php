<?php
namespace App\Http\ViewComposers;

use App\Models\Product;
use App\Models\Operation;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
class ProductComposer
{
    protected $user;
    protected $product;
    public function __construct()
    {
        $this->user = Auth::user();
    }
    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $product = null;
        $cnt_tot = 0;
        if (Auth::check()) {
            
            $products = Product::all();
            foreach($products as $product){
                $q= Operation::getQYesF($product->id);
                if( $q==0 ||  $q<=$product->inventary_min){
                    $cnt_tot++;
                }
              }
        }
        $view->with('cnt_tot', $cnt_tot);
    }
}