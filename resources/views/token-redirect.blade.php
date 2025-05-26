<!DOCTYPE html>
<html>
    <head>
        <title>Redirecting to Menu</title>
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
    
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        </style>
    </head>
<body>
    <div class="loader"></div>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const token = urlParams.get('token');

        if (token) {
            sessionStorage.setItem('api_token', token);

            window.location.href = `/menu?token=${token}`;
        } else {
            window.location.href = `/login`;
        }
        // const token = sessionStorage.getItem('api_token');
        // if (token) {
        //     window.location.href = `/sourcing_plan/public/menu?token=${token}`;
        // } else {
        //     window.location.href = `/sourcing_plan/public/login`;
        // }
    </script>
</body>
</html>
