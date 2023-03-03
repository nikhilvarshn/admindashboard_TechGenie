@extends('layouts.main')

@section('main-section')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid dashboard-default-sec" style="overflow:hidden">
    <div class="container" style="overflow-X:scroll">
        <table id="myTable">
            <thead>
                <th>S.No</th>
                <th>User_id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Category</th>
                <th>Question</th>
                <th>Date and Time</th>
                <th>Mentor Id</th>
                <th>Google Meet Link</th>
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
            {data:'user_id'},
            {data:'full_name'},
            {data:'email'},
            {data:'category'},
            {data:'question'},
            {data:'date_and_time'},
            {data:'mentor_id'},
            {data:'google_meet_link'},
            {data:'ticket_status'},
        ]
    });
    v.on('order.dt search.dt', function () {
        let i = 1;
        v.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
        v.cells(null, 9, { search: 'applied', order: 'applied' }).every(function (cell) {
            let c=this.data();
            if(c==='1'){
                this.data('<span style="color:green">Raised</span>');
            }
            if(c==='2'){
                this.data('<span style="color:green">Inprocessing</span>');
            }
            if(c==='3'){
                this.data('<span style="color:red">Closed</span>');
            }
           
            // c===1?this.data('Active'):this.data('in-Active');
        });
    }).draw();
   });
</script>
@endsection


