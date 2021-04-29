<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Donation extends Model
{
    use SoftDeletes;
    protected $table = 'donations';
    public $primaryKey = 'donation_id';

    public function donor(){
        return $this->belongsTo(Donor::class);
    }

    public function relief()

    {
        return $this->belongsToMany(Relief::class, 'donation_relief','donation_id','relief_id');
    }
    

    public function expenditure(){
        return $this->belongsToMany(Expenditure::class,'donation_expenditure','donation_id','exp_id');
    }
    

    
}
