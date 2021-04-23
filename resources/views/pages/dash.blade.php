<style>
    .yay{
     
        height: auto;
        padding: 0;
        width: auto;
    }
    .res{
        
        height: 200px;

        padding: 0;
    }
    .donation{
        
        height: 200px;

        padding: 0;
    }
    .contr{
        margin-top:300px;
    }
    .image img{
        height:150px;
        width: 150px;
        border: 2px solid;
        border-radius: 15px;
        margin-top:10px;
        margin-bottom: 10px;
    }

    .res p{
        font-size: 30px;
        
    }
    .donation p{
        font-size: 20px;
    }

    .display{
        border:1px solid;
        padding: 10px;
        border-radius: 20px;
        height: 150px;
        width: 350px;

    }
    .image2 img{
        height:150px;
        width: 300px;
        border: 2px solid;
        border-radius: 15px;
        margin-top:10px;
        margin-bottom: 10px;
    }
 
</style>
@extends('layout.app')

@section('content')
<div class="main-body">
    <div class="col-lg-4 yay">
        <div class="image d-inline">
            <img src="/img/brgylogo.jpg" class="Lapasan logo"> 
        </div>
        <div class="image2 d-inline">
            <img src="/img/logo2.png" alt="CDO Logo">   
        </div>
    </div>
        <div class="container-fluid cont">
            <div class="row">
                
                <div class="col-lg-4 donation d-flex align-items-center justify-content-center">
    
                    <div class="display" style="background: aliceblue">
                        <div class="text-center">
                            <p>Total Residents</p> 
                       </div>
                       <div class="text-center">
                           <p style="font-size: 50">{{$res}}</p>
                       </div>
                    </div>
                </div>
                <div class="col-lg-4 donation d-flex align-items-center justify-content-center">
                    <div class="display " style="background: aquamarine">
                        <div class="text-center">
                            <p>Total Donors</p> 
                       </div>
                       <div class="text-center">
                           <p style="font-size: 50">{{$donor}}</p>
                       </div>
                    </div>
                </div>
                <div class="col-lg-4 donation d-flex align-items-center justify-content-center">
                    <div class="display" style="background: azure">
                        <div class="text-center">
                            <p>Total Donations</p> 
                       </div>
                       <div class="text-center">
                           <p style="font-size: 50">{{$donation}}</p>
                       </div>
                    </div>
                </div>
                <div class="col-lg-4 donation d-flex align-items-center justify-content-center">
                    <div class="display" style="background: beige">
                        <div class="text-center">
                            <p>Total Relief</p> 
                       </div>
                       <div class="text-center">
                           <p style="font-size: 50">{{$relief}}</p>
                       </div>
                    </div>
                </div>
                <div class="col-lg-4 donation d-flex align-items-center justify-content-center">
                    <div class="display" style="background:antiquewhite">
                        <div class="text-center">
                            <p>Total Distributed Relief</p> 
                       </div>
                       <div class="text-center">
                           <p style="font-size: 50">{{$distrel}}</p>
                       </div>
                    </div>
                </div>
                <div class="col-lg-4 donation d-flex align-items-center justify-content-center">
                    <div class="display" style="background: rgb(229, 153, 207)">
                        <div class="text-center">
                            <p>Total Number of Expenses</p> 
                       </div>
                       <div class="text-center">
                           <p style="font-size: 50">{{$exp}}</p>
                       </div>
                    </div>
                </div>
            </div>
          
        </div>
</div>
@endsection