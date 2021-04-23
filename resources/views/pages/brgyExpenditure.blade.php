<style>
    .tabledes{

        margin-top:30px;
    }
</style>
@extends('layout.brgyUser')
@section('content')
   <div class="container-fluid">
       <div class="row">
           <div>
           </div>
           <div class="col-xl-12">
               <div>
                   <h2>Expenditures</h2>
               </div>
               <div class="table-responsive-xl tabledes">
                <table class="table table-sm text-center">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Used Amount</th>
                        <th scope="col">Puchased by</th>
                        <th scope="col">Date purchased</th>
                        <th scope="col">items</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenditures as $expenditure)
                            <tr>
                                <td class="align-middle">{{$expenditure->exp_used_amount}}</td>
                                <td class="align-middle">{{$expenditure->purchased_by}}</td>
                                <td class="align-middle">{{$expenditure->date_purchased}}</td>
                                <td>
                                    @foreach ($expenditure->exp_items as $item)
                                        <ul>
                                            <li>{{$item->item_quantity}}&nbsp;{{$item->item_unit}}&nbsp;{{$item->item_name}}</li>
                                        </ul>
                                    @endforeach
                                </td>   
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
               </div>
           </div>
           <div>
            {{$expenditures->links()}}
           </div>
       </div>
   </div>
   
   
@endsection