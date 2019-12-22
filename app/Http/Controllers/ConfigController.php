<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuration;
use Illuminate\Support\Facades\Input;
use Image;
use File;
use DB;

class ConfigController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'imageConfig']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configs = Configuration::all();
        return view('inventario.config.configuracion', compact('configs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $return = (object) [
            'response' => false
        ];
        try {
            DB::beginTransaction();
            foreach ($request->post() as $short => $val) {
                Configuration::where('short', $short)
                    ->update(['val' => $val]);
            }
            $return->response = true;

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        if ($return->response = true) {
            return redirect()->route('config.index');
        }
    }

    /**
     * Show image product.
     *
     * @param $id
     * @param $image
     *
     * @return string
     */
    public function imageConfig($id, $image)
    {
        return Image::make(storage_path() . '/configs/id/' . $id . '/uploads/images/config/' . $image)->response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload($id)
    {
        if (Input::hasFile('file')) {
            $config = Configuration::find($id);
            $avatar = Input::file('file');
            $filename = 'config.' . $avatar->getClientOriginalExtension();
            $save_path = storage_path() . '/configs/id/' . $config->id . '/uploads/images/config/';
            $path = $save_path . $filename;
            $public_path = '/images/configs/' . $config->id . '/config/' . $filename;

            // Make the user a folder and set permissions
            File::makeDirectory($save_path, $mode = 0755, true, true);

            // Save the file to the server
            Image::make($avatar)->resize(300, 300)->save($save_path . $filename);

            // Save the public image path
            $config->val = $public_path;
            $config->save();

            return response()->json(['path' => $path], 200);
        } else {
            return response()->json(false, 200);
        }
    }
}
