@extends('layouts.main')

@section('main-section')

<div class="page-body">
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h4 style="display: inline;">Student</h4>
                    <button style="display: inline;float:right;" class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Add New Student</button>
                </div>
            </div> 
        
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="data-table">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>STD ID</th>
                                    <th>Student Name</th>
                                    <th>Father's Name</th>
                                    <th>Mother's Name</th>
                                    <th>DOB</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Blood Group</th>
                                    <th>Permanent Address</th>
                                    <th>City Name</th>
                                    <th>State</th>
                                    <th>PinCode</th>
                                    <th>Religion</th>
                                    <th>Mobile Number</th>
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
@include('modals/student_addedit')
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
        $.ajax({ type: "POST", url: "/student", data: $('#dataForm').serialize() , dataType: "json",
            success: function(response){
                    $('#title').val("");
                    swal({   title: response.msg,   type: "success", text: "College Central Management System", confirmButtonColor: "#71aa68",   },function(){table.draw(); });
                    $('#student_id').val("");
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
            ajax: "{{ url('getStudentData') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'stdid', name: 'stdid'},
                {data: 'studentname', name: 'studentname'},
                {data: 'fathername', name:'fathername'},
                {data: 'mothername', name:'mothername'},
                {data: 'dob', name:'dob'},
                {data: 'age', name: 'age'},
                {data: 'gender', name: 'gender'},
                {data: 'bloodgroup', name: 'bloodgroup'},
                {data: 'permanentaddress', name: 'permanentaddress'},
                {data: 'city', name: 'city'},
                {data: 'state', name: 'state'},
                {data: 'pincode', name: 'pincode'},
                {data: 'religion', name: 'religion'},
                {data: 'mobilenumber', name: 'mobilenumber'},
                {data: 'status', name: 'status', orderable: false, searchable: false},
                {data: 'updated_at', name: 'Last Update', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],

            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }
		});

    $('body').on('click', '.editstudent', function () {
		var product_id = $(this).data('id');
		$.get("{{ url('student/edit') }}" +'/' + product_id, function (data) { 
            $('#saveBtn').val("Save Changes");
            $('#ajaxModel').modal('show');
            $('#student_id').val(product_id);
            $('#studentname').val(data.studentname); 
            $('#fathername').val(data.fathername); 
            $('#mothername').val(data.mothername); 
            $('#dob').val(data.dob); 
            $('#age').val(data.age); 
            $('#gender').val(data.gender); 
            $('#bloodgroup').val(data.bloodgroup); 
            $('#permanentaddress').val(data.permanentaddress); 
            $('#city').val(data.city); 
            $('#state').val(data.state); 
            $('#pincode').val(data.pincode); 
            $('#religion').val(data.religion); 
            $('#mobilenumber').val(data.mobilenumber);
            $('#status').val(data.status);
            $('.standardSelect').selectpicker('refresh');
        })
		});
    

    $('body').on('click', '.delstudent', function () {
        var product_id = $(this).data("id");
        swal({   title: "Are You Sure", text: "College Central Management System",  type: "warning",    showCancelButton: true,    confirmButtonColor: "#e6b034",  cancelButtonText: "Cancel", confirmButtonText: "Delete", closeOnConfirm: false, closeOnCancel: true },
        function (isConfirm){ 
        if(isConfirm){
                    swal({    title: "Deleting Data ...", text: "Manufacturing Management System",  showConfirmButton: false });
        $.ajax({type: "GET",url: "{{ url('student/delete') }}"+'/'+product_id,
            success: function (data) {
            swal({   title: data.success ,   type: "success", text: "Manufacturing Management System", confirmButtonColor: "#71aa68",   },function(){table.draw(); });
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
    $("#student_id").val("");
    $('#studentname').val(""); 
    $('#fathername').val(""); 
    $('#mothername').val(""); 
    $('#dob').val(""); 
    $('#age').val(""); 
    $('#gender').val(""); 
    $('#bloodgroup').val(""); 
    $('#permanentaddress').val(""); 
    $('#city').val(""); 
    $('#state').val(""); 
    $('#pincode').val(""); 
    $('#religion').val(""); 
    $('#mobilenumber').val("");
    $('#status').val("");

    $('#ajaxModel').modal('hide');

    $('#studentname').removeClass("is-invalid"); 
    $('#fathername').removeClass("is-invalid"); 
    $('#mothername').removeClass("is-invalid"); 
    $('#dob').removeClass("is-invalid"); 
    $('#age').removeClass("is-invalid"); 
    $('#gender').removeClass("is-invalid"); 
    $('#bloodgroup').removeClass("is-invalid"); 
    $('#permanentaddress').removeClass("is-invalid"); 
    $('#city').removeClass("is-invalid"); 
    $('#state').removeClass("is-invalid"); 
    $('#pincode').removeClass("is-invalid"); 
    $('#religion').removeClass("is-invalid"); 
    $('#mobilenumber').removeClass("is-invalid");
    $("#status").removeClass("is-invalid");

    $("#name-error").html("");
    $("#student_id-error").html("");
    $("#studentname-error").html(""); 
    $("#fathername-error").html(""); 
    $("#mothername-error").html(""); 
    $("#dob-error").html(""); 
    $("#age-error").html(""); 
    $("#gender-error").html(""); 
    $("#bloodgroup-error").html(""); 
    $("#permanentaddress-error").html(""); 
    $("#city-error").html(""); 
    $("#state-error").html(""); 
    $("#pincode-error").html(""); 
    $("#religion-error").html(""); 
    $("#mobilenumber-error").html("");
    $("#status-error").html("");

    $('#saveBtn').html('Save Changes');
}

</script>


@endsection