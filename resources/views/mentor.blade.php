@extends('layouts.main')

@section('main-section')

<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h4 style="display: inline;">Mentor's</h4>
                    <button style="display: inline;float:right;" class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Add New Mentor</button>
                </div>
            </div> 
            <div class="card">
                <div class="card-body">
                <div class="table-responsive">
                    <table class="display" id="data-table">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
<<<<<<< HEAD
                            <th>MTR ID</th>
                            <th>Name</th>
                            <th>Category</th>
=======
                            <th>Qualification</th>
>>>>>>> e8b2ffb20ea4faeeb26e0a4b41ea11b28ba5f6c7
                            <th>Status</th>
                            <th>Updated At</th>
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
</div>
@endsection

@section('script')
<script>
    let closeModal=()=>{
        $('#title').val("");
    }
    
    $(document).ready(function() {
        $(document).on('click','#saveBtn' ,function (e) {
            e.preventDefault();
<<<<<<< HEAD
            $.ajax({ type: "POST", url: "/mentor", data: $('#dataForm').serialize() , dataType: "json",
                success: function(response){
                    $('#title').val("");
                    swal({   title: response.msg,   type: "success", text: "Data filled ", confirmButtonColor: "#71aa68",   },function(){table.draw(); });
                    $('#mentor_id').val("");
=======
            $.ajax({ type: "POST", url: "/qualification", data: $('#dataForm').serialize() , dataType: "json",
                success: function(response){
                    $('#title').val("");
                    swal({   title: response.msg,   type: "success", text: "Data filled ", confirmButtonColor: "#71aa68",   },function(){table.draw(); });
                    $('#qualification_id').val("");
>>>>>>> e8b2ffb20ea4faeeb26e0a4b41ea11b28ba5f6c7
                    $('.bd-example-modal-lg').modal('hide');
                },
                error: function (response) {
                    if (response.status == 422) {
                        var x = response.responseJSON;
                        $.each(x.errors, function( index, value ) {
                            $("#"+index).addClass("is-invalid");
                            $("#"+index+"-error").html(value[0]);
                        });
                    }
                }
            });
        });

        var table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
<<<<<<< HEAD
            ajax: "{{ url('getMentorData') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'mtrid', name: 'mtrid'},
                {data: 'title', name: 'title'},
                {data: 'category', name: 'category'},
=======
            ajax: "{{ url('getQualificationData') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'title', name: 'title'},
>>>>>>> e8b2ffb20ea4faeeb26e0a4b41ea11b28ba5f6c7
                {data: 'status', name: 'status', orderable: false, searchable: false},
                {data: 'updated_at', name: 'Last Update', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],

            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }
		});

<<<<<<< HEAD
        $('body').on('click', '.editmentor', function () {
            var product_id = $(this).data('id');
            $.get("{{ url('mentor/edit') }}" +'/' + product_id, function (data) { 
                $('#saveBtn').val("Save Changes");
                $('#ajaxModel').modal('show');
                $('#mentor_id').val(product_id);
                $('#title').val(data.title);
                $('#category').val(data.category);
=======
        $('body').on('click', '.editqualification', function () {
            var product_id = $(this).data('id');
            $.get("{{ url('qualification/edit') }}" +'/' + product_id, function (data) { 
                $('#saveBtn').val("Save Changes");
                $('#ajaxModel').modal('show');
                $('#qualification_id').val(product_id);
                $('#title').val(data.title); 
>>>>>>> e8b2ffb20ea4faeeb26e0a4b41ea11b28ba5f6c7
                $('#status').val(data.status);
                $('.standardSelect').selectpicker('refresh');
            })
		});

<<<<<<< HEAD
        $('body').on('click', '.delmentor', function () {
            var product_id = $(this).data("id");
            swal({   title: "Are You Sure", text: "Delete Mentor Data",  type: "warning",    showCancelButton: true,    
=======
        $('body').on('click', '.delqualification', function () {
            var product_id = $(this).data("id");
            swal({   title: "Are You Sure", text: "College Central Management System",  type: "warning",    showCancelButton: true,    
>>>>>>> e8b2ffb20ea4faeeb26e0a4b41ea11b28ba5f6c7
                confirmButtonColor: "#e6b034",  cancelButtonText: "Cancel", confirmButtonText: "Delete", closeOnConfirm: false, closeOnCancel: true 
            },
            function (isConfirm){ 
                if(isConfirm){
<<<<<<< HEAD
                    swal({    title: "Deleting Data ...",   showConfirmButton: false });
                    $.ajax({type: "GET",url: "{{ url('mentor/delete') }}"+'/'+product_id,
                    success: function (data) {
                        swal({   title: data.success ,   type: "success", confirmButtonColor: "#71aa68",},
=======
                    swal({    title: "Deleting Data ...", text: "Manufacturing Management System",  showConfirmButton: false });
                    $.ajax({type: "GET",url: "{{ url('qualification/delete') }}"+'/'+product_id,
                    success: function (data) {
                        swal({   title: data.success ,   type: "success", text: "Manufacturing Management System", confirmButtonColor: "#71aa68",   },
>>>>>>> e8b2ffb20ea4faeeb26e0a4b41ea11b28ba5f6c7
                            function(){table.draw(); });
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });
        });
    });
    
    function reset_modal() {
<<<<<<< HEAD
        $("#mentor_id").val("");
        $("#name").val("");
        $("#category").val("");
=======
        $("#qualification_id").val("");
        $("#name").val("");
>>>>>>> e8b2ffb20ea4faeeb26e0a4b41ea11b28ba5f6c7
        $("#status").val("");
        
        $('#ajaxModel').modal('hide');
        
        $("#name").removeClass("is-invalid");
<<<<<<< HEAD
        $("#category").removeClass("is-invalid");
        $("#status").removeClass("is-invalid");
        
        $("#name-error").html("");
        $("#category-error").html("");
=======
        $("#status").removeClass("is-invalid");
        
        $("#name-error").html("");
>>>>>>> e8b2ffb20ea4faeeb26e0a4b41ea11b28ba5f6c7
        $("#status-error").html("");
        
        $('#saveBtn').html('Save Changes');
    }
</script>
@endsection