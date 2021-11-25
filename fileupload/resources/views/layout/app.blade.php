<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>


@yield('content')
@yield('script')
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</body>

</html>
