@extends('layouts.main')

@section('main-section')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid dashboard-default-sec" style="overflow:hidden">
        <div class="container" style="overflow-X:scroll">
            <table id="myTable">
                <thead>
                    <th>Sr.No</th>
                    <th>TICKET ID</th>
                    <th>User id</th>
                    <th>User Name</th>
                    <th>Category</th>
                    <th>Question</th>
                    <th>Date by User</th>
                    <th>Time by User </th>
                    <th>Mentor Id</th>
                    <th>Mentor Name</th>
                    <th>Ticket Status</th>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    let v=$('#myTable').DataTable({
        data:<?php echo $users?>,
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
            {data:'ticketid'},
            {data:'user_id'},
            {data:'username'},
            {data:'category'},
            {data:'question'},
            {data:'datebyuser'},
            {data:'timebyuser'},
            {data:'mentorid'},
            {data:'mentorname'},
            {data:'ticket_status'},
        ]
    });
    v.on('order.dt search.dt', function () {
        let i = 1;
        v.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
        // v.cells(null, 12, { search: 'applied', order: 'applied' }).every(function (cell) {
        //     let c=this.data();
        //     console.log(typeof c);
        //     if(c==='1'){
        //         this.data('Active');
        //     }
        //     if(c==='0'){
        //         this.data('InActive');
        //     }
        // });
    }).draw();
});
</script>
@endsection