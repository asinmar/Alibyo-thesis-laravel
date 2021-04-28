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
        height:100px;
        width: 100px;
        border: 1px solid;
        border-radius: 5px;
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
        border-radius: 5px;
        height: 150px;
        width: 380px;

    }
    .image2 img{
        height:100px;
        width: 250px;
        border: 1px solid;
        border-radius: 5px;
        margin-top:10px;
        margin-bottom: 10px;
    }

    #brgy{
        margin-top: 30px;
        font-size: 140px;
        font-family: "Times New Roman", Times, serif;
    }
    .leftbox{
        display: block;
        height: 720px;
        background-color: rgb(226, 211, 240);
    }
    .right .col-lg-6{
        margin-top: 50px;
     
    }
    .right{
        margin-top:40px;
    }
    .top-display{
        background-color: rgb(61, 61, 61);
        height: 40px;
        margin-top: 0;
        font-family: 
    }
    .top-display p{
        
        font-size: 24px;
        color: white;
        font-family: "Times New Roman", Times, serif;
    }
    @media only screen and (max-width:411px){
        .leftbox{
            display: none;
      
         }
    }
    .right .values{
        font-family: "Times New Roman", Times, serif;
        font-size: 60;
    }
</style>
@extends('layout.app')

@section('content')

<div class="container-fluid">
    <div class="row ">
        <div class="col-lg-6 leftbox">
            <div class="d-flex justify-content-around">
                <div class="image d-inline">
                    <img src="/img/brgylogo.jpg" class="Lapasan logo"> 
                </div>
                <div class="image2 d-inline">
                    <img src="/img/logo2.png" alt="CDO Logo">   
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <p id="brgy">Barangay <br>Lapasan</p>
            </div>
        </div>
        <div class="col-lg-6 right">
            <div class="row">
                <div class="col-lg-6">
                    <div class="display" >
                        <div class="text-center top-display">
                            <p>Total Residents</p> 
                       </div>
                       <div class="text-center">
                           <p class="values">{{$res}}</p>
                       </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="display ">
                        <div class="text-center  top-display">
                            <p>Total Donors</p> 
                       </div>
                       <div class="text-center">
                           <p class="values">{{$donor}}</p>
                       </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="display">
                        <div class="text-center  top-display">
                            <p>Total Donations</p> 
                       </div>
                       <div class="text-center">
                           <p class="values">{{$donation}}</p>
                       </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="display">
                        <div class="text-center  top-display">
                            <p>Total Relief</p> 
                       </div>
                       <div class="text-center">
                           <p class="values">{{$relief}}</p>
                       </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="display">
                        <div class="text-center  top-display">
                            <p>Total Distributed Relief</p> 
                       </div>
                       <div class="text-center">
                           <p class="values">{{$distrel}}</p>
                       </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="display">
                        <div class="text-center  top-display">
                            <p>Total Number of Expenses</p> 
                       </div>
                       <div class="text-center">
                           <p class="values">{{$exp}}</p>
                       </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<!-- {{-- <div class="main-body">
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
                           <p class="values">{{$res}}</p>
                       </div>
                    </div>
                </div>
                <div class="col-lg-4 donation d-flex align-items-center justify-content-center">
                    <div class="display " style="background: aquamarine">
                        <div class="text-center">
                            <p>Total Donors</p> 
                       </div>
                       <div class="text-center">
                           <p class="values">{{$donor}}</p>
                       </div>
                    </div>
                </div>
                <div class="col-lg-4 donation d-flex align-items-center justify-content-center">
                    <div class="display" style="background: azure">
                        <div class="text-center">
                            <p>Total Donations</p> 
                       </div>
                       <div class="text-center">
                           <p class="values">{{$donation}}</p>
                       </div>
                    </div>
                </div>
                <div class="col-lg-4 donation d-flex align-items-center justify-content-center">
                    <div class="display" style="background: beige">
                        <div class="text-center">
                            <p>Total Relief</p> 
                       </div>
                       <div class="text-center">
                           <p class="values">{{$relief}}</p>
                       </div>
                    </div>
                </div>
                <div class="col-lg-4 donation d-flex align-items-center justify-content-center">
                    <div class="display" style="background:antiquewhite">
                        <div class="text-center">
                            <p>Total Distributed Relief</p> 
                       </div>
                       <div class="text-center">
                           <p class="values">{{$distrel}}</p>
                       </div>
                    </div>
                </div>
                <div class="col-lg-4 donation d-flex align-items-center justify-content-center">
                    <div class="display" style="background: rgb(229, 153, 207)">
                        <div class="text-center">
                            <p>Total Number of Expenses</p> 
                       </div>
                       <div class="text-center">
                           <p class="values">{{$exp}}</p>
                       </div>
                    </div>
                </div>
            </div>
          
        </div>
</div> --}} -->
@endsection