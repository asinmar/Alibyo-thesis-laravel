
<style>
    .column h1{
        margin-left: 20px;
        margin-top:50px;
    }
    .column .wrapper{
        height: 400px;
        overflow-y:auto;
        width: 1700px;
    }
    .column .table-fixed thead th{
        
        background:black;
        top: 0px;
        position: sticky;
        color: white;
    }
    .column .table-fixed thead th::after{
        content: '';
        width: 100%;
        height: 2px;
        position: relative;
        bottom: 0;
        left: 0;
    }
    div[class="row"]{
        margin-top: 20px;
    }
    

</style>
@extends('layout.app')

@section('content')
    <div class="column">
        <div class="row">
            <h1>Residents List</h1>
            @if (count($posts)>0)
                <div class="wrapper">
                    <table class="table table-striped table-fixed text-center">
                        <thead>
                            <tr>
                                <th scope="col">User ID</th>
                                <th scope="col">Username</th>
                                <th scope="col">Password</th>       
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <th scope="row">{{$post->user_id}}</th>
                                    <td>{{$post->username}}</td>
                                    <td>{{$post->user_pass}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{$post->user_id}}</th>
                                    <td>{{$post->username}}</td>
                                    <td>{{$post->user_pass}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{$post->user_id}}</th>
                                    <td>{{$post->username}}</td>
                                    <td>{{$post->user_pass}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{$post->user_id}}</th>
                                    <td>{{$post->username}}</td>
                                    <td>{{$post->user_pass}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{$post->user_id}}</th>
                                    <td>{{$post->username}}</td>
                                    <td>{{$post->user_pass}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{$post->user_id}}</th>
                                    <td>{{$post->username}}</td>
                                    <td>{{$post->user_pass}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{$post->user_id}}</th>
                                    <td>{{$post->username}}</td>
                                    <td>{{$post->user_pass}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{$post->user_id}}</th>
                                    <td>{{$post->username}}</td>
                                    <td>{{$post->user_pass}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{$post->user_id}}</th>
                                    <td>{{$post->username}}</td>
                                    <td>{{$post->user_pass}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{$post->user_id}}</th>
                                    <td>{{$post->username}}</td>
                                    <td>{{$post->user_pass}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{$post->user_id}}</th>
                                    <td>{{$post->username}}</td>
                                    <td>{{$post->user_pass}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{$post->user_id}}</th>
                                    <td>{{$post->username}}</td>
                                    <td>{{$post->user_pass}}</td>
                                </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button>asdasd</button>
        </div>
    </div>
    @else
        <p>walay sulod</p>
    @endif

@endsection