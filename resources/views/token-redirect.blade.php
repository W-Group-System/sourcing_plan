<!DOCTYPE html>
<html>
    <head>
        <title>Redirecting to Menu</title>
        <style>
            /* Loader styles */
            .loader {
                border: 16px solid #f3f3f3;
                border-top: 16px solid #3498db;
                border-radius: 50%;
                width: 80px;
                height: 80px;
                animation: spin 2s linear infinite;
                margin: 0 auto;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
    
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
    
            .message {
                text-align: center;
                font-size: 18px;
                position: absolute;
                top: 60%;
                left: 50%;
                transform: translateX(-50%);
            }
        </style>
    </head>
<body>
    <div class="loader"></div>
    <div class="message">Redirecting...</div>
    <script>
        const token = sessionStorage.getItem('api_token');
        if (token) {
            window.location.href = `/sourcing_plan/public/menu?token=${token}`;
        } else {
            window.location.href = `/sourcing_plan/public/login`;
        }
    </script>
</body>
</html>
