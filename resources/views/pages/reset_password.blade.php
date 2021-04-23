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
    <style>
        .container{
            margin-top:4rem
        }
    </style>
    <title>Forget Password</title>
</head>
<body class="bg-light">
    <div class="container border bg-white">
        <div class="row">
            <div class="col password-reset d-flex justify-content-center">
                <h2>Password Reset</h2>
            </div> 
            <div class="col-md-12">
                @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{session('error')}}
                </div>
                @endif
            </div>
            <div class="col-md-12">
                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{session('success')}}
                </div>
                @endif
            </div>
            <div class="col-md-12 d-flex justify-content-center">  
                <div class="col-md-8" style="float: left">
                    <form action="{{url('/send_email')}}" method="POST">
                        {{ csrf_field() }}
                    <label>Please Enter Email</label>
                    <input type="email" name="email" class="form-control"  placeholder="sample@sample.com">
                    <a href="/" class="btn btn-danger">Return</a>
                    <input type="submit" class="btn btn-secondary" style="float: right" value="Reset">
                </form>
                </div> 
            </div>
        </div>
    </div>
    
</body>
</html>