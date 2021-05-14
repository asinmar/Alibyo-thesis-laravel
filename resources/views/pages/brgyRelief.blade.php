
@extends('layout.brgyUser')

@section('content')

<div class="wrapper">
    <h2>Relief to be Distributed</h2>
    @if (count($reliefs)>0)
    <table class=" table table-sm table-fixed text-center table-responsive-lg">
        <thead class="thead-dark">
            <tr>
                <th>Relief Name</th>
                <th>Relief Quantity</th>
                <th>Relief Status</th>
                <th>Remarks</th>
                <th>Relief item/Description</th>
                <th>Date Prepared</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($reliefs as $relief)
                <tr>
                    <td>{{$relief->relief_name}}</td>
                    
                    <td>{{$relief->relief_quantity}}</td>
                    <td>{{$relief->relief_status}}</td>
                    <td>{{$relief->relief_remarks}}</td>
                    <td>
                        @foreach($relief->relief_items as $item)
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
    @else
        <h6>No Data Recorded</h6>
    @endif
    {{$reliefs->links()}}
</div>
    
@endsection
