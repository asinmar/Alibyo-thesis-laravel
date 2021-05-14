<style>
    .head{
        background-color: gainsboro;
        margin-bottom: 5px;
        border: 1px solid;
        border-radius: 3px;
    }
</style>
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
        @if (session('successcomp'))
        <div class="alert alert-info" role="alert">
        {{session('successcomp')}}
        </div>
        @endif
        
    </div>
    <div class="wrapper" >
        <div class="head">
            <h2>Donations</h2>
            <div style="float: right">
                <button class="btn btn-outline-primary btn-sm" onclick="pending()">Pending</button>
                <button class="btn btn-outline-primary btn-sm" onclick="completed()">Completed</button>
            </div>
        </div>
        {{-- Pending Donations --}}
        <div class="restable" id="pending">
            <div class="table-responsive-lg">
                @if (count($donations)>0)
                    <table class="table table-striped table-sm table-fixed text-center ">
                        <thead class="thead-dark">
                            <tr>    
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Amount</th>
                                <th>Donation Description</th>
                                <th>Donation Type</th>
                                <th>Donation Status</th>
                                <th>Received By</th>
                                <th>Date Received</th>
                                <th>Delete</th>
                                <th>Use</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($donations as $donation)
                            <tr>
                                <td style="display: none">{{$donation->donation_id}}</td>
                                <td>{{$donation->donation_quantity}}</td>
                                <td>{{$donation->donation_unit}}</td>
                                <td>{{$donation->donation_amount}}</td>
                                <td>{{$donation->donation_description}}</td>
                                <td>{{$donation->donation_type}}</td>
                                <td>{{$donation->donation_status}}</td>
                                <td>{{$donation->donation_recieved_by}}</td>
                                <td>{{$donation->created_at}}</td>
                                <td><button type="button" class="btn btn-outline-danger deletebtn" data-toggle="modal" data-target="#delete_modal">
                                    <i class="far fa-trash-alt"></i>
                                  </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm completebtn" data-toggle="modal" data-target="#completedmodal">
                                        Complete
                                      </button>
                                </td>
                            </tr>      
                            @endforeach    
                    
                        </tbody>
                    </table>
                @else
                    <p>No Donations Recorded yet!</p>
                @endif                 
    
            </div>
        </div> 

        {{-- Completed Donations --}}
        <div class="restable" id="completed" style="display:none">    
            <div class="table-responsive-lg">
                @if (count($compdonations)>0)
                    <table class="table table-striped table-sm table-fixed text-center ">
                        <thead class="thead-dark">
                            <tr>    
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Amount</th>
                                <th>Donation Description</th>
                                <th>Donation Type</th>
                                <th>Donation Status</th>
                                <th>Received By</th>
                                <th>Date Received</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($compdonations as $compdonation)
                            <tr>
                                <td style="display: none">{{$compdonation->donation_id}}</td>
                                <td>{{$compdonation->donation_quantity}}</td>
                                <td>{{$compdonation->donation_unit}}</td>
                                <td>{{$compdonation->donation_amount}}</td>
                                <td>{{$compdonation->donation_description}}</td>
                                <td>{{$compdonation->donation_type}}</td>
                                <td>{{$compdonation->donation_status}}</td>
                                <td>{{$compdonation->donation_recieved_by}}</td>
                                <td>{{$compdonation->created_at}}</td>
                            </tr>      
                            @endforeach    
                    
                        </tbody>
                    </table>
                @else
                    <p>No Donations Recorded yet!</p>
                @endif                 
    
            </div>
       
        </div> 
        <div>
            <a href="/donation" class="btn btn-danger">Return</a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Add Donation
            </button>
        </div>
    </div>
    

<!--Completed Modal -->

<div class="modal fade" id="completedmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="exampleModalLabel">Warning!!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h6>This will update the donation status as <strong>COMPLETED</strong></h6>
          <form action="{{url('/donation_complete')}}" method="POST">
            {{ csrf_field() }}
            {{method_field('PUT')}}
            <input type="hidden" name="id" id="completeid">
            <input type="hidden" name="stat_update" value="COMPLETED">
            <div id="divcash" style="display: none">
                <h4>Cash</h4>
                <label>Amount</label>
                <input type="text" id="amount" class="form-control" readonly>
            </div>
            <div id="divrel" style="display: none">
                <h4>Relief</h4>
                <label>Quantity</label>
                <input type="text" id="qty" class="form-control" readonly>
                <label>Unit</label>
                <input type="text" id="unit" class="form-control" readonly>
                
                <label>Description</label>
                <input type="text" id="desc" class="form-control" readonly>
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

   {{-- Register modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Register Donation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-6 d-flex justify-content-center">
                            <input type="button" onclick="div()" value="Relief" class="btn btn-primary">
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <input type="button" onclick="div2()" value="Cash" class="btn btn-primary">
                        </div>
                    </div>
                    {{-- Relief --}}
                    <div id="relief" style="display: none">
                        <form action="{{action('DonationsController@store')}}"  method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="donation_type" value="RELIEF">
                            <div>
                                <label>Quantity</label>
                                <input type="number" name="qty" class="form-control" required>
                            </div>
                            <div>
                                <label for="exampleFormControlSelect1">Unit</label>
                                <select class="form-control" name="unit" id="exampleFormControlSelect1" required>
                                    <option disabled selected>Options</option>
                                    <option>pc/s</option>
                                    <option>kl/s</option>
                                </select>
                            </div>
                            <div>
                                <label for="exampleFormControlSelect1">Description</label>
                                <select class="form-control" name="description" id="exampleFormControlSelect1" required>
                                    <option disabled selected>Basic Relief</option>
                                    <option>Rice</option>
                                    <option>Noodle</option>
                                    <option>Canned Goods</option>
                                    <option>Bottled Water</option>
                                    <option>Coffee</option>
                                    <option>Hygiene Kits</option>
                                </select>
                            </div>
                            <!-- <div>
                                <label>Description</label>
                                <input type="text" name="description" class="form-control" required>
                            </div> -->
                            <div class="form-group">
                                <label for="recieve">Recieve By</label>
                                <input type="text" class="form-control" name="recieveby" required>
                            </div>
                            <input type="hidden" name="donation_status" value="PENDING">
                            <input type="hidden" name="id" value="{{$donorid}}">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" value="Register new Donation" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                    {{-- Cash --}}
                    <div id="cash" style="display: none">
                        <form action="{{action('DonationsController@store')}}"  method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="donation_type" value="CASH">
                            <div class="form-group">
                                <label>Amount (PHP)</label>
                                <input type="number" name="amountval" class="form-control" required>  
                            </div>
                            <div class="form-group">
                                <label for="recieve">Recieve By</label>
                                <input type="text" class="form-control" name="recieveby" required>
                            </div>
                            <input type="hidden" name="donation_status" value="PENDING">
                                <input type="hidden" name="id" value="{{$donorid}}">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" value="Register new Donation" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Donation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{url('/del_donation')}}" method="POST">
                {{ csrf_field() }}
                {{method_field('PUT')}}
            <div class="modal-body">
                <input type="hidden" name="id" id="delid">
                <label>Reason of Deletion</label>
                <textarea name="reason" cols="30" rows="3" class="form-control"></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary" value="Submit">
            </div>
          </div>
        </form>
        </div>
      </div>
<script>
    $(document).ready(function() {
        $('.deletebtn').on('click',function() {
        $tr = $(this).closest('tr');
        var data = $tr.children('td').map(function (){
            return $(this).text();
        }).get();
        console.log(data);
        $('#delid').val(data[0]);
        });
    });
</script>
    {{-- <div class="modal-bg">
        <div class="modal-display">
            <h2>Register New Donor</h2>
            <form action="{{action('DonationsController@store')}}"  method="POST">
                @csrf
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Donation Description</label>
                        <input type="text" name="description" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Donation Type</label>
                            <div class="form-check">
                                <input class="form-check-input" id="relief" type="radio" name="donation_type" value="RELIEF" required>
                                <label class="form-check-label" for="relief">Relief</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" id="cash" type="radio" name="donation_type" value="CASH" required>
                                <label class="form-check-label" for="cash">Cash</label>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="recieve">Recieve By</label>
                        <input type="text" class="form-control" id="recieve" name="recieveby" required>
                    </div>
                    <input type="hidden" name="donation_status" value="PENDING">
                    <input type="hidden" name="id" value="{{$donorid}}"><p>{{$donorid}}</p>
                    <input type="submit" value="Add Relief" class="btn btn-primary">
                </div>
                <div class="reg-form">
                    <label for="name">Description</label>
                    <input type="text" name="description" id="name"><br>
                    <label for="" style="margin-right: 20px">Donation Type: </label>
                    <input type="radio" id="lgu" name="donation_type" value="Relief">
                    <label for="lgu" style="margin-right: 10px">Relief</label>
                    <input type="radio" id="ngo" name="donation_type" value="Cash">
                    <label for="ngo">Cash</label><br>
                    <label for="contact">Recieve By</label>
                    <input type="hidden" name="donation_status" value="Pending">
                    <input type="text" id="contact" name="recieveby" value=""><br>
                    <input type="hidden" name="id" value="{{$donor}}">
                    <input type="submit" value="Add">
                </div>
            </form>
           
        </div>
    </div> --}}
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
        </script>    --}}
<script>
    function div() {
   document.getElementById("relief").style.display = "block";
   document.getElementById("cash").style.display = "none";
    }

    function div2() {
    document.getElementById("cash").style.display = "block";
    document.getElementById("relief").style.display = "none";
    }

    function pending() {
    document.getElementById("pending").style.display = "block";
    document.getElementById("completed").style.display = "none";
    }
    function completed() {
    document.getElementById("completed").style.display = "block";
    document.getElementById("pending").style.display = "none";
    }
</script>

<script>
    $(document).ready(function() {
        $('.completebtn').on('click',function() {
        $tr = $(this).closest('tr');
        var data = $tr.children('td').map(function (){
            return $(this).text();
        }).get();
        console.log(data);
        if(data[5]=='CASH'){
            document.getElementById("divcash").style.display = "block";
            document.getElementById("divrel").style.display = "none";
            $('#completeid').val(data[0]);
            $('#amount').val(data[3]);
        }
        if(data[5]=='RELIEF'){
            document.getElementById("divrel").style.display = "block";
            document.getElementById("divcash").style.display = "none";
            $('#completeid').val(data[0]);
            $('#unit').val(data[2]);
            $('#qty').val(data[1]);
            $('#desc').val(data[4]);
            }
        });
     
       
    });
</script>
@endsection
