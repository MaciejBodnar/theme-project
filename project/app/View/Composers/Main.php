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
            'tiles' => $this->getGalleryTiles(),
            'gallery' => $this->getGalleryData(),
            'testimonials' => $this->getTestimonialsData(),
            'statistics' => $this->getStatisticsData(),
            'policy' => $this->getPolicyData(),
            'cta_section' => $this->getCtaData(),
            'settings' => $this->getSettingsData(),
        ];
    }

    private function getGalleryTiles()
    {
        // Check for ACF gallery field first
        if (function_exists('get_field')) {
            $acf_gallery = \get_field('gallery_tiles');
            if ($acf_gallery && is_array($acf_gallery)) {
                $tiles = [];
                foreach ($acf_gallery as $item) {
                    if (is_array($item)) {
                        $tiles[] = [
                            'href' => $item['href'] ?? '',
                            'src' => $item['image']['url'] ?? $item['url'] ?? '',
                            'label' => $item['label'] ?? $item['title'] ?? '',
                        ];
                    }
                }
                if (!empty($tiles)) {
                    return $tiles;
                }
            }
        }

        // Fallback to hardcoded tiles
        return [
            [
                'src' => get_theme_file_uri('resources/images/image-gallery.png'),
                'label' => 'FAT dissolving Injections',
                'href' => '#'
            ],
            [
                'src' => get_theme_file_uri('resources/images/image-gallery.png'),
                'label' => 'SCLEROtherapy',
                'href' => '#'
            ],
            [
                'src' => get_theme_file_uri('resources/images/image-gallery.png'),
                'label' => 'ANTI wrinkles treatment',
                'href' => '#'
            ],
            [
                'src' => get_theme_file_uri('resources/images/image-gallery.png'),
                'label' => 'WAXing',
                'href' => '#'
            ],
            [
                'src' => get_theme_file_uri('resources/images/image-gallery.png'),
                'label' => 'SKIN Boosters',
                'href' => '#'
            ],
            [
                'src' => get_theme_file_uri('resources/images/image-gallery.png'),
                'label' => 'ADVANced facials',
                'href' => '#'
            ],
            [
                'src' => get_theme_file_uri('resources/images/image-gallery.png'),
                'label' => 'LASH extension',
                'href' => '#'
            ],
            [
                'src' => get_theme_file_uri('resources/images/image-gallery.png'),
                'label' => 'CHEMical Peel',
                'href' => '#'
            ],
            [
                'src' => get_theme_file_uri('resources/images/image-gallery.png'),
                'label' => 'EYES & Brows',
                'href' => '#'
            ],
            [
                'src' => get_theme_file_uri('resources/images/image-gallery.png'),
                'label' => 'MANIcures & Pedicures',
                'href' => '#'
            ],
            [
                'src' => get_theme_file_uri('resources/images/image-gallery.png'),
                'label' => 'MASSage & SPA',
                'href' => '#'
            ],
            [
                'src' => get_theme_file_uri('resources/images/image-gallery.png'),
                'label' => 'VITAmine Injections',
                'href' => $this->getAcfUrlSafe('href', false, '/gallery')
            ],
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
            'title' => $this->getAcfFieldSafe('hero_title', false, 'About us'),
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
                get_theme_file_uri('resources/images/logo.png')
            ),
            'hero_background' => $this->getAcfImageSafe(
                'hero_background',
                false,
                'full',
                get_theme_file_uri('resources/images/image-backgroundv3.png')
            ),
            'hero_button_text' => $this->getAcfFieldSafe('hero_button_text', false, 'Check our services'),
            'hero_button_url' => $this->getAcfUrlSafe('hero_button_url', false, '/gallery'),
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
        ];
    }

    private function getSettingsData()
    {
        return [
            'gold_color' => $this->getAcfFieldSafe('gold_color', false, '#d1b07a'),
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
}
