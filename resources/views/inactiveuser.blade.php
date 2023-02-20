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
                <th>Mobile No.</th>
                <th>School/college Name</th>
                <th>Course/Class Name</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Plan_id</th>
                <th>Purchase_date</th>
                <th>Expire_date</th>
                <th>Plan_status</th>
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
            {data:'mobile_no'},
            {data:'coll_name'},
            {data:'course_name'},
            {data:'dob'},
            {data:'gender'},
            {data:'plan_id'},
            {data:'purchase_date'},
            {data:'expire_date'},
            {data:'plan_status'},
        ]
    });
    v.on('order.dt search.dt', function () {
        let i = 1;
        v.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
        v.cells(null, 12, { search: 'applied', order: 'applied' }).every(function (cell) {
            let c=this.data();
            
             console.log(typeof c);
            if(c==='1'){
                this.data('Active');
            }
            if(c==='0'){
                this.data('InActive');
            }
           
            // c===1?this.data('Active'):this.data('in-Active');
        });
    }).draw();
   });
</script>
@endsection


