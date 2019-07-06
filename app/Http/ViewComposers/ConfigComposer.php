<?php
namespace App\Http\ViewComposers;

use App\Models\Configuration;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ConfigComposer
{
    protected $user;
    protected $configuration;
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
        $configNomEmp = null;
        $configNomImp = null;
        $configValImp = null;
        $configSimbMon= null;
        $configimagen = null;

        if (Auth::check()) {
            $configNomEmp = Configuration::find(1)->val;
            $configimagen = Configuration::find(6);
        }
        $view->with(['configNomEmp' => $configNomEmp,
                    'configimagen'=> $configimagen]);
    }
}
