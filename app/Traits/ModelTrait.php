<?php 


namespace App\Traits;

trait CommonController{

    public function donationstrait(){
        $modelobject = $this->Donation;
        $model = $modelobject::all();
        return $model;
    }
    
}

?>
