<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <title>QR-CODE</title>
</head>
<style>
    .qrcontainer{
        background: white;
        margin: 20% 0px 0px;
        height: 220px;
        border:2px dashed;
        padding-top: 10px;
        padding-left: 10px;
        padding-right: 10px;
        padding-bottom: 10px;
    }
    .bg{
        margin-top:50px;
        background:#fdff93;
        border: 1px solid;
        border-radius: 10px;
        height: 500px;
       

    }
    .com{
        position: absolute;
        padding-top:350px;
    }
    
</style>
<body>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="bg col-lg-5 col-md-10 col-xs-12  d-flex justify-content-center" >
                <div class="qrcontainer">
                   
                    {{$qrcode}}
                </div>
                <div class="com">
                    <h5><strong>Resident's Qr-Code</strong></h5>
                    <h6>Kindly to open snipping tool to copy the qrcode</h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <div d-flex justify-content-center>
                    <a href="/resident" class="btn btn-outline-danger">Return</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>