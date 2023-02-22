@extends('layouts.main')

@section('main-section')

<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="card radius-10">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 data-tables" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    {{-- <th>Updated At</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripting')

<script type="text/javascript">
    $(document).ready(function() {
		$(".standardSelect").selectpicker();

        $('.standardSelect').on('change', function () {
            $(this).valid();
            $('.standardSelect').selectpicker('refresh');
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

		var table2 = $('.data-tables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('getRegisteredData') }}",
            columns: [
				{data: 'DT_RowIndex', name: 'DT_RowIndex'},
				{data: 'full_name', name: 'full_name'},
				{data: 'email', name: 'email'},
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }
        });    
		$('.standardSelect').selectpicker('refresh'); 
    });
</script>
@endsection