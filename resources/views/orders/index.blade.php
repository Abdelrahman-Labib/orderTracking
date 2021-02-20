@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.message')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Orders</div>

                    <div class="card-body">
                        <div class="mb-3">

                            <button class="btn btn-success" data-toggle="modal" data-target="#addModal">
                                Create new order
                            </button>
                        </div>

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Order info</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <th scope="row">{{$order->id}}</th>
                                    <td>{{$order->user->name}}</td>
                                    <td>{{$order->address}}</td>
                                    <td>{{$order->order_info}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" method="post" action="{{route('orders.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Users</label>
                        <select name="user_id" class="form-control" id="exampleFormControlSelect1" required>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" placeholder="Address" value="{{old('address')}}" required>
                        @include('layouts.error', ['input' => 'address'])
                    </div>
                    <div class="form-group">
                        <label>Order info</label>
                        <input type="text" name="order_info" class="form-control" placeholder="Order info" value="{{old('order_info')}}" required>
                        @include('layouts.error', ['input' => 'order_info'])
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
                    <button type="submit" class="btn btn-info btn-sm">Save <i class="fa fa-check"></i></button>
                </div>
            </form>
        </div>
    </div>

@endsection
