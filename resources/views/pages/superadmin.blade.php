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

        .navbar .test i{
            padding-right: 30px;
            color:black;
            font-size: 20px;
            margin: 8px 0px 8px; 
        }
        .test ul{
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        .navbar a{
            color: rgb(36, 35, 35);
        }
    
        .test ul li:hover a{
            padding-left: 60px;
            transition: .5s;
        }
        .logout{
            padding-left: 30px;
        }
    </style>
    <title>Super Admin</title>

</head>
<body>
    {{--<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Alibyo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Actions
              </a>
              <div class="dropdown-menu bg-light test" aria-labelledby="navbarDropdownMenuLink">
                    <ul>
                        <li><a class="dropdown-item" href="/resident"><i class="fas fa-users"></i>Residents</a></li>
                        <li><a class="dropdown-item" href="/donation"><i class="fa fa-hand-holding-heart"></i>Donations</a></li>
                        <li><a class="dropdown-item" href="/relief"><i class="fas fa-boxes"></i>Reliefs</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-qrcode"></i>QR-code</a></li>
                        <li><a class="dropdown-item" href="/smsSender"><i class="far fa-envelope"></i>Send SMS</a></li>
                        
                    </ul>
              </div>
            </li>
          </ul>
        </div>
    </nav> --}}
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
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
        </div>
      </nav>
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{session('success')}}
                    </div>
                @endif
              </div>
          </div>
      </div>
      <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div style="float: right">
                    <button class="btn btn-outline-primary btn-sm" onclick="disabled_account()">Disabled</button>
                    <button class="btn btn-outline-primary btn-sm" onclick="enabled_account()">Enabled</button>
                </div>
            </div>
        </div>
      </div>
      
      <div class="container-fluid">
          <div class="row">
              <div class="col col-lg-12">
                <div id="enabled" style="display: none">
                    <div class="table-responsive-lg">
                          <table class="table table-striped table-sm">
                            <thead>
                              <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Account</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($enabled_users as $user)
                                <tr>
                                   <td>{{$user->id}}</td>
                                   <td>{{$user->lastname}}, {{$user->firstname}} {{$user->middlename}}</td>
                                   <td>
                                    <div class="dropdown">
                                        <button class="btn btn-success  btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{$user->acc_status}}
                                        </button>
                                            <form method="POST">
                                            {{ csrf_field() }}
                                            {{method_field('PUT')}}
                                            <input type="hidden" name="id" value="{{$user->id}}">
                                            <input type="hidden" name="name" value="{{$user->lastname}}, {{$user->firstname}} {{$user->middlename}}"> 
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">&nbsp;
                                                <button type="submit" name="status" value="Enabled" formaction="{{url('update_admin_account')}}" class="btn btn-success btn-sm">Enable</button>
                                                &nbsp; &nbsp;
                                                <button type="submit" name="status" value="Disabled" formaction="{{url('update_admin_account')}}" class="btn btn-danger btn-sm">Disable</button>
                                            </div>
                                        </form>
                                    </div>
                                   </td>
                                  </tr>
                                @endforeach
                              
                            </tbody>
                          </table>
                    </div>
                    </div>
                    <div id="disabled" style="display: block">
                        <div class="table-responsive-lg">
                              <table class="table table-striped table-sm">
                                <thead>
                                  <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Account</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($disabled_users as $user)
                                    <tr>
                                       <td>{{$user->id}}</td>
                                       <td>{{$user->lastname}}, {{$user->firstname}} {{$user->middlename}}</td>
                                       <td>
                                            <div class="dropdown">
                                                <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{$user->acc_status}}
                                                </button>
                                                    <form method="POST">
                                                    {{ csrf_field() }}
                                                    {{method_field('PUT')}}
                                                    <input type="hidden" name="id" value="{{$user->id}}">
                                                    <input type="hidden" name="name" value="{{$user->lastname}}, {{$user->firstname}} {{$user->middlename}}"> 
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">&nbsp;
                                                        <button type="submit" name="status" value="Enabled" formaction="{{url('update_admin_account')}}" class="btn btn-success btn-sm">Enable</button>
                                                        &nbsp; &nbsp;
                                                        <button type="submit" name="status" value="Disabled" formaction="{{url('update_admin_account')}}" class="btn btn-danger btn-sm">Disable</button>
                                                    </div>
                                                </form>
                                            </div>
                                        {{-- <button class="btn btn-danger btn-sm">{{$user->acc_status}}</button> --}}
                                       </td>
                                      </tr>
                                    @endforeach
                                  
                                </tbody>
                              </table>
                        </div>
                        </div>
                  </div>
              </div>
          </div>
      </div>
      
<script>
    function disabled_account() {
    document.getElementById("disabled").style.display = "block";
    document.getElementById("enabled").style.display = "none";
    }
    function enabled_account() {
    document.getElementById("enabled").style.display = "block";
    document.getElementById("disabled").style.display = "none";
    }

    
</script>
</body>
</html>