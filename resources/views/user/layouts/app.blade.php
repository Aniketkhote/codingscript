<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('user/layouts/header')
</head>
<body>
    
    @include('user/layouts/nav')

    <div class="main">
        @section('content')
            @show
    </div>

    @include('user/layouts/footer')

</body>
</html>
