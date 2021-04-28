<style>
    .container-fluid{
        margin-top: 30px;
    }
</style>
@extends('layout.app')


@section('content')

<div class="container-fluid">
    <div>
        <h2>Past Relief Receivers</h2>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-resposive-xl">
                <table class="table table-striped table-sm text-center">
                    <thead>
                      <tr>
                        <th scope="col">Names</th>
                        <th scope="col">Received Relief</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $record)
                            <tr>
                                <td>{{$record->res_last_name}}, {{$record->res_first_name}} {{$record->res_middle_name}}</td>
                                <td> 
                                    @foreach ($record->relief as $item)
                                        <ul style="list-style-type: none">
                                            <li>{{$item->relief_name}}</li>
                                        </ul>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                      
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
    
@endsection