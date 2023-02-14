@php $status = [1=>'Active', 0=>'In-Active']; @endphp
@php $gender = [0=>'Male', 1=>'Female', 2=>'Other']; @endphp
@php $bloodgroup = [0=>'A+', 1=>'A-', 2=>'B+', 3=>'B-', 4=>'AB+', 5=>'AB-', 6=>'O+', 7=>'O-']; @endphp

<div class="modal fade bd-example-modal-lg" id="ajaxModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add New Student</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="col-sm-12 col-xs-12">

                    {!! Form::open(['id' => 'dataForm', 'name' => 'dataForm', 'class'=>'form-horizontal']) !!}
                    
                    <div class="row justify-content-center">   

                        {{csrf_field()}}
                        {!! Form::hidden('student_id', '', ['id'=>'student_id']); !!}
                        
                        <div class="col-sm-4 col-xs-12">
                            <label for="studentname">Student Name :</label>
                            {!! Form::text('studentname', '', ['class'=>"form-control", 'id'=>"studentname", 'placeholder'=>"Enter Student Name", 'required']); !!} <br>
                            <span class="text-danger" id="title-error"></span>
                        </div>

                        <div class="col-sm-4 col-xs-12">
                            <label for="fathername">Father's Name :</label>
                            {!! Form::text('fathername', '', ['class'=>"form-control", 'id'=>"fathername", 'placeholder'=>"Enter Father's Name", 'required']); !!} <br>
                            <span class="text-danger" id="title-error"></span>
                        </div>

                        <div class="col-sm-4 col-xs-12">
                            <label for="mothername">Mother's Name :</label>
                            {!! Form::text('mothername', '', ['class'=>"form-control", 'id'=>"mothername", 'placeholder'=>"Enter Mother's Name", 'required']); !!} <br>
                            <span class="text-danger" id="title-error"></span>
                        </div>

                        <div class="col-sm-4 col-xs-12">
                            <label for="dob">DOB :</label>
                            {!! Form::text('dob', '', ['class'=>"form-control", 'id'=>"dob", 'placeholder'=>"Enter Your DOB", 'required']); !!} <br>
                            <span class="text-danger" id="title-error"></span>
                        </div>

                        <div class="col-sm-4 col-xs-12">
                            <label for="age">Age :</label>
                            {!! Form::text('age', '', ['class'=>"form-control", 'id'=>"age", 'placeholder'=>"Enter Your Age", 'required']); !!} <br>
                            <span class="text-danger" id="title-error"></span>
                        </div>

                        <div class="col-sm-4 col-xs-12">
                            <label for="gender">Gender :</label>
                            {!! Form::select('gender', $gender, '', ['class'=>'standardSelect form-control', 'title'=>'Select ', 'data-live-search'=>'true', 'id'=>'gender' , 'data-style'=>'btn-sp', 'data-dropup-auto'=>'false', 'data-size'=>'5']) !!}<br>
                            <span class="text-danger" id="status-error"></span>
                        </div>

                        <div class="col-sm-4 col-xs-12">
                            <label for="bloodgroup">Blood Group :</label>
                            {!! Form::select('bloodgroup', $bloodgroup, '', ['class'=>'standardSelect form-control', 'title'=>'Select ', 'data-live-search'=>'true', 'id'=>'bloodgroup' , 'data-style'=>'btn-sp', 'data-dropup-auto'=>'false', 'data-size'=>'5']) !!}<br>
                            <span class="text-danger" id="status-error"></span>
                        </div>

                        <div class="col-sm-4 col-xs-12">
                            <label for="permanentaddress">Permanent Address :</label>
                            {!! Form::text('permanentaddress', '', ['class'=>"form-control", 'id'=>"permanentaddress", 'placeholder'=>"Enter Permanent Address", 'required']); !!} <br>
                            <span class="text-danger" id="title-error"></span>
                        </div>

                        <div class="col-sm-4 col-xs-12">
                            <label for="city">City Name :</label>
                            {!! Form::text('city', '', ['class'=>"form-control", 'id'=>"city", 'placeholder'=>"Enter Your City", 'required']); !!} <br>
                            <span class="text-danger" id="title-error"></span>
                        </div>

                        <div class="col-sm-4 col-xs-12">
                            <label for="state">State Name :</label>
                            {!! Form::text('state', '', ['class'=>"form-control", 'id'=>"state", 'placeholder'=>"Enter Your State", 'required']); !!} <br>
                            <span class="text-danger" id="title-error"></span>
                        </div>

                        <div class="col-sm-4 col-xs-12">
                            <label for="pincode">Pin Code :</label>
                            {!! Form::text('pincode', '', ['class'=>"form-control", 'id'=>"pincode", 'placeholder'=>"Enter Your City PinCode", 'required']); !!} <br>
                            <span class="text-danger" id="title-error"></span>
                        </div>

                        <div class="col-sm-4 col-xs-12">
                            <label for="religion">Religion :</label>
                            {!! Form::text('religion', '', ['class'=>"form-control", 'id'=>"religion", 'placeholder'=>"Enter Your Religion", 'required']); !!} <br>
                            <span class="text-danger" id="title-error"></span>
                        </div>
                        
                        <div class="col-sm-4 col-xs-12">
                            <label for="mobilenumber">Mobile Number :</label>
                            {!! Form::text('mobilenumber', '', ['class'=>"form-control", 'id'=>"mobilenumber", 'placeholder'=>"Enter Your Mobile Number", 'required']); !!} <br>
                            <span class="text-danger" id="title-error"></span>
                        </div>

                        <div class="col-sm-4 col-xs-12">
                            <label for="status">Status :</label>
                            {!! Form::select('status', $status, '', ['class'=>'standardSelect form-control', 'title'=>'Select ', 'data-live-search'=>'true', 'id'=>'status' , 'data-style'=>'btn-sp', 'data-dropup-auto'=>'false', 'data-size'=>'5']) !!}<br>
                            <span class="text-danger" id="status-error"></span>
                        </div>
                        <br>
                    </div>
                </div>
                {!! Form::close(); !!}
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button"  data-bs-dismiss = "modal" onclick="closeModal()">Close</button>
                {!! Form::submit('Add Student', ['class'=>'btn btn-primary btn-rounded', 'id'=>'saveBtn']); !!}
            </div>
        </div>
    </div>
</div>