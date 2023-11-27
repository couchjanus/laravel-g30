<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oldschool layout - @yield('title')</title>
</head>
<body>
    @section('navbar')
        This is the navbar Section
    @show

    <div class="container">
        @yield('content')
    </div>

</body>
</html>
