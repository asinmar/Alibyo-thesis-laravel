<style>
    .container-fluid{
        margin-top: 30px;
    }
</style>
@extends('layout.cityadmin')


@section('content')

<div class="container-fluid">
    <div>
        <h2>Relief Receivers</h2>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-resposive-xl">
                <table class="table table-striped table-sm text-center">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Relief Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Total Relief Prepared</th>
                        <th scope="col">Relief Recievers</th>
                        <th scope="col">Total Received</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $record)
                            <tr>
                               <td>{{$record->relief_name}}</td>
                               <td>{{$record->relief_description}}</td>
                               <td>{{$record->relief_quantity}}</td>
                                <td> 
                                    @foreach ($record->resident as $item)
                                        <ul style="list-style-type: none">
                                            {{$item->res_last_name}}, {{$item->res_first_name}} {{$item->res_middle_name}}
                                        </ul>
                                    @endforeach
                                </td>
                                <td>{{count($record->resident)}}</td>
                                
                            </tr>

                        @endforeach
                      
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
    
@endsection