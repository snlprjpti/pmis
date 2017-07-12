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

    <div class="form-group {{ ($errors->has('organization_name'))?"has-error":'' }}">

        <label for="organization_name" class="col-sm-2 control-label">Organization Name</label>

        <div class="col-sm-5">
            {!!
                Form::text('organization_name',null,[
                    'class'         =>  "form-control",
                    'placeholder'   =>  "Enter Organization Name",
                    'id'            =>  "organization_name"
                ])
            !!}

            {!! $errors->first('organization_name', '<span class="label label-danger" >:message</span >') !!}

        </div>

    </div>

    <div class="form-group">

        <label for="organization_type" class="col-sm-2 control-label">Organization Type</label>

        <div class="col-sm-5">

            {!!
                Form::select('organization_type',[ 'Government'=>'Government','INGO/NGO'=>'INGO/NGO'], null,[
                    'class'         =>  "form-control",
                    'placeholder'   =>  "Enter Organization Name",
                    'id'            =>  "organization_type",
                    'required'
                ])
            !!}

            {!! $errors->first('organization_type', '<span class="label label-danger" >:message</span >') !!}

        </div>

    </div>

    <div class="form-group">

        <label for="type" class="col-sm-2 control-label"> Type</label>

        <div class="col-sm-5">

            {!!
                Form::select('type',[ 'Book'=>'Book','Report'=>'Report','Research'=>'Research'], null,[
                    'class'         =>  "form-control",
                    'placeholder'   =>  "Enter Organization Name",
                    'id'            =>  "type",
                    'required'
                ])
            !!}

            {!! $errors->first('type', '<span class="label label-danger" >:message</span >') !!}

        </div>

    </div>

    <div class="form-group">

        <label for="book_publisher" class="col-sm-2 control-label">Publisher</label>

        <div class="col-sm-5">
            {!!
                Form::text('publisher',null,[
                    'class'         =>  "form-control",
                    'placeholder'   =>  "Enter Publisher Name",
                    'id'            =>  "book_publisher"
                ])
            !!}
        </div>

    </div>
    <div class="form-group">

        <label for="published_year" class="col-sm-2 control-label">Published Year</label>

        <div class="col-sm-5">
            {!!
                Form::text('published_year',null,[
                    'class'         =>  "form-control",
                    'placeholder'   =>  "Enter Published Year",
                    'id'            =>  "published_year"
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

        <label for="book_status" class="col-sm-2 control-label">Is Active ?</label>

        <div class="col-sm-5">
            {!!
                Form::checkbox('book_status',1,null,[
                        'class'         =>  "form-control",
                        'id'            =>  "book_status"
                ])
            !!}

        </div>

    </div>
    <div class="form-group">

        <label for="is_viewable_to_central" class="col-sm-2 control-label">Display to Central ?</label>

        <div class="col-sm-5">
            {!!
                Form::checkbox('is_viewable_to_central',1,null,[
                        'class'         =>  "form-control",
                        'id'            =>  "is_viewable_to_central"
                ])
            !!}

        </div>

    </div>
    <div class="form-group">

        <label for="is_viewable_to_district" class="col-sm-2 control-label">Display to District ?</label>

        <div class="col-sm-5">
            {!!
                Form::checkbox('is_viewable_to_district',1,null,[
                        'class'         =>  "form-control",
                        'id'            =>  "is_viewable_to_district"
                ])
            !!}

        </div>

    </div>

    <div class="form-group">

        <label for="is_viewable_to_department" class="col-sm-2 control-label">Display to Department ?</label>

        <div class="col-sm-5">
            {!!
                Form::checkbox('is_viewable_to_department',1,null,[
                        'class'         =>  "form-control",
                        'id'            =>  "is_viewable_to_department"
                ])
            !!}

        </div>

    </div>

