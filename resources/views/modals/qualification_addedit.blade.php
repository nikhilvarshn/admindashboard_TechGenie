@php $status = [1=>'Active', 0=>'In-Active']; @endphp

<div class="modal fade bd-example-modal-lg" id="ajaxModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myLargeModalLabel">Add New Qualification</h4>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="col-sm-12 col-xs-12">
                
                {!! Form::open(['id' => 'dataForm', 'name' => 'dataForm', 'class'=>'form-horizontal']) !!}
                
                        <div class="row justify-content-center">   

                            {{csrf_field()}}

                            {!! Form::hidden('qualification_id', '', ['id'=>'qualification_id']); !!}
                            
                            <div class="col-sm-4 col-xs-12">
                                <label for="title">Qualification  :</label>
                                {!! Form::text('title', '', ['class'=>"form-control", 'id'=>"title", 'placeholder'=>"Enter Qualification Name", 'required']); !!} <br>
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
          <button class="btn btn-secondary" type="button"  data-bs-dismiss = "modal" onclick="closeModal()">Close</button>
          {!! Form::submit('Add Qualification', ['class'=>'btn btn-primary btn-rounded', 'id'=>'saveBtn']); !!}
        </div>
      </div>
    </div>
  </div>