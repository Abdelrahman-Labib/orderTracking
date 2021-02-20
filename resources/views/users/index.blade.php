@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.message')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users</div>

                <div class="card-body">
                    <div class="mb-3">

                        <button class="btn btn-success" data-toggle="modal" data-target="#addModal">
                            Create new user
                        </button>
                    </div>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <button class="btn btn-dark" onclick="openModalEdit({{$user}})">Edit</button>
                                    <button class="btn btn-danger" onclick="openModalDelete({{$user->id}})">Delete</button>
                                    <a href="{{route('users.show', $user->id)}}" class="btn btn-primary">View</a>
                                </td>
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
        <form class="modal-content" method="post" action="{{route('users.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{old('name')}}" required>
                    @include('layouts.error', ['input' => 'name'])
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{old('phone')}}" required>
                    @include('layouts.error', ['input' => 'phone'])
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{old('email')}}" required>
                    @include('layouts.error', ['input' => 'email'])
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    @include('layouts.error', ['input' => 'password'])
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
                <button type="submit" class="btn btn-info btn-sm">Save <i class="fa fa-check"></i></button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content" method="post" id="edit_form" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" id="e_name" name="name" class="form-control" placeholder="Name" required>
                    @include('layouts.error', ['input' => 'name'])
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" id="e_phone" name="phone" class="form-control" placeholder="Phone" required>
                    @include('layouts.error', ['input' => 'phone'])
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" id="e_email" name="email" class="form-control" placeholder="Email" required>
                    @include('layouts.error', ['input' => 'email'])
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
                <button type="submit" class="btn btn-info btn-sm">Save <i class="fa fa-check"></i></button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content" method="post" id="delete_form">
            @csrf
            @method('delete')
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label class="col-sm-12 form-control-label" style="font-weight: bold">
                        Are you sure for deleting, <label style="color: #bd2130" id="delete_title"></label>
                    </label>
                </div><!-- row -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
                <button type="submit" class="btn btn-info btn-sm">Save <i class="fa fa-check"></i></button>
            </div>
        </form>
    </div>
</div>

@endsection

<script>
    function openModalEdit(user) {
        $('#e_name').val(user.name);
        $('#e_phone').val(user.phone);
        $('#e_email').val(user.email);
        $('#edit_form').attr('action', '/home/' + user.id);
        $('#editModal').modal('show');
    }

    function openModalDelete(user_id) {
        $('#delete_title').text(user_id);
        $('#delete_form').attr('action', '/home/' + user_id);
        $('#deleteModal').modal('show');
    }
</script>
