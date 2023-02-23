@extends('layouts.main')

@section('main-section')

<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid dashboard-default-sec">
      <div class="row">

        <div class="card">
            <div class="card-body">
                <h4 style="display: inline;">Category</h4>
                <button style="display: inline;float:right;" class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg" onclick="showSaveBtn()">Add New Category</button>
            </div>
        </div> 
        
        <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="display" id="datatable">
                  <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Name</th>
                        <th>Action</th>
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
  @include('modals/category_addedit')
    <!-- Container-fluid Ends-->
  </div>
  <script>
    let showSaveBtn=()=>{
        let tit=document.getElementById('myLargeModalLabel');
        let sbtn=document.getElementById('saveBtn');
        let ebtn=document.getElementById('editBtn');
        let cn=document.getElementById('cn');
        cn.value="";
        tit.innerHTML="Add New Category";
        sbtn.classList.remove('removebtn');
        ebtn.classList.add('removebtn');
    }
    
    
  </script>
  <script>
    let resd=[];
    let cn=()=>{
        let cn=document.getElementById('cn');
        return {name:cn.value};
    }
    function subdata(){
        let xhr=new XMLHttpRequest();
        xhr.open('POST','/api/createCategory');
        xhr.setRequestHeader('Content-Type','application/json');
        xhr.onreadystatechange=()=>{
            if(xhr.readyState===4){
                if(xhr.status>199 && xhr.status<300){
                    let tem=JSON.parse(xhr.response);
                    location.reload();
                }
                else{
                    console.log('Some Error');
                    
                }
            }
        }
        xhr.send(JSON.stringify(cn()));
    }
    let xhr=new XMLHttpRequest();
        xhr.open('GET','/api/showCategoryData');
        xhr.onreadystatechange=()=>{
            if(xhr.readyState===4){
                if(xhr.status>199 && xhr.status<300){
                    let tem=JSON.parse(xhr.response);
                    resd=tem.data;  
                    datable(resd);  
                }
                else{
                    console.log('Some Error');datable(resd);
                }
            }
        }
        xhr.send();
    let v;
   function datable(resd){
        let cl;
        $(document).ready(function(){
             v=$('#datatable').DataTable({
                data:resd,
                columnDefs: [
                 {
                searchable: false,
                orderable: false,
                targets: 0,
                 },
                 {
                searchable: false,
                orderable: false,
                targets: 2,
                'createdCell':  function (td, cellData, rowData, row, col) {
           			$(td).attr('id',cellData); 
           			$(td).attr('class','d-flex'); 
        		}
                 }
            ],
            order: [[1, 'asc']],
                columns:[
                    {data:'id'},
                    {data:'name'},
                    {data:'id'},
                ]
            });
            v.on('order.dt search.dt', function () {
            let i = 1;
            v.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
            });
            v.cells(null, 2, { search: 'applied', order: 'applied' }).every(function (cell) {
                this.data(`<div class="editm" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg" style="margin:0px;width:26px;height:26px;border-radius:13px;background-color:green;color:#fff;cursor:pointer;display:flex;justify-content:center;align-items:center;"><i class="bi bi-pencil-square"></i></div>&nbsp;&nbsp;<div class="myc" style="margin:0px;width:26px;height:26px;border-radius:13px;background-color:red;color:#fff;cursor:pointer;display:flex;justify-content:center;align-items:center;"><i class="bi bi-trash3"></i></div>`)
            // c===1?this.data('Active'):this.data('in-Active');
            });
        }).draw();
        });
   }
   $('#datatable').on('click','.myc',function(){ 
        let sv=this.parentElement.getAttribute('id');
        swal({   title: "Are You Sure", text: "College Central Management System",  type: "warning",    showCancelButton: true,    confirmButtonColor: "#e6b034",  cancelButtonText: "Cancel", confirmButtonText: "Delete", closeOnConfirm: false, closeOnCancel: true },
        function (isConfirm){ 
        if(isConfirm){
            swal({    title: "Deleting Data ...", text: "Manufacturing Management System",  showConfirmButton: false });
            let xhr=new XMLHttpRequest();
            xhr.open('GET',`/api/deleteCategoryData/${sv}`);
            xhr.onreadystatechange=()=>{
                if(xhr.readyState===4){
                    if(xhr.status>199 && xhr.status<300){
                        swal({   title: 'Deleted' ,   type: "success", text: "Manufacturing Management System", confirmButtonColor: "#71aa68",   },function(){v.draw(); });
                        location.reload();
                    }
                    else{
                        console.log('Error:', xhr.response);
                    }
                }
            }
            xhr.send();
        }
        });
   });
   $('#datatable').on('click','.editm',function(){
        
        let pid=this.parentElement.getAttribute('id');
        let tit=document.getElementById('myLargeModalLabel');
        let sbtn=document.getElementById('saveBtn');
        let ebtn=document.getElementById('editBtn');
        let cn=document.getElementById('cn');
        let ch=document.getElementById('category_id');
        ch.value=pid;
        tit.innerHTML="Edit Category";
        sbtn.classList.add('removebtn');
        ebtn.classList.remove('removebtn');
        let xhr=new XMLHttpRequest();
        xhr.open('GET',`/api/getcategory/${pid}`);
        xhr.onreadystatechange=()=>{
            if(xhr.readyState===4){
                if(xhr.status>199 && xhr.status<300){
                    let tem=JSON.parse(xhr.response);
                    cn.value=tem.data.name;
                }
                else{
                    console.log('Some Error');
                    
                }
            }
        }
        xhr.send();

    });
    let ecn=()=>{
        let cn=document.getElementById('cn');
        let ch=document.getElementById('category_id');
        return {id:ch.value,name:cn.value};
    }
    function editdata(){
        let xhr=new XMLHttpRequest();
        xhr.open('POST','/api/editcategory');
        xhr.setRequestHeader('Content-Type','application/json');
        xhr.onreadystatechange=()=>{
            if(xhr.readyState===4){
                if(xhr.status>199 && xhr.status<300){
                    let tem=JSON.parse(xhr.response);
                    location.reload();
                }
                else{
                    console.log('Some Error');
                    
                }
            }
        }
        xhr.send(JSON.stringify(ecn()));
    }
  </script>

@endsection

