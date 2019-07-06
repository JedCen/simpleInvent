<?php

namespace App\Http\Requests\Inventario;

use Illuminate\Foundation\Http\FormRequest;

class ProductoUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'barcode'       => 'required|integer',
            'user_id'       => 'required|integer',
            'name'          => 'required',
            'category_id'   => 'required|integer',
            'description'   => 'required',
            'price_in'      => 'required|numeric',
            'price_out'     => 'required|numeric',
            'unit'          => 'required',
            'presentation'  => 'required',
            'inventary_min' => 'required|numeric',
        ];
       

        if ($this->get('image')) {
            $rules = array_merge($rules, ['image'         => 'mimes:jpg,jpeg,png']);
        }

        return $rules;
    }
}
