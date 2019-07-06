<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'category_id',
        'q'
    ];

    protected $fillable = [];

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function operation()
    {
        return $this->hasMany('App\Models\Operation');
    }

    public function sell()
    {
        return $this->hasOne('App\Models\Sell');
    }

    public static function getById($id)
    {
        $sql = Product::where('id', $id)->first();
        return $sql;
    }
}
