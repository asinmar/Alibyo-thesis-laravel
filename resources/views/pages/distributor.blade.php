@extends('layout.app')

@section('content')
    <div>
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
        @endforeach
        @if (session('success'))
        <div class="alert alert-success" role="alert">
        {{session('success')}}
        </div>
        @endif
        @if (session('failed'))
        <div class="alert alert-danger" role="alert">
        {{session('failed')}}
        </div>
        @endif
    </div>
    <div class="wrapper" >
        <div>
            <h1>Distributor</h1>
        </div>
        <form action="{{url('/search_result')}}" method="POST">
            {{ csrf_field() }}
            {{method_field('PUT')}}
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-lg-3 col-md-5 col-12">
                <input type="text" name="search" class="form-control" required>
            </div>
            <div class="btn-group col-md-1" role="group" aria-label="Basic example">
                <input type="submit" class="btn btn-success" value="Search">
                <a href="/distributor" class="btn btn-danger">All</a>
            </div>
        </div>
    </form>
        <div class="restable">
            @if (count($distributors)>0)
            <div class="table-responsive-lg">
                <table class="table table-striped table-sm table-fixed text-center ">
                    <thead class="thead-dark">
                        <tr>
                            <th>Distributor ID</th>
                            <th>Last Name</th>
                            <th>FirstName</th>
                            <th>Middle Name</th>
                            <th>Gender</th>
                            <th>Contact Number</th>
                            <th>Username</th>
                            <th>Birth Date</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Reset Password</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($distributors as $distributor)
                              <tr>
                                  <td>{{$distributor->distributor_id}}</td>
                                  <td>{{$distributor->last_name}}</td>
                                  <td>{{$distributor->first_name}}</td>
                                  <td>{{$distributor->middle_name}}</td>
                                  <td>{{$distributor->gender}}</td>
                                  <td>{{$distributor->contact_number}}</td>
                                  <td>{{$distributor->username}}</td>
                                  <td>{{$distributor->date_of_birth}}</td>
                                  <td>
                                      @if ($distributor->status=='Enabled')
                                        <div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{$distributor->status}}
                                            </button>
                                            <form method="POST">
                                                {{ csrf_field() }}
                                                {{method_field('PUT')}}
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <div class="d-flex justify-content-around">
                                                        <input type="hidden" name="id" value="{{$distributor->distributor_id}}">
                                                        <button class="btn btn-success btn-sm" formaction="{{url('/update_status')}}" name="status" value="Enabled">Enable</button>
                                                        <button class="btn btn-danger btn-sm" formaction="{{url('/update_status')}}" name="status" value="Disabled">Disable</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        @else
                                        <div class="dropdown">
                                            <button class="btn btn-danger dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{$distributor->status}}
                                            </button>
                                            <form method="POST">
                                                {{ csrf_field() }}
                                                {{method_field('PUT')}}
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <div class="d-flex justify-content-around">
                                                        <input type="hidden" name="id" value="{{$distributor->distributor_id}}">
                                                        <button class="btn btn-success btn-sm" formaction="{{url('/update_status')}}" name="status" value="Enabled">Enable</button>
                                                        <button class="btn btn-danger btn-sm" formaction="{{url('/update_status')}}" name="status" value="Disabled">Disable</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                      @endif
                                  </td>
                                  <td>
                                    <button type="button" class="btn btn-primary btn-sm editinfo editbtn"  data-toggle="modal" data-target="#edit_distributor">
                                        <i class="fas fa-user-edit"></i>
                                      </button>
                                  </td>
                                  <td>
                                    <button type="button" class="btn btn-info btn-sm reset" data-toggle="modal" data-target="#reset">
                                        Reset
                                      </button>
                                  </td>
                                  <td>
                                    <button type="button" class="btn btn-danger btn-sm deletebtn" data-toggle="modal" data-target="#deletedist">
                                        delete
                                    </button>
                                  </td>
                              </tr>       
                        @endforeach
                    </tbody>
                </table>     
            </div>
            @else
                <p style="margin-left: 40px">No Distributor list</p>
            @endif
        </div>
        <div>
            {{$distributors->links()}}
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_distributor">
           Register Distributor
          </button>
    </div>

  
    <div class="modal fade" id="reset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-danger" id="exampleModalLabel">Warning!!</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
                <form action="{{url('/reset_distributor_password')}}" method="POST">
                    {{ csrf_field() }}
                    {{method_field('PUT')}}
                    <div class="modal-body">
                        <p>This will reset the Distributor's password</p>
                    <input type="hidden" name="id" id="resetid">
                    <input type="hidden" name="pass" value="password">
                        <p id="rlname" style="display: inline"></p><p style="display: inline">, </p>
                        <p id="rfname" style="display: inline"></p>
                        <p id="rmname" style="display: inline"></p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  
  
    {{-- Edit Modal --}}
    <div class="modal fade" id="edit_distributor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update Info</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form  action="{{url('edit_distributor')}}" method="POST">
                {{ csrf_field() }}
                {{method_field('PUT')}}
                <div class="modal-body">
                <input type="hidden" name="id" id="id">
                <label>Last Name</label>
                <input type="text" name="lname" id="lastname" class="form-control"  required>
                <label>First Name</label>
                <input type="text" name="fname" id="firstname" class="form-control"  required>
                <label>Middle Name</label>
                <input type="text" name="mname" id="middlename" class="form-control">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Gender</label>
                    <select class="form-control" id="gender" name="gender" id="exampleFormControlSelect1">
                      <option disabled selected ></option>
                      <option>Female</option>
                      <option>Male</option>
                    </select>
                </div>
                <label>Contact Number</label>
                <input type="number" name="contact"  class="form-control" maxlength="11" id="contact" required>
                <label for="birth">Date of Birth</label>
                <input type="date" class="form-control" id="birth" name="dob" min="1900-01-01" max="2999-01-01"  required>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
          </div>
        </div>
    </div>

{{-- delete modal --}}
<div class="modal fade" id="deletedist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{url('/delete_distributor')}}" method="POST">
            {{ csrf_field() }}
            {{method_field('PUT')}}
        <div class="modal-body">
            
                <input type="hidden" name="id" id="dist_id">
                <label>Last Name</label>
                <input type="text" id="l_name" class="form-control" readonly>
                <label>First Name</label>
                <input type="text" id="f_name" class="form-control" readonly>
                <label>Middle Name</label>
                <input type="text" id="m_name" class="form-control" readonly>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>


    <!-- Modal -->
<div class="modal fade" id="add_distributor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Register Distributor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{url('/register_distributor')}}" method="POST" >
            {{ csrf_field() }}
        <div class="modal-body">
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lname"  class="form-control" required>
            </div>
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="fname"  class="form-control" required>
            </div>
            <div class="form-group">
                <label>Middle Name</label>
                <input type="text" name="mname"  class="form-control" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Gender</label>
                <select class="form-control" name="gender" id="exampleFormControlSelect1">
                  <option disabled selected>Gender</option>
                  <option>Female</option>
                  <option>Male</option>
                </select>
            </div>
              <input type="hidden" name="status" value="Disabled">
            <div class="form-group">
                <label for="contact">Contact Number</label>
                <input type="text" class="form-control"  name="contact" maxlength="11" required>
            </div>
            <div class="form-group">
                <label for="email">Date of Birth</label>
                <input type="date" class="form-control" name="dob" required>
            </div>
            <hr>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username"  class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" value="password" class="form-control" required disabled>
            </div>
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="Confirm">
        </div>
    </form>
      </div>
    </div>
</div>
  
<script>
    $(document).ready(function() {
        $('.editbtn').on('click',function() {
        $tr = $(this).closest('tr');
        var data = $tr.children('td').map(function (){
          return $(this).text();
        }).get();
        console.log(data);
        $('#id').val(data[0]);
        $('#lastname').val(data[1]);
        $('#firstname').val(data[2]);
        $('#middlename').val(data[3]);
        $('#gender').val(data[4]);
        $('#contact').val(data[5]);
        $('#birth').val(data[7]);
      });
    });
</script>


<script>
    $(document).ready(function() {
        $('.deletebtn').on('click',function() {
        $tr = $(this).closest('tr');
        var data = $tr.children('td').map(function (){
          return $(this).text();
        }).get();
        console.log(data);
        $('#dist_id').val(data[0]);
        $('#l_name').val(data[1]);
        $('#f_name').val(data[2]);
        $('#m_name').val(data[3]);
      });
    });
</script>

<script>
    $(document).ready(function() {
        $('.reset').on('click',function() {
        $tr = $(this).closest('tr');
        var data = $tr.children('td').map(function (){
          return $(this).text();
        }).get();
        console.log(data);
        $('#resetid').val(data[0]);

        document.getElementById('rlname').innerHTML = data[1];
        document.getElementById('rfname').innerHTML = data[2];
        document.getElementById('rmname').innerHTML = data[3];
      });
    });
</script>

@endsection


         
