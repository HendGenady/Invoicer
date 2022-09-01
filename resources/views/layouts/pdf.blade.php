<!DOCTYPE html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <!-- <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css" > -->
        <style>
            td{
                text-align: center;
            }
            th{
                padding:10px;
            }
            body{ 
                font-family: DejaVu Sans;
            }
        </style>
    </head>
    <body>
        @yield('content1')
        <script src="{{ asset('js/app.js') }}" type="text/js"></script>
    </body>
</html>