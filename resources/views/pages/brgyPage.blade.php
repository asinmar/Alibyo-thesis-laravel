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
        <h2>Donations</h2>
    </div>
    <div class="main">
        
        <div class="table-responsive-lg">
            @if (count($donors)>0)
            <table class="table table-sm text-center">
                <thead>
                  <tr>
                    <th scope="col">Name/Comp. Name</th>
                    <th scope="col">Donor Type</th>
                    <th scope="col">Given Donations</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($donors as $donor)
                        <tr>
                            <td>{{$donor->donor_name}}</td>
                            <td>{{$donor->donor_type}}</td>
                            <td>
                                <a href="/givendonation/{{$donor->donor_id}}" class="btn btn-outline-primary btn-sm">view</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <h6 class="text-center">No Donors Registered</h6>
            @endif
            {{ $donors->links() }}
        </div>
    </div>
@endsection