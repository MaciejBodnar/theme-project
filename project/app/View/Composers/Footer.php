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
            'social' => $this->getSocialData(),
            'contact' => $this->getContactData(),
            'settings' => $this->getSettingsData(),
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
            'facebook_url' => $this->getAcfFieldSafe('footer_facebook_url', false, '#'),
            'instagram_url' => $this->getAcfFieldSafe('footer_instagram_url', false, '#'),
            'tiktok_url' => $this->getAcfFieldSafe('footer_tiktok_url', false, '#'),
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
                'title' => $this->getAcfFieldSafe('footer_hours_title', false, 'WE\'RE open!'),
                'schedule' => $this->getAcfFieldSafe('footer_hours_schedule', false, 'Monday – Saturday 10:00 – 21:00<br>Sunday 10:00 – 18:00'),
            ],
            'address' => [
                'title' => $this->getAcfFieldSafe('footer_address_title', false, 'FIND us!'),
                'details' => $this->getAcfFieldSafe('footer_address_details', false, 'Sweet Beauty Edinburgh LTD<br>Unit 2 – 66A Newhaven Road<br>Edinburgh EH6 5QB'),
            ],
            'contact_info' => [
                'title' => $this->getAcfFieldSafe('footer_contact_title', false, 'GET in touch!'),
                'email' => $this->getAcfFieldSafe('footer_email', false, 'info@sweetbeauty.co.uk'),
                'phone' => $this->getAcfFieldSafe('footer_phone', false, '+447943661484'),
                'phone_display' => $this->getAcfFieldSafe('footer_phone_display', false, '0794 366 1484'),
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
            'privacy_policy_url' => $this->getAcfFieldSafe('footer_privacy_url', false, site_url('/privacy-policy')),
            'privacy_policy_text' => $this->getAcfFieldSafe('footer_privacy_text', false, 'Privacy Policy'),
            'copyright_text' => $this->getAcfFieldSafe('footer_copyright_text', false, 'Sweet Beauty Edinburgh LTD – D&C with <span class="text-white/80">SLT Media</span>'),
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
