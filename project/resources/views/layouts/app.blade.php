<!doctype html>
<html @php(language_attributes())>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php(do_action('get_header'))
    @php(wp_head())

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body @php(body_class())>
    @php(wp_body_open())

    <div id="app">
        @if (
            !(is_front_page() &&
                empty(get_query_var('custom_page')) &&
                (get_page_template_slug() === '' || get_page_template_slug() === 'views/front-page.blade.php')
            ))
            @include('sections.header')
        @endif

        <main id="main" class="main">
            @yield('content')
        </main>

        @include('sections.footer')
    </div>

    @php(do_action('get_footer'))
    @php(wp_footer())
</body>

</html>
