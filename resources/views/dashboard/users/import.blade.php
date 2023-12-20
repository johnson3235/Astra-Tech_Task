@extends('layouts.parent')
@section('title', 'Import')


@section('content')
<div class="col-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Import Users File</h3>
        </div>
        {{-- <input type="hidden" name="id" value="{{ $album->id }}"> --}}
        <form method="post" action="{{ route('users.import') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-row">
                    <div class="col-4">
                        <label for="full_name_heading">Full Name Heading</label>
                        <input type="text" name="full_name_heading" class="form-control @error('full_name_heading') is-invalid @enderror"
                            id="full_name_heading" value="{{ old('full_name_heading') }}">
                        @error('full_name_heading')
                            <p class="text-danger"> {{ $message }} </p>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="email_heading">Email Heading</label>
                        <input type="text" name="email_heading" class="form-control @error('email_heading') is-invalid @enderror"
                            id="email_heading" value="{{ old('email_heading') }}">
                        @error('email_heading')
                            <p class="text-danger"> {{ $message }} </p>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="phone_number_heading">Phone Number Heading</label>
                        <input type="text" name="phone_number_heading" class="form-control @error('phone_number_heading') is-invalid @enderror"
                            id="phone_number_heading" value="{{ old('phone_number_heading') }}">
                        @error('phone_number_heading')
                            <p class="text-danger"> {{ $message }} </p>
                        @enderror
                    </div>
                    
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <label for="file">file</label>
                        <input class="form-control" type="file" name="file" class="form-control @error('file') is-invalid @enderror"
                            id="file"  accept=".xlsx" >
                        @error('file')
                            <p class="text-danger"> {{ $message }} </p>
                        @enderror
                    </div>
                </div>
                   
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-outline-primary" name="submit" value="index">Import Users Data</button>
            </div>
        </form>
    </div>
</div>

@endsection