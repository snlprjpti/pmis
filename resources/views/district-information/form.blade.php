<div class="form-group">

    <label for="zone" class="col-sm-2 control-label">Parent </label>

    <div class="col-sm-5">

        {!!
            Form::select('parent_id',[''=>'Choose parent title']+$lists, null,[
                'class'         =>  "form-control",
                'id'            =>  "zone",
            ])
        !!}

    </div>

</div>

<div class="form-group">

    <label for="title" class="col-sm-2 control-label">Title</label>

    <div class="col-sm-5">

        {!!
            Form::text('title', null,[
                'class'         =>  "form-control",
                'id'            =>  "title",
                'required'
            ])
        !!}

        {!! $errors->first('title', '<span class="label label-danger" >:message</span >') !!}

    </div>

</div>

<div class="form-group">

    <label for="content" class="col-sm-2 control-label">Content</label>

    <div class="col-sm-9">

        {!!
            Form::textarea('content', null,[
                'class'         =>  "form-control summernote",
                'id'            =>  "content",
            ])
        !!}

        {!! $errors->first('content', '<span class="label label-danger" >:message</span >') !!}

    </div>

</div>


<div class="form-group">

    <label for="status" class="col-sm-2 control-label">Publish ?</label>

    <div class="col-sm-5">
        {!!
            Form::checkbox('status',1,null,[
                    'class'         =>  "form-control",
                    'id'            =>  "status"
            ])
        !!}

    </div>

</div>

@section('js')
    <script type="text/javascript">

        var summernoteUploadImageUrl = '{{ action('DistrictsInformationController@uploadImage') }}';
        var token = '{{ csrf_token()  }}';

        $('#summernote').on('summernote.image.upload', function(customEvent, files) {
            var data = new FormData();
            data.append("image", file);
            data.append("_token", token);
            $.ajax({
                data: data,
                type: "POST",
                url: summernoteUploadImageUrl,
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    editor.insertImage(welEditable, url);
                }
            });

        });

    </script>
@endsection




