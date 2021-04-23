<style>
    .tabledes{

        margin-top:30px;
    }
</style>
@extends('layout.cityadmin')
@section('content')
   <div class="container-fluid">
       <div class="row">
           <div class="col-xl-12">
               <div class="table-responsive-xl tabledes">
                <table class="table table-sm text-center">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Name/Org. Name/Comp. Name</th>
                        <th scope="col">Donor Type</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Email</th>
                        <th scope="col">Donation Given</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($donations as $donation)
                            <tr>
                                <th>{{$donation->donor_name}}</th>
                                <td>{{$donation->donor_type}}</td>
                                <td>{{$donation->donor_contact_number}}</td>
                                <td>{{$donation->donor_email}}</td>
                                <td>
                                    <a href="/donation_recieved/{{$donation->donor_id}}" class="btn btn-success btn-sm">view</a>
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