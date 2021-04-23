
@extends('layout.brgyUser')

@section('content')

<div class="wrapper">
    <h2>Distributed Relief</h2>
    @if (count($reliefs)>0)
    <table class=" table table-sm table-fixed text-center table-responsive-lg">
        <thead>
            <tr>
                <th>Relief Name</th>
                <th>Relief item/Description</th>
                <th>Relief Quantity</th>
                <th>Relief Status</th>
                <th>Remarks</th>
                <th>Date Prepared</th>
                <th>Relief Used</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reliefs as $relief)
                <tr>
                    <td>{{$relief->relief_name}}</td>
                    <td>{{$relief->relief_description}}</td>
                    <td>{{$relief->relief_quantity}}</td>
                    <td>{{$relief->relief_status}}</td>
                    <td>{{$relief->relief_remarks}}</td>
                    <td>{{$relief->relief_date_prepared}}</td>
                    <td>
                        @foreach ($relief->donations as $item)
                        @if ($item->donation_type == 'CASH')
                        <li>{{$item->donation_amount}} Pesos</li>
                        @else
                        <li>{{$item->donation_quantity}} &nbsp;{{$item->donation_unit}} &nbsp; {{$item->donation_description}}</li>
                        @endif
                            
                        @endforeach
                    </td>
                </tr>             
            @endforeach
        </tbody>
    </table>
    @else
        <h6>No Data Recorded</h6>
    @endif
    {{$reliefs->links()}}
</div>
    
@endsection
