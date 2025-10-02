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
            'settings' => $this->getSettingsData(),
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
            'before_section' => [
                'title' => $this->getAcfFieldSafe('rent_before_title', false, 'BEFORE you start'),
                'paragraph_1' => $this->getAcfFieldSafe('rent_before_paragraph_1', false, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy tincidunt ut laoreet dolore magna aliquam erat.'),
                'paragraph_2' => $this->getAcfFieldSafe('rent_before_paragraph_2', false, 'At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren.'),
            ],
            'description_1' => $this->getAcfFieldSafe('rent_description_1', false, 'Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy tincidunt ut laoreet dolore magna aliquam erat.'),
            'description_2' => $this->getAcfFieldSafe('rent_description_2', false, 'At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren.'),
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
            'fields' => [
                'name_placeholder' => $this->getAcfFieldSafe('form_name_placeholder', false, 'Name'),
                'surname_placeholder' => $this->getAcfFieldSafe('form_surname_placeholder', false, 'Surname'),
                'email_placeholder' => $this->getAcfFieldSafe('form_email_placeholder', false, 'Email'),
                'contact_placeholder' => $this->getAcfFieldSafe('form_contact_placeholder', false, 'Contact Number'),
                'day_placeholder' => $this->getAcfFieldSafe('form_day_placeholder', false, 'Preferred day'),
                'time_placeholder' => $this->getAcfFieldSafe('form_time_placeholder', false, 'Preferred time'),
            ],
            'terms' => [
                'checkbox_text' => $this->getAcfFieldSafe('form_checkbox_text', false, 'I hereby agree that this data will be stored and processed for the purpose of establishing contact. I am aware that I can revoke my consent at any time.'),
                'disclaimer_text' => $this->getAcfFieldSafe('form_disclaimer_text', false, 'I understand that submitting this form does not <strong class="text-white">guarantee</strong> my requested date and time. A member of the Sweet Beauty team will review my enquiry and send a confirmation email once availability has been verified.'),
            ],
            'submit_button_text' => $this->getAcfFieldSafe('form_submit_text', false, 'SEND'),
        ];
    }

    /**
     * Get settings data
     *
     * @return array
     */
    private function getSettingsData()
    {
        return [
            'gold_color' => $this->getAcfFieldSafe('rent_gold_color', false, '#d1b07a'),
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
