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
               <div>
                    <div class="table-responsive-xl tabledes">
                        <div>
                            <button class="btn btn-success btn-sm" onclick="comp()">Completed</button>
                            <button class="btn btn-warning btn-sm" onclick="pend()">Pending</button>
                        </div>
                        {{-- PENDING RELIEF --}}
                        <div id="pending" style="display: none">
                            <table class="table table-sm text-center">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Relief Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Remarks</th>
                                    <th scope="col">Items</th>
                                    <th scope="col">Date Prepared</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                                    @foreach ($pending_reliefs as $relief)
                                        <tr>
                                            <th>{{$relief->relief_name}}</th>
                                            
                                            <td>{{$relief->relief_quantity}}</td>
                                            <td>{{$relief->relief_status}}</td>
                                            <td>{{$relief->relief_remarks}}</td>
                                            <td>@foreach($relief->relief_items as $item)
                                                    <ul>
                                                        <li>{{$item->ri_quantity}}&nbsp;{{$item->ri_unit}}&nbsp;{{$item->ri_description}}</li>
                                                    </ul>
                                                @endforeach
                                            </td>
                                            <td>{{$relief->relief_date_prepared}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                          </table>
                        </div>
                        {{-- COMPLETED RELIEF --}}
                        <div id="completed" style="display: block">
                            <table class="table table-sm text-center">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Relief Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Remarks</th>
                                    <th scope="col">Date Prepared</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                                    @foreach ($completed_reliefs as $relief)
                                        <tr>
                                            <th>{{$relief->relief_name}}</th>
                                            <td>{{$relief->relief_description}}</td>
                                            <td>{{$relief->relief_quantity}}</td>
                                            <td>{{$relief->relief_status}}</td>
                                            <td>{{$relief->relief_remarks}}</td>
                                            <td>{{$relief->relief_date_prepared}}</td>
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
    function comp(){
        document.getElementById("completed").style.display = "block";
        document.getElementById("pending").style.display = "none";
    }
    function pend(){
        document.getElementById("completed").style.display = "none";
        document.getElementById("pending").style.display = "block";
    }
</script>
@endsection