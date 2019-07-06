<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class OperationType extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'operation_type';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    public function operation()
    {
        return $this->hasOne('App\Models\Operation');
    }

    public static function getByName($name)
    {
        $sqls = DB::table('operation_type')->where('name', '=', $name)->get();
         
        $found = null;
        $data = new OperationType();
        foreach ($sqls as $sql) {
            $q = array(
            'id' => $sql->id,
            'name' => $sql->name
            );
        }
        return $found = new OperationType();
    }
}
