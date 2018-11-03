<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'operation';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    
    protected $guarded = [
        'id'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function operation_type()
    {
        return $this->belongsTo('App\Models\OperationType');
    }

    public function person()
    {
        return $this->belongsTo('App\Models\Person');
    }

    public function sell()
    {
        return $this->belongsTo('App\Models\Sell');
    }

    public static function getQYesF($product_id){
        $q=0;
        $operations = Operation::getAllByProductId($product_id);
        
        foreach($operations as $operation){
                if($operation->operation_type_id==1){ $q+=$operation->q; }
                elseif ($operation->operation_type_id==2){  $q+=(-$operation->q); }
        }
        // print_r($data);
        return $q;
    }
    public function getProduct(){ 
        return Product::getById($this->product_id);
    }

/*----- ///   /// ----*/
    public static function getAllByProductId($product_id){
        $sql = Operation::where('product_id', $product_id)->orderBy('created_at', 'desc')->get();
        
        return $sql;
    }

    public static function getAllProductsBySellId($sell_id){
        $sql = Operation::where('sell_id','=', $sell_id)->orderBy('created_at', 'desc')->get();
        return $sql;
    }
}
