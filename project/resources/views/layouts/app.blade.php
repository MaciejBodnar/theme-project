<!doctype html>
<html @php(language_attributes())>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php(do_action('get_header'))
    @php(wp_head())

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body @php(body_class())>
    @php(wp_body_open())

    <div id="app">
        <div class="lg:hidden fixed top-0 left-0 right-0 z-30">
            @include('sections.header')
        </div>

        @if (!is_front_page())
            <div class="hidden lg:block">
                @include('sections.header')
            </div>
        @endif

        <main id="main" class="main">
            @yield('content')
        </main>
    </div>

    @php(do_action('get_footer'))
    @php(wp_footer())
</body>

</html>
