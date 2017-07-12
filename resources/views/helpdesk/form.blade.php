<div class="form-group">


    <div class="col-sm-8">

        {!!
            Form::textarea('reply_message', null,[
                'class'         =>  "form-control",
                'id'            =>  "reply_message",
                'required'
            ])
        !!}

        {!! $errors->first('reply_message', '<span class="label label-danger" >:message</span >') !!}

    </div>

</div>
