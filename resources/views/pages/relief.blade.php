<style>
    .checkbox{
        margin-top: 10px;
        border: 1px solid;
        height: 200px;
        border-radius: 3px;
        
    }
    .checkbox h6{
        text-align: center;
    }
    .inside{
        padding:0 20px 0;  
        height: 158px;
      
    }


</style>
@extends('layout.app')

@section('content')
@foreach ($errors->all() as $item)
    <div class="alert alert-danger" role="alert">
      {{$item}}
    </div>
@endforeach

@if (session('success'))
  <div class="alert alert-success" role="alert">
    {{session('success')}}
  </div>
@endif
<div class="wrapper" >
    <h1>Relief List</h1>
    
    <div class="restable">
        
        <div class="table-responsive-lg">
            @if (count($reliefs)>0) 
            <table class="table table-striped table-fixed text-center ">
                <thead>
                    <tr class="thead-dark">
                        <th scope="col">Relief Name</th>
                        <th scope="col">Relief item/Description</th>
                        <th scope="col">Relief Quantity</th>
                        <th scope="col">Relief QR-code</th>
                        <th scope="col">Relief Status</th>
                        <th scope="col">Donation/s Used</th>
                        <th scope="col">Remarks</th>
                        <th scope="col">Date Prepared</th>
                        <th> </th>
                        <th> </th>
                    </tr>
                </thead>         
                <tbody> 
                    @foreach ($reliefs as $relief)  
                    <tr>
                        <td style="display: none">{{$relief->relief_id}}</td>
                        <td>{{$relief->relief_name}}</td>
                        <td>{{$relief->relief_description}}</td>
                        <td>{{$relief->relief_quantity}}</td>
                        <td><a href="/relief/{{$relief->relief_id}}" class="btn btn-primary btn-sm"><i class="fas fa-qrcode"></i></a></td>
                        <td>{{$relief->relief_status}}</td>
                        <td>
                          <div class="dropdown">
                            <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              View
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 300px">
                              @foreach ($relief->donations as $item)
                              <ul>
                              @if ($item->donation_type == 'CASH')
                                <li>
                                  <p>{{$item->donation_amount}}&nbsp;PESOS</p>
                                </li>
                              @else
                                <li>  
                                  <p>{{$item->donation_quantity}}&nbsp;{{$item->donation_unit}}&nbsp;{{$item->donation_description}}</p>
                                </li>
                              @endif
                            </ul>
                               @endforeach
                            </div>
                          </div>
                        </td>
                        <td>{{$relief->relief_remarks}}</td>
                        <td>{{$relief->relief_date_prepared}}</td>
                        <td>
                          <button id="{{$relief->relief_id}}" type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="getid(this.id)">
                            Complete
                          </button>
                        </td>
                        <td>
                          <button type="button" class="btn btn-danger btn-sm deletebtn" data-toggle="modal" data-target="#deletemodal">
                              Delete
                          </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @else
                    <h4>No Relief Registered</h4>
                @endif
            </table>

        </div>
    </div>
    <button type="button" class="btn btn-primary newrelief" data-toggle="modal" data-target="#reliefmodal">
        Register New Relief
      </button>
</div>

{{-- delete modal --}}
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">This Relief will be Deleted</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('/delete_relief')}}" method="POST">
        {{ csrf_field() }}
        {{method_field('PUT')}}
        <div class="modal-body">
          <input type="hidden" name="id" id="delid">
          <label>Relief Name</label>
            <input type="text" id="delname" class="form-control">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Completed relief Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLabel">Warning!!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Relief will be moved to Distributed Relief</h5>
        <form action="{{url('/relief_complete')}}" method="POST">
          {{ csrf_field() }}
          {{method_field('PUT')}}
          <input type="hidden" name="completeid" id="id">  
          <input type="hidden" name='status' value="COMPLETED">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Proceed">
      </div>
    </form>
    </div>
  </div>
</div>
<!-- add Relief Modal -->
<div class="modal fade " id="reliefmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Register New Relief</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {{-- <form action="{{action('ReliefsController@store')}}" method="POST"> --}}
                <form id="reliefform">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Relief Name</label>
                    <input type="text" class="form-control" name="reliefname" required>
                    <label>Relief item/Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="reliefdesc" required></textarea>
                    <p class="text-muted">Please input All relief items</p>
                    <label>Relief Quantity(Packs/PCS.) </label>
                    <input type="number" class="form-control" name="reliefqty" required>
                    <p class="text-muted">(Please enter total number of relief prepared)</p>
                    <label>Date Prepared</label>
                    <input type="date" name="reliefprep" class="form-control" min="1900-01-01" max="2999-01-01" required>
                    <div class="form-group">
                      <label>Remarks</label>
                      <textarea class="form-control" rows="3" name="remarks"></textarea>
                    </div>
                    <input type="hidden" name='status' value="PENDING">
                    <div class=" checkbox">
                        <h6>Please select donation used</h6>
                        <div class="inside overflow-auto">
                          @foreach ($donations as $item) 
                          <div class="form-check">                           
                                <input class="form-check-input" type="checkbox" name="yay[]" value="{{$item->donation_id}}">
                                <label class="form-check-label">
                                  @if ($item->donation_type == 'CASH')
                                  <tr>
                                    <td>{{$item->donation_amount}}</td> 
                                    <td>PHP</td>
                                  </tr>
                                  @else
                                    <tr>
                                      <td>{{$item->donation_quantity}}-</td>
                                      <td> {{$item->donation_unit}}-</td>
                                      <td>{{$item->donation_description}}</td>
                                    </tr>
                                  @endif
                                    
                                </label>       
                            </div>
                            @endforeach  
                        </div>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Confirm">
                </div>
            </form>
        </div>
    </div>
</div>


<script>
  $(document).ready(function() {
  $('.deletebtn').on('click',function() {
  $tr = $(this).closest('tr');
  var data = $tr.children('td').map(function (){
      return $(this).text();

  }).get();
  console.log(data);
  $('#delid').val(data[0]);
  $('#delname').val(data[1]);
  });      
});
</script>
<script>
    $(document).ready(function() {
      $('#reliefform').on('submit',function(e) {
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "/addrelief",
          data: $('#reliefform').serialize(),
          success: function(response) {
            console.log(response)
            alert('Relief Registered');
            location.reload();
          },
          error:function(error) {
            console.log(error)
            alert('Relief not saved, Please double check inputs');
          }
        });
      });
    });
</script>
<script>
  var msg = '{{Session::get('alert')}}';
  var exist = '{{Session::has('alert')}}';
  if(exist){
    alert(msg);
  }
</script>
<script>
  function getid($id){
    document.getElementById("id").value = $id;
  }
</script>
@endsection
         
