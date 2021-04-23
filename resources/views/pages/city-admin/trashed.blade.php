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
@extends('layout.cityadmin')

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
            
                <button type="button" class="btn btn-outline-success"  onclick="dono()">Donors</button>
                <button type="button" class="btn btn-outline-success"  onclick="dona()">Donations</button>
                <button type="button" class="btn btn-outline-success" onclick="relbtn()">Reliefs</button>
                
               
            </div>
        </div>
        <div class="col-md-6 col-12 d-flex justify-content-center">
            <div class="btn-group" role="group" aria-label="Basic example"  style="padding:0">
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


            {{-- Donor --}}
            <div class="table-format" id="donor" style="display: block">
                <div class="table-responsive-xl">
                    @if (count($donors)>0)
                    <table class="table table-striped text-center">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Donation list</th>
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
                    <table class="table table-striped text-center">
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
                    <table class="table table-striped text-center">
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
                    <table class="table table-striped text-center">
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
                    <table class="table table-striped text-center">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Quantity</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Name</th>
                            <th scope="col">Deleted Expenditure ID</th>
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
        </div>
    </div>
</div>



{{-- Donor Modal --}}


{{-- resident modal --}}


{{-- distributor modal --}}




<script>

    function dono(){
        document.getElementById("donor").style.display = "block";
        document.getElementById("donation").style.display = "none";
        document.getElementById("expenditure").style.display = "none";
        document.getElementById("exp_item").style.display = "none";
        document.getElementById("relief").style.display = "none";
    }
    function dona(){
        document.getElementById("donor").style.display = "none";
        document.getElementById("donation").style.display = "block";
        document.getElementById("expenditure").style.display = "none";
        document.getElementById("exp_item").style.display = "none";
        document.getElementById("relief").style.display = "none";
    }

    function relbtn(){
        document.getElementById("donor").style.display = "none";
        document.getElementById("donation").style.display = "none";
        document.getElementById("expenditure").style.display = "none";
        document.getElementById("exp_item").style.display = "none";
        document.getElementById("relief").style.display = "block";
    }

    function exp(){
        document.getElementById("donor").style.display = "none";
        document.getElementById("donation").style.display = "none";
        document.getElementById("expenditure").style.display = "block";
        document.getElementById("exp_item").style.display = "none";
        document.getElementById("relief").style.display = "none";
    }
    function expitem(){
        document.getElementById("donor").style.display = "none";
        document.getElementById("donation").style.display = "none";
        document.getElementById("expenditure").style.display = "none";
        document.getElementById("exp_item").style.display = "block";
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