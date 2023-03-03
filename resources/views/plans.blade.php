@extends('layouts.main')

@section('main-section')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid dashboard-default-sec" style="overflow:hidden">
    <div class="container" style="overflow-X:scroll">
        <table id="myTable">
            <thead>
                <th>S.No</th>
                <th>Plan_id</th>
                <th>Plan_name</th>
                <th>Price</th>
                <th>Duration</th>
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
            {data:'plan_id'},
            {data:'plan_name'},
            {data:'plan_price'},
            {data:'plan_duration'},
        ]
    });
    v.on('order.dt search.dt', function () {
        let i = 1;
        v.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
        v.cells(null, 4, { search: 'applied', order: 'applied' }).every(function (cell) {
            let c=this.data();
            
             console.log(typeof c);
            if(c==='180'){
                this.data('6 Months');
            }
            if(c==='365'){
                this.data('Yearly');
            }
            if(c==='1460'){
                this.data('4 Years');
            }
           
            // c===1?this.data('Active'):this.data('in-Active');
        });
    }).draw();
   });
</script>
@endsection


