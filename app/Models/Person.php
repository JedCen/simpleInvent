<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'person';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];
    protected $fillable = [
        'name',
        'address1',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function sell()
    {
        return $this->hasOne('App\Models\Sell');
    }

    public function operation()
    {
        return $this->hasMany('App\Models\Operation');
    }
}
