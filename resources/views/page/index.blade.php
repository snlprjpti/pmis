@extends('layouts.master')

@section('content')
	               

      <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="pull-right">
          <a  class="btn btn-primary"  href="{{ action('PageController@create') }}">Add Pages</a>
                </div>

                <i class="ion-ios-paper"></i> &nbsp;Pages
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                       <?php  $i = 1 ;?>
                        @forelse($pages as $page)    
                       <tr>
                          <td>{{$i}}</td> 
                          <td>{{$page->title}}</td> 
                          <td>{!!$page->description!!}</td>
                          <td>{{$page->order}}</td>
                          <td>{{$page->status}}</td>

                          <td><a href="{{action('PageController@edit',[$page->id])}}" title="Edit" >
                                <i class="icon ion-edit"></i>
                              </a>
                          </td>
                            <td>
                            @if($page->id != 2)
                              <form action="{{ action('PageController@destroy',[$page->id]) }}" method="POST" id="{{$page->id}}" >                                  
                                  <input type="hidden" name="_method" value="DELETE"/>
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                  
                                  <button  data-toggle="tooltip" data-placement="top" title="Delete" type="submit" class="delete">
                                    <i class="icon ion-trash-a"></i>
                                  </button>

                              </form>
                            @endif  
                          </td> 
                       </tr>
                       <?php  $i++ ;?>
                       @empty
                        <tr id="noRecord">
                            <td class="alert alert-warning" role="alert" colspan="8">No Pages</td>
                        </tr>
                        @endforelse
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection