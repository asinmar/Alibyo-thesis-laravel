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
    <a class="navbar-brand" href="/donation_recieved">Alibyo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item a">
          <a class="nav-link" href="/donation_recieved">Donations<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item a">
          <a class="nav-link" href="/barangay_relief_receivers">Residents<span class="sr-only"></span></a>
        </li>
        <li class="nav-item a">
          <a class="nav-link" href="/relief_information">Reliefs<span class="sr-only"></span></a>
        </li>
        <li class="nav-item a">
          <a class="nav-link" href="/barangay_expenditures">Expenditures<span class="sr-only"></span></a>
        </li>
        <li class="nav-item a">
          <a class="nav-link" href="/barangay_trashed">Trashed<span class="sr-only"></span></a>
        </li>
      </ul> 
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
                    <a class="dropdown-item" href="{{ url('/update_information') }}">
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
  </nav>