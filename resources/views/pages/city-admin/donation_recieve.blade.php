<style>
    .tabledes{
        margin-top:30px;
    }
</style>
@extends('layout.cityadmin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="table-responsive-xl tabledes">
                <div>
                    <button class="btn btn-success btn-sm" onclick="comp()">Completed</button>
                    <button class="btn btn-warning btn-sm" onclick="pen()">Pending</button>
                    <button class="btn btn-danger btn-sm" onclick="del()">Deleted</button>
                </div>
                <div id="pending" style="display: none">
                    <table class="table table-sm text-center">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Quantity</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Description</th>
                            <th scope="col">Donation Type</th>
                            <th scope="col">Donation Status</th>
                            <th scope="col">Recieved By</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                            @if (count($pendonations)>0)
                            @foreach ($pendonations as $donation)
                            <tr>
                                <th>{{$donation->donation_quantity}}</th>
                                <td>{{$donation->donation_unit}}</td>
                                <td>{{$donation->donation_amount}}</td>
                                <td>{{$donation->donation_description}}</td>
                                <td>{{$donation->donation_type}}</td>
                                <td>{{$donation->donation_status}}</td>
                                <td>{{$donation->donation_recieved_by}}</td>
                            </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td>No Pending Donations</td>
                                </tr>
                            @endif
                           
                        </tbody>
                      </table>
                </div>


                <div id="completed" style="display: block">
                    <table class="table table-sm text-center">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Quantity</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Description</th>
                            <th scope="col">Donation Type</th>
                            <th scope="col">Donation Status</th>
                            <th scope="col">Recieved By</th> 
                          </tr>
                        </thead>
                        
                        <tbody>
                            @if (count($compdonations)>0)
                            @foreach ($compdonations as $donation)
                                <tr>
                                    <th>{{$donation->donation_quantity}}</th>
                                    <td>{{$donation->donation_unit}}</td>
                                    <td>{{$donation->donation_amount}}</td>
                                    <td>{{$donation->donation_description}}</td>
                                    <td>{{$donation->donation_type}}</td>
                                    <td>{{$donation->donation_status}}</td>
                                    <td>{{$donation->donation_recieved_by}}</td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td>No Completed Donations</td>
                                </tr>
                            @endif
                           
                        </tbody>
                    </table>
                </div>



                <div id="deleted" style="display: none">
                    <table class="table table-sm text-center">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Quantity</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Description</th>
                            <th scope="col">Donation Type</th>
                            <th scope="col">Donation Status</th>
                            <th scope="col">Recieved By</th>
                            <th scope="col">Reason to delete</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                            @if (count($deldonations)>0)
                            @foreach ($deldonations as $donation)
                            <tr>
                                <th>{{$donation->donation_quantity}}</th>
                                <td>{{$donation->donation_unit}}</td>
                                <td>{{$donation->donation_amount}}</td>
                                <td>{{$donation->donation_description}}</td>
                                <td>{{$donation->donation_type}}</td>
                                <td>{{$donation->donation_status}}</td>
                                <td>{{$donation->donation_recieved_by}}</td>
                                <td>{{$donation->reason_to_delete}}</td>
                            </tr>
                        @endforeach
                            @else
                                <tr>
                                    <td>No Deleted Donation</td>
                                </tr>
                            @endif
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function pen() {
   document.getElementById("pending").style.display = "block";
   document.getElementById("completed").style.display = "none";
   document.getElementById("deleted").style.display = "none";
    }

    function comp() {
    document.getElementById("completed").style.display = "block";
    document.getElementById("pending").style.display = "none";
    document.getElementById("deleted").style.display = "none";
    }

    function del(){
    document.getElementById("deleted").style.display = "block";
    document.getElementById("completed").style.display = "none";
    document.getElementById("pending").style.display = "none";
    }
</script>
@endsection