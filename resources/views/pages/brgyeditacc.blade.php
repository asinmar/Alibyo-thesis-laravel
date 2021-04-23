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
@extends('layout.brgyUser')

@section('content')

<div class="container-fluid main">
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
@endsection
