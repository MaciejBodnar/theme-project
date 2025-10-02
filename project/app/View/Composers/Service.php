<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Service extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'template-service',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'service' => $this->getData(),
        ];
    }

    private function getData()
    {
        $data = [];

        if (function_exists('get_field')) {
            $data = [
                'content' => $this->getAcfFieldSafe('content'),
                'photo' => wp_get_attachment_image($this->getAcfFieldSafe('photo'), 'full'),
                'gallery_description' => $this->getAcfFieldSafe('gallery_description'),
                'images' => $this->getGalleryImages(),
            ];
        }

        return $data;
    }

    private function getGalleryImages()
    {
        $images = [];

        if (function_exists('get_field')) {
            $data = \get_field('images');

            if (empty($data)) {
                return [];
            }

            foreach ($data as $image) {
                $images[] = [
                    'image' => wp_get_attachment_image($image, 'full'),
                    'category' => $this->getAcfFieldSafe('category', $image),
                    'link' => wp_get_attachment_url($image, 'full'),
                    'location' => $this->getAcfFieldSafe('location', $image),
                    'title' => get_the_title($image),
                ];
            }
        }

        return $images;
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
