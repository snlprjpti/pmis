@extends('layouts.master')

@section('content')
    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="pull-right">
                        <!-- <a class="btn btn-primary" href="{{ action('Other\ImportantLinksController@create') }}"> Add New</a> -->
                </div>

                Important Links
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Organization</th>
                            <th>Address</th>
                            <th style="width: 150px;">Country</th>
                            <th style="width: 50px;">Order</th>
                            <th style="width: 50px;">Email</th>
                            <th style="width: 50px;">URL</th>
                            <th style="width: 50px;">status</th>
                            <th style="width: 80px;">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($links as $link)
                            <tr>
                                <td>{{ $link->organization_name }}</td>
                                <td>{{ $link->address }}</td>
                                <td>{{ super_echo($link->country,['name'])}}</td>
                                <td>{{ $link->display_order }}</td>
                                <td><a href="mailto:{{ $link->email }}"><i class="fa fa-envelope-o"></i></a></td>
                                <td><a href="{{ $link->url }}"><i class="fa fa-link"></i></a></td>
                                <td><i class="ion {{ ($link->link_status >0)?'ion-checkmark-round':'ion-close-round' }}"></i></td>
                                <td>
                                    <form action="{{ action('Other\ImportantLinksController@destroy',[$link->id]) }}" method="POST"  id="{{ $link->id }}">

                                        <input type="hidden" name="_method" value="DELETE"/>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                        <a  data-toggle="tooltip" data-placement="top" title="Edit" class="edit-button" href="{{ action('Other\ImportantLinksController@edit',[$link->id]) }}">
                                            <i class="icon ion-edit"></i>
                                        </a>
                                        &nbsp;
                                        <button  data-toggle="tooltip" data-placement="top" title="Delete" type="submit" class="delete">
                                            <i class="icon ion-trash-a"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr id="noRecord">
                                <td class="alert alert-warning" role="alert" colspan="8">No record to show.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
                {{  $links->render() }}
            </div>
        </div>
    </div>

@stop