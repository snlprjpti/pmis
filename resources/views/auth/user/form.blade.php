<div class="form-group {{ ($errors->has('name'))?"has-error":'' }}">

    <label for="name" class="col-sm-2 control-label">Full Name</label>

    <div class="col-sm-5">
        {!!
            Form::text('name',null,[
                    'class'         =>  "form-control",
                    'placeholder'   =>  "Enter Employee Name",
                    'id'            =>  "name",
                    'required'
            ])
        !!}
        {!! $errors->first('name', '<span class="label label-danger" >:message</span >') !!}

    </div>

</div>

<div class="form-group">

    <label for="designation" class="col-sm-2 control-label">Designation</label>

    <div class="col-sm-5">

        {!!
            Form::select('designation_id',[''=>'Choose Designation']+$designations, null,[
                'class'         =>  "form-control",
                'id'            =>  "designation",
                'required'
            ])
        !!}

        {!! $errors->first('designation_id', '<span class="label label-danger" >:message</span >') !!}

    </div>

</div>



<div class="form-group {{ ($errors->has('email'))?"has-error":'' }}">

    <label for="email" class="col-sm-2 control-label">Email</label>

    <div class="col-sm-5">
        {!!
            Form::text('email',null,[
                    'class'         =>  "form-control",
                    'placeholder'   =>  "Enter Employee Email",
                    'id'            =>  "email",
                    'required'

            ])
        !!}
        {!! $errors->first('email', '<span class="label label-danger" >:message</span >') !!}

    </div>

</div>

<div class="form-group">

    <label for="district" class="col-sm-2 control-label">District</label>

    <div class="col-sm-5">

        {!!
            Form::select('district_id',[''=>'Choose District']+$districts, null,[
                'class'         =>  "form-control",
                'id'            =>  "district",
                'required'
            ])
        !!}

        {!! $errors->first('district_id', '<span class="label label-danger" >:message</span >') !!}

    </div>

</div>

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

        {!! $errors->first('district_id', '<span class="label label-danger" >:message</span >') !!}

    </div>

</div>


<div class="form-group">

    <label for="type" class="col-sm-2 control-label">User Type</label>

    <div class="col-sm-5">

        {!!
            Form::select('type',[''=>'Choose Type']+['Super Admin'=>'Super Admin','Admin'=>'Admin'], null,[
                'class'         =>  "form-control",
                'id'            =>  "type",
                'required'
            ])
        !!}

        {!! $errors->first('type', '<span class="label label-danger" >:message</span >') !!}

    </div>

</div>

<div class="form-group">

    <label for="type" class="col-sm-2 control-label">Password</label>

    <div class="col-sm-5">

        {!!
            Form::text('password',(isset($password))?$password:null,[
                'class'         =>  "form-control",
                'id'            =>  "type",
            ])
        !!}

        {!! $errors->first('password', '<span class="label label-danger" >:message</span >') !!}

    </div>

</div>

<div class="form-group">

    <label for="book_status" class="col-sm-2 control-label">Enable Login ?</label>

    <div class="col-sm-5">
        {!!
            Form::checkbox('status',1,null,[
                    'class'         =>  "form-control",
                    'id'            =>  "book_status"
            ])
        !!}

    </div>

</div>

