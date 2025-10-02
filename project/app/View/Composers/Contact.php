<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Contact extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'template-contact',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'contact' => $this->getContactData(),
        ];
    }

    /**
     * Get contact page data from ACF fields
     *
     * @return array
     */
    private function getContactData()
    {
        return [
            'company' => $this->getCompanyData(),
            'form' => $this->getFormData(),
        ];
    }

    /**
     * Get company information from ACF fields
     *
     * @return array
     */
    private function getCompanyData()
    {
        return [
            'email' => $this->getAcfFieldSafe('company_email', false, 'info@sweetbeauty.co.uk'),
            'phone' => $this->getAcfFieldSafe('company_phone', false, '+44 794 366 1484'),
            'addr' => $this->getCompanyAddress(),
            'hours' => $this->getCompanyHours(),
        ];
    }

    /**
     * Get company address from ACF fields
     *
     * @return array
     */
    private function getCompanyAddress()
    {
        // Check for ACF address fields
        if (function_exists('get_field')) {
            $address_line_1 = \get_field('company_address_line_1');
            $address_line_2 = \get_field('company_address_line_2');
            $address_line_3 = \get_field('company_address_line_3');

            $address = [];
            if ($address_line_1) $address[] = $address_line_1;
            if ($address_line_2) $address[] = $address_line_2;
            if ($address_line_3) $address[] = $address_line_3;

            if (!empty($address)) {
                return $address;
            }
        }

        // Fallback address
        return [
            'Sweet Beauty Edinburgh LTD',
            'Unit 2 – 66A Newhaven Road',
            'Edinburgh EH6 5QB'
        ];
    }

    /**
     * Get company opening hours from ACF fields
     *
     * @return array
     */
    private function getCompanyHours()
    {
        // Check for ACF hours fields
        if (function_exists('get_field')) {
            $hours_weekdays = \get_field('opening_hours_weekdays');
            $hours_weekend = \get_field('opening_hours_weekend');

            $hours = [];
            if ($hours_weekdays) $hours[] = $hours_weekdays;
            if ($hours_weekend) $hours[] = $hours_weekend;

            if (!empty($hours)) {
                return $hours;
            }
        }

        // Fallback hours
        return [
            'Monday – Saturday 10:00 – 21:00',
            'Sunday 10:00 – 18:00'
        ];
    }

    /**
     * Get form configuration from ACF fields
     *
     * @return array
     */
    private function getFormData()
    {
        return [
            'action' => $this->getAcfFieldSafe('form_action_url', false, '#'),
            'method' => $this->getAcfFieldSafe('form_method', false, 'post'),
            'submit_text' => $this->getAcfFieldSafe('form_submit_text', false, 'SEND'),
            'consent_text' => $this->getAcfFieldSafe(
                'form_consent_text',
                false,
                'I hereby agree that this data will be stored and processed for the purpose of establishing contact. I am aware that I can revoke my consent at any time.*'
            ),
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
