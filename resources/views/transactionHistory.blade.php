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
                <th>plan_id</th>
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
        v.cells(null, 6, { search: 'applied', order: 'applied' }).every(function (cell) {
            let c=this.data();
            
             console.log(typeof c);
            if(c==='1'){
                this.data('<span style="color:green">Active</span>');
            }
            if(c==='0'){
                this.data('<span style="color:red">Expire</span>');
            }
           
            // c===1?this.data('Active'):this.data('in-Active');
        });
    }).draw();
   });
</script>
@endsection


