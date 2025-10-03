@php
    $url = function (string $slug, string $fallback = null) {
        if ($slug === 'home') {
            return home_url('/');
        }
        $page = get_page_by_path($slug);
        return $page ? get_permalink($page->ID) : $fallback ?? site_url("/{$slug}");
    };

    $is_training =
        is_page(['training']) ||
        get_query_var('custom_page') === 'training' ||
        strpos($_SERVER['REQUEST_URI'], '/training') !== false;

    $is_gallery =
        is_page(['gallery']) ||
        get_query_var('custom_page') === 'gallery' ||
        strpos($_SERVER['REQUEST_URI'], '/gallery') !== false;

    $is_contact =
        is_page(['contact']) ||
        get_query_var('custom_page') === 'contact' ||
        strpos($_SERVER['REQUEST_URI'], '/contact') !== false ||
        is_page(['rent']) ||
        get_query_var('custom_page') === 'rent' ||
        strpos($_SERVER['REQUEST_URI'], '/rent') !== false;

    $is_about =
        is_page(['about']) ||
        get_query_var('custom_page') === 'about' ||
        strpos($_SERVER['REQUEST_URI'], '/about') !== false;

    $is_home = (is_front_page() || is_home()) && !$is_training && !$is_gallery && !$is_contact && !$is_about;

    $items = [
        ['label' => 'HOME', 'href' => $url('home'), 'active' => $is_home],
        ['label' => 'ABOUT', 'href' => $url('about'), 'active' => $is_about],
        ['label' => 'TRAINING', 'href' => $url('training'), 'active' => $is_training],
        ['label' => 'GALLERY', 'href' => $url('gallery'), 'active' => $is_gallery],
        ['label' => 'CONTACT', 'href' => $url('contact'), 'active' => $is_contact],
    ];
@endphp

<nav class="flex flex-col space-y-8">
    @foreach ($items as $it)
        <a href="{{ $it['href'] }}" @if ($it['active']) aria-current="page" @endif
            class="mobile-nav-link text-center text-2xl uppercase transition-all duration-300 {{ $it['active'] ? 'text-[#d1b07a]' : 'text-white hover:text-[#d1b07a]' }}">
            {{ $it['label'] }}
        </a>
    @endforeach
</nav>
