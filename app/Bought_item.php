<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Bought_item extends Model
{
    use SoftDeletes;
    protected $table = 'bought_items';
    public $primaryKey = 'item_id';
    public $timestamps = false;

    public function expenditure(){
        return $this->belongsTo('App\Expenditure','exp_id','exp_id');
    }

}
