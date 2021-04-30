@extends('layout.brgyUser')

@section('content')

    <div class="wrapper">
        <div class="restable">
            <div class="table-responsive-lg">
                @if (count($donations)>0)
                <table class="table table-sm text-center">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Quantity</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Description</th>
                        <th scope="col">Donation Type</th>
                        <th scope="col">Donation Status</th>
                      </tr>
                    </thead>
                    <tbody>
                            @foreach ($donations as $donation)
                                <tr> 
                                    <td>{{$donation->donation_quantity}}</td>
                                    <td>{{$donation->donation_unit}}</td>
                                    <td>{{$donation->donation_amount}}</td>
                                    <td>{{$donation->donation_description}}</td>
                                    <td>{{$donation->donation_type}}</td>
                                    <td>{{$donation->donation_status}}</td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
                @else
                    <h6 class="text-center">No Donations Given</h6>
                @endif
            </div>
        </div>
        <a href="/brgyPage" class="btn btn-outline-primary">Return</a>
    </div>
@endsection