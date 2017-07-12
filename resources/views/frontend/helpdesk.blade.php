@extends('layouts.frontend')

@section('title')
    HelpDesk
@endsection
@section('content')

    <div class="row">
        @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Warning!</strong> {{ session('error').session()->forget('error') }}.
            </div>

        @elseif(session()->has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ session('success').session()->forget('success') }}
            </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-heading">
                Please fill the form
            </div>
            {!! Form::open(['class'=>'form-horizontal']) !!}

            <div class="panel-body">

                <div class="form-group">

                    <label for="name" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-5">

                        {!!
                            Form::text('name', null,[
                                'class'         =>  "form-control",
                                'id'            =>  "name",
                                'placeholder'   =>  "Enter your name",
                                'required'
                            ])
                        !!}

                        {!! $errors->first('name', '<span class="label label-danger" >:message</span >') !!}

                    </div>

                </div>

                <div class="form-group">

                    <label for="email" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-5">

                        {!!
                            Form::email('email', null,[
                                'class'         =>  "form-control",
                                'id'            =>  "email",
                                'placeholder'   =>  "Enter your email",
                                'required'
                            ])
                        !!}

                        {!! $errors->first('email', '<span class="label label-danger" >:message</span >') !!}

                    </div>

                </div>

                <div class="form-group">

                    <label for="phone" class="col-sm-2 control-label">Phone no.</label>

                    <div class="col-sm-5">

                        {!!
                            Form::text('phone', null,[
                                'class'         =>  "form-control",
                                'id'            =>  "phone",
                                'placeholder'   =>  "Enter your phone no",
                                'required'
                            ])
                        !!}

                        {!! $errors->first('phone', '<span class="label label-danger" >:message</span >') !!}

                    </div>

                </div>

                <div class="form-group">

                    <label for="subject" class="col-sm-2 control-label">Subject</label>

                    <div class="col-sm-5">

                        {!!
                            Form::text('subject', null,[
                                'class'         =>  "form-control",
                                'id'            =>  "subject",
                                'placeholder'   =>  "Enter subject",
                                'required'
                            ])
                        !!}

                        {!! $errors->first('subject', '<span class="label label-danger" >:message</span >') !!}

                    </div>

                </div>

                <div class="form-group">

                    <label for="message" class="col-sm-2 control-label">Message</label>

                    <div class="col-sm-8">

                        {!!
                            Form::textarea('message', null,[
                                'class'         =>  "form-control",
                                'id'            =>  "message",
                                'placeholder'   =>  "Enter message",
                                'required'
                            ])
                        !!}

                        {!! $errors->first('message', '<span class="label label-danger" >:message</span >') !!}

                    </div>

                </div>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <button type="submit" class="btn-success btn">Submit</button>
                        <button type="reset" class="btn-inverse btn">Reset</button>
                    </div>
                </div>

            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection