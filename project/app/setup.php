<?php

/**
 * Theme setup.
 */

namespace App;

use Illuminate\Support\Facades\Vite;

add_filter('wpcf7_load_css', '__return_false');
add_filter('wpcf7_autop', '__return_false', 999);
add_filter('wpcf7_form_class_attr', fn($c) => $c . ' cf7-custom-form');


/**
 * Inject styles into the block editor.
 *
 * @return array
 */
add_filter('block_editor_settings_all', function ($settings) {
    $style = Vite::asset('resources/css/editor.css');

    $settings['styles'][] = [
        'css' => "@import url('{$style}')",
    ];

    return $settings;
});

/**
 * Inject scripts into the block editor.
 *
 * @return void
 */
add_filter('admin_head', function () {
    if (! get_current_screen()?->is_block_editor()) {
        return;
    }

    $dependencies = json_decode(Vite::content('editor.deps.json'));

    foreach ($dependencies as $dependency) {
        if (! wp_script_is($dependency)) {
            wp_enqueue_script($dependency);
        }
    }

    echo Vite::withEntryPoints([
        'resources/js/editor.js',
    ])->toHtml();
});

/**
 * Use the generated theme.json file.
 *
 * @return string
 */
add_filter('theme_file_path', function ($path, $file) {
    return $file === 'theme.json'
        ? public_path('build/assets/theme.json')
        : $path;
}, 10, 2);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
    ]);

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
     */
    add_theme_support('customize-selective-refresh-widgets');
}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ];

    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id' => 'sidebar-primary',
    ] + $config);

    register_sidebar([
        'name' => __('Footer', 'sage'),
        'id' => 'sidebar-footer',
    ] + $config);
});

/**
 * Add custom routes for the theme
 */
add_action('init', function () {
    // Add rewrite rule for pages
    add_rewrite_rule('^training/?$', 'index.php?custom_page=training', 'top');
    add_rewrite_rule('^gallery/?$', 'index.php?custom_page=gallery', 'top');
    add_rewrite_rule('^gallery/([^/]+)/?$', 'index.php?custom_page=gallery_post&post_slug=$matches[1]', 'top');
    add_rewrite_rule('^contact/?$', 'index.php?custom_page=contact', 'top');
    add_rewrite_rule('^about/?$', 'index.php?custom_page=about', 'top');
    add_rewrite_rule('^rent/?$', 'index.php?custom_page=rent', 'top');

    // Flush rewrite rules on theme activation (only once)
    if (get_option('sage_custom_routes_flushed') !== 'gallery_posts_added') {
        flush_rewrite_rules();
        update_option('sage_custom_routes_flushed', 'gallery_posts_added');
    }
});

/**
 * Add custom query vars
 */
add_filter('query_vars', function ($vars) {
    $vars[] = 'custom_page';
    $vars[] = 'post_slug';
    return $vars;
});

/**
 * Handle custom route templates
 */
add_action('template_redirect', function () {
    $custom_page = get_query_var('custom_page');

    if ($custom_page) {
        switch ($custom_page) {
            case 'training':
                // Set up proper WordPress context for Training page
                global $wp_query, $post;

                $training_page = get_page_by_path('training');
                if ($training_page) {
                    $wp_query->queried_object = $training_page;
                    $wp_query->queried_object_id = $training_page->ID;
                    $post = $training_page;
                    setup_postdata($post);
                }

                echo view('template-training')->render();
                exit;
            case 'gallery':
                // Set up proper WordPress context for Gallery page
                global $wp_query, $post;

                $gallery_page = get_page_by_path('gallery');
                if ($gallery_page) {
                    $wp_query->queried_object = $gallery_page;
                    $wp_query->queried_object_id = $gallery_page->ID;
                    $post = $gallery_page;
                    setup_postdata($post);
                }

                echo view('template-gallery')->render();
                exit;
            case 'gallery_post':
                echo view('single-album')->render();
                exit;
            case 'contact':
                // Set up proper WordPress context for Contact page
                global $wp_query, $post;

                $contact_page = get_page_by_path('contact');
                if ($contact_page) {
                    $wp_query->queried_object = $contact_page;
                    $wp_query->queried_object_id = $contact_page->ID;
                    $post = $contact_page;
                    setup_postdata($post);
                }

                echo view('template-contact')->render();
                exit;
            case 'about':
                global $wp_query, $post;

                $about_page = get_page_by_path('about');
                if ($about_page) {
                    $wp_query->queried_object = $about_page;
                    $wp_query->queried_object_id = $about_page->ID;
                    $post = $about_page;
                    setup_postdata($post);
                }

                echo view('template-about')->render();
                exit;
            case 'rent':
                // Set up proper WordPress context for Rent page
                global $wp_query, $post;

                $rent_page = get_page_by_path('rent');
                if ($rent_page) {
                    $wp_query->queried_object = $rent_page;
                    $wp_query->queried_object_id = $rent_page->ID;
                    $post = $rent_page;
                    setup_postdata($post);
                }

                echo view('template-rent')->render();
                exit;
        }
    }
});

add_action('after_setup_theme', function () {
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
    ]);
});
