@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.message')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">View user</div>

                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item active">Topics name</li>
                            @foreach($user->topics as $topic)
                                <li class="list-group-item">{{$topic->id}} - {{$topic->name}}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item active">Orders</li>
                            @foreach($user->orders as $order)
                                <li class="list-group-item">{{$order->id}} - {{$order->order_info}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
