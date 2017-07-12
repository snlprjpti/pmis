<div class="form-group">

    <label for="census_year" class="col-sm-2 control-label">Census Year</label>

    <div class="col-sm-5">

        {!!
            Form::text('census_year', null,[
                'class'         =>  "form-control datepicker",
                'id'            =>  "census_year",
                'required'
            ])
        !!}

        {!! $errors->first('census_year', '<span class="label label-danger" >:message</span >') !!}

    </div>

</div>

<div class="form-group">

    <label for="total_population" class="col-sm-2 control-label">Total Population</label>

    <div class="col-sm-5">

        {!!
            Form::text('total_population', null,[
                'class'         =>  "form-control",
                'id'            =>  "total_population",
                'required'
            ])
        !!}

        {!! $errors->first('total_population', '<span class="label label-danger" >:message</span >') !!}

    </div>

</div>

<div class="form-group">

    <label for="birth_per_sec" class="col-sm-2 control-label">Birth Per Sec</label>

    <div class="col-sm-5">

        {!!
            Form::text('birth_per_sec', null,[
                'class'         =>  "form-control",
                'id'            =>  "birth_per_sec",
                'required'
            ])
        !!}

        {!! $errors->first('birth_per_sec', '<span class="label label-danger" >:message</span >') !!}

    </div>

</div>

<div class="form-group">

    <label for="death_per_sec" class="col-sm-2 control-label">Death Per Sec</label>

    <div class="col-sm-5">

        {!!
            Form::text('death_per_sec', null,[
                'class'         =>  "form-control",
                'id'            =>  "death_per_sec",
                'required'
            ])
        !!}

        {!! $errors->first('death_per_sec', '<span class="label label-danger" >:message</span >') !!}

    </div>

</div>

<div class="form-group">

    <label for="migration_per_sec" class="col-sm-2 control-label">Migration Per Sec</label>

    <div class="col-sm-5">

        {!!
            Form::text('migration_per_sec', null,[
                'class'         =>  "form-control",
                'id'            =>  "migration_per_sec",
                'required'
            ])
        !!}

        {!! $errors->first('migration_per_sec', '<span class="label label-danger" >:message</span >') !!}

    </div>

</div>

<div class="form-group">

    <label for="sex_ratio" class="col-sm-2 control-label">Sex Ratio</label>

    <div class="col-sm-5">

        {!!
            Form::text('sex_ratio', null,[
                'class'         =>  "form-control",
                'id'            =>  "sex_ratio",
                'required'
            ])
        !!}

        {!! $errors->first('sex_ratio', '<span class="label label-danger" >:message</span >') !!}

    </div>

</div>


<div class="form-group">

    <label for="status" class="col-sm-2 control-label">Is this Current Census ?</label>

    <div class="col-sm-5">
        {!!
            Form::checkbox('status',1,null,[
                    'class'         =>  "form-control",
                    'id'            =>  "status"
            ])
        !!}

    </div>

</div>

