<nav class="navbar navbar-deep-purple">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="{{ Request::is('home') ? 'active': null}}"><a href="{{ url('/') }}"><i class="ion ion-ios-home"></i>&nbsp;Home</a></li>
                    <li class="dropdown  {{ Request::is('documents/*') ? 'active': null}}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="ion ion-document-text"></i> &nbsp;Documents <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="{{ Request::is('documents/book*') ? 'active': null}}" ><a href="{{ action('Document\BooksController@frontIndex') }}">Books And Reports</a></li>
                        </ul>
                    </li>
                    <li class="{{ Request::is('population-clock') ? 'active': null}}"><a href="{{ action('HomeController@populationClock') }}"><i class="ion ion-ios-people"></i>&nbsp;Population Clock</a></li>
                    <li class="{{ Request::is('helpdesk') ? 'active': null}}"><a href="{{ action('HelpDeskMessagesController@create') }}"><i class="ion ion-ios-people"></i>&nbsp;HelpDesk</a></li>
                    <li class="{{ Request::is('district*') ? 'active': null}}"><a href="{{ action('DistrictsController@frontIndex') }}"><i class="ion ion-ios-people"></i>&nbsp;District Demography</a></li>
                    {{--<li class="{{ Request::is('video*') ? 'active': null}}"><a href="{{ action('VideosController@index') }}"><i class="ion ion-ios-people"></i>&nbsp;Videos</a></li>--}}
                     
                      <?php
                        $pages = \Pmis\Eloquent\Page::where('status','=','1')->where('id','!=',2)->get();
                      ?>
                    @forelse($pages as $page)
                        <li  class="{{ Request::is('pages/') ? 'active': null}}"><a href="{{url('/pages/'.$page->id)}}">{{$page->title}}</a></li>
                    @empty
                    @endforelse

                    <li><a href="{{ action('Auth\AuthController@getLogin') }}"><i class="ion ion-log-in"></i>&nbsp;Login</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
