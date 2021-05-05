<?php 
use Carbon\Carbon;
?>
@extends('layout.app')
@section('content')
  <div class="wrapper">
      <h1>Resident List</h1>
      <div class="container-fluid p-2" >
        <div class="row d-flex">
            <div class="col-lg-4 col-md-6 col-sm-12 col-12 d-inline ">
                <form action="{{action('ResidentsController@index')}}" method="POST">
                    <div class="input-group">
                            {{ csrf_field() }}
                            {{method_field('GET')}}
                            <select  required name="purok" id="purokopt" class="form-control form-control-sm"  >
                                <option selected  hidden >{{$selpurok}}</option>
                                <option>all</option>
                                <option>CENTRO KOLAMBOG</option>
                                <option>SAN ISIDRO LABRADOR</option>
                                <option>LAPAZ I</option>
                                <option>LAPAZ II</option>
                                <option>STO. NIÑO</option>
                                <option>SAN JUAN I</option>
                                <option>SAN JUAN II</option>
                                <option>LAMBAGO</option>
                                <option>SAN LAZARO</option>
                                <option>SEASIDE KOLAMBOG</option>
                                <option>UPPER KOLAMBOG</option>
                                <option>WESTERN KOLAMBOG</option>
                                <option>MAMBATO</option>
                                <option>LITTLE CEBU</option>
                                <option>LAPSAP</option>
                                <option>LAWESBRA</option>
                            </select>
                            <div class="input-group-append">
                                <input type="submit" class="btn btn-outline-primary btn-sm" value="Search Purok">
                            </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-8 col-md-6 col-12 d-inline d-flex justify-content-lg-end justify-content-center justify-content-md-end " >
              <form class="form-inline" action="{{action('ResidentsController@index')}}" method="POST" >
                  {{ csrf_field() }}
                  {{method_field('GET')}}
                  <input type="text" name="name_search" class="form-control form-control-sm" placeholder="Enter Family Name" required>
                    <input type="submit" value="Search" class="btn btn-outline-success btn-sm">  
              </form>
            </div>
        </div>
        {{-- <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <form action="{{action('ResidentsController@index')}}" method="POST" >
                    <div class="form-group">
                        @csrf
                        {{method_field('GET')}}
                          <input type="text" name="name_search" class="form-control" placeholder="enter Family Name" required>  
                          <div class="d-flex justify-content-center">
                            <input type="submit" value="Search Family Name" class="btn btn-outline-success sm">   
                        </div>           
                    </div>
                    
                </form>
            </div>
        </div> --}}
    </div>
      <div class="restable">
            @if (count($residents)>0)
            <div class="table-responsive-xl">
                <table class="table table-striped table-fixed text-center table-sm ">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Last Name</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Middle Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Age</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Purok</th>
                            <th scope="col">Civil Status</th>
                            <th scope="col">Family Number</th>
                            <th scope="col">Qr Status</th>
                            <th scope="col">Qr-Code</th>
                            <th scope="col" colspan="2">Action</th>  
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($residents as $resident)
                              <tr>
                                  <td style="display: none">{{$resident->res_id}}</td>
                                  <td>{{$resident->res_last_name}}</td>
                                  <td>{{$resident->res_first_name}}</td>
                                  <td>{{$resident->res_middle_name}}</td>
                                  <td>{{$resident->res_gender}}</td>
                                  <?php
                                  $dob = $resident->res_date_of_birth;
                                  $years = Carbon::parse($dob)->age;
                                  ?>
                                  <td>{{$years}}</td>
                                  <td>{{$resident->res_contact_number}}</td>
                                  <td>{{$resident->res_purok}}</td>
                                  <td>{{$resident->res_civil_status}}</td>
                                  <td>{{$resident->res_family_number}}</td>
                                  <td style="display: none">{{$resident->res_date_of_birth}}</td>
                                  <td style="display: none">{{$resident->res_barangay}}</td>
                                  <td style="display: none">{{$resident->res_qrcode_status}}</td>
                                  <td>
                                    @if ($resident->res_qrcode_status=='Enabled')
                                    <button class="btn btn-success  btn-sm enablebtn" style="height: 32px" type="button"  >
                                      {{$resident->res_qrcode_status}}
                                    </button>
                                    @else
                                    <button class="btn btn-danger  btn-sm enablebtn" style="height: 32px" type="button"  >
                                      {{$resident->res_qrcode_status}}
                                    </button>
                                    @endif   
                                  </td>
                                  <td><a href="/resident/{{$resident->res_id}}" class="btn btn-outline-primary btn-sm"><i class="fas fa-qrcode"></i></a></td>
                                  {{-- <td><a href="/resident/{{$resident->res_id}}/edit" ><i class="fas fa-user-edit"></i>Edit</a></td> --}}
                                  <td><a href="#" class="btn btn-outline-primary btn-sm editbtn"><i class="fas fa-user-edit"></i>Edit</a></td>
                                  <td><a href="#" style="color: red" class="btn btn-outline-danger btn-sm deletebtn" data-toggle="modal" data-target="#residentdeletemodal  "><i class="fas fa-trash"></i>Delete</a></td>    
                                 
                                </tr>       
                        @endforeach
                    </tbody>
                </table> 
            </div>    
          @else
              <p style="margin-left: 40px">NO RESULTS FOUND</p>
          @endif
      </div>


      <div class="dropdown">
        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Menu
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#residentaddmodal" >
            Register Resident
          </button>
        
          <button type="button" class="btn btn-outline-info btn-sm purokupdate" data-toggle="modal" data-target="#updatepurokqr" >
            Update Purok QR
          </button>
        
          <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Update All QR
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <button type="button" class="dropdown-item" data-toggle="modal" data-target="#enablemodal">
              Enable
            </button>
            <button type="button" class="dropdown-item" data-toggle="modal" data-target="#disablemodal">
              Disable
            </button>
          </div>
      </div>
       

        
      
    </div>
  </div>

<!--Enable all qr Modal -->
<div class="modal fade" id="enablemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><p style="color: red">Warning!!</p></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{action('ResidentsController@updateAllQr')}}" method="POST">
        {{ csrf_field() }}
        {{method_field('PUT')}}
        <div class="modal-body">
          <input type="hidden" name="allqr" value="Enabled">
          <h5>This will ENABLE all QR-code status</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" value="Proceed" class="btn btn-primary">
        </div>
    </form>
    </div>
  </div>
</div>

<!--disable all qr Modal -->
<div class="modal fade" id="disablemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><p style="color: red">Warning!!</p></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{action('ResidentsController@updateAllQr')}}" method="POST">
        {{ csrf_field() }}
        {{method_field('PUT')}}
        <div class="modal-body">
            <input type="hidden" name="allqr" value="Disabled">
            <h5>This will DISABLE all QR-code status</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" value="Proceed" class="btn btn-primary">
        </div>
      </form>
    </div>
  </div>
</div>

{{-- update specific purok qr --}}
<div class="modal fade" id="updatepurokqr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Purok QR-code</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{-- <form action="{{action('ResidentsController@purokQrupdate')}}" method="POST"> --}}
        <form id="update-purok-qr-modal">
        {{ csrf_field() }}
        {{method_field('PUT')}}
      <div class="modal-body">
        <label>Select QR Update</label>
        <select class="form-select" aria-label="Default select example" name="purokqrupdate" required>
          <option disabled selected>Select Update</option>
          <option value="Enabled">Enable</option>
          <option value="Disabled">Disable</option>
        </select>
        <label>Select Purok</label>
        <select class="form-select" aria-label="Default select example" name="purok" required>
          <option disabled selected>Select Purok---</option>
          <option>CENTRO KOLAMBOG</option>
          <option>SAN ISIDRO LABRADOR</option>
          <option>LAPAZ I</option>
          <option>LAPAZ II</option>
          <option>STO. NIÑO</option>
          <option>SAN JUAN I</option>
          <option>SAN JUAN II</option>
          <option>LAMBAGO</option>
          <option>SAN LAZARO</option>
          <option>SEASIDE KOLAMBOG</option>
          <option>UPPER KOLAMBOG</option>
          <option>WESTERN KOLAMBOG</option>
          <option>MAMBATO</option>
          <option>LITTLE CEBU</option>
          <option>LAPSAP</option>
          <option>LAWESBRA</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  
        <input type="submit" class="btn btn-primary" value="Proceed">
      </div>
    </form>
    </div>
  </div>
</div>

  <!-- Add Resident Modal -->
  <div class="modal fade" id="residentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        {{-- <form action="{{action('ResidentsController@store')}}" method="POST"> --}}
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Register New Resident</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          {{-- <form id="addform" > --}}
            <form action="{{action('ResidentsController@duplicateCheck')}}" method="POST">
            {{ csrf_field() }}
            {{method_field('PUT')}}
          <div class="modal-body">
            
            <div class="form-group">
              <label for="lastname">Last Name</label>
              <input type="text" class="form-control"  name="last_name" placeholder="Last Name" required>
            </div>
            <div class="form-group">
              <label for="firstname">First Name</label>
              <input type="text" class="form-control"  name="first_name" placeholder="Fist Name" required>
            </div>
            <div class="form-group">
              <label for="middlename">Middle Name</label>
              <input type="text" class="form-control"  name="middle_name" placeholder="Middle Name">
            </div>
            <div class="form-group">
              <label for="gender">Gender</label>
                <select name="gender" class="form-control"  required>
                  <option disabled selected>Gender---</option>
                  <option>Male</option>
                  <option>Female</option>
                </select>
            </div>
            {{-- <div class="form-group">
              <label for="">Gender: </label>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Male" required>
                <label class="form-check-label" for="inlineRadio1">Male</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Female" required>
                <label class="form-check-label" for="inlineRadio2">Female</label>
              </div>
            </div> --}}
            <div class="form-group">
              <label for="age">Birth Date</label>
              <input type="date" class="form-control" id="regage" name="dob" onkeyup="regAgeCalc(this)" min="1900-01-01" max="2999-01-01" required>
            </div>
            <p id="warn" style="color: red"></p>
            <div class="form-group">
              <label for="contactnum">Contact Number</label>
              <input type="tel" class="form-control"  name="contact_number" maxlength="11" pattern="[0-9]{11}" placeholder="09XXXXXXXXX" required>
            </div>
            <div class="form-group">
              <label for="purok">Purok</label>
                <select name="purok" class="form-control" required>
                  <option disabled selected>Select Purok---</option>
                  <option>CENTRO KOLAMBOG</option>
                  <option>SAN ISIDRO LABRADOR</option>
                  <option>LAPAZ I</option>
                  <option>LAPAZ II</option>
                  <option>STO. NIÑO</option>
                  <option>SAN JUAN I</option>
                  <option>SAN JUAN II</option>
                  <option>LAMBAGO</option>
                  <option>SAN LAZARO</option>
                  <option>SEASIDE KOLAMBOG</option>
                  <option>UPPER KOLAMBOG</option>
                  <option>WESTERN KOLAMBOG</option>
                  <option>MAMBATO</option>
                  <option>LITTLE CEBU</option>
                  <option>LAPSAP</option>
                  <option>LAWESBRA</option>
                </select>
              
            </div>
            <input type="hidden" name="barangay" value="Lapasan">
            <input type="hidden" name="qrcode" value="Disabled">
            <div class="form-group">
              <label for="civil_stat">Civil Status</label>
                <select name="civil_status" class="form-control" required>
                  <option disabled selected>Civil Status---</option>
                  <option>Single</option>
                  <option>Married</option>
                  <option>Divorced</option>
                  <option>Widowed</option>
                </select>
            </div>
            <div class="form-group">
              <label for="family_num">Family Number</label>
              <input type="number" class="form-control" name="family_number" placeholder="Family Number" required>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            {{-- <input type="submit" value="Submit" class="btn btn-primary"> --}}
            <button type="submit" class="btn btn-primary">Register Resident</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  {{-- End of Add --}}
 

  <!-- Edit Resident Modal -->
  <div class="modal fade" id="residenteditmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        {{-- <form action="{{action('ResidentsController@store')}}" method="POST"> --}}
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Resident Info</h5>
            <button type="button" class="close closebtn" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="editform" >
            {{ csrf_field() }}
            {{method_field('PUT')}}
          <div class="modal-body">
            <input type="hidden" name="id" id="id">
            <div class="form-group">
              <label for="lastname">Last Name</label>
              <input type="text" class="form-control" id="lastname" name="last_name" placeholder="Last Name" required>
            </div>
            <div class="form-group">
              <label for="firstname">First Name</label>
              <input type="text" class="form-control" id="firstname" name="first_name" placeholder="Fist Name" required>
            </div>
            <div class="form-group">
              <label for="middlename">Middle Name</label>
              <input type="text" class="form-control" id="middlename" name="middle_name" placeholder="Middle Name" required>
            </div>
            <div class="form-group">
              <label for="gender">Gender</label>
                <select name="gender" class="form-control" id="gender" required>
                  <option disabled selected>Gender---</option>
                  <option>Male</option>
                  <option>Female</option>
                </select>
            </div>
            <div class="form-group">
              <label for="age">Birth Date</label>
              <input type="date" class="form-control" id="age" name="dob" onkeyup="agecalc(this)" min="1900-01-01" max="2999-01-01" required>
              
              <p id="test" style="color: red"></p>
            </div>
            <div class="form-group">
              <label for="contactnum">Contact Number</label>
              <input type="tel"  class="form-control" id="contactnum" name="contact_number" maxlength="11" pattern="[0-9]{11}" placeholder="09XXXXXXXXX" required>
            </div>
            <div class="form-group">
              <label for="purok">Purok</label>
                <select name="purok" class="form-control" id="purok" required>
                  <option disabled selected>Select Purok---</option>
                  <option>CENTRO KOLAMBOG</option>
                  <option>SAN ISIDRO LABRADOR</option>
                  <option>LAPAZ I</option>
                  <option>LAPAZ II</option>
                  <option>STO. NIÑO</option>
                  <option>SAN JUAN I</option>
                  <option>SAN JUAN II</option>
                  <option>LAMBAGO</option>
                  <option>SAN LAZARO</option>
                  <option>SEASIDE KOLAMBOG</option>
                  <option>UPPER KOLAMBOG</option>
                  <option>WESTERN KOLAMBOG</option>
                  <option>MAMBATO</option>
                  <option>LITTLE CEBU</option>
                  <option>LAPSAP</option>
                  <option>LAWESBRA</option>
                </select>
              
            </div>
            <input type="hidden" name="barangay" id="barangay">
            <input type="hidden" name="qrcode" id="qrstatus">
            <div class="form-group">
              <label for="civil_stat">Civil Status</label>
                <select name="civil_status" class="form-control" id="civil_stat" required>
                  <option disabled selected>Civil Status---</option>
                  <option>Single</option>
                  <option>Married</option>
                  <option>Divorced</option>
                  <option>Widowed</option>
                </select>
            </div>
            <div class="form-group">
              <label for="family_num">Family Number</label>
              <input type="number" class="form-control" id="family_num" name="family_number" placeholder="Family Number" required>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button"  class="btn btn-secondary closebtn" data-dismiss="modal">Close</button>
            {{-- <input type="submit" value="Submit" class="btn btn-primary"> --}}
            <button type="submit" class="btn btn-primary">Update Resident</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  {{-- End of Edit Modal --}}

  <div class="modal fade" id="residentdeletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="text-danger" style="padding-right:15px"><i class="fas fa-exclamation-circle"></i></h3>
          <h5 class="modal-title text-danger" id="exampleModalLongTitle">Warning!!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{-- <form action="{{action('ResidentsController@softdelete')}}" method="POST"> --}}
          <form id="deleteform">
          {{ csrf_field() }}
          {{method_field('PUT')}}
        
        <div class="modal-body">
          <h6>This Resident will be <strong>DELETED</strong></h6>
          <input type="hidden" id="delid" name="deleteid">
          <label>Last Name</label>
          <input type="text" id="dellname" class="form-control" readonly>
          <label>First Name</label>
          <input type="text" id="delfname" class="form-control" readonly>
          <label>Middle Name</label>
          <input type="text" id="delmname" class="form-control" readonly>
          <label>Purok</label>
          <input type="text" id="delpurok" class="form-control" readonly>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-danger" value="Confirm">
        </div>
      </div>
    </form>
    </div>
  </div>

  {{-- edit qr-code Modal --}}
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Update QR-Code Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="edit-qr-status" >
          {{ csrf_field() }}
          {{method_field('PUT')}}
          <div class="modal-body">
              <input type="hidden" name="qrida" id="qrida">
              <select name="qrstat" class="form-control">
                <option disabled selected>Select Action</option>
                <option value="Enabled">Enable</option>
                <option value="Disabled">Disable</option> 
              </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary " data-dismiss="modal" id="closeQrModal">Close</button>
            <input type="submit" value="Save Changes" class="btn btn-primary">
          </div>
        </form> 
      </div>
    </div>
  </div>

{{-- update qr code --}}
<script>
   $(document).ready(function() {
    $('.enablebtn').on('click',function() {
      $('#exampleModalCenter').modal('show');
      $tr = $(this).closest('tr');

      var data = $tr.children('td').map(function (){
        return $(this).text();
      }).get();

      console.log(data);
      $('#qrida').val(data[0]);
     

    });
    

    $('#edit-qr-status').on('submit',function(e) {
      e.preventDefault();
      var id = $('#qrida').val();
      $.ajax({
        type: "PUT",
        url: "/residentupdateqr/"+id,
        data: $('#edit-qr-status').serialize(),
        success: function(response){
          console.log(response);
          $('#exampleModalCenter').modal('hide');
          alert('Data updated');
          location.reload();
        },
        error: function(error) {
          console.log(error);
          alert('Error Update');
        },
      });
    });
  });
</script>
<script>
  $(document).ready(function() {
    $('#closeQrModal').on('click',function() {
      $('#exampleModalCenter').modal('hide');
    });
  });
</script>
{{-- end update qr code --}}

{{-- adding resident --}}
{{-- <script>
  
    $(document).ready(function() {

      $('#addform').on('submit',function(e) {
        e.preventDefault();

        $.ajax({
          type: "POST",
          url: "/residentadd",
          data: $('#addform').serialize(),
          success: function(response) {
            console.log(response)
            $(".fade").hide();
            $('#residentaddmodal').hide();
            // $("#addform").trigger("reset");
            alert('Data Saved');
            location.reload();
            
          },
          error:function(error) {
            console.log(error)
            alert('Data Not Saved');
          }
        });
      });
    });
</script> --}}

{{-- editing resident --}}
<script>
  $(document).ready(function() {
    $('.editbtn').on('click',function() {
      $('#residenteditmodal').modal('show');

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
      $('#age').val(data[10]);
      $('#contactnum').val(data[6]);
      $('#purok').val(data[7]);
      $('#civil_stat').val(data[8]);
      $('#family_num').val(data[9]);
      $('#barangay').val(data[11]);
      $('#qrstatus').val(data[12]);
    });
    $('#editform').on('submit',function(e) {
      e.preventDefault();
      var id = $('#id').val();
      $.ajax({
        type: "PUT",
        url: "/residentupdate/"+id,
        data: $('#editform').serialize(),
        success: function(response){
          console.log(response);
          $('#residenteditmodal').modal('hide');
          alert('Data updated');
          location.reload();
        },
        error: function(error) {
          console.log(error);
          alert('Update Error');
        },
      });
    });
  });
</script>
<script>
  $(document).ready(function() {
    $('.closebtn').on('click',function() {
      $('#residenteditmodal').modal('hide');
    });
  });
</script>
{{-- end editing resident --}}


{{-- Delete resident --}}
<script>
  $(document).ready(function() {
    $('.deletebtn').on('click',function() {
      $tr = $(this).closest('tr');
      var data = $tr.children('td').map(function (){
        return $(this).text();
      }).get();
      console.log(data);
      $('#delid').val(data[0]);
      $('#dellname').val(data[1]);
      $('#delfname').val(data[2]);
      $('#delmname').val(data[3]);
      $('#delpurok').val(data[7]);
    });
    

    $('#deleteform').on('submit',function(e) {
      e.preventDefault();
      var id = $('#id').val();
      $.ajax({
        type: "PUT",
        url: "/residentdelete/"+id,
        data: $('#deleteform').serialize(),
        success: function(response){
          console.log(response);
          $('#residentdeletemodal').modal('hide');
          alert('Data Deleted');
          location.reload();
        },
        error: function(error) {
          console.log(error);
          alert('Submission Error');
        },
      });
    });
  });
</script>
{{-- age indicator for update --}}
<script>
  function agecalc(val){
    var dob = document.getElementById("age").value;
     var age = Math.floor((new Date() - new Date(dob).getTime()) / 3.15576e+10)
      if (age >=100) {
        document.getElementById("test").innerHTML = "Resident is 100 y/o and above! please proceed if necessary";
      } else if (age<18){
        document.getElementById("test").innerHTML = "Resident is minor. Please proceed if necessary";
        
      }else{
        document.getElementById("test").innerHTML = "";
      }
    
  }
</script>

{{-- age indicator for register --}}
<script>
  function regAgeCalc(val){
    var dob = document.getElementById("regage").value;
     var age = Math.floor((new Date() - new Date(dob).getTime()) / 3.15576e+10)
      if (age >=100) {
        document.getElementById('warn').innerHTML = "Resident is 100 y/o and above! please proceed if necessary";
      } else if (age<18){
        document.getElementById("warn").innerHTML = "Resident is minor. Please proceed if necessary";
        
      }else{
        document.getElementById("warn").innerHTML = "";
      }
    
  }
</script>

{{-- alert scripts --}}
<script>
  var msg = '{{Session::get('alert')}}';
  var exist = '{{Session::has('alert')}}';
  if(exist){
    alert(msg);
  }
</script>

{{-- end alert scripts --}}

{{-- update purok qr code --}}
<script>
  $(document).ready(function() {
  //  $('.purokupdate').on('click',function() {
  //    $('#updatepurokqr').modal('show');
  //  });
   $('#update-purok-qr-modal').on('submit',function(e) {
     e.preventDefault();
     $.ajax({
       type: "PUT",
       url: "/purokqrupdate",
       data: $('#update-purok-qr-modal').serialize(),
       success: function(response){
         console.log(response);
        //  $('#updatepurokqr').modal('hide');
         alert('Purok QR Updated');
         location.reload();
       },
       error: function(error) {
         console.log(error);
         alert('Error Update');  
       },
     });
   });
 });
</script>
{{-- <script>
  $(document).ready(function() {
    $('.purokmodalclose').on('click',function() {
      $('#updatepurokqr').modal('hide');
    });
  });
</script> --}}
{{-- end update purok qr code --}}
@endsection
    


 