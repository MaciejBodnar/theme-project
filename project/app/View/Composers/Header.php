<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Header extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'sections.header',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'header' => $this->getHeaderData(),
        ];
    }

    /**
     * Get header data including language switcher
     *
     * @return array
     */
    private function getHeaderData()
    {
        return [
            'logo' => $this->getLogoData(),
            'languages' => $this->getLanguages(),
            'current_language' => $this->getCurrentLanguage(),
            'social_links' => $this->getSocialLinks(),
            'book_now' => $this->getBookNowData(),
        ];
    }

    /**
     * Get logo configuration data
     *
     * @return array
     */
    private function getLogoData()
    {
        return [
            'image' => $this->getLogoImage(),
            'url' => $this->getAcfFieldSafe('header_logo_url', 'option', home_url('/')),
            'alt' => $this->getAcfFieldSafe('header_logo_alt', 'option', 'Logo'),
        ];
    }

    /**
     * Get logo image URL from ACF or fallback
     *
     * @return string
     */
    private function getLogoImage()
    {
        if (function_exists('get_field')) {
            $logo_field = \get_field('header_logo_image', 'option');

            if (!empty($logo_field)) {
                // Handle different ACF image field return types
                if (is_array($logo_field) && isset($logo_field['url'])) {
                    return $logo_field['url'];
                } elseif (is_numeric($logo_field)) {
                    $image_url = wp_get_attachment_image_url($logo_field, 'full');
                    if ($image_url) {
                        return $image_url;
                    }
                } elseif (is_string($logo_field)) {
                    return $logo_field;
                }
            }
        }

        // Fallback to default logo
        return get_theme_file_uri('resources/images/menu-logo.png');
    }

    /**
     * Get available languages from Polylang
     *
     * @return array
     */
    private function getLanguages()
    {
        if (function_exists('pll_the_languages')) {
            $languages = \pll_the_languages([
                'raw' => 1,
                'hide_if_empty' => 0,
                'hide_current' => 0,
                'show_flags' => 0,
                'show_names' => 1,
            ]);

            if (is_array($languages)) {
                return array_map(function ($lang) {
                    return [
                        'code' => strtoupper($lang['slug']),
                        'name' => $lang['name'],
                        'url' => $lang['url'],
                        'current' => $lang['current_lang'],
                        'locale' => $lang['locale'] ?? '',
                        'flag' => $lang['flag'] ?? '', // If you want flags later
                    ];
                }, $languages);
            }
        }

        // Fallback if Polylang is not active
        return [
            [
                'code' => 'EN',
                'name' => 'English',
                'url' => home_url('/'),
                'current' => true,
                'locale' => 'en_US',
                'flag' => '',
            ],
            [
                'code' => 'PL',
                'name' => 'Polski',
                'url' => '#',
                'current' => false,
                'locale' => 'pl_PL',
                'flag' => '',
            ],
        ];
    }

    /**
     * Get current language
     *
     * @return string
     */
    private function getCurrentLanguage()
    {
        if (function_exists('pll_current_language')) {
            $current = \pll_current_language('slug');
            return strtoupper($current ?: 'EN');
        }

        // Fallback to detect language from URL or use default
        $current_url = $_SERVER['REQUEST_URI'] ?? '';
        if (strpos($current_url, '/pl/') !== false || strpos($current_url, '/pl') !== false) {
            return 'PL';
        }

        return 'EN';
    }

    /**
     * Get social media links
     *
     * @return array
     */
    private function getSocialLinks()
    {
        return [
            'facebook' => $this->getAcfFieldSafe('social_facebook_url', 'option', '#'),
            'instagram' => $this->getAcfFieldSafe('social_instagram_url', 'option', '#'),
            'tiktok' => $this->getAcfFieldSafe('social_tiktok_url', 'option', '#'),
        ];
    }

    /**
     * Get book now button data
     *
     * @return array
     */
    private function getBookNowData()
    {
        $page_field = $this->getAcfFieldSafe('header_book_now_page', 'option', null);
        $url = '#'; // Default fallback
        $page_id = null;

        // Handle different ACF return formats
        if ($page_field) {
            if (is_numeric($page_field)) {
                // Return format: Page ID
                $page_id = $page_field;
            } elseif (is_array($page_field) && isset($page_field['ID'])) {
                // Return format: Page Object
                $page_id = $page_field['ID'];
            } elseif (is_object($page_field) && isset($page_field->ID)) {
                // Return format: Page Object (WP_Post)
                $page_id = $page_field->ID;
            } elseif (is_string($page_field) && filter_var($page_field, FILTER_VALIDATE_URL)) {
                // Return format: Page URL - just use it directly
                $url = $page_field;
                $page_id = null; // Skip translation logic
            }
        }

        // If we have a page ID, get its translated URL for current language
        if ($page_id) {
            if (function_exists('pll_get_post') && function_exists('pll_current_language')) {
                // Get current language
                $current_lang = \pll_current_language();

                // Get the translated page ID for current language
                $translated_page_id = \pll_get_post($page_id, $current_lang);

                if ($translated_page_id) {
                    $url = get_permalink($translated_page_id);
                } else {
                    // If no translation exists, use original page
                    $url = get_permalink($page_id);
                }
            } else {
                // If Polylang is not active, just use the page directly
                $url = get_permalink($page_id);
            }
        }

        return [
            'text' => $this->getAcfFieldSafe('header_book_now_text', 'option', 'BOOK NOW'),
            'url' => $url,
        ];
    }

    /**
     * Safe ACF field retrieval with fallback
     *
     * @param string $field_name
     * @param mixed $post_id
     * @param mixed $fallback
     * @return mixed
     */
    private function getAcfFieldSafe($field_name, $post_id = false, $fallback = null)
    {
        if (function_exists('get_field')) {
            $value = \get_field($field_name, $post_id);
            return !empty($value) ? $value : $fallback;
        }
        return $fallback;
    }
}
