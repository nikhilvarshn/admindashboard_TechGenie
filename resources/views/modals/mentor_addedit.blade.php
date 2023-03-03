@php $status = [1=>'Active', 0=>'In-Active']; @endphp

<div class="modal fade bd-example-modal-lg" id="ajaxModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <style>
          .removeElement{
            display:none;
          }
        </style>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add New Mentor</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-sm-12 col-xs-12">
                    {!! Form::open(['id' => 'dataForm', 'name' => 'dataForm', 'class'=>'form-horizontal']) !!}
                        <div class="row justify-content-center">
                            {{csrf_field()}}

                            {!! Form::hidden('mentor_id', '', ['id'=>'mentor_id']); !!}

                            <div class="col-sm-4 col-xs-12" id="mnamed">
                                <label for="title">Mentor Name  :</label>
                                {!! Form::text('name', '', ['class'=>"form-control", 'id'=>"mname", 'placeholder'=>"Enter Mentor Name", 'required']); !!} <br>
                                <span class="text-danger" id="title-error"></span>
                            </div>
                            <div class="col-sm-4 col-xs-12" id="memaild">
                                <label for="title">Mentor Email  :</label>
                                {!! Form::text('email', '', ['class'=>"form-control", 'id'=>"memail", 'placeholder'=>"Enter Email", 'required']); !!} <br>
                                <span class="text-danger" id="title-error"></span>
                            </div>
                            <div class="col-sm-4 col-xs-12" id="mpasswordd">
                                <label for="title">Mentor Password  :</label>
                                {!! Form::text('password', '', ['class'=>"form-control", 'id'=>"mpassword", 'placeholder'=>"Enter Mentor Name", 'required']); !!} <br>
                                <span class="text-danger" id="title-error"></span>
                            </div>
                            <div class="col-sm-4 col-xs-12" id="mcpasswordd">
                                <label for="title">Confirm Password  :</label>
                                {!! Form::text('password_confirmation', '', ['class'=>"form-control", 'id'=>"mcpassword", 'placeholder'=>"Enter Mentor Name", 'required']); !!} <br>
                                <span class="text-danger" id="title-error"></span>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <label for="title">Choose Category  :</label>
                                <select name="" id="cat" class="form-control"></select>
                                <br>
                                <span class="text-danger" id="title-error"></span>
                            </div>


                            <!-- <div class="col-sm-4 col-xs-12">
                                <label for="status">Status :</label>
                                {!! Form::select('status', $status, '', ['class'=>'standardSelect form-control', 'title'=>'Select ', 'placeholder'=>"Select the status", 'data-live-search'=>'true', 'id'=>'status' , 'data-style'=>'btn-sp', 'data-dropup-auto'=>'false', 'data-size'=>'5']) !!}<br>
                                <span class="text-danger" id="status-error"></span>
                            </div> -->

                            <br>
                        </div>
                </div>
                {!! Form::close(); !!}
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button"  data-bs-dismiss = "modal" >Close</button>
                {!! Form::submit('Submit', ['class'=>'btn btn-primary btn-rounded', 'id'=>'saveBtn','onclick'=>'sub();']); !!}
                {!! Form::submit('Edit Category', ['class'=>'btn btn-primary btn-rounded', 'id'=>'editBtn','onclick'=>'editd();','data-bs-dismiss'=>'modal']); !!}

            </div>
        </div>
    </div>
</div>