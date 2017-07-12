@extends('layouts.master')

@section('content')
    @if(!empty($types))
    <div class="row">
	    <div class="row">
	        <div class="col-md-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Vital Statistic Types
                    </div>

                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($types as $type)
                                    <tr>
                                        <td>{{ $type->name }}</td>
                                        <td>
                                            <form
                                            	action="{{ action('Configuration\VitalStatisticTypeController@destroy',[$type->id]) }}"
                                            	method="POST"
                                            	id="{{  $type->id}}"
                                        	>
                                                <input type="hidden" name="_method" value="DELETE"/>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                                <a  data-toggle="tooltip"
                                                	data-placement="top"
                                                	title="Edit"
                                                	class="edit-button"
                                                	href="{{ action('Configuration\VitalStatisticTypeController@edit',[$type->id]) }}"
                                            	>
                                                    <i class="icon ion-edit"></i>
                                                </a>
                                                &nbsp;
                                                <button data-toggle="tooltip"
                                                		data-placement="top"
                                                		title="Delete"
                                                		type="submit"
                                                		class="delete"
                                                >
                                                    <i class="icon ion-trash-a"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr id="noRecord">
                                        <td class="alert alert-warning" role="alert" colspan="5">No record to show.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
	        </div>
	        @include('config.vital-statistic-type.form')
	    </div>
    </div>
    @endif
@stop