@extends('layouts.parent')
@section('title', 'view User')


@section('content')

@include('includes.response-messages')
<div class="col-12">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">view user</h3>
        </div>
        {{-- <input type="hidden" name="id" value="{{ $album->id }}"> --}}
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                        value="{{ $user->full_name }}">
            
                </div>
                <div class="col-6">
                    <label for="created_at">Created_at</label>
                    <input type="created_at" name="created_at"
                        class="form-control @error('created_at') is-invalid @enderror" id="created_at"
                        value="{{ $user->created_at }}">
                 
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-6">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        value="{{ $user->email }}">
                  
                </div>
                <div class="col-6">
                    <label for="phone_number">Phone Number</label>
                    <input type="phone_number" name="phone_number"
                        class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                        value="{{ $user->phone_number }}">
                   
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
