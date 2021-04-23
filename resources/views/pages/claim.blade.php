<style>
    .list-of-res{
        margin-top: 20px;
    }
</style>
@extends('layout.app')

@section('content')
    <div class="container">
        <div>
            <h2>List of Reciever</h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="list-of-res">
                    @if (count($residents)>0)
                    <table class="table table-sm">
                        
                        <thead class="text-center">
                          <tr>
                            <th scope="col">Name</th>   
                            <th scope="col">Purok</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($residents as $resident)
                                <tr>
                                   <td><strong>{{$resident->res_last_name}}, {{$resident->res_first_name}} {{$resident->res_middle_name}}</strong></td>
                                   <td>{{$resident->res_purok}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                      <div class="row">
                          <div class="col-12 text-center">
                            {{$residents->links()}}
                          </div>
                      </div>
                      @else
                        <h3>No Receiver/s Found</h3>
                      @endif
                </div>
            </div>
        </div>
    </div>
@endsection