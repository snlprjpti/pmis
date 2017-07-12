    <div class="form-group">

        <label for="fiscals" class="col-sm-2 control-label">Financial Year</label>

        <div class="col-sm-5">

            {!!
                Form::select('fiscal_id',[''=>'Choose Financial Year']+$fiscals, null,[
                    'class'         =>  "form-control",
                    'id'            =>  "fiscals",
                    'required'
                ])
            !!}

            {!! $errors->first('district_id', '<span class="label label-danger" >:message</span >') !!}

        </div>

    </div>


    @if(is_super_admin())
    <div class="form-group">

        <label for="office" class="col-sm-2 control-label">Office</label>

        <div class="col-sm-5">

            {!!
                Form::select('office_id',[''=>'Choose Office']+$offices, null,[
                    'class'         =>  "form-control",
                    'id'            =>  "office",
                    'required'
                ])
            !!}

            {!! $errors->first('office', '<span class="label label-danger" >:message</span >') !!}

        </div>

    </div>

    @else
        <input type="hidden" name="office_id" value="{{auth()->user()->office_id}}"/>
    @endif

    <div class="form-group">

        <label for="type" class="col-sm-2 control-label"> Type</label>

        <div class="col-sm-5">

            {!!
                Form::select('type',[ 'Physical'=>'Physical','Financial'=>'Financial'], null,[
                    'class'         =>  "form-control",
                    'id'            =>  "type",
                    'required'
                ])
            !!}

            {!! $errors->first('organization_type', '<span class="label label-danger" >:message</span >') !!}

        </div>

    </div>

    <div class="form-group">

        <label for="submission_date" class="col-sm-2 control-label">Submission Date</label>

        <div class="col-sm-5">
            {!!
                Form::text('submission_date',null,[
                    'class'         =>  "form-control datepicker",
                    'placeholder'   =>  "Select Submission Date",
                    'id'            =>  "submission_date"
                ])
            !!}
        </div>

    </div>


    <div class="form-group  {{ ($errors->has('book_file'))?"has-error":'' }}">

        <label for="book_file" class="col-sm-2 control-label">Upload Document</label>

        <div class="col-sm-5">
            {!!
                Form::file('book_file',[
                    'class'         =>  "form-control",
                    'id'            =>  "book_file"
                ])
            !!}
            <span id="helpBlock" class="help-block">Allowed File types : jpg,jpeg,pdf,doc,docx and Max File Size :: {{ ini_get('upload_max_filesize') }}</span>
            {!! $errors->first('book_file', '<span class="label label-danger" >:message</span >') !!}

        </div>

    </div>

