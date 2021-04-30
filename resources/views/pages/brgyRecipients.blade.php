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
        <h4>Recipients</h4>
    </div>
    <div class="main">
        
        <div class="table-responsive-lg">
            @if (count($recipients)>0)
            <table class="table table-sm text-center">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Name/Comp. Name</th>
                    <th scope="col">Donor Type</th>
                    <th scope="col">Given Donations</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Purok</th>

                  </tr>
                </thead>
                <tbody>
                    @foreach ($recipients as $recipient)
                        <tr>
                            <td>{{$recipient->res_last_name}}</td>
                            <td>{{$recipient->res_first_name}}</td>
                            <td>{{$recipient->res_middle_name}}</td>
                            <td>{{$recipient->res_gender}}</td>
                            <td>{{$recipient->res_purok}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <h6 class="text-center">No Donors Registered</h6>
            @endif
            {{ $recipients->links() }}
        </div>
    </div>
@endsection