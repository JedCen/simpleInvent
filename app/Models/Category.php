<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'category';

    /**
     * [$fillable description]
     * @var array
     */
    protected $fillable = ['name'];
    
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    public function product()
    {
        return $this->hasOne('App\Models\Product');
    }

}
