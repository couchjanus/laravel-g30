<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main conponent - {{ config('app.name', 'Front page') }}</title>
</head>
<body>
    <div>

        @if (isset($header))
            <header>
                {{ $header }}
            </header>
        @endif
        {{-- page content --}}
        <main>
            {{ $slot }}
        </main>
    </div>

    @if (isset($footer))
            <footer>
                {{ $footer }}
            </footer>
    @endif
</body>
</html>
