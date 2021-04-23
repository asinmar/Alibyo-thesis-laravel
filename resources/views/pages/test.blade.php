@foreach ($relief as $item)
    <h3>{{$item->relief_name}}</h3>
    @foreach ($item->donations as $list)
        <p>{{$list->donation_description}}</p>
    @endforeach
@endforeach