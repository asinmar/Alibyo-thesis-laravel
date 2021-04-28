<style>
    .main{
        margin: 30px 10px 0px;
    }
    .head{
        margin-top:20px;
    }
</style>
@extends('layout.brgyUser')

@section('content')
    <div class="head text-center">
        <h2>Receivers</h2>
    </div>
    <div class="main">
        <div class="table-responsive-lg">
            @if (count($recievers)>0)
            <table class="table table-sm text-center">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Purok</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($recievers as $reciever)
                        <tr>
                            <td>{{$reciever->res_last_name}}, {{$reciever->res_first_name}} {{$reciever->res_middle_name}}</td>
                            <td>{{$reciever->res_purok}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <h6 class="text-center">No recievers Registered</h6>
            @endif
            {{ $recievers->links() }}
        </div>
    </div>
@endsection