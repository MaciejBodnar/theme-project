<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class About extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'template-about',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'about' => $this->getAboutData(),
        ];
    }

    private function getAboutData()
    {
        return [
            'hero' => $this->getHeroData(),
            'team' => $this->getTeamData(),
            'certificates' => $this->getCertificatesData(),
            'testimonials' => $this->getTestimonialsData(),
            'buttons' => $this->getButtonsData(),
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
        ];
    }

    private function getTeamData()
    {
        $team_members = $this->getAcfFieldSafe('team_members', false, []);
        $team_title = $this->getAcfFieldSafe('team_title', false, 'Our Team');

        if (empty($team_members)) {
            // Default team data as fallback
            return [
                'title' => $team_title,
                'members' => [
                    [
                        'name' => 'Weronika',
                        'image' => get_theme_file_uri('resources/images/image-team.png'),
                        'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy eirmod tempor.',
                    ],
                    [
                        'name' => 'Weronika',
                        'image' => get_theme_file_uri('resources/images/image-team.png'),
                        'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy eirmod tempor.',
                    ],
                    [
                        'name' => 'Weronika',
                        'image' => get_theme_file_uri('resources/images/image-team.png'),
                        'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy eirmod tempor.',
                    ],
                ],
                'background_image' => $this->getAcfImageSafe(
                    'team_background_image',
                    false,
                    'full',
                    get_theme_file_uri('resources/images/image-backgroundv3.png')
                ),
            ];
        }

        $processed_team = [];
        foreach ($team_members as $member) {
            $processed_team[] = [
                'name' => $member['name'] ?? 'Team Member',
                'image' => $this->getImageFromField($member['image'] ?? null, get_theme_file_uri('resources/images/about/team-placeholder.jpg')),
                'bio' => $member['bio'] ?? '',
            ];
        }

        return [
            'title' => $team_title,
            'members' => $processed_team,
            'background_image' => $this->getAcfImageSafe(
                'team_background_image',
                false,
                'full',
                get_theme_file_uri('resources/images/image-backgroundv3.png')
            ),
        ];
    }

    private function getCertificatesData()
    {
        $certificates = $this->getAcfFieldSafe('certificates', false, []);
        $certificates_title = $this->getAcfFieldSafe('certificates_title', false, '');

        if (empty($certificates)) {
            // Default certificates as fallback
            return [
                'title' => $certificates_title,
                'images' => [
                    get_theme_file_uri('resources/images/image-certificates.png'),
                    get_theme_file_uri('resources/images/image-instagram.png'),
                    get_theme_file_uri('resources/images/image-certificates.png'),
                ],
            ];
        }

        $processed_certs = [];
        foreach ($certificates as $cert) {
            $cert_url = $this->getImageFromField($cert['certificate_image'] ?? $cert, '');
            if (!empty($cert_url)) {
                $processed_certs[] = $cert_url;
            }
        }

        return [
            'title' => $certificates_title,
            'images' => $processed_certs,
        ];
    }

    private function getTestimonialsData()
    {
        $testimonials = $this->getAcfFieldSafe('testimonials', false, []);
        $testimonials_title = $this->getAcfFieldSafe('testimonials_title', false, 'Testimonials');

        if (empty($testimonials)) {
            // Default testimonials as fallback
            return [
                'title' => $testimonials_title,
                'items' => [
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
                ],
            ];
        }

        $processed_testimonials = [];
        foreach ($testimonials as $testimonial) {
            $processed_testimonials[] = [
                'text' => $testimonial['text'] ?? $testimonial['testimonial_text'] ?? '',
                'name' => strtoupper($testimonial['name'] ?? $testimonial['client_name'] ?? 'Anonymous'),
            ];
        }

        return [
            'title' => $testimonials_title,
            'items' => $processed_testimonials,
        ];
    }

    private function getButtonsData()
    {
        $buttons = $this->getAcfFieldSafe('testimonial_buttons', false, []);

        if (empty($buttons)) {
            // Default buttons as fallback
            return [
                [
                    'text' => 'VIEW more',
                    'url' => '/reviews',
                    'icon' => 'fas fa-arrow-right',
                ],
                [
                    'text' => 'BOOK now',
                    'url' => '/book-now',
                ],
            ];
        }

        $processed_buttons = [];
        foreach ($buttons as $button) {
            $processed_buttons[] = [
                'text' => $button['button_text'] ?? $button['text'] ?? 'Button',
                'url' => $button['button_url'] ?? $button['url'] ?? '#',
                'icon' => $button['button_icon'] ?? $button['icon'] ?? '',
            ];
        }

        return $processed_buttons;
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
