<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Main extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'front-page',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'main' => $this->getMainData(),
        ];
    }

    private function getMainData()
    {
        return [
            'hero' => $this->getHeroData(),
            'gallery' => $this->getGalleryData(),
            'testimonials' => $this->getTestimonialsData(),
            'statistics' => $this->getStatisticsData(),
            'policy' => $this->getPolicyData(),
            'cta_section' => $this->getCtaData(),
            'settings' => $this->getSettingsData(),
            'instagram' => $this->getInstagramData(),
            'social' => $this->getSocialData(),
            'contact' => $this->getContactData(),
            'albums' => $this->getAlbums(),
        ];
    }

    private function getGalleryData()
    {
        return [
            'button_text' => $this->getAcfFieldSafe('gallery_button_text', false, 'BOOK now'),
            'button_url' => $this->getAcfUrlSafe('gallery_button_url', false, '/book-now'),
        ];
    }


    private function getHeroData()
    {
        return [
            'title' => $this->getAcfFieldSafe('hero_title', false, 'O NAS TUTAJ JEST POLSKI'),
            'description' => $this->getAcfFieldSafe(
                'hero_description',
                false,
                'Sweet Beauty is top rated beauty salon located in the heart of Leith in Edinburgh. We offer a wide range of services, such as traditional white facial cosmetology treatments, chemical peels, electrical and ultrasound treatments, aesthetic procedures, micro-sclerotherapy, fat dissolving injections, intramuscular vitamin injections, as well as cosmetic procedures including eyebrow tint, henna and shape, body waxing, massages, manicure and pedicure, eyelash lift and extension.'
            ),
            'salon_title' => $this->getAcfFieldSafe('salon_title', false, 'Our Salon'),
            'salon_description' => $this->getAcfFieldSafe(
                'salon_description',
                false,
                'We have 3 treatment rooms, one of which has 3 beds and one with 2 beds, 3 manicure desks and 2 eyebrow styling places. We organize trainings and sublet rooms to independent trainers. Feel free to contact us!'
            ),
            'opening_hours' => $this->getAcfFieldSafe(
                'opening_hours',
                false,
                'Monday – Saturday 10:00 – 21:00<br>Sunday 10:00 – 18:00'
            ),
            'hero_image' => $this->getAcfImageSafe(
                'hero_image',
                false,
                'full',
                get_theme_file_uri('resources/images/image-hero.png')
            ),
            'hero_logo' => $this->getAcfImageSafe(
                'hero_logo',
                false,
                'full',
                get_theme_file_uri('resources/images/OG.png')
            ),
            'hero_background' => $this->getAcfImageSafe(
                'hero_background',
                false,
                'full',
                get_theme_file_uri('resources/images/OG.png')
            ),
            'hero_button_text' => $this->getAcfFieldSafe('hero_button_text', false, 'More about us'),
            'hero_button_url' => $this->getAcfUrlSafe('hero_button_url', false, '/about-us'),
        ];
    }


    private function getTestimonialsData()
    {
        $testimonials = $this->getAcfFieldSafe('testimonials', false, []);

        if (empty($testimonials)) {
            // Default testimonials as fallback
            $default_testimonials = [
                [
                    'text' => 'Weronika is fantastic. Very qualified. I was trying a lots of different things as I have a very problematic skin. Thanks to Weronika for the first time I believe that my skin can be clear and healthy. She is a very professional and knowledgeable beauty specialist. I highly recommend all her services.',
                    'name' => 'PAMELA K.',
                ],
                [
                    'text' => 'Weronika is absolutely amazing!!! I had my waxing done a few times now and won\'t go anywhere else xx',
                    'name' => 'IWONA G.',
                ],
                [
                    'text' => 'After the first visits today with Weronika I\'ve became her loyal client. So much knowledge and professionalism that you trust her straight away. The atmosphere in the beauty room is very relaxing and foremost hygienic; for those who care about healthy environment you would definitely appreciate Weronika\'s careful approach to your skin. Plenty of specialised equipment and high quality products in use. I would definitely recommend Sweet Beauty Edinburgh.',
                    'name' => 'KATIE W.',
                ],
            ];
        } else {
            $default_testimonials = [];
            foreach ($testimonials as $testimonial) {
                $default_testimonials[] = [
                    'text' => $testimonial['text'] ?? $testimonial['testimonial_text'] ?? '',
                    'name' => strtoupper($testimonial['name'] ?? $testimonial['client_name'] ?? 'Anonymous'),
                ];
            }
        }

        return [
            'title' => $this->getAcfFieldSafe('testimonials_title', false, 'Testimonials'),
            'image' => $this->getAcfImageSafe('testimonials_image', false, 'full', get_theme_file_uri('resources/images/image-testimonials.png')),
            'testimonials' => $default_testimonials,
            'cta_view_more' => $this->getAcfFieldSafe('testimonials_cta_view_more', false, 'View More'),
            'cta_view_more_icon' => $this->getAcfFieldSafe(
                'testimonials_cta_view_more_icon',
                false,
                'fa-solid fa-arrow-up-right-from-square'
            ),
            'cta_view_more_url' => $this->getAcfUrlSafe('testimonials_cta_view_more_url', false, '/gallery'),
            'cta_book_now' => $this->getAcfFieldSafe('testimonials_cta_book_now', false, 'Book Now'),
            'cta_book_now_url' => $this->getAcfUrlSafe('testimonials_cta_book_now_url', false, '/rent'),
        ];
    }

    private function getStatisticsData()
    {
        return [
            'clients' => [
                'number' => $this->getAcfFieldSafe('stats_clients_number', false, '500'),
                'label' => $this->getAcfFieldSafe('stats_clients_label', false, 'Clients'),
            ],
            'treatments' => [
                'number' => $this->getAcfFieldSafe('stats_treatments_number', false, '40'),
                'label' => $this->getAcfFieldSafe('stats_treatments_label', false, 'Treatments'),
            ],
            'experience' => [
                'number' => $this->getAcfFieldSafe('stats_experience_number', false, '10k+'),
                'label' => $this->getAcfFieldSafe('stats_experience_label', false, 'Hours of Experience'),
            ],
            'products' => [
                'number' => $this->getAcfFieldSafe('stats_products_number', false, '95'),
                'label' => $this->getAcfFieldSafe('stats_products_label', false, 'Products'),
            ],
        ];
    }

    private function getPolicyData()
    {
        return [
            'title' => $this->getAcfFieldSafe('policy_title', false, 'My policy'),
            'paragraph' => $this->getAcfFieldSafe(
                'policy_paragraph',
                false,
                'Relax, improved well-being and taking care of yourself should be possible for everyone, that is why the services I offer are affordable, but what’s important, they go hand in hand with full professionalism.
                <br><br>What counts for me is that my clients can afford regular visits – one-off treatments give a short-term effect and don’t give permanent solution to most problems.
                <br><br>I’m still learning and training, each of my clients is treated individually and gives me the opportunity to expand my knowledge and skills.
                <br><br>I am not a doctor – I do not make diagnoses, if something goes beyond my competence, I do not undertake the treatment.
                <br><br>I do my best to provide comprehensive service to my clients. I believe that through hard work, constantly expanding my qualifications, knowledge and skills, I can make them trust me and feel special.
                <br><br>I pride myself in great attention to detail.'
            ),
        ];
    }

    private function getCtaData()
    {
        return [
            'title' => $this->getAcfFieldSafe('cta_title', false, 'Unlock your glow'),
            'view_more_text' => $this->getAcfFieldSafe('cta_view_more_text', false, 'VIEW more'),
            'view_more_url' => $this->getAcfUrlSafe('cta_view_more_url', false, '/reviews'),
            'book_now_text' => $this->getAcfFieldSafe('cta_book_now_text', false, 'BOOK now'),
            'book_now_url' => $this->getAcfUrlSafe('cta_book_now_url', false, '/book-now'),
            'background' => $this->getAcfImageSafe(
                'cta_background',
                false,
                'full',
                get_theme_file_uri('resources/images/image-backgroundv3.png')
            ),
        ];
    }

    private function getSettingsData()
    {
        return [
            'copyright_text' => $this->getAcfFieldSafe('footer_copyright_text', false, 'Sweet Beauty Edinburgh LTD – D&C with <span class="text-white/80">SLT Media</span>'),
        ];
    }

    /**
     * Get Instagram section data
     *
     * @return array
     */
    private function getInstagramData()
    {
        $instagram_images = $this->getAcfFieldSafe('footer_instagram_images', false, []);

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
            'title' => $this->getAcfFieldSafe('footer_instagram_title', false, 'Instagram'),
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
            ],
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
                'title' => 'Fat Dissolving Injections',
                'slug' => 'fat-dissolving-injections',
                'excerpt' => 'Professional fat dissolving injections and procedures',
                'link' => home_url('/gallery/fat-dissolving-injections'),
                'thumbnail' => get_theme_file_uri('resources/images/gallery-1.png'),
                'image_count' => 12,
            ],
            [
                'id' => 2,
                'title' => 'Sclerotherapy',
                'slug' => 'sclerotherapy',
                'excerpt' => 'Advanced sclerotherapy treatments and solutions',
                'link' => home_url('/gallery/sclerotherapy'),
                'thumbnail' => get_theme_file_uri('resources/images/gallery-2.png'),
                'image_count' => 8,
            ],
            [
                'id' => 3,
                'title' => 'Anti wrinkles treatment',
                'slug' => 'anti-wrinkles-treatment',
                'excerpt' => 'Advanced anti-wrinkles treatments and solutions',
                'link' => home_url('/gallery/anti-wrinkles-treatment'),
                'thumbnail' => get_theme_file_uri('resources/images/gallery-3.png'),
                'image_count' => 15,
            ],
            [
                'id' => 4,
                'title' => 'Waxing',
                'slug' => 'waxing',
                'excerpt' => 'Professional waxing services for smooth skin',
                'link' => home_url('/gallery/waxing'),
                'thumbnail' => get_theme_file_uri('resources/images/gallery-4.png'),
                'image_count' => 6,
            ],
            [
                'id' => 5,
                'title' => 'Skin boosters',
                'slug' => 'skin-boosters',
                'excerpt' => 'Advanced skin booster treatments and solutions',
                'link' => home_url('/gallery/skin-boosters'),
                'thumbnail' => get_theme_file_uri('resources/images/gallery-5.png'),
                'image_count' => 6,
            ],
            [
                'id' => 6,
                'title' => 'Advanced Facials',
                'slug' => 'advanced-facials',
                'excerpt' => 'Professional facial treatments and solutions',
                'link' => home_url('/gallery/advanced-facials'),
                'thumbnail' => get_theme_file_uri('resources/images/gallery-6.png'),
                'image_count' => 6,
            ],
            [
                'id' => 7,
                'title' => 'Lash Extensions',
                'slug' => 'lash-extensions',
                'excerpt' => 'Professional lash extension services',
                'link' => home_url('/gallery/lash-extensions'),
                'thumbnail' => get_theme_file_uri('resources/images/gallery-7.png'),
                'image_count' => 6,
            ],
            [
                'id' => 8,
                'title' => 'Chemical Peels',
                'slug' => 'chemical-peels',
                'excerpt' => 'Professional chemical peel treatments',
                'link' => home_url('/gallery/chemical-peels'),
                'thumbnail' => get_theme_file_uri('resources/images/gallery-8.png'),
                'image_count' => 6,
            ],
            [
                'id' => 9,
                'title' => 'Eyes & Brows',
                'slug' => 'eyes-brows',
                'excerpt' => 'Professional eyebrow and eyelash services',
                'link' => home_url('/gallery/eyes-brows'),
                'thumbnail' => get_theme_file_uri('resources/images/gallery-9.png'),
                'image_count' => 6,
            ],
            [
                'id' => 10,
                'title' => 'Manicures & Pedicures',
                'slug' => 'manicures-pedicures',
                'excerpt' => 'Professional manicure and pedicure services',
                'link' => home_url('/gallery/manicures-pedicures'),
                'thumbnail' => get_theme_file_uri('resources/images/gallery-10.png'),
                'image_count' => 6,
            ],
            [
                'id' => 11,
                'title' => 'Massage & SPA',
                'slug' => 'massage-spa',
                'excerpt' => 'Professional massage and spa services',
                'link' => home_url('/gallery/massage-spa'),
                'thumbnail' => get_theme_file_uri('resources/images/gallery-11.png'),
                'image_count' => 6,
            ],
            [
                'id' => 12,
                'title' => 'Vitamins Injections',
                'slug' => 'vitamins-injections',
                'excerpt' => 'Professional vitamin injection services',
                'link' => home_url('/gallery/vitamins-injections'),
                'thumbnail' => get_theme_file_uri('resources/images/gallery-12.png'),
                'image_count' => 6,
            ],
            [
                'id' => 13,
                'title' => 'Packages',
                'slug' => 'packages',
                'excerpt' => 'Professional packages for various services',
                'link' => home_url('/gallery/packages'),
                'thumbnail' => get_theme_file_uri('resources/images/gallery-13.png'),
                'image_count' => 6,
            ],
            [
                'id' => 14,
                'title' => 'Facial & Electrical Treatments',
                'slug' => 'facial-electrical-treatments',
                'excerpt' => 'Professional facial and electrical treatments',
                'link' => home_url('/gallery/facial-electrical-treatments'),
                'thumbnail' => get_theme_file_uri('resources/images/gallery-14.png'),
                'image_count' => 6,
            ],
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

    /**
     * Safe ACF URL field retrieval with automatic base URL prepending
     *
     * @param string $field_name
     * @param mixed $post_id
     * @param string $fallback
     * @return string
     */
    private function getAcfUrlSafe($field_name, $post_id = false, $fallback = '')
    {
        $url = $this->getAcfFieldSafe($field_name, $post_id, $fallback);

        // If the URL starts with a slash, it's a relative URL, so prepend the home URL
        if (!empty($url) && strpos($url, '/') === 0) {
            return home_url($url);
        }

        // If it's already a full URL (starts with http:// or https://) or empty, return as is
        return $url;
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
}
