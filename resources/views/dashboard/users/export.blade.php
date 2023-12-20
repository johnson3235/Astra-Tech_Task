@extends('layouts.parent')
@section('title', 'Export')


@section('content')
    <div class="container">
        <h2>Export Users</h2>
        
        {{-- <form action="{{ route('users.export') }}" method="post">
            @csrf
            <label for="selected_columns">Select Columns for Export:</label>
            <select name="selected_columns[]" id="selected_columns" multiple>
                @foreach($allColumns as $column)
                    <option value="{{ $column }}">{{ ucfirst($column) }}</option>
                @endforeach
            </select>
            <button type="submit">Export Users</button>
        </form>
    </div> --}}

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('users.export') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="selected_columns">Select Columns for Export:</label>
                        <select name="selected_columns[]" id="selected_columns" class="form-control" multiple>
                            <option value="id">ID</option>
                            <option value="full_name">Full Name</option>
                            <option value="phone_number">Phone Number</option>
                            <option value="email">Email</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Export Users</button>
                </form>
            </div>
        </div>
    </div>

    {{-- <form  action="{{ route('users.export') }}" method="post">
        @csrf
        <label for="selected_columns">Select Columns for Export:</label>
        <select name="selected_columns[]" id="selected_columns" multiple>
            <option value="id">ID</option>
            <option value="full_name">Full Name</option>
            <option value="phone_number">Phone Number</option>
            <option value="email">Email</option>
        </select>
        <button type="submit">Export Users</button>
    </form> --}}
@endsection