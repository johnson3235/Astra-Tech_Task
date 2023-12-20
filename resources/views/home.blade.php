@extends('layouts.parent')
@section('title', 'Users')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    @include('includes.response-messages')
    <div class="col-12">
        <div class="card">
            <div class="col-2 pt-2" style="    float: left;
        
            left: 85%;
            position: relative;
        ">
                 <a href="{{ route('users.export.view') }}" class="btn btn-outline-warning  btn-lg">Export</a>
                 <a href="{{ route('users.import.view') }}" class="btn btn-outline-warning  btn-lg">import</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Full_Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Creation Date</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->full_name}}</td>
                                <td>{{ $user->email}}</td>
                                <td>{{ $user->phone_number}}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                <a href= "{{ route('users.view', $user->id) }}"
                                        class="btn btn-outline-primary"> View </a>
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="btn btn-outline-warning"> Edit </a>

                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteConfirmationModal{{ $user->id }}">Delete</button>

                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

    <div class="modal fade" id="deleteConfirmationModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">Cancel</button>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('js')
<script>
    function confirmDelete(userId) {
        $('#deleteConfirmationModal').modal('show');
        $('#cancel').click(function () {
            $('#deleteConfirmationModal').modal('hide');
        });;

        $('#confirmDeleteButton').click(function () {
            // Redirect to the delete route
            window.location.href = '/users/' + userId + '/delete';
        });
    }
</script>
    <!-- DataTables  & Plugins -->
    <script src="{{ url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ url('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ url('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ url('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>


    
@endsection
