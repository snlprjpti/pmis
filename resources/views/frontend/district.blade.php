@extends('layouts.frontend2')

@section('sidebar')
    <div class="panel panel-default" id="affix">
        <div class="panel-body">
            @if(!empty($district))
            <h4>{{ $district->name }}</h4>
            <img class="img img-responsive" src="{{ asset($district->map_path) }}" alt="{{ $district->name }}"/>
                <hr/>
            <ul id="tree" class="tree">
                @foreach($district->informations as $info)
                    <li><a href="#{{ $info->title }}">{{ $info->title }}</a>
                        @if($info->subpages->count())
                            <ul>
                                @foreach($info->subpages as $subpage)
                                    <li><a href="#{{ $subpage->title }}">{{ $subpage->title }}</a>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
            @endif

        </div>
    </div>
@endsection
@section('content')
<div class="row">
<div class="panel panel-default">

    <div class="panel-body">

        {!! Form::select('district',[''=>'Choose District'] + $districtList,(isset($district))?$district->id:null,['class'=>'form-control','onChange'=>"window.location.href=goto(this.value)"]) !!}
        @if(!empty($district))
        <hr/>
        <div class="district-information">
            @foreach($district->informations as $information)
                <article>
                    <h4 id="{{ $information->title }}">
                        <a href="#{{ $information->title }}">{{ $information->title }}</a>
                    </h4>
                    <hr/>
                {!! $information->content !!}
                </article>
                @if($information->subpages->count())
                    @foreach($information->subpages as $subpageinfo)
                        <article style="margin-left: 35px">
                            <h4 id="{{ $subpageinfo->title }}">
                                <a href="#{{ $subpageinfo->title }}">{{ $subpageinfo->title }}</a>
                            </h4>
                            <hr/>
                            {!! $subpageinfo->content !!}
                        </article>
                    @endforeach
                @endif
            <br/>
            @endforeach
        </div>
        @endif
    </div>
</div>
</div>
@endsection
@section('js')
    <script type="text/javascript">
        function goto(param)
        {
            var base = "{{ action('DistrictsController@frontIndex') }}";
            return base+'/'+param;
        }
    </script>
@endsection