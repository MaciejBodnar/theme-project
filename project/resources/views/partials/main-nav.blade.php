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

    $is_home = (is_front_page() || is_home()) && !$is_training;
    $is_about = is_page(['about']);
    $is_gallery = is_page(['gallery']);
    $is_contact = is_page(['contact']);

    $items = [
        ['label' => 'HOME', 'href' => $url('home'), 'active' => $is_home],
        ['label' => 'ABOUt', 'href' => $url('about'), 'active' => $is_about],
        ['label' => 'TRAIning', 'href' => $url('training'), 'active' => $is_training],
        ['label' => 'GALLery', 'href' => $url('gallery'), 'active' => $is_gallery],
        ['label' => 'CONtact', 'href' => $url('contact'), 'active' => $is_contact],
    ];
@endphp

<ul class="flex gap-8 uppercase tracking-wide text-[13px]">
    @foreach ($items as $it)
        <li>
            <a href="{{ $it['href'] }}" @if ($it['active']) aria-current="page" @endif
                class="transition {{ $it['active'] ? 'text-[#d1b07a] font-semibold' : 'text-gray-300 hover:text-white' }}">
                {{ $it['label'] }}
            </a>
        </li>
    @endforeach
</ul>
