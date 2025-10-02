<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Training extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'template-training',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'training' => $this->getTrainingData(),
        ];
    }

    private function getTrainingData()
    {
        $data = [
            'hero' => $this->getHeroData(),
            'instagram' => $this->getInstagramData(),
        ];

        return $data;
    }


    private function getHeroData()
    {
        return [
            'title' => $this->getAcfFieldSafe('hero_title', false, get_the_title() ?: 'Training'),
            'intro' => $this->getAcfFieldSafe(
                'hero_intro',
                false,
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy eirmod tempor incididunt ut labore et dolore magna aliquam erat, sed diam volutpat.'
            ),
            'body' => $this->getAcfFieldSafe(
                'hero_body',
                false,
                'Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy eirmod tempor incididunt ut labore et dolore magna aliquam erat, sed diam volutpat.'
            ),
            'image' => $this->getAcfImageSafe(
                'hero_image',
                false,
                'full',
                get_theme_file_uri('resources/images/training-hero.jpg')
            ),
        ];
    }


    private function getInstagramData()
    {
        $images = [];

        if (function_exists('get_field')) {
            $gallery = \get_field('instagram_gallery');

            if (!empty($gallery) && is_array($gallery)) {
                foreach ($gallery as $image) {
                    if (is_array($image) && isset($image['url'])) {
                        $images[] = $image['url'];
                    } elseif (is_numeric($image)) {
                        $images[] = wp_get_attachment_url($image);
                    }
                }
            }
        }

        // Fallback images if no ACF data
        if (empty($images)) {
            $images = [
                get_theme_file_uri('resources/images/insta-1.jpg'),
                get_theme_file_uri('resources/images/insta-2.jpg'),
                get_theme_file_uri('resources/images/insta-3.jpg'),
                get_theme_file_uri('resources/images/insta-4.jpg'),
                get_theme_file_uri('resources/images/insta-5.jpg'),
                get_theme_file_uri('resources/images/insta-6.jpg'),
                get_theme_file_uri('resources/images/insta-7.jpg'),
                get_theme_file_uri('resources/images/insta-8.jpg'),
            ];
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

    /**
     * Safe ACF image retrieval with fallback
     *
     * @param string $field_name
     * @param mixed $post_id
     * @param string $size
     * @param string $fallback_url
     * @return string
     */
    private function getAcfImageSafe($field_name, $post_id = false, $size = 'full', $fallback_url = '')
    {
        if (function_exists('get_field')) {
            $image = \get_field($field_name, $post_id);

            if ($image) {
                if (is_array($image) && isset($image['url'])) {
                    return $image['url'];
                } elseif (is_string($image)) {
                    return wp_get_attachment_image_url($image, $size) ?: $image;
                } elseif (is_numeric($image)) {
                    return wp_get_attachment_image_url($image, $size) ?: $fallback_url;
                }
            }
        }
        return $fallback_url;
    }
}
