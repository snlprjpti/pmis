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

            {!! $errors->first('office_id', '<span class="label label-danger" >:message</span >') !!}

        </div>

    </div>

@else
    <input type="hidden" name="office_id" value="{{auth()->user()->office_id}}"/>
@endif

<div class="form-group {{ ($errors->has('title'))?"has-error":'' }}">

        <label for="book_title" class="col-sm-2 control-label">Title</label>

        <div class="col-sm-5">
            {!!
                Form::text('title',null,[
                        'class'         =>  "form-control",
                        'placeholder'   =>  "Enter Title",
                        'id'            =>  "book_title"
                ])
            !!}
            {!! $errors->first('title', '<span class="label label-danger" >:message</span >') !!}

        </div>

    </div>

    <div class="form-group">

        <label for="book_author" class="col-sm-2 control-label">Author</label>

        <div class="col-sm-5">
            {!!
                Form::text('author',null,[
                    'class'         =>  "form-control",
                    'placeholder'   =>  "Enter Author Name",
                    'id'            =>  "book_author"
                ])
            !!}
        </div>

    </div>

    <div class="form-group">

        <label for="organization_type" class="col-sm-2 control-label">Type</label>

        <div class="col-sm-5">

            {!!
                Form::select('type',[''=>'Select Document Type']+[ 'Book'=>'Book','Report'=>'Report','NewsPaper'=>'NewsPaper','Other'=>'Other'], null,[
                    'class'         =>  "form-control",
                    'id'            =>  "organization_type",
                    'required'
                ])
            !!}

            {!! $errors->first('type', '<span class="label label-danger" >:message</span >') !!}

        </div>

    </div>


    <div class="form-group">

        <label for="book_published_on" class="col-sm-2 control-label">Published On</label>

        <div class="col-sm-5">
            {!!
                Form::text('published_on',null,[
                    'class'         =>  "form-control datepicker",
                    'placeholder'   =>  "Enter document published date",
                    'id'            =>  "book_published_on"
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

    <div class="form-group">

        <label for="documents_status" class="col-sm-2 control-label">Is Active ?</label>

        <div class="col-sm-5">
            {!!
                Form::checkbox('documents_status',1,null,[
                        'class'         =>  "form-control",
                        'id'            =>  "book_status"
                ])
            !!}

        </div>

    </div>

