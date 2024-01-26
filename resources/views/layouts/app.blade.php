<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Sourcing Plan')</title>
    <link rel="icon" type="image/x-icon" href="{{URL::asset('/images/sourcing.png')}}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{ asset('css/jquery.gritter.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url("{{ asset('/images/3.gif')}}") 50% 50% no-repeat rgb(249,249,249) ;
            opacity: .8;
            background-size:200px 120px;
        }
    </style>
    
</head>
<body>
    <div id = "loader" style="display:none;" class="loader">
    </div>
    <div id="app">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            {{-- <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                            </span> --}}
                            @auth
                                <a href="#">
                                    <span class="clear"> <span class="block m-t-xs">{{auth()->user()->name}}<strong class="font-bold"></strong>
                                    </span><span class="text-muted text-xs block"></span>{{auth()->user()->position}}</span>
                                </a>
                            @endauth
                        </div>
                        <div class="logo-element">
                            SP
                        </div>
                    </li>
                    <li>
                        <a href="{{ url('/') }}"><i class="fa fa-th-large"></i><span class="nav-label">Dashboards</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-search"></i> <span class="nav-label">Sourcing Plan </span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li>
                                <a href="{{ url('/cott') }}">Cottonii</a>
                            </li>
                            <li>
                                <a href="{{ url('/spi') }}">Spinosum</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ url('/supplier') }}"><i class="fa fa-truck"></i><span class="nav-label">Suppliers</span></a>
                    </li>
                    <li>
                        <a href="{{ url('/upload') }}"><i class="fa fa-upload"></i><span class="nav-label">Signed Documents</span></a>
                    </li>
                    @if (@auth()->user()->position == 'Administrator')
                    <li>
                        <a href="{{ url('/user') }}"><i class="fa fa-users" aria-hidden="true"></i><span class="nav-label">Users</span></a>
                    </li>
                    @endif
                </ul>
            </div>
        </nav>
    
        <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Welcome to Sourcing Plan</span>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="logout(); show();">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </nav>
        </div>
        <div class="wrapper">
            @yield('content')
        </div>
    </div>
   
    <script>
        function show() {
            document.getElementById("loader").style.display="block";
        }
        function logout() {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        }
    </script>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <!-- Mainly scripts --> 
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
 
    <!-- Flot -->
    <script src="{{ asset('js/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.pie.js') }}"></script>
 
    <!-- Peity -->
    <script src="{{ asset('js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('js/demo/peity-demo.js') }}"></script>
 
    <!-- Custom and plugin javascript -->
    <script src="{{ asset('js/inspinia.js') }}"></script>
    <script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>
 
    <!-- jQuery UI -->
    <script src="{{ asset('js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
 
    <!-- GITTER -->
    <script src="{{ asset('js/plugins/gritter/jquery.gritter.min.js') }}"></script>
 
    <!-- Sparkline -->
    <script src="{{ asset('js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
 
    <!-- Sparkline demo data  -->
    <script src="{{ asset('js/demo/sparkline-demo.js') }}"></script>
 
    <!-- ChartJS-->
    <script src="{{ asset('js/plugins/chartJs/Chart.min.js') }}"></script>
 
    <!-- Toastr -->
    <script src="{{ asset('js/plugins/toastr/toastr.min.js') }}"></script>

    <!-- DataTables -->
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    @include('sweetalert::alert')
    @yield('footer')
</body>
</html>
