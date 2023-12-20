@extends('layouts.parent')
@section('title', 'Edit user')

@section('content')

    @include('includes.response-messages')
    <div class="col-12">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Edit User</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="{{ route('users.updates',$user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- <input type="hidden" name="id" value="{{ $album->id }}"> --}}
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-6">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                                id="first_name" value="{{ $user->names[0] }}">
                            @error('first_name')
                                <p class="text-danger"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                                id="last_name" value="{{ $user->names[1] }}">
                            @error('last_name')
                                <p class="text-danger"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <br/>
                    <div class="form-row">
                        <div class="col-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" value="{{ $user->email}}">
                            @error('email')
                                <p class="text-danger"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="phone_number">Phone Number</label>
                            <input type="phone" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror"
                                id="phone_number" value="{{ $user->phone_number }}">
                            @error('phone_number')
                                <p class="text-danger"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-warning" name="submit" value="index">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection

