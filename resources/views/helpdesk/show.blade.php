@extends('layouts.master')

@section('content')

    @if(!empty($message))
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Message Detail
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <ul class="list-group helpdesk">
                            <li class="list-group-item">
                                <strong>Subject :</strong>
                            </li>
                            <li class="list-group-item">
                                <strong>Name :</strong>
                            </li>
                            <li class="list-group-item">
                                <strong>Email :</strong>
                            </li>
                            <li class="list-group-item">
                                <strong> Phone no :</strong>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-10">
                        <ul class="list-group helpdesk">
                            <li class="list-group-item">
                                {{ $message->subject }}
                            </li>
                            <li class="list-group-item">
                                {{ $message->name }}
                            </li>
                            <li class="list-group-item">
                                {{ $message->email }}
                            </li>
                            <li class="list-group-item">
                                {{ $message->phone }}
                            </li>
                        </ul>

                    </div>

                </div>

                <div class="panel-body">

                    <h4>Message</h4>
                    {!! $message->message !!}

                    <hr/>

                    @if(empty($message->reply_message))
                    <h4>Reply</h4>

                    {!! Form::open(['method'=>'PUT','class'=>'form-horizontal']) !!}

                    @include('helpdesk.form')


                    <button type="submit" class="btn-success btn"><i class="ion ion-reply-all"></i>&nbsp;Reply</button>

                    {!! Form::close() !!}

                    @else
                        <blockquote>
                        <h4>
                            Replied Message
                            <small>Replied By :  {{ super_echo($message->replier,['name']) }}</small>
                            <small>Replied on :  {{$message->replied_on->toDayDateTimeString() }}</small>
                        </h4>
                        {!! $message->reply_message !!}
                        <hr/>
                        </blockquote>
                    @endif
                </div>
        </div>
    </div>
    @endif
@endsection