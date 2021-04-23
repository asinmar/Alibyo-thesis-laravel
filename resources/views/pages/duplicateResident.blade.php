<style>
    .maintable{
        height: 0;
    }
</style>
@extends('layout.app')
@section('content')


<div class="wrapper">
    <h3>This Person/s may the same!</h3>
    <div class="maintable">
        <div class="table-responsive-xl">
            <table class="table table-fixed text-center">
                <thead  class="thead-dark">
                    <tr>
                        <th scope="col">Last Name</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Middle Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Date of Birth</th>
                        <th scope="col">Barangay</th>
                    </tr>
                   
                </thead>
                <tbody>
                    <tr class="bg-warning">
                        @foreach ($newregister as $item)
                            <th>{{$item}}</th>
                        @endforeach
                    </tr>
                    @foreach ($residents as $resident)
                    <tr>
                        <td>{{$resident->res_last_name}}</td>
                        <td>{{$resident->res_first_name}}</td>
                        <td>{{$resident->res_middle_name}}</td>
                        <td>{{$resident->res_gender}}</td>
                        <td>{{$resident->res_date_of_birth}}</td>
                        <td>{{$resident->res_barangay}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>  
        <div>
            <p><strong>If these person are different, just click proceed</strong></p>
            <div>
                <form action="{{action('ResidentsController@store')}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="last_name"  value="{{$request['last_name']}}">
                    <input type="hidden" name="first_name" value="{{$request['first_name']}}">
                    <input type="hidden" name="middle_name" value="{{$request['middle_name']}}">
                    <input type="hidden" name="gender" value="{{$request['gender']}}">
                    <input type="hidden" name="contact_number" value="{{$request['contact_number']}}">
                    <input type="hidden" name="purok" value="{{$request['purok']}}">
                    <input type="hidden" name="barangay" value="{{$request['barangay']}}">
                    <input type="hidden" name="qrcode" value="{{$request['qrcode']}}">
                    <input type="hidden" name="civil_status" value="{{$request['civil_status']}}">
                    <input type="hidden" name="family_number" value="{{$request['family_number']}}">
                    <input type="hidden" name="dob" value="{{$request['dob']}}">
                    <input type="submit" class="btn btn-primary" value="Proceed">
                    <a href="/resident" class="btn btn-danger">Return</a>
                </form>
            </div>
        </div> 
    </div>
</div>

@endsection
    


 