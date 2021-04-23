@extends('layout.app')

@section('content')
    <div>
        @foreach ($errors as $error)
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
            <h1>Donations</h1>
        </div>
        <div class="restable">
            @if (count($donors)>0)
            <table class="table table-striped table-sm table-fixed text-center ">
                <thead class="thead-dark">
                    <tr>
                        <th>Donor's ID</th>
                        <th>Name/Org. Name/Comp. Name</th>
                        <th>Donor Type</th>
                        <th>Contact Number</th>
                        <th>Email Address</th>
                        <th>Given Donation</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($donors as $donor)
                          <tr>
                              <td>{{$donor->donor_id}}</td>
                              <td>{{$donor->donor_name}}</td>
                              <td>{{$donor->donor_type}}</td>
                              <td>{{$donor->donor_contact_number}}</td>
                              <td>{{$donor->donor_email}}</td>
                              <td>
                              <a href="/donorInfo/{{$donor->donor_id}}" class="btn btn-outline-primary btn-sm">view</a>
                              </td>
                              <td>
                                <button type="button" class="btn btn-primary btn-sm editinfo" data-toggle="modal" data-target="#editDonor">
                                    <i class="fas fa-user-edit"></i>
                                  </button>
                              </td>
                              <td>
                                <button type="button" class="btn btn-danger btn-sm deletedonor" data-toggle="modal" data-target="#deleteDonor">
                                    Trash
                                  </button>
                              </td>
                          </tr>       
                    @endforeach
                </tbody>
            </table>     
            @else
                <p style="margin-left: 40px">This Table is empty</p>
            @endif
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
           Register new Donor
          </button>
    </div>


    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteDonor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Are sure to Delete this Donor?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{url('/delete_donor')}}" method="POST">
                {{ csrf_field() }}
                {{method_field('PUT')}}
                <div class="modal-body">
                <input type="hidden" name="id" id="delid">
                <label>Name/Org. Name/Comp.Name</label>
                <input type="text"  class="form-control" id="delname"  readonly>
                <label>Contact Number</label>
                <input type="number" class="form-control" maxlength="11" id="delcontact" readonly>
                <label>Email</label>
                <input type="text" class="form-control" id="delemail" readonly>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
          </div>
        </div>
      </div>


    {{-- Edit Modal --}}
    <div class="modal fade" id="editDonor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{url('/edit_donor_info')}}" method="POST">
                {{ csrf_field() }}
                {{method_field('PUT')}}
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                <label>Name/Org. Name/Comp.Name</label>
                <input type="text" name="name" class="form-control" id="name" required>
                <label>Contact Number</label>
                <input type="number" name="contact"  class="form-control" maxlength="11" id="contact" required>
                <label>Email</label>
                <input type="text" name="email" class="form-control" id="email" required>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
          </div>
        </div>
      </div>



    {{-- <div class="modal-bg">
        <div class="modal-display">
            <h2>Register New Donor</h2>
                <div class="container">
                    <form action="{{action('DonorsController@store')}}" method="POST" >
                        @csrf
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="name">Name / Org. Name / Comp. Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Donor Type</label>
                            <div class="form-check">
                                <input class="form-check-input" id="lgu" type="radio" name="donor_type" value="LGU">
                                <label class="form-check-label" for="lgu">LGU</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" id="ngo" type="radio" name="donor_type" value="NGO">
                                <label class="form-check-label" for="ngo">NGO</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact Number</label>
                            <input type="text" class="form-control" id="contact" name="contactnum" maxlength="11" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" id="email" class="form-control" name="email" required>
                        </div>
                        
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary float-right " type="submit">Submit form</button>
                    </div>
                     </form>
                </div>
                <span class="modal-close"><i class="fas fa-times"></i></span>
           
        </div>
    </div> --}}
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Register Donor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{action('DonorsController@store')}}" method="POST" >
            {{ csrf_field() }}
        <div class="modal-body">
            <div class="form-group">
                <label for="name">Name / Org. Name / Comp. Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Donor Type</label>
                <div class="form-check">
                    <input class="form-check-input" id="lgu" type="radio" name="donor_type" value="LGU">
                    <label class="form-check-label" for="lgu">LGU</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="ngo" type="radio" name="donor_type" value="NGO">
                    <label class="form-check-label" for="ngo">NGO</label>
                </div>
            </div>
            <div class="form-group">
                <label for="contact">Contact Number</label>
                <input type="text" class="form-control" id="contact" name="contactnum" maxlength="11" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" class="form-control" name="email" required>
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
  
    {{-- <script>
        var modalBtn = document.querySelector('.modal-btn');
        var modalBg = document.querySelector('.modal-bg');
        var modalClose = document.querySelector('.modal-close');
        modalBtn.addEventListener('click',function(){
            modalBg.classList.add('bg-active')
        });
        modalClose.addEventListener('click',function(){
            modalBg.classList.remove('bg-active')
        })
    </script>  
    script>
            var msg = '{{Session::get('success-alert')}}';
            var exist = '{{Session::has('success-alert')}}';
            if(exist){
              alert(msg);
            }
    </script>  --}}
    <script>
        $(document).ready(function() {
            $('.deletedonor').on('click',function() {
            $tr = $(this).closest('tr');
            var data = $tr.children('td').map(function (){
                return $(this).text();
            }).get();
            console.log(data);
            $('#delid').val(data[0]);
            $('#delname').val(data[1]);
            $('#delcontact').val(data[3]);
            $('#delemail').val(data[4]);
            });      
        });
    </script>

<script>
    $(document).ready(function() {
        $('.editinfo').on('click',function() {
        $tr = $(this).closest('tr');
        var data = $tr.children('td').map(function (){
            return $(this).text();
        }).get();
        console.log(data);
        $('#id').val(data[0]);
        $('#name').val(data[1]);
        $('#contact').val(data[3]);
        $('#email').val(data[4]);
        });      
    });
</script>
    
@endsection


         
