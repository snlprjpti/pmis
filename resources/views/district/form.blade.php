<div class="form-group">

    <label for="zone" class="col-sm-2 control-label">Zone</label>

    <div class="col-sm-5">

        {!!
            Form::select('zone_id',$zones, null,[
                'class'         =>  "form-control",
                'id'            =>  "zone",
                'required'
            ])
        !!}

        {!! $errors->first('zone_id', '<span class="label label-danger" >:message</span >') !!}

    </div>

</div>

<div class="form-group">

    <label for="district_name" class="col-sm-2 control-label">Name</label>

    <div class="col-sm-5">

        {!!
        Form::text('name', null,[
        'class'         =>  "form-control",
        'id'            =>  "district_name",
        'required'
        ])
        !!}

        {!! $errors->first('name', '<span class="label label-danger" >:message</span >') !!}

    </div>

</div>

<div class="form-group">

    <label for="headquarter" class="col-sm-2 control-label">Headquarter</label>

    <div class="col-sm-5">

        {!!
            Form::text('headquarter', null,[
            'class'         =>  "form-control",
            'id'            =>  "headquarter",
            'required'
            ])
        !!}

        {!! $errors->first('headquarter', '<span class="label label-danger" >:message</span >') !!}

    </div>

</div>


<div class="form-group  {{ ($errors->has('map_file'))?"has-error":'' }}">

    <label for="map" class="col-sm-2 control-label">District Map</label>

    <div class="col-sm-5">
        {!!
            Form::file('map_file',[
                'class'         =>  "form-control",
                'id'            =>  "book_file"
            ])
        !!}
        <span id="helpBlock" class="help-block">Allowed File types : jpg,jpeg and Max File Size :: {{ ini_get('upload_max_filesize') }}</span>
        {!! $errors->first('map_file', '<span class="label label-danger" >:message</span >') !!}

    </div>

</div>