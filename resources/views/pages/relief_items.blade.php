<style>
    .head{
        background-color: gainsboro;
        padding: 0px 20px 0px;
        border: 1px solid;
    }
    input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
</style>
@extends('layout.app')
@section('content') 

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 ">
                <div>
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                    @endforeach
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                      {{session('success')}}
                    </div>
                    @endif
                    @if (session('failed'))
                    <div class="alert alert-danger" role="alert">
                      {{session('failed')}}
                    </div>
                    @endif
                </div>
                <div class="head">
                    <h2>Relief Items</h2>
                </div>
                
                <div class="restable">
                    <div class="responsive-table-lg">
                        <table class="table text-center table-sm" >
                          @if (count($relief_items)>0)
                            <thead class="thead-dark">
                                <tr>
                                    <th>Quantity</th>
                                    <th>Units</th>
                                    <th>item Name</th>
                                </tr>
                            </thead>
                            <tbody> 
                            @foreach($relief_items as $item)
                            <tr>
                                <td>{{$item->ri_quantity}}</td>
                                <td>{{$item->ri_unit}}</td>
                                <td>{{$item->ri_description}}</td>
                            </tr>
                            @endforeach  
                            </tbody>
                            @else
                            <h5>No Items recorded!</h5>
                            @endif 
                        </table>
                    </div>               
                    </div>
                   
                </div>
                <div>
                  <a href="/relief" class="btn btn-danger">Return</a>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#additemmodal">
                        Add Item
                      </button>
                    
                </div>
            </div>
        </div>
     </div>
</div>


{{-- Delete Modal --}}
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/delete_exp_item" method="POST">
        {{ csrf_field() }}
        {{method_field('PUT')}}
        <div class="modal-body">
          <input type="hidden" name="id"  id="delid">
          
          <p style="display: inline" id="qty"></p>
          <p style="display: inline" id="unit"></p>
          <p style="display: inline" id="name"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="additemmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{url('/relief_item_add')}}" method="POST">
            {{ csrf_field() }}
            {{method_field('PUT')}}
        <div class="modal-body">
            <input type="hidden" name="relief_id" value="{{$relief_id}}">
                <div class="form-row">
                  <div class="col-2">
                      <label>Quantity</label>
                    <input type="number" name="qty" class="form-control" required>
                  </div>
                  <div class="col-2">
                    <label for="exampleFormControlSelect1">Unit</label>
                    <select class="form-control" name="unit" id="exampleFormControlSelect1">
                      <option disabled selected>Unit</option>
                      <option>pc/s</option>
                      <option>kl/s</option>
                    </select>
                  </div>
                 
                  <div class="col-8">
                      <label for="exampleFormControlSelect1">Description</label>
                      <select class="form-control" name="desc" id="exampleFormControlSelect1" required>
                          <option disabled selected>Basic Reliefs</option>
                         
                          @if($rice>=$res && $rice!=0)
                            <option>Rice</option>
                          @endif
                          @if($noodle>=$res && $noodle!=0)
                            <option>Noodle</option>
                          @endif
                          @if($can>=$res && $can!=0)
                            <option>Canned Goods</option>
                          @endif
                          @if($bw>=$res && $bw!=0)
                            <option>Bottled Water</option>
                          @endif
                          @if($coffee>=$res && $coffee!=0)
                            <option>Coffee</option>
                          @endif
                          @if($hk>=$res && $hk!=0)
                            <option>Hygiene Kits</option>
                          @endif
                          <!--                           
                          <option>Noodle</option>
                          <option>Canned Goods</option>
                          <option>Bottled Water</option>
                          <option>Coffee</option>
                          <option>Hygiene Kits</option> -->
                      </select>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                @if($res != 0)
                <input type="submit" value="Submit" class="btn btn-primary">
                @else
                    <p>Please Enable Residents QR-Code First</p>
                @endif
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
    document.getElementById('qty').innerHTML = data[1];
    document.getElementById('unit').innerHTML = data[2];
    document.getElementById('name').innerHTML = data[3];
    });    
    
  });
</script> 
@endsection