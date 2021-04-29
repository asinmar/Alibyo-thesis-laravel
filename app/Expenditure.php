<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Expenditure extends Model
{
    use SoftDeletes;
    protected $table = 'expenditures';
    public $primaryKey = 'exp_id';
    // public $timestamps = false;
    function exp_items(){
        return $this->hasMany('App\Bought_item','exp_id','exp_id');
    }

    public function donation(){
        return $this->belongsToMany(Donation::class,'donation_expenditure','exp_id','donation_id');
    }
}
