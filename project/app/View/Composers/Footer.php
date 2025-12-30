<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Footer extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'sections.footer',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'footer' => $this->getFooterData(),
        ];
    }

    /**
     * Get footer data
     *
     * @return array
     */
    private function getFooterData()
    {
        return [
            'instagram' => $this->getInstagramData(),
            'social' => $this->getSocialData(),
            'contact' => $this->getContactData(),
            'settings' => $this->getSettingsData(),
        ];
    }

    /**
     * Get Instagram section data
     *
     * @return array
     */
    private function getInstagramData()
    {
        $instagram_images = $this->getAcfFieldSafe('footer_instagram_images', 'option', []);

        // Process ACF gallery if available
        $processed_images = [];
        if (!empty($instagram_images)) {
            foreach ($instagram_images as $image) {
                $image_url = $this->getImageFromField($image, '');
                if (!empty($image_url)) {
                    $processed_images[] = $image_url;
                }
            }
        }

        // Fallback to default images if no ACF images
        if (empty($processed_images)) {
            $processed_images = [
                get_theme_file_uri('resources/images/image-instagram.png'),
                get_theme_file_uri('resources/images/image-instagram.png'),
                get_theme_file_uri('resources/images/image-instagram.png'),
                get_theme_file_uri('resources/images/image-instagram.png'),
            ];
        }

        return [
            'title' => $this->getAcfFieldSafe('footer_instagram_title', 'option', 'Instagram'),
            'images' => $processed_images,
        ];
    }

    /**
     * Get social media data
     *
     * @return array
     */
    private function getSocialData()
    {
        return [
            'facebook_url' => $this->getAcfFieldSafe('footer_facebook_url', 'option', '#'),
            'instagram_url' => $this->getAcfFieldSafe('footer_instagram_url', 'option', '#'),
            'tiktok_url' => $this->getAcfFieldSafe('footer_tiktok_url', 'option', '#'),
        ];
    }

    /**
     * Get contact information data
     *
     * @return array
     */
    private function getContactData()
    {
        return [
            'hours' => [
                'title' => $this->getAcfFieldSafe('footer_hours_title', 'option', 'WE\'RE open!'),
                'schedule' => $this->getAcfFieldSafe('footer_hours_schedule', 'option', 'Monday – Saturday 10:00 – 21:00<br>Sunday 10:00 – 18:00'),
            ],
            'address' => [
                'title' => $this->getAcfFieldSafe('footer_address_title', 'option', 'FIND us!'),
                'details' => $this->getAcfFieldSafe('footer_address_details', 'option', 'Sweet Beauty Edinburgh LTD<br>Unit 2 – 66A Newhaven Road<br>Edinburgh EH6 5QB'),
            ],
            'contact_info' => [
                'title' => $this->getAcfFieldSafe('footer_contact_title', 'option', 'GET in touch!'),
                'email' => $this->getAcfFieldSafe('footer_email', 'option', 'info@sweetbeauty.co.uk'),
                'phone' => $this->getAcfFieldSafe('footer_phone', 'option', '+447943661484'),
            ],
        ];
    }

    /**
     * Get footer settings
     *
     * @return array
     */
    private function getSettingsData()
    {
        return [
            'copyright_text' => $this->getAcfFieldSafe('footer_copyright_text', 'option', 'Sweet Beauty Edinburgh LTD – D&C with <span class="text-white/80">SLT Media</span>'),
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

    /**
     * Helper to extract image URL from various field formats
     *
     * @param mixed $image_field
     * @param string $fallback
     * @param string $size
     * @return string
     */
    private function getImageFromField($image_field, $fallback = '', $size = 'full')
    {
        if (empty($image_field)) {
            return $fallback;
        }

        if (is_array($image_field) && isset($image_field['url'])) {
            return $image_field['url'];
        } elseif (is_string($image_field)) {
            return wp_get_attachment_image_url($image_field, $size) ?: $image_field;
        } elseif (is_numeric($image_field)) {
            return wp_get_attachment_image_url($image_field, $size) ?: $fallback;
        }

        return $fallback;
    }
}
