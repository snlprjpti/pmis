    <div class="panel panel-default"  id="filter_incomes">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="ion-ios-color-filter"></i> Filter Documents
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <form>

                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="ion-calendar"></i>
                                </div>

                                {!! Form::select('financial_year',[''=>'Choose Financial Year']+$fiscals,Input::query('financial_year'),[
                                    'class'         => "form-control",
                                    'id'            => "branch",
                                    ])
                                !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="ion-clipboard"></i>
                                </div>

                                {!! Form::select('type',[''=>'Choose Document Type']+['Physical'=>'Physical', 'Financial'=>'Financial'],Input::query('type'),[
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