@php $status = [1=>'Active', 0=>'In-Active']; @endphp

<div class="modal fade bd-example-modal-lg" id="ajaxModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myLargeModalLabel">Add New Category</h4>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="col-sm-12 col-xs-12">
                
                {!! Form::open(['id' => 'dataForm', 'name' => 'dataForm', 'class'=>'form-horizontal']) !!}
                
                        <div class="row justify-content-center">   

                            {{csrf_field()}}

                            {!! Form::hidden('cid', '', ['id'=>'category_id']); !!}
                            
                            <div class="col-sm-4 col-xs-12">
                                <label for="title">Category Name :</label>
                                {!! Form::text('cn', '', ['class'=>"form-control", 'id'=>"cn", 'placeholder'=>"Enter Category Name", 'required']); !!} <br>
                                <span class="text-danger" id="title-error"></span>
                            </div>

                            <!-- <div class="col-sm-4 col-xs-12">
                                <label for="status">Status :</label>
                                {!! Form::select('status', $status, '', ['class'=>'standardSelect form-control', 'title'=>'Select ', 'data-live-search'=>'true', 'id'=>'status' , 'data-style'=>'btn-sp', 'data-dropup-auto'=>'false', 'data-size'=>'5']) !!}<br>
                                <span class="text-danger" id="status-error"></span>
                            </div> -->

                            <br>
                        </div>
                    </div>
                    {!! Form::close(); !!}
        </div>
        <style>
          .removebtn{
            display:none;
          }
        </style>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button"  data-bs-dismiss = "modal" >Close</button>
          {!! Form::submit('Add Category', ['class'=>'btn btn-primary btn-rounded', 'id'=>'saveBtn','onclick'=>'subdata();','data-bs-dismiss'=>'modal']); !!}
          {!! Form::submit('Edit Category', ['class'=>'btn btn-primary btn-rounded', 'id'=>'editBtn','onclick'=>'editdata();','data-bs-dismiss'=>'modal']); !!}
        </div>
      </div>
    </div>
  </div>