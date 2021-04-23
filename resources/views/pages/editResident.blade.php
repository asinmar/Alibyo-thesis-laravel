@extends('layout.app')
@section('content')
<div class="wrapper">
    <div class="editsection">
        <form action="{{action('ResidentsController@update',$resident->res_id)}}" method="POST">
            @csrf
            {{method_field('PUT')}}
            <label for="lastname">Lastname</label>
            <input type="text" name="last_name" id="lastname" value={{$resident->res_last_name}}><br>
            <label for="firstname">First Name</label>
            <input type="text" name="first_name" id="firstname" value="{{$resident->res_first_name}}"><br>
            <label for="middlename">Middle Name</label>
            <input type="text" name="middle_name" id="middlename" value="{{$resident->res_middle_name}}"><br>
            <label for="gender">Gender</label>
            @if ($resident->res_gender=='Male')
            <input type="radio"name="gender" id="gender" value="Male" checked="checked">Male
            <input type="radio" name="gender" id="gender" value="Female">Female<br>
            @else
            <input type="radio"name="gender" id="gender" value="Male">Male
            <input type="radio" name="gender" id="gender" value="Female" checked="checked">Female<br>
            @endif
            <label for="contactnum">Contact Number</label>
            <input type="text" name="contact_number" maxlength="11" minlength="11" id="contactnum" value="{{$resident->res_contact_number}}"><br>
            <label for="barangay">Barangay</label>
            <input type="text" name="barangay" id="barangay" value="{{$resident->res_barangay}}"><br>
            <label for="purok">Purok</label>
            <input type="text"name="purok" id="purok" value="{{$resident->res_purok}}"><br>
            <label for="civilstatus">Civil Status</label>
            <input type="text" name="civil_status" id="civilstatus" value="{{$resident->res_civil_status}}"><br>
            <label for="famnum">Family Number</label>
            <input type="text" name="family_number" id="famnum" value="{{$resident->res_family_number}}">
            <input type="hidden"  name="id" value="{{$resident->res_id}}">
            <input type="submit"  value="Submit">


        </form>

    </div>

</div>
    
@endsection