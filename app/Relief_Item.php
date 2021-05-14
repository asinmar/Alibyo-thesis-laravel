<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relief_Item extends Model
{
    public function relief(){
        return $this->belongsTo('App\Relief','relief_id','relief_id');
    }
}
