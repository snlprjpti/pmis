<div class="col-md-5">
    <div class="panel  @if(isset($label))
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
            Designation
        </div>

        @if(isset($label))
            {!! Form::model($designation,[
                         'action'=>['Configuration\DesignationsController@update',$designation->id],
                         'class' =>'form-horizontal',
                         'method' =>'PUT'

                 ])
             !!}
        @else
            {!! Form::open([
                         'action'=>'Configuration\DesignationsController@store',
                         'class' =>'form-horizontal',

                 ])
             !!}

        @endif


        <div class="panel-body">

            <div class="form-group">

                <label for="name" class="col-sm-3 control-label">Name</label>

                <div class="col-sm-9">

                    {!!
                        Form::text('name', null,[
                            'class'         =>  "form-control",
                            'placeholder'   =>  "Enter Designation Name",
                            'id'            =>  "name",
                            'required'
                        ])
                    !!}

                    {!! $errors->first('name', '<span class="label label-danger" >:message</span >') !!}

                </div>

            </div>
            <div class="form-group">

                <label for="display_order" class="col-sm-3 control-label">Display Order</label>

                <div class="col-sm-9">

                    {!!
                        Form::text('display_order', null,[
                            'class'         =>  "form-control",
                            'placeholder'   =>  "Display Order ",
                            'id'            =>  "display_order",
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
                        <a href="{{ action('Configuration\DesignationsController@index') }}" class="btn-default btn">Cancel</a>
                    @endif

                    <button type="reset" class="btn-inverse btn">Reset</button>
                </div>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>