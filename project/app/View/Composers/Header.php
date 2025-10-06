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
            $languages = pll_the_languages([
                'raw' => 1,
                'hide_if_empty' => 0,
            ]);

            if (is_array($languages)) {
                return array_map(function ($lang) {
                    return [
                        'code' => strtoupper($lang['slug']),
                        'name' => $lang['name'],
                        'url' => $lang['url'],
                        'current' => $lang['current_lang'],
                    ];
                }, $languages);
            }
        }

        // Fallback if Polylang is not active
        return [
            [
                'code' => 'ENG',
                'name' => 'English',
                'url' => '#',
                'current' => true,
            ],
            [
                'code' => 'PL',
                'name' => 'Polski',
                'url' => '#',
                'current' => false,
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
            $current = pll_current_language('slug');
            return strtoupper($current ?: 'EN');
        }

        return 'ENG';
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
        return [
            'text' => $this->getAcfFieldSafe('header_book_now_text', 'option', 'BOOK NOW'),
            'url' => $this->getAcfFieldSafe('header_book_now_url', 'option', '/rent'),
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
