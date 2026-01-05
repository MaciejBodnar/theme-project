@php
    $url = function (string $slug, string $fallback = null) {
        if ($slug === 'home') {
            if (function_exists('pll_home_url')) {
                return pll_home_url();
            }
            return home_url('/');
        }

        $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'en';

        $page = get_page_by_path($slug);

        if (!$page && function_exists('pll_get_post')) {
            $all_pages = get_posts([
                'post_type' => 'page',
                'name' => $slug,
                'posts_per_page' => -1,
                'suppress_filters' => false,
                'lang' => '',
            ]);

            if (!empty($all_pages)) {
                $english_page = $all_pages[0];

                $translated_page_id = pll_get_post($english_page->ID, $current_lang);
                if ($translated_page_id) {
                    $page = get_post($translated_page_id);
                } else {
                    $page = $english_page;
                }
            }
        }

        if ($page) {
            $permalink = get_permalink($page->ID);

            if (function_exists('pll_get_post') && function_exists('pll_current_language')) {
                $page_lang = function_exists('pll_get_post_language')
                    ? pll_get_post_language($page->ID)
                    : $current_lang;
                if ($page_lang !== $current_lang) {
                    $current_lang_page_id = pll_get_post($page->ID, $current_lang);
                    if ($current_lang_page_id) {
                        $permalink = get_permalink($current_lang_page_id);
                    }
                }
            }

            return $permalink;
        }

        return $fallback ?? site_url("/{$slug}");
    };

    $is_page_related = function (string $slug) {
        if (is_page($slug)) {
            return true;
        }

        if (get_query_var('custom_page') === $slug) {
            return true;
        }

        if (strpos($_SERVER['REQUEST_URI'], "/{$slug}") !== false) {
            return true;
        }

        if (function_exists('pll_get_post')) {
            $current_post_id = get_the_ID();
            if ($current_post_id) {
                $translations = function_exists('pll_get_post_translations')
                    ? pll_get_post_translations($current_post_id)
                    : [];

                foreach ($translations as $lang => $translation_id) {
                    $translation_page = get_post($translation_id);
                    if ($translation_page && $translation_page->post_name === $slug) {
                        return true;
                    }
                }

                $current_template = get_page_template_slug($current_post_id);
                if (strpos($current_template, $slug) !== false) {
                    return true;
                }

                foreach ($translations as $lang => $translation_id) {
                    $translation_template = get_page_template_slug($translation_id);
                    if (strpos($translation_template, $slug) !== false) {
                        return true;
                    }
                }
            }
        }

        return false;
    };

    $get_page_title = function (string $slug) use ($url) {
        if ($slug === 'home') {
            return function_exists('pll_current_language') && pll_current_language() === 'pl'
                ? 'STRONA GŁÓWNA'
                : 'HOME';
        }

        $page_url = $url($slug);

        $page_id = url_to_postid($page_url);

        if ($page_id > 0) {
            $page = get_post($page_id);
            if ($page && !empty($page->post_title)) {
                return strtoupper($page->post_title);
            }
        }

        $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'en';

        $page = get_page_by_path($slug);
        if ($page && !empty($page->post_title)) {
            if (function_exists('pll_get_post_language')) {
                $page_lang = pll_get_post_language($page->ID);
                if ($page_lang === $current_lang) {
                    return strtoupper($page->post_title);
                }
            } else {
                return strtoupper($page->post_title);
            }
        }

        $pages_in_lang = get_posts([
            'post_type' => 'page',
            'posts_per_page' => -1,
            'lang' => $current_lang,
            'suppress_filters' => false,
        ]);

        foreach ($pages_in_lang as $page_check) {
            $check_url = get_permalink($page_check->ID);
            if ($check_url === $page_url || $page_check->post_name === $slug) {
                return strtoupper($page_check->post_title);
            }
        }

        return strtoupper($slug);
    };

    $is_training = $is_page_related('training');
    $is_gallery = $is_page_related('gallery');
    $is_contact = $is_page_related('contact') || $is_page_related('rent');
    $is_about = $is_page_related('about');

    $is_home = (is_front_page() || is_home()) && !$is_training && !$is_gallery && !$is_contact && !$is_about;

    $items = [
        ['label' => $get_page_title('home'), 'href' => $url('home'), 'active' => $is_home],
        ['label' => $get_page_title('about'), 'href' => $url('about'), 'active' => $is_about],
        ['label' => $get_page_title('training'), 'href' => $url('training'), 'active' => $is_training],
        ['label' => $get_page_title('gallery'), 'href' => $url('gallery'), 'active' => $is_gallery],
        ['label' => $get_page_title('contact'), 'href' => $url('contact'), 'active' => $is_contact],
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
