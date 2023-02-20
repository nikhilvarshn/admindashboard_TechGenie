@extends('layouts.main')

@section('main-section')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid dashboard-default-sec">
    <div class="container">
        <table id="myTable">
            <thead>
                <th>S.No</th>
                <th>User_id</th>
                <th>Name</th>
                <th>Email</th>
            </thead>
        </table>
    </div>
</div>
</div>
<script>
    $(document).ready( function () {
        
    let dol=$('#myTable').DataTable({
        data:<?php echo $reg?>,
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            },
        ],
        order: [[1, 'asc']],
        columns:[
            {data:'id'},
            {data:'id'},
            {data:'full_name'},
            {data:'email'}
        ]
    });
    dol.on('order.dt search.dt', function () {
        let i = 1;
        dol.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();
} );
</script>
@endsection