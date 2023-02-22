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
                            <th>MTR ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>

                            <th>Category</th>
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
            $.ajax({ type: "POST", url: "/mentor", data: $('#dataForm').serialize() , dataType: "json",
                success: function(response){
                    $('#title').val("");
                    swal({   title: response.msg,   type: "success", text: "Data filled ", confirmButtonColor: "#71aa68",   },function(){table.draw(); });
                    $('#mentor_id').val("");
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
            ajax: "{{ url('getMentorData') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'mtrid', name: 'mtrid'},
                {data: 'title', name: 'title'},
                {data: 'email', name: 'email'},
                {data: 'password', name: 'password'},
                {data: 'category', name: 'category'},
                {data: 'status', name: 'status', orderable: false, searchable: false},
                {data: 'updated_at', name: 'Last Update', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],

            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }
		});

        $('body').on('click', '.editmentor', function () {
            var product_id = $(this).data('id');
            $.get("{{ url('mentor/edit') }}" +'/' + product_id, function (data) { 
                $('#saveBtn').val("Save Changes");
                $('#ajaxModel').modal('show');
                $('#mentor_id').val(product_id);
                $('#title').val(data.title);
                $('#email').val(data.email);
                $('#password').val(data.password);
                $('#category').val(data.category);
                $('#status').val(data.status);
                $('.standardSelect').selectpicker('refresh');
            })
		});

        $('body').on('click', '.delmentor', function () {
            var product_id = $(this).data("id");
            swal({   title: "Are You Sure", text: "Delete Mentor Data",  type: "warning",    showCancelButton: true,    
                confirmButtonColor: "#e6b034",  cancelButtonText: "Cancel", confirmButtonText: "Delete", closeOnConfirm: false, closeOnCancel: true 
            },
            function (isConfirm){ 
                if(isConfirm){
                    swal({    title: "Deleting Data ...",   showConfirmButton: false });
                    $.ajax({type: "GET",url: "{{ url('mentor/delete') }}"+'/'+product_id,
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
        $("#mentor_id").val("");
        $("#name").val("");
        $("#email").val("");
        $("#password").val("");
        $("#category").val("");
        $("#status").val("");
        
        $('#ajaxModel').modal('hide');
        
        $("#name").removeClass("is-invalid");
        $("#email").removeClass("is-invalid");
        $("#password").removeClass("is-invalid");
        $("#category").removeClass("is-invalid");
        $("#status").removeClass("is-invalid");
        
        $("#name-error").html("");
        $("#email-error").html("");
        $("#password-error").html("");
        $("#category-error").html("");
        $("#status-error").html("");
        
        $('#saveBtn').html('Save Changes');
    }
</script>
@endsection