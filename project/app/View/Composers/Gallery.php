<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Gallery extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'template-gallery',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'gallery' => $this->getGalleryData(),
        ];
    }

    /**
     * Get all gallery data
     *
     * @return array
     */
    private function getGalleryData()
    {
        return [
            'albums' => $this->getAlbums(),
            'settings' => $this->getGallerySettings(),
        ];
    }

    /**
     * Get all albums from WordPress posts
     *
     * @return array
     */
    private function getAlbums()
    {
        // Get posts from 'gallery' category or posts with gallery ACF field
        $albums = get_posts([
            'post_type' => 'post',
            'post_status' => 'publish',
            'numberposts' => -1,
            'orderby' => 'date',
            'order' => 'DESC',
            'meta_query' => [
                [
                    'key' => 'is_gallery_album',
                    'value' => '1',
                    'compare' => '='
                ]
            ]
        ]);

        // If no posts with meta field, try category approach
        if (empty($albums)) {
            $gallery_category = get_category_by_slug('gallery');
            if ($gallery_category) {
                $albums = get_posts([
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'numberposts' => -1,
                    'category' => $gallery_category->term_id,
                    'orderby' => 'date',
                    'order' => 'DESC'
                ]);
            }
        }

        if (empty($albums)) {
            // Return default albums if no posts exist
            return $this->getDefaultAlbums();
        }

        $processed_albums = [];
        foreach ($albums as $album) {
            $album_data = [
                'id' => $album->ID,
                'title' => $album->post_title,
                'slug' => $album->post_name,
                'excerpt' => $album->post_excerpt ?: wp_trim_words($album->post_content, 20),
                'link' => home_url('/gallery/' . $album->post_name),
                'thumbnail' => $this->getAlbumThumbnail($album->ID),
                'image_count' => $this->getAlbumImageCount($album->ID),
            ];

            $processed_albums[] = $album_data;
        }
        return $processed_albums;
    }
    /**
     * Get default albums as fallback
     *
     * @return array
     */
    private function getDefaultAlbums()
    {
        return [
            [
                'id' => 1,
                'title' => 'Beauty Treatments',
                'slug' => 'beauty-treatments',
                'excerpt' => 'Professional beauty treatments and procedures',
                'link' => home_url('/gallery/beauty-treatments'),
                'thumbnail' => get_theme_file_uri('resources/images/image-gallery.png'),
                'image_count' => 12,
            ],
            [
                'id' => 2,
                'title' => 'Skin Care',
                'slug' => 'skin-care',
                'excerpt' => 'Advanced skincare treatments and solutions',
                'link' => home_url('/gallery/skin-care'),
                'thumbnail' => get_theme_file_uri('resources/images/image-gallery.png'),
                'image_count' => 8,
            ],
            [
                'id' => 3,
                'title' => 'Massage Therapy',
                'slug' => 'massage-therapy',
                'excerpt' => 'Relaxing and therapeutic massage sessions',
                'link' => home_url('/gallery/massage-therapy'),
                'thumbnail' => get_theme_file_uri('resources/images/image-gallery.png'),
                'image_count' => 15,
            ],
            [
                'id' => 4,
                'title' => 'Nail Care',
                'slug' => 'nail-care',
                'excerpt' => 'Professional manicure and pedicure services',
                'link' => home_url('/gallery/nail-care'),
                'thumbnail' => get_theme_file_uri('resources/images/image-gallery.png'),
                'image_count' => 6,
            ],
            [
                'id' => 5,
                'title' => 'Nail Care',
                'slug' => 'nail-care',
                'excerpt' => 'Professional manicure and pedicure services',
                'link' => home_url('/gallery/nail-care'),
                'thumbnail' => get_theme_file_uri('resources/images/image-gallery.png'),
                'image_count' => 6,
            ],
            [
                'id' => 6,
                'title' => 'Nail Care',
                'slug' => 'nail-care',
                'excerpt' => 'Professional manicure and pedicure services',
                'link' => home_url('/gallery/nail-care'),
                'thumbnail' => get_theme_file_uri('resources/images/image-gallery.png'),
                'image_count' => 6,
            ],
            [
                'id' => 7,
                'title' => 'Nail Care',
                'slug' => 'nail-care',
                'excerpt' => 'Professional manicure and pedicure services',
                'link' => home_url('/gallery/nail-care'),
                'thumbnail' => get_theme_file_uri('resources/images/image-gallery.png'),
                'image_count' => 6,
            ],
            [
                'id' => 8,
                'title' => 'Nail Care',
                'slug' => 'nail-care',
                'excerpt' => 'Professional manicure and pedicure services',
                'link' => home_url('/gallery/nail-care'),
                'thumbnail' => get_theme_file_uri('resources/images/image-gallery.png'),
                'image_count' => 6,
            ],
            [
                'id' => 9,
                'title' => 'Nail Care',
                'slug' => 'nail-care',
                'excerpt' => 'Professional manicure and pedicure services',
                'link' => home_url('/gallery/nail-care'),
                'thumbnail' => get_theme_file_uri('resources/images/image-gallery.png'),
                'image_count' => 6,
            ],
            [
                'id' => 10,
                'title' => 'Nail Care',
                'slug' => 'nail-care',
                'excerpt' => 'Professional manicure and pedicure services',
                'link' => home_url('/gallery/nail-care'),
                'thumbnail' => get_theme_file_uri('resources/images/image-gallery.png'),
                'image_count' => 6,
            ],
            [
                'id' => 11,
                'title' => 'Nail Care',
                'slug' => 'nail-care',
                'excerpt' => 'Professional manicure and pedicure services',
                'link' => home_url('/gallery/nail-care'),
                'thumbnail' => get_theme_file_uri('resources/images/image-gallery.png'),
                'image_count' => 6,
            ],
            [
                'id' => 12,
                'title' => 'Nail Care',
                'slug' => 'nail-care',
                'excerpt' => 'Professional manicure and pedicure services',
                'link' => home_url('/gallery/nail-care'),
                'thumbnail' => get_theme_file_uri('resources/images/image-gallery.png'),
                'image_count' => 6,
            ],
            [
                'id' => 13,
                'title' => 'Nail Care',
                'slug' => 'nail-care',
                'excerpt' => 'Professional manicure and pedicure services',
                'link' => home_url('/gallery/nail-care'),
                'thumbnail' => get_theme_file_uri('resources/images/image-gallery.png'),
                'image_count' => 6,
            ],
            [
                'id' => 14,
                'title' => 'Nail Care',
                'slug' => 'nail-care',
                'excerpt' => 'Professional manicure and pedicure services',
                'link' => home_url('/gallery/nail-care'),
                'thumbnail' => get_theme_file_uri('resources/images/image-gallery.png'),
                'image_count' => 6,
            ],
        ];
    }

    /**
     * Get album thumbnail image
     *
     * @param int $album_id
     * @return string
     */
    private function getAlbumThumbnail($album_id)
    {
        // Try to get featured image first
        $thumbnail = get_the_post_thumbnail_url($album_id, 'medium');

        if ($thumbnail) {
            return $thumbnail;
        }

        // Try to get first image from gallery
        $gallery_images = $this->getAcfFieldSafe('album_images', $album_id, []);
        if (!empty($gallery_images) && isset($gallery_images[0])) {
            return $this->getImageFromField($gallery_images[0], '');
        }

        // Return placeholder
        return get_theme_file_uri('resources/images/image-gallery.png');
    }

    /**
     * Get count of images in album
     *
     * @param int $album_id
     * @return int
     */
    private function getAlbumImageCount($album_id)
    {
        $gallery_images = $this->getAcfFieldSafe('album_images', $album_id, []);
        return count($gallery_images);
    }

    /**
     * Get gallery settings
     *
     * @return array
     */
    private function getGallerySettings()
    {
        return [
            'gold_color' => $this->getAcfFieldSafe('gallery_gold_color', 'option', '#d1b07a'),
            'title' => $this->getAcfFieldSafe('gallery_title', 'option', 'Gallery'),
            'description' => $this->getAcfFieldSafe('gallery_description', 'option', ''),
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
     * @return string
     */
    private function getImageFromField($image_field, $fallback = '')
    {
        if (empty($image_field)) {
            return $fallback;
        }

        if (is_array($image_field) && isset($image_field['url'])) {
            return $image_field['url'];
        } elseif (is_string($image_field)) {
            return wp_get_attachment_image_url($image_field, 'full') ?: $image_field;
        } elseif (is_numeric($image_field)) {
            return wp_get_attachment_image_url($image_field, 'full') ?: $fallback;
        }

        return $fallback;
    }
}
