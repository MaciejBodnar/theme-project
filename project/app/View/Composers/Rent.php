<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Rent extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'template-rent',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'rent' => $this->getRentData(),
        ];
    }

    /**
     * Get rent page data
     *
     * @return array
     */
    private function getRentData()
    {
        return [
            'content' => $this->getContentData(),
            'form' => $this->getFormData(),
        ];
    }

    /**
     * Get content section data
     *
     * @return array
     */
    private function getContentData()
    {
        return [
            'title' => $this->getAcfFieldSafe('rent_title', false, 'Rent a space for training'),
            'subtitle' => $this->getAcfFieldSafe('rent_subtitle', false, 'Before we start'),
            'description' => $this->getAcfFieldSafe('rent_description_1', false, 'Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy tincidunt ut laoreet dolore magna aliquam erat.'),
        ];
    }

    /**
     * Get form section data
     *
     * @return array
     */
    private function getFormData()
    {
        return [
            'labels' => $this->getFormLabelsData(),
            'placeholders' => $this->getFormPlaceholdersData(),
            'terms' => [
                'checkbox_text' => $this->getAcfFieldSafe('form_checkbox_text', false, 'I hereby agree that this data will be stored and processed for the purpose of establishing contact. I am aware that I can revoke my consent at any time.'),
                'disclaimer_text' => $this->getAcfFieldSafe('form_disclaimer_text', false, 'I understand that submitting this form does not <strong class="text-white">guarantee</strong> my requested date and time. A member of the Sweet Beauty team will review my enquiry and send a confirmation email once availability has been verified.'),
            ],
            'submit_button_text' => $this->getAcfFieldSafe('form_submit_text', false, 'SEND'),
        ];
    }

    /**
     * Get form field labels from ACF fields
     *
     * @return array
     */
    private function getFormLabelsData()
    {
        return [
            'name_label' => $this->getAcfFieldSafe('form_name_label', false, 'Name'),
            'surname_label' => $this->getAcfFieldSafe('form_surname_label', false, 'Surname'),
            'email_label' => $this->getAcfFieldSafe('form_email_label', false, 'Email'),
            'contact_label' => $this->getAcfFieldSafe('form_contact_label', false, 'Contact Number'),
            'date_label' => $this->getAcfFieldSafe('form_date_label', false, 'Preferred date'),
            'time_label' => $this->getAcfFieldSafe('form_time_label', false, 'Preferred time'),
        ];
    }

    /**
     * Get form field placeholders from ACF fields
     *
     * @return array
     */
    private function getFormPlaceholdersData()
    {
        return [
            'name_placeholder' => $this->getAcfFieldSafe('form_name_placeholder', false, ''),
            'surname_placeholder' => $this->getAcfFieldSafe('form_surname_placeholder', false, ''),
            'email_placeholder' => $this->getAcfFieldSafe('form_email_placeholder', false, ''),
            'contact_placeholder' => $this->getAcfFieldSafe('form_contact_placeholder', false, ''),
            'date_placeholder' => $this->getAcfFieldSafe('form_date_placeholder', false, 'Select date'),
            'time_placeholder' => $this->getAcfFieldSafe('form_time_placeholder', false, 'Select time'),
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
