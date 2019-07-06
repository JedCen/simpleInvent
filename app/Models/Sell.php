<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Operation;

class Sell extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sell';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];

    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function operation()
    {
        return $this->hasMany('App\Models\Operation');
    }

    public function operation_type()
    {
        return $this->hasMany('App\Models\OperationType');
    }

    public function person()
    {
        return $this->belongsTo('App\Models\Person');
    }

    public function box()
    {
        return $this->hasOne('App\Models\Box');
    }

    public function product()
    {
        return $this->hasOne('App\Models\Product');
    }

    public static function getSells()
    {
        $sql = DB::table('sell')->where('operation_type_id', '=', 2)->orderBy('created_at', 'desc')->get();
        
        return $sql;
    }
}
