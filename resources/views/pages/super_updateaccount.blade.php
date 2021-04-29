<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
    .main{
        margin-top:20px;
    }
    .classbody{
        border: 1px solid;
        border-radius: 10px;
        border-color: black;
        background: gainsboro;
    }
    .maincont{
        margin-top:20px;
        border:1px solid;
        border-radius: 5px;
    
    }
    p{
      font-size: 20px;
    }
</style>
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/super_admin">Alibyo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->lastname }},  {{ Auth::user()->firstname }}  {{ Auth::user()->middlename }}<span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <a class="dropdown-item" href="{{ url('edit_super_admin_account') }}">
                            {{ __('Edit Profile') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
        </div>
      </nav><div class="container-fluid main">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
          @foreach ($errors->all() as $error)
          <div class="alert alert-danger" role="alert">
            {{$error}}
          </div>
          @endforeach
          @if (session('error'))
            <div class="alert alert-danger" role="alert">
              {{session('error')}}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success" role="alert">
              {{session('success')}}
            </div>
        @endif
            <div class="d-flex justify-content-center  classbody">
                <h5>Edit Account</h5>
            </div>
            <div class="col-md-12 maincont">
                <p><strong>Name: </strong>{{Auth::user()->lastname}}, {{Auth::user()->firstname}} {{Auth::user()->middlename}}</p>
                <p><strong>Contact No.: </strong>{{Auth::user()->contact_number}}</p>
                <p><strong>Email: </strong>{{Auth::user()->email}}</p>
                <a type="button" href="" data-toggle="modal" data-target="#editAccount">Edit Account</a><br>
                <a type="button" href="" data-toggle="modal" data-target="#changepassModal">Change Password</a>
            </div>
            <a href="/super_admin" class="btn btn-danger btn-sm">Return</a>
        </div>
    </div>
</div>
{{-- Edit Acc modal --}}
<div class="modal fade" id="editAccount" tabindex="-1" role="dialog" aria-labelledby="editAccountLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editAccountLabel">Edit Account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('updateUser')}}" method="POST">
          {{ csrf_field() }}
          {{method_field('PUT')}}
        <div class="modal-body">
          <label>Last Name</label>
          <input type="text" name="lname" class="form-control" value="{{Auth::user()->lastname}}" required>
          <label>First Name</label>
          <input type="text" name="fname" class="form-control" value="{{Auth::user()->firstname}}" required>
          <label>middle Name</label>
          <input type="text" name="mname" class="form-control" value="{{Auth::user()->middlename}}">
          <label>Contact Number</label>
          <input type="text" name="contactnum" maxlength="11" class="form-control" value="{{Auth::user()->contact_number}}">
          <label>Email</label>
          <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="Save Changes">
        </div>
      </form>
      </div>
    </div>
  </div>
{{-- Change Pass modal --}}
  <div class="modal fade" id="changepassModal" tabindex="-1" role="dialog" aria-labelledby="changepassModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changepassModalLabel">Change Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('changepass')}}" method="POST">
          {{ csrf_field() }}
          {{method_field('PUT')}}
        <div class="modal-body">
            <label for="">Enter Old Password</label>
            <input type="password" name="oldpass" class="form-control">
            <label for="">Enter New Password</label>
            <input type="password" name="new_password" class="form-control" autocomplete="new-password">
            <label for="">Confirm Password</label>
            <input type="password" name="confirmpass" class="form-control" autocomplete="new-password">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" value="Submit" class="btn btn-primary">
        </div>
      </div>
    </form>
    </div>
  </div>

    
</body>
</html>


