<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Album extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'single-album',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'album' => $this->getAlbumData(),
        ];
    }

    /**
     * Get album data based on current context
     *
     * @return array
     */
    private function getAlbumData()
    {
        $post_slug = get_query_var('post_slug') ?: $this->view->getData()['post_slug'] ?? null;

        if (!$post_slug) {
            return $this->getDefaultAlbumData();
        }

        $album_post = get_page_by_path($post_slug, OBJECT, 'post');

        if (!$album_post) {
            return $this->getDefaultAlbumData();
        }

        return [
            'info' => $this->getAlbumInfo($album_post),
            'images' => $this->getAlbumImages($album_post->ID),
            'settings' => $this->getAlbumSettings($album_post->ID),
        ];
    }
    /**
     * Get album basic information
     *
     * @param \WP_Post $album_post
     * @return array
     */
    private function getAlbumInfo($album_post)
    {
        return [
            'id' => $album_post->ID,
            'title' => $album_post->post_title,
            'slug' => $album_post->post_name,
            'description' => $album_post->post_content,
            'excerpt' => $album_post->post_excerpt,
            'date' => $album_post->post_date,
        ];
    }

    /**
     * Get all images for the album
     *
     * @param int $album_id
     * @return array
     */
    private function getAlbumImages($album_id)
    {
        $images = $this->getAcfFieldSafe('album_images', $album_id, []);

        if (empty($images)) {
            return $this->getDefaultImages();
        }

        $processed_images = [];
        foreach ($images as $index => $image) {
            $image_data = [
                'id' => $this->getImageIdFromField($image),
                'url' => $this->getImageFromField($image, ''),
                'alt' => $this->getImageAlt($image),
                'caption' => $this->getImageCaption($image),
                'full_url' => $this->getImageFromField($image, '', 'full'),
                'thumb_url' => $this->getImageFromField($image, '', 'medium'),
            ];

            if (!empty($image_data['url'])) {
                $processed_images[] = $image_data;
            }
        }

        return $processed_images;
    }

    /**
     * Get default images for fallback
     *
     * @return array
     */
    private function getDefaultImages()
    {
        $default_images = [];
        for ($i = 1; $i <= 12; $i++) {
            $default_images[] = [
                'id' => $i,
                'url' => get_theme_file_uri('resources/images/image-album.png'),
                'alt' => "Album image $i",
                'caption' => '',
                'full_url' => get_theme_file_uri('resources/images/image-album.png'),
                'thumb_url' => get_theme_file_uri('resources/images/image-album.png'),
            ];
        }
        return $default_images;
    }

    /**
     * Get album settings
     *
     * @param int $album_id
     * @return array
     */
    private function getAlbumSettings($album_id)
    {
        return [
            'layout' => $this->getAcfFieldSafe('album_layout', $album_id, 'grid'),
            'columns' => $this->getAcfFieldSafe('album_columns', $album_id, 3),
        ];
    }

    /**
     * Get default album data for fallback
     *
     * @return array
     */
    private function getDefaultAlbumData()
    {
        return [
            'info' => [
                'id' => 0,
                'title' => 'Sample Album',
                'slug' => 'sample-album',
                'description' => 'This is a sample album with default content.',
                'excerpt' => 'Sample album description',
                'date' => date('Y-m-d H:i:s'),
            ],
            'images' => $this->getDefaultImages(),
            'settings' => [
                'layout' => 'grid',
                'columns' => 3,
            ],
        ];
    }

    /**
     * Get image ID from field
     *
     * @param mixed $image_field
     * @return int
     */
    private function getImageIdFromField($image_field)
    {
        if (is_array($image_field) && isset($image_field['ID'])) {
            return (int) $image_field['ID'];
        } elseif (is_numeric($image_field)) {
            return (int) $image_field;
        }
        return 0;
    }

    /**
     * Get image alt text
     *
     * @param mixed $image_field
     * @return string
     */
    private function getImageAlt($image_field)
    {
        if (is_array($image_field) && isset($image_field['alt'])) {
            return $image_field['alt'];
        }

        $image_id = $this->getImageIdFromField($image_field);
        if ($image_id) {
            return get_post_meta($image_id, '_wp_attachment_image_alt', true) ?: '';
        }

        return '';
    }

    /**
     * Get image caption
     *
     * @param mixed $image_field
     * @return string
     */
    private function getImageCaption($image_field)
    {
        if (is_array($image_field) && isset($image_field['caption'])) {
            return $image_field['caption'];
        }

        $image_id = $this->getImageIdFromField($image_field);
        if ($image_id) {
            $attachment = get_post($image_id);
            return $attachment ? $attachment->post_excerpt : '';
        }

        return '';
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
