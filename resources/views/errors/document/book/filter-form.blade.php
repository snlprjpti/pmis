    <div class="panel panel-default"  id="filter_incomes">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="ion-ios-color-filter"></i> Filter Documents
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <form>

                    <div class="col-md-5">
                        <div class="form-group">
                                {!! Form::text('title',Input::query('title'),[
                                    'class' =>'form-control',
                                    'id'    => "title",
                                    ])
                                !!}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="ion-ios-home"></i>
                                </div>

                                {!! Form::select('organization_type',[''=>'Choose Organization']+['Government'=>'Government','INGO/NGO'=>'INGO/NGO'],Input::query('organization_type'),[
                                    'class'         => "form-control",
                                    'id'            => "branch",
                                    ])
                                !!}
                            </div>
                        </div>
                    </div>
                    @if(is_super_admin())

                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="ion-ios-briefcase"></i>
                                </div>

                                {!! Form::select('office',[''=>'Choose Office'] + $offices,Input::query('office'),[
                                    'class'         => "form-control",
                                    'id'            => "office",
                                    ])
                                !!}
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary btn-block">
                            Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>