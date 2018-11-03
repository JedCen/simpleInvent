<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Configuration;
use Illuminate\Support\Facades\Input;
use Image;
use File;
use DB;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getConfig()
    {
        $configs = Configuration::all()->pluck('val', 'short');
        return response()->json(['configs' => $configs], 200);
    }
}
