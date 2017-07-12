<div class="row">
    <form>
        <div class="col-md-3">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="ion-ios-briefcase"></i>
                    </div>

                    {!! Form::select('branch',[''=>'Choose branch']+$branchList,Input::query('branch'),[
                        'class'         => "form-control",
                        'id'            => "branch",
                        ])
                    !!}
                </div>
            </div>
        </div>

        <div class="col-md-1">
            <button type="submit" class="btn btn-primary btn-block">
                Filter
            </button>
        </div>
    </form>
</div>