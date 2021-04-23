<style>

    .table-format{
        margin-top:10px;
        height: 500;
        border: 1px solid;
        border-radius: 4px;
        width: auto;
        overflow-y: auto;
    }
</style>
@extends('layout.app')

@section('content')
    
<div class="d-flex justify-content-center">
    <h2>Trashed</h2>
</div>

    @foreach ($errors->all() as $item)
    <div class="alert alert-danger" role="alert">
        {{$item}}
    </div>  
    @endforeach
    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {{session('success')}}
    </div>  
    @endif

<div class="container d-flex justify-content-around">
    <div class="row">
        <div class="col-md-6 col-12 d-flex justify-content-center" style="padding:0">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-outline-success" onclick="res()">Residents</button>
                <button type="button" class="btn btn-outline-success"  onclick="dono()">Donors</button>
                <button type="button" class="btn btn-outline-success"  onclick="dona()">Donations</button>
                <button type="button" class="btn btn-outline-success" onclick="dist()">Distributor</button>
            </div>
        </div>
        <div class="col-md-6 col-12 d-flex justify-content-center">
            <div class="btn-group" role="group" aria-label="Basic example"  style="padding:0">
                <button type="button" class="btn btn-outline-success" onclick="rel()">Reliefs</button>
                <button type="button" class="btn btn-outline-success" onclick="exp()">Expenditures</button>
                <button type="button" class="btn btn-outline-success" onclick="expitem()">Expenditure items</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            {{-- Resident --}}
            <div class="table-format" id="resident" style="display: block">
                <div class="table-responsive-xl">
                    @if (count($residents)>0)
                    <table class="table table-striped text-center table-sm">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Purok</th>
                            <th scope="col">Retrieve Resident</th>
                          </tr>
                        </thead>
                        <tbody>
                           
                            @foreach ($residents as $resident)
                            <tr>


                                <td style="display:none">{{$resident->res_id}}</td>
                                <td>{{$resident->res_last_name}}, {{$resident->res_first_name}} {{$resident->res_middle_name}}</td>
                                <td>{{$resident->res_date_of_birth}}</td>
                                <td>{{$resident->res_gender}}</td>
                                <td>{{$resident->res_purok}}</td>
                                <th style="display:none">{{$resident->res_id}}</th>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm retrieveResident" data-toggle="modal" data-target="#residentmodal">
                                        Retrive
                                      </button>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                      </table>
                      @else
                        <h5>No Deleted Resident</h5>
                    @endif
                </div>
            </div>


            {{-- Donor --}}
            <div class="table-format" id="donor" style="display: none">
                <div class="table-responsive-xl">
                    @if (count($donors)>0)
                    <table class="table table-striped text-center table-sm">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Retrieve</th>
                            <th scope="col">Donations</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($donors as $donor)
                            <tr>
                                <td style="display: none">{{$donor->donor_id}}</td>
                                <td>{{$donor->donor_name}}</td>
                                <td>{{$donor->donor_type}}</td>
                                <td>{{$donor->donor_contact_number}}</td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm donorbtn" data-toggle="modal" data-target="#donormodal">
                                        Retrieve
                                    </button>
                                </td>
                            
                                <td>
                                    @foreach ($donor->mydonor as $item)
                                        <ul>
                                            @if ($item->donation_type == 'CASH')
                                            <li>{{$item->donation_amount}}  Pesos</li>
                                            @else
                                            <li>{{$item->donation_quantity}}&nbsp;{{$item->donation_unit}}&nbsp;{{$item->donation_description}}</li>
                                            @endif
                                        </ul>
                                    @endforeach
                                    
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                      @else
                        <h5>No Deleted Donor</h5>
                      @endif
                </div>
            </div>

            {{-- Donation --}}
            <div class="table-format" id="donation" style="display: none">
                <div class="table-responsive-xl">
                    @if (count($donations)>0)
                    <table class="table table-striped text-center table-sm">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Quantity</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Description</th>
                            <th scope="col">Type</th>
                            <th scope="col">Recieved By</th>
                            <th scope="col">Reason to Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($donations as $donation)
                            <tr>
                                <th>{{$donation->donation_quantity}}</th>
                                <td>{{$donation->donation_unit}}</td>
                                <td>{{$donation->donation_amount}}</td>
                                <td>{{$donation->donation_description}}</td>
                                <td>{{$donation->donation_type}}</td>
                                <td>{{$donation->donation_recieved_by}}</td>
                                <td>{{$donation->reason_to_delete}}</td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                      </table>
                      @else
                        <h5>No Deleted Donation</h5>
                      @endif
                </div>
            </div>


            {{-- Releif --}}
            <div class="table-format" id="relief" style="display: none">
                <div class="table-responsive-xl">
                    @if (count($reliefs)>0)
                    <table class="table table-striped text-center table-sm">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Discription</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Remarks</th>
                            <th scope="col">Date Prepared</th>
                          </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($reliefs as $relief)
                            <tr>
                                <th>{{$relief->relief_name}}</th>
                                <td>{{$relief->relief_description}}</td>
                                <td>{{$relief->relief_quantity}}</td>
                                <td>{{$relief->relief_remarks}}</td>
                                <td>{{$relief->relief_date_prepared}}</td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                      </table>
                      @else
                        <h5>No Deleted Relief</h5>
                      @endif
                </div>
            </div>


            {{-- Expenditure --}}
            <div class="table-format" id="expenditure" style="display: none">
                <div class="table-responsive-xl">
                    @if (count($exps)>0)
                    <table class="table table-striped text-center table-sm">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Amount Used</th>
                            <th scope="col">Recieved By</th>
                            <th scope="col">Date Prepared</th>
                            <th scope="col">Deleted At</th>
                            <th scope="col">Items</th>
                          </tr>
                        </thead>
                        <tbody>
                           
                            @foreach ($exps as $exp)
                            <tr>
                                <td>{{$exp->exp_used_amount}}</td>
                                <td>{{$exp->purchased_by}}</td>
                                <td>{{$exp->date_purchased}}</td>
                                <td>{{$exp->deleted_at}}</td>
                                <td>
                                    @foreach ($exp->exp_items as $item)
                                    <ul>
                                        <li>{{$item->item_quantity}}&nbsp;{{$item->item_unit}}&nbsp;{{$item->item_name}}</li>
                                    </ul>

                                @endforeach
                                </td>
                            </tr>
                            @endforeach  
                        </tbody>
                      </table>
                      @else
                        <h5>No Deleted Expenditure</h5>
                      @endif
                </div>
            </div>


            {{-- Exp_Item --}}
            <div class="table-format" id="exp_item" style="display: none">
                <div class="table-responsive-xl">
                    @if (count($exp_items)>0)
                    <table class="table table-striped text-center table-sm">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Quantity</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Name</th>
                            <th scope="col">Deleted From ID</th>
                          </tr>
                        </thead>
                        <tbody>
                           
                            @foreach ($exp_items as $exp_item)
                            <tr>
                                <th>{{$exp_item->item_quantity}}</th>
                                <td>{{$exp_item->item_unit}}</td>
                                <td>{{$exp_item->item_name}}</td>
                                <td>{{$exp_item->exp_id}}</td>
                              
                            </tr>
                            @endforeach
                           
                        </tbody>
                      </table>
                      @else
                      <h5>No Deleted Expenditure Items</h5>
                  @endif
                </div>
            </div>



            {{-- Distributor --}}
            <div class="table-format" id="distributor" style="display: none">
                <div class="table-responsive-xl">
                    @if (count($distributors)>0)
                        <table class="table table-striped text-center table-sm table-sm">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Date of Birth</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Retrieve</th>
                            
                            </tr>
                            </thead>
                        
                            <tbody>
                                
                                @foreach ($distributors as $distributor)
                                <tr>
                                    <td style="display: none">{{$distributor->distributor_id}}</td>
                                    <td>{{$distributor->last_name}}, {{$distributor->first_name}} {{$distributor->middle_name}}</td>
                                    <td>{{$distributor->date_of_birth}}</td>
                                    <td>{{$distributor->gender}}</td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm distbtn" data-toggle="modal" data-target="#distmodal">
                                            Retrieve
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                      @else
                       <h5>No Deleted Distributors</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>



{{-- Donor Modal --}}
<div class="modal fade" id="donormodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Retrieve Donor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{url('/ret_donor')}}" method="POST">
            {{ csrf_field() }}
            {{method_field('PUT')}}
            <div class="modal-body">
            <input type="hidden" name="id" id="retdonid">
            <label>Name/Comp. Name/Org. Name</label>
            <input type="text"  id="retdonname" class="form-control">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Confirm</button>
            </div>
        </form>
      </div>
    </div>
  </div>

{{-- resident modal --}}
<div class="modal fade" id="residentmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Retrieve Resident</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{url('/ret_res')}}" method="POST">
            {{ csrf_field() }}
            {{method_field('PUT')}}
        <div class="modal-body">
                <input type="hidden" name="id" id="retresid">
                <label>Name</label>
                <input type="text"  id="retresname" class="form-control">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Confirm</button>
        </div>
        </form>
      </div>
    </div>
</div>


{{-- distributor modal --}}

<div class="modal fade" id="distmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Retrieve Distributor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{url('/ret_dist')}}" method="POST">
            {{ csrf_field() }}
            {{method_field('PUT')}}
            <div class="modal-body">
                <input type="hidden" name="id" id="retdistid">
                <label>Name</label>
                <input type="text" id="retdistname" class="form-control">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Confirm</button>
            </div>
        </form>
      </div>
    </div>
</div>



<script>
    function res(){
        document.getElementById("resident").style.display = "block";
        document.getElementById("donor").style.display = "none";
        document.getElementById("donation").style.display = "none";
        document.getElementById("expenditure").style.display = "none";
        document.getElementById("exp_item").style.display = "none";
        document.getElementById("distributor").style.display = "none";
        document.getElementById("relief").style.display = "none";
    }
    function dono(){
        document.getElementById("resident").style.display = "none";
        document.getElementById("donor").style.display = "block";
        document.getElementById("donation").style.display = "none";
        document.getElementById("expenditure").style.display = "none";
        document.getElementById("exp_item").style.display = "none";
        document.getElementById("distributor").style.display = "none";
        document.getElementById("relief").style.display = "none";
    }
    function dona(){
        document.getElementById("resident").style.display = "none";
        document.getElementById("donor").style.display = "none";
        document.getElementById("donation").style.display = "block";
        document.getElementById("expenditure").style.display = "none";
        document.getElementById("exp_item").style.display = "none";
        document.getElementById("distributor").style.display = "none";
        document.getElementById("relief").style.display = "none";
    }
    function dist(){
        document.getElementById("resident").style.display = "none";
        document.getElementById("donor").style.display = "none";
        document.getElementById("donation").style.display = "none";
        document.getElementById("expenditure").style.display = "none";
        document.getElementById("exp_item").style.display = "none";
        document.getElementById("distributor").style.display = "block";
        document.getElementById("relief").style.display = "none";
    }
    function rel(){
        document.getElementById("resident").style.display = "none";
        document.getElementById("donor").style.display = "none";
        document.getElementById("donation").style.display = "none";
        document.getElementById("expenditure").style.display = "none";
        document.getElementById("exp_item").style.display = "none";
        document.getElementById("distributor").style.display = "none";
        document.getElementById("relief").style.display = "block";
    }

    function exp(){
        document.getElementById("resident").style.display = "none";
        document.getElementById("donor").style.display = "none";
        document.getElementById("donation").style.display = "none";
        document.getElementById("expenditure").style.display = "block";
        document.getElementById("exp_item").style.display = "none";
        document.getElementById("distributor").style.display = "none";
        document.getElementById("relief").style.display = "none";
    }
    function expitem(){
        document.getElementById("resident").style.display = "none";
        document.getElementById("donor").style.display = "none";
        document.getElementById("donation").style.display = "none";
        document.getElementById("expenditure").style.display = "none";
        document.getElementById("exp_item").style.display = "block";
        document.getElementById("distributor").style.display = "none";
        document.getElementById("relief").style.display = "none";
    }
</script>



<script>
        $(document).ready(function() {
        $('.retrieveResident').on('click',function() {
        $tr = $(this).closest('tr');
        var data = $tr.children('td').map(function (){
            return $(this).text();

        }).get();
        console.log(data);
        $('#retresid').val(data[0]);
        $('#retresname').val(data[1]);
        });      
    });
</script>



<script>
    $(document).ready(function() {
    $('.distbtn').on('click',function() {
    $tr = $(this).closest('tr');
    var data = $tr.children('td').map(function (){
        return $(this).text();

    }).get();
    console.log(data);
    $('#retdistid').val(data[0]);
    $('#retdistname').val(data[1]);
    });      
});
</script>


<script>
    $(document).ready(function() {
    $('.donorbtn').on('click',function() {
    $tr = $(this).closest('tr');
    var data = $tr.children('td').map(function (){
        return $(this).text();

    }).get();
    console.log(data);
    $('#retdonid').val(data[0]);
    $('#retdonname').val(data[1]);
    });      
});
</script>
@endsection