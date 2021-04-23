<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Donor extends Model
{
    use SoftDeletes;
    protected $table = 'donors';
    public $primaryKey = 'donor_id';
    function mydonor(){
        return $this->hasMany('App\Donation','donor_id','donor_id');
    }

    function mydonor_del(){
        return $this->hasMany('App\Donation','donor_id','donor_id')->onlyTrashed();
    }

}
