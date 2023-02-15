@extends('layouts.main')

@section('main-section')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h4 style="display: inline;">Active User</h4>
                    {{-- <button style="display: inline;float:right;" class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Add New Qualification</button> --}}
                </div>
            </div> 
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="data-table">
                            <thead>
                                <tr>
                                    <th>USER ID</th>
                                    <th>Full Name </th>
                                    <th>Email</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $value)
                                <tr>
                                    <td>USER-{{ $value->id }}</td>
                                    <td>{{ $value->full_name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->status}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    {{-- @include('modals/qualification_addedit') --}}
    <!-- Container-fluid Ends-->
</div>

@endsection

@section('script')
    <script>
        var table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'full_name', name: 'full_name'},
                {data: 'email', name: 'email'},
                {data: 'status', name: 'status'},
            ],

            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }
		});
</script>


@endsection