@extends('layouts.main')

@section('main-section')

<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid dashboard-default-sec">
      <div class="row">

        <div class="card">
            <div class="card-body">
                <h4 style="display: inline;">Mentor's</h4>
                <button style="display: inline;float:right;" class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg" onclick="getCat()" >Add New Mentor's</button>
            </div>
        </div> 
        
        <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="display" id="datatable">
                    <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Mentor Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Category_Id</th>
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
  @include('modals/mentor_addedit')
    <!-- Container-fluid Ends-->
  </div>
  <script>
    let appOption=(id,text)=>{
        let cat=document.getElementById('cat');
        let op=document.createElement('option');
        op.value=id;
        let cr=document.createTextNode(text);
        op.appendChild(cr);
        cat.appendChild(op);
    } 
    let hidein=()=>{
        let mn=document.getElementById('mnamed');
        let me=document.getElementById('memaild');
        let mpa=document.getElementById('mpasswordd');
        let mcpa=document.getElementById('mcpasswordd');
        let ht=document.getElementById('myLargeModalLabel');
        let sbtn=document.getElementById('saveBtn');
        let ebtn=document.getElementById('editBtn');
        mn.classList.add('removeElement');
        me.classList.add('removeElement');
        mpa.classList.add('removeElement');
        mcpa.classList.add('removeElement');
        ht.innerHTML="Edit Mentor";
        sbtn.classList.add('removeElement');
        ebtn.classList.remove('removeElement');

    }
    let showin=()=>{
        let mn=document.getElementById('mnamed');
        let me=document.getElementById('memaild');
        let mpa=document.getElementById('mpasswordd');
        let mcpa=document.getElementById('mcpasswordd');
        let ht=document.getElementById('myLargeModalLabel');
        let cat=document.getElementById('cat');
        cat.value="";
        let sbtn=document.getElementById('saveBtn');
        let ebtn=document.getElementById('editBtn');
        mn.classList.remove('removeElement');
        me.classList.remove('removeElement');
        mpa.classList.remove('removeElement');
        mcpa.classList.remove('removeElement');
        ht.innerHTML="Add New Mentor";
        sbtn.classList.remove('removeElement');
        ebtn.classList.add('removeElement');
    }
    let getInputData=()=>{
        let mname=document.getElementById('mname');
        let memail=document.getElementById('memail');
        let mpa=document.getElementById('mpassword');
        let mcpa=document.getElementById('mcpassword');
        let cat=document.getElementById('cat');
        
        return {
            name:mname.value,
            email:memail.value,
            password:mpa.value,
            password_confirmation:mcpa.value,
            category_id:cat.value,
        };
    }
    let getCat=()=>{
        showin();
        let xhr=new XMLHttpRequest();
        xhr.open('GET','/api/showCategoryData');
        xhr.onreadystatechange=()=>{
            if(xhr.readyState===4){
                if(xhr.status>199 && xhr.status<300){
                    let da=JSON.parse(xhr.response);
                    let arr=da.data;
                    arr.map((x)=>{
                        appOption(x.id,x.name);
                    });
                    
                }
            }
        }
        xhr.send();
    }
    let sub=()=>{
        let xhr=new XMLHttpRequest();
        xhr.open('POST','/api/creatementor');
        xhr.setRequestHeader('Content-Type','application/json');
        xhr.onreadystatechange=()=>{
            if(xhr.readyState===4){
                if(xhr.status>199 && xhr.status<300){
                    let da=JSON.parse(xhr.response);
                    location.reload();
                }
                else
                console.log('Some Errors');
            }
        }
        xhr.send(JSON.stringify(getInputData()));
    }
    $('#datatable').on('click','.editmy',function(){
        let id=this.parentElement.getAttribute('id');
        let mn=document.getElementById('mentor_id');
        let cat=document.getElementById('cat');
        cat.value=id;
        mn.value=id;
        getCat();
        hidein();
        let xhr=new XMLHttpRequest();
        xhr.open('GET',`/api/getmentor/${id}`);
        xhr.onreadystatechange=()=>{
            if(xhr.readyState===4){
                if(xhr.status>199 && xhr.status<300){
                    let da=JSON.parse(xhr.response);
                    let arr=da.data;
                    cat.value=arr.category_id;
                    
                }
            }
        }
        xhr.send();

    });
    let eddata=()=>{
        let mn=document.getElementById('mentor_id');
        let cat=document.getElementById('cat');
        return {
            id:mn.value,
            category_id:cat.value
        };
    }
    let editd=()=>{
        let xhr=new XMLHttpRequest();
        xhr.open('POST','/api/editmentor');
        xhr.setRequestHeader('Content-Type','application/json');
        xhr.onreadystatechange=()=>{
            if(xhr.readyState===4){
                if(xhr.status>199 && xhr.status<300){
                    let da=JSON.parse(xhr.response);
                    location.reload();
                }
                else
                console.log('Some Errors');
            }
        }
        xhr.send(JSON.stringify(eddata()));
    }
    $(document).ready(function(){
             v=$('#datatable').DataTable({
                data:<?php echo $user?>,
                columnDefs: [
                 {
                searchable: false,
                orderable: false,
                targets: 0,
                 },
                 {
                searchable: false,
                orderable: false,
                targets: 5,
                'createdCell':  function (td, cellData, rowData, row, col) {
           			$(td).attr('id',cellData); 
           			$(td).attr('class','d-flex'); 
        		}
                 }
            ],
            order: [[1, 'asc']],
                columns:[
                    {data:'id'},
                    {data:'id'},
                    {data:'name'},
                    {data:'email'},
                    {data:'category_id'},
                    {data:'id'},
                ]
            });
            v.on('order.dt search.dt', function () {
            let i = 1;
            v.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
            });
            v.cells(null, 5, { search: 'applied', order: 'applied' }).every(function (cell) {
                this.data(`<div class="editmy" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg" style="margin:0px;width:26px;height:26px;border-radius:13px;background-color:green;color:#fff;cursor:pointer;display:flex;justify-content:center;align-items:center;"><i class="bi bi-pencil-square"></i></div>&nbsp;&nbsp;<div class="myc" style="margin:0px;width:26px;height:26px;border-radius:13px;background-color:red;color:#fff;cursor:pointer;display:flex;justify-content:center;align-items:center;"><i class="bi bi-trash3"></i></div>`)
            // c===1?this.data('Active'):this.data('in-Active');
            });
        }).draw();
        });
        $('#datatable').on('click','.myc',function(){ 
        let sv=this.parentElement.getAttribute('id');
        swal({   title: "Are You Sure", text: "College Central Management System",  type: "warning",    showCancelButton: true,    confirmButtonColor: "#e6b034",  cancelButtonText: "Cancel", confirmButtonText: "Delete", closeOnConfirm: false, closeOnCancel: true },
        function (isConfirm){ 
        if(isConfirm){
            swal({    title: "Deleting Data ...", text: "Manufacturing Management System",  showConfirmButton: false });
            let xhr=new XMLHttpRequest();
            xhr.open('GET',`/api/deletementor/${sv}`);
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
  </script>
 
  

@endsection

