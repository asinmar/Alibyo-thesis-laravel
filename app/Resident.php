<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Resident extends Model
{

    use SoftDeletes;
    protected $table = 'residents';
    public $primaryKey = 'res_id';
    //

    public function relief(){
        return $this->belongsToMany(Relief::class,'resident_relief','res_id','relief_id');
    }

}
