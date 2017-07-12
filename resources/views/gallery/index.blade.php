@extends('layouts.master')

@section('content')
	
	    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="pull-right">
					<a  class="btn btn-primary"	 href="{{ action('GalleryController@create') }}">Add Images</a>
                </div>

                <i class="ion-android-image"></i> &nbsp;Gallery
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Images</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php  $i = 1 ;?>
                        @forelse($galleries as $gallery)    
                       <tr>
                          <td>{{$i}}</td> 
                          <td>{{$gallery->title}}</td> 

                          <td>
                              <a href="{{URL::to('gallery',$gallery->image)}}" target="_blank">
                              <img class="gallery-image" src="{{url('gallery', $gallery->image)}}"></a>
                          </td>
                          <td>
                              @if($gallery->status == 1)
                              <a href="{{url('backend/gallery/status',[$gallery->id])}}" class="btn btn-sm btn-success">On</a>
                              @elseif($gallery->status == 0)
                              <a href="{{url('backend/gallery/status',[$gallery->id])}}" class="btn btn-sm btn-danger">Off</a>
                              @endif
                          </td>
                          <td>
                            <form action="{{ action('GalleryController@destroy',[$gallery->id]) }}" method="POST" id="{{$gallery->id}}">                                  
                                <input type="hidden" name="_method" value="DELETE"/>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <button  data-toggle="tooltip" data-placement="top" title="Delete" type="submit" class="delete">
                                    <i class="btn-lg icon ion-trash-a"></i>
                                </button>

                            </form>
                          </td> 
                       </tr>
                       <?php  $i++ ;?>
                       @empty
                        <tr id="noRecord">
                            <td class="alert alert-warning" role="alert" colspan="8">No Images</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            <?php echo $galleries->render();?>

            </div>
        </div>
    </div>

@endsection