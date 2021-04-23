
<style>

    .inside{
        border:1px solid;
        height: 120px;
        padding-left:30px;
        border-color:rgb(214, 214, 214);
    }
</style>
@extends('layout.app')

@section('content')
<div class="container" >
    <div class="row d-flex justify-content-center" >
        <div class="col-lg-8 col-sm-10 col-xs-12">
            @foreach ($errors as $error)
            <div class="alert alert-danger">
                {{$error}}
            </div>
            @endforeach
            @if (session('success'))
            <div class="alert alert-success" role="alert">
              {{session('success')}}
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger" role="alert">
              {{session('error')}}
            </div>
        @endif

        <div >
            <h2 class="text-center">Send To</h2>
            <div class=" d-flex justify-content-around">
                <button class="btn btn-success" onclick="donors_div()">Donors</button>
                <button class="btn btn-success" onclick="residents_div()">Residents</button>
               
            </div>
            
            </div>
                <div class="smsbox" style="margin-top:30px; border:1px solid; padding:50px; border-radius:10px;display:none;" id="residents">
                    <h4>The message will be send to all enabled QR-CODE</h4>
                    <form action="{{action('ResidentsController@residentsms')}}" method="POST">
                        @csrf
                    
                        <div class="form-group">
                            <input type="hidden" name="number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="sms"><strong>Compose Message</strong></label>
                            <textarea name="sms" id="sms" name="sms" rows="5" class="form-control" placeholder="Message here" onkeyup="countChar(this)" required></textarea>
                        </div>
                        <p class="text-right"><span id="myText">100</span></p>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success">Send to Residents</button>
                        </div>
                        
                    </form>
                </div>
                <div class="smsbox" style="margin-top:30px; border:1px solid; padding:50px; border-radius:10px;display:block;" id="donors">
                    <form action="{{action('DonorsController@donorsms')}}" method="POST">
                        @csrf
                    
                        <div class="form-group">
                            <input type="hidden" name="number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="sms"><strong>Compose Message</strong></label>
                            <textarea name="sms" id="sms" name="sms" rows="5" class="form-control" placeholder="Message here" onkeyup="donorChar(this)" required></textarea>
                        </div>
                        <p class="text-right"><span id="donorText">100</span></p>
                    <div class=" checkbox">
                        <h6>Please select donor to recieve message</h6>
                        <div class="inside overflow-auto">
                          @foreach ($donors as $item) 
                          <div class="form-check">                           
                                <input class="form-check-input" type="checkbox" name="lists[]" value="{{$item->donor_id}}">
                                <label class="form-check-label">
                                    <tr>
                                      <td>{{$item->donor_name}}&nbsp;{{$item->donor_type}}</td>
                                       
                           
                                    </tr>  
                                </label>       
                            </div>
                            @endforeach  
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-success" method="POST">Send to Donors</button>
                    </div>
                </form>
                    {{$donors->links()}}
                </div>
            </div>
        </div>
</div>  


<script>
     function residents_div() {
   document.getElementById("residents").style.display = "block";
   document.getElementById("donors").style.display = "none";
    }

    function donors_div() {
    document.getElementById("donors").style.display = "block";
    document.getElementById("residents").style.display = "none";
    }
</script>
<script type="text/javascript">
    function countChar(val){
        var len = val.value.length;
       if(len <=100 ){
          var value = 100-len
       }
       else{
           value = "Limit Reached!";
       }

        document.getElementById("myText").innerHTML = value;
    }

    function donorChar(val){
        var len = val.value.length;
       if(len <=100 ){
          var value = 100-len
       }
       else{
           value = "Limit Reached!";
       }

        document.getElementById("donorText").innerHTML = value;
    }
</script>
<script>
    var msg = '{{Session::get('smsalert')}}';
    var exist = '{{Session::has('smsalert')}}';
    if(exist){
      alert(msg);
    }
  </script>

@endsection
