<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Blank extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'template-blank-page',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'blank' => $this->getBlankData(),
        ];
    }

    private function getBlankData()
    {
        return [
            'description' => $this->getAcfFieldSafe(
                'description',
                false,
                '<strong>Sweet</strong> Beauty is top rated beauty salon located in the heart of Leith in Edinburgh. We offer a wide range of services, such as traditional white facial cosmetology treatments, chemical peels, electrical and ultrasound treatments, aesthetic procedures, micro-sclerotherapy, fat dissolving injections, intramuscular vitamin injections, as well as cosmetic procedures including eyebrow tint, henna and shape, body waxing, massages, manicure and pedicure, eyelash lift and extension.'
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
