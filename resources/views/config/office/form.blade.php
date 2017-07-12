<div class="col-md-5">
    <div class="panel @if(isset($label))
                        panel-danger
                      @else
                        panel-default
                      @endif
                ">
        <div class="panel-heading">
            @if(isset($label))
                Edit
            @else
                Add
            @endif
            Office
        </div>

        @if(isset($label))
            {!! Form::model($office,[
                         'action'=>['Configuration\OfficesController@update',$office->id],
                         'class' =>'form-horizontal',
                         'method' =>'PUT'

                 ])
             !!}
        @else
            {!! Form::open([
                         'action'=>'Configuration\OfficesController@store',
                         'class' =>'form-horizontal',

                 ])
             !!}

        @endif


        <div class="panel-body">

            <div class="form-group">

                <label for="district" class="col-sm-3 control-label">District</label>

                <div class="col-sm-9">

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

                <label for="name" class="col-sm-3 control-label">Name</label>

                <div class="col-sm-9">

                    {!!
                        Form::text('office_name', null,[
                            'class'         =>  "form-control",
                            'placeholder'   =>  "Enter Office Name",
                            'id'            =>  "name",
                            'required'
                        ])
                    !!}

                    {!! $errors->first('name', '<span class="label label-danger" >:message</span >') !!}

                </div>

            </div>
            <div class="form-group">

                <label for="type" class="col-sm-3 control-label">Type</label>

                <div class="col-sm-9">

                    {!!
                        Form::select('office_type',[ 'Central'=>'Central','District'=>'District','Department'=>'Department'], null,[
                            'class'         =>  "form-control",
                            'placeholder'   =>  "Display Order ",
                            'id'            =>  "display_order",
                            'required'
                        ])
                    !!}

                    {!! $errors->first('display_order', '<span class="label label-danger" >:message</span >') !!}

                </div>

            </div>

        </div>

        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <button type="submit" class="btn-success btn">Save</button>
                    @if(isset($label))
                        <a href="{{ action('Configuration\OfficesController@index') }}" class="btn-default btn">Cancel</a>
                    @endif

                    <button type="reset" class="btn-inverse btn">Reset</button>
                </div>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>