@extends('layouts.main')
@section('main-section')

<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h4 style="display: inline;">Category's</h4>
                    <button style="display: inline;float:right;" class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Add New Category</button>
                </div>
            </div> 
            <div class="card">
                <div class="card-body">
                <div class="table-responsive">
                    <table class="display" id="data-table">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>CTR ID</th>
                            <th>Title</th>
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
    @include('modals/category_addedit')
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
            $.ajax({ type: "POST", url: "/category", data: $('#dataForm').serialize() , dataType: "json",
                success: function(response){
                    $('#title').val("");
                    swal({   title: response.msg,   type: "success", text: "Data filled ", confirmButtonColor: "#71aa68",   },function(){table.draw(); });
                    $('#category_id').val("");
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
            ajax: "{{ url('getCategoryData') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'ctrid', name: 'ctrid'},
                {data: 'title', name: 'title'},
                {data: 'status', name: 'status', orderable: false, searchable: false},
                {data: 'updated_at', name: 'Last Update', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],

            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }
		});

        $('body').on('click', '.editcategory', function () {
            var product_id = $(this).data('id');
            $.get("{{ url('category/edit') }}" +'/' + product_id, function (data) { 
                $('#saveBtn').val("Save Changes");
                $('#ajaxModel').modal('show');
                $('#category_id').val(product_id);
                $('#title').val(data.title);
                $('#status').val(data.status);
                $('.standardSelect').selectpicker('refresh');
            })
		});

        $('body').on('click', '.delcategory', function () {
            var product_id = $(this).data("id");
            swal({   title: "Are You Sure", text: "Delete Category Data",  type: "warning",    showCancelButton: true,    
                confirmButtonColor: "#e6b034",  cancelButtonText: "Cancel", confirmButtonText: "Delete", closeOnConfirm: false, closeOnCancel: true 
            },
            function (isConfirm){ 
                if(isConfirm){
                    swal({    title: "Deleting Data ...",   showConfirmButton: false });
                    $.ajax({type: "GET",url: "{{ url('category/delete') }}"+'/'+product_id,
                    success: function (data) {
                        swal({   title: data.success ,   type: "success", confirmButtonColor: "#71aa68",},
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
        $("#category_id").val("");
        $("#name").val("");
        $("#status").val("");
        
        $('#ajaxModel').modal('hide');
        
        $("#name").removeClass("is-invalid");
        $("#status").removeClass("is-invalid");
        
        $("#name-error").html("");
        $("#status-error").html("");
        
        $('#saveBtn').html('Save Changes');
    }
</script>
@endsection