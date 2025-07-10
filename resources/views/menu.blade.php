{{-- @extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>Welcome, {{ auth()->user()->name }}!</h2>
    <p>Select a system to continue:</p>
    
    <a href="{{ route('system.redirect', 'system1') }}" class="btn btn-primary">Go to System 1</a>
    <a href="{{ route('system.redirect', 'system2') }}" class="btn btn-secondary">Go to System 2</a>
</div>
@endsection --}}

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{URL::asset('/images/menu3.png')}}">

</head>

<body class="gray-bg" style="display: flex; justify-content: center; align-items: center; height: 100vh;">

    <div class="menu-middle-box text-center animated fadeInDown">

       <div class="row">
            <div class="col-lg-12">
                @if ((@auth()->user()->position != 'Plant Analyst') || (@auth()->user()->position != 'QC Senior Supervisor'))
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <a href="{{ route('system.redirect', 'system1') }}" class="btn btn-primary">
                                    <div class="image text-center">
                                        <img src="{{ asset('/images/sp.png') }}" alt="Sourcing Plan" style="max-height: 400px;">
                                    </div>
                                    <h2 class="text-center mt-2">Sourcing Plan</h2>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <a href="#" class="btn btn-success" onclick="redirectToSystem2()">
                                    <div class="image text-center">
                                        <img src="{{ asset('/images/cm.png') }}" alt="Complete Monitoring" style="max-height: 400px;">
                                    </div>
                                    <h2 class="text-center mt-2">Complete Monitoring</h2>
                                </a>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <a href="#" class="btn btn-success" onclick="redirectToSystem2()">
                                    <div class="image text-center">
                                        <img src="{{ asset('/images/cm.png') }}" alt="Complete Monitoring" style="max-height: 400px;">
                                    </div>
                                    <h2 class="text-center mt-2">Complete Monitoring</h2>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
       </div>
    </div>


    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <script src="{{ asset('js/inspinia.js') }}"></script>
    <script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>
    <script>
        // function redirectToSystem2() {
        //     const token = '{{ auth()->user()->api_token }}';
        //     const targetUrl = `https://complete-monitoring.wsystem.online/login-with-token?token=${token}`;
        //     window.location.href = targetUrl;
        // }
        function redirectToSystem2() {
            const token = '{{ auth()->user()->api_token }}';
            const targetUrl = `http://localhost/complete-monitoring/public/login-with-token?token=${token}`;
            window.location.href = targetUrl;
        }
        // function redirectToSystem2() {
        //     if (!sessionStorage.getItem('api_token')) {
        //         sessionStorage.setItem('api_token', '{{ auth()->user()->api_token }}');
        //     }

        //     window.location.href = 'http://localhost/complete-monitoring/public/login-with-token';
        // }
    </script>

</body>

</html>

