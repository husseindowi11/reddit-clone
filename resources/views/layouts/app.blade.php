<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{asset('/assets/js/config.js')}}"></script>
    <script src="{{asset('/vendors/tinymce/tinymce.min.js')}}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
          integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
          crossorigin="anonymous"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    @livewireStyles
    <link href="{{asset('/vendors/glightbox/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('/vendors/plyr/plyr.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/css/theme-rtl.min.css')}}" rel="stylesheet" id="style-rtl">
    <link href="{{asset('/assets/css/theme.min.css')}}" rel="stylesheet" id="style-default">
    <link href="{{asset('/assets/css/user-rtl.min.css')}}" rel="stylesheet" id="user-style-rtl">
    <link href="{{asset('/assets/css/user.min.css" rel="stylesheet')}}" id="user-style-default">

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>


                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('communities.index')}}">
                                    {{ __('My Communities')}}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @yield('content')
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-light d-flex flex-between-center py-3">
                            <h5>
                                Newest Posts 😎
                            </h5>
                        </div>
                        <div class="card-body">
                            @foreach($newestPosts as $post)
                                <div class="row g-0 align-items-center py-2 position-relative border-bottom border-200">
                                    <h6>
                                        <a href="{{ route('communities.posts.show',[$post->community, $post]) }}">{{ $post->title }}</a>
                                    </h6>
                                    <small>{{ $post->created_at->diffForHumans() }}</small>
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer bg-light p-0">
                            <a class="btn btn-sm btn-link d-block w-100 py-2" href="#!">
                                Show more<span class="fas fa-chevron-right ms-1 fs--2"></span>
                            </a>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-header bg-light d-flex flex-between-center py-3">
                            <h5>Newest Communities 🚀</h5>
                        </div>

                        <div class="card-body">
                            @foreach($newestCommunities as $community)
                                <div class="row g-0 align-items-center py-2 position-relative border-bottom border-200">
                                    <h6>
                                        <a href="{{ route('communities.show',$community) }}">{{ $community->name }}</a>
                                        ({{ $community->posts_count }} posts)
                                    </h6>
                                    <small>{{ $community->created_at->diffForHumans() }}</small>
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer bg-light p-0">
                            <a class="btn btn-sm btn-link d-block w-100 py-2" href="#!">
                                Show more<span class="fas fa-chevron-right ms-1 fs--2"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<!-- ===============================================-->
<!--    JavaScripts-->
<!-- ===============================================-->
<script src="{{asset('/vendors/popper/popper.min.js')}}"></script>
<script src="{{asset('/vendors/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('/vendors/anchorjs/anchor.min.js')}}"></script>
<script src="{{asset('/vendors/is/is.min.js')}}"></script>
<script src="{{asset('/vendors/glightbox/glightbox.min.js')}}"></script>
<script src="{{asset('/vendors/plyr/plyr.polyfilled.min.js')}}"></script>
<script src="{{asset('/vendors/fontawesome/all.min.js')}}"></script>
<script src="{{asset('/vendors/lodash/lodash.min.js')}}"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
<script src="{{asset('/vendors/list.js/list.min.js')}}"></script>
<script src="{{asset('/assets/js/theme.js')}}"></script>

<link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:100,200,300,400,500,600,700,800,900&amp;display=swap"
    rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>
@livewireScripts
</body>
</html>
