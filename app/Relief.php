<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Relief extends Model
{
    use SoftDeletes;
    protected $table = 'reliefs';
    public $primaryKey = 'relief_id';
    public function donations()
    {
        return $this->belongsToMany(Donation::class, 'donation_relief','relief_id','donation_id');
    }

    public function resident(){
        return $this->belongsToMany(Resident::class,'resident_relief','relief_id','res_id');
    }
}
