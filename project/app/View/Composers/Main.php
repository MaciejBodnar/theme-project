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
            'main' => $this->getAboutData(),
        ];
    }

    private function getAboutData()
    {
        return [
            'hero' => $this->getHeroData(),
            'tiles' => $this->getGalleryTiles(),
            'team' => $this->getTeamData(),
            'certificates' => $this->getCertificatesData(),
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
                'src' => get_theme_file_uri('resources/images/gallery/fat-dissolving.jpg'),
                'label' => 'FAT dissolving Injections',
            ],
            [
                'src' => get_theme_file_uri('resources/images/gallery/sclerotherapy.jpg'),
                'label' => 'SCLEROtherapy'
            ],
            [
                'src' => get_theme_file_uri('resources/images/gallery/anti-wrinkles.jpg'),
                'label' => 'ANTI wrinkles treatment',
            ],
            [
                'src' => get_theme_file_uri('resources/images/gallery/waxing.jpg'),
                'label' => 'WAXing'
            ],
            [
                'src' => get_theme_file_uri('resources/images/gallery/skin-boosters.jpg'),
                'label' => 'SKIN Boosters'
            ],
            [
                'src' => get_theme_file_uri('resources/images/gallery/advanced-facials.jpg'),
                'label' => 'ADVANced facials'
            ],
            [
                'src' => get_theme_file_uri('resources/images/gallery/lash.jpg'),
                'label' => 'LASH extension'
            ],
            [
                'src' => get_theme_file_uri('resources/images/gallery/chemical-peel.jpg'),
                'label' => 'CHEMical Peel'
            ],
            [
                'src' => get_theme_file_uri('resources/images/gallery/eyes-brows.jpg'),
                'label' => 'EYES & Brows'
            ],
            [
                'src' => get_theme_file_uri('resources/images/gallery/manicures.jpg'),
                'label' => 'MANIcures & Pedicures'
            ],
            [
                'src' => get_theme_file_uri('resources/images/gallery/massage-spa.jpg'),
                'label' => 'MASSage & SPA'
            ],
            [
                'src' => get_theme_file_uri('resources/images/gallery/vitamins.jpg'),
                'label' => 'VITAmine Injections'
            ],
        ];
    }


    private function getHeroData()
    {
        return [
            'title' => $this->getAcfFieldSafe('hero_title', false, 'About us'),
            'description_1' => $this->getAcfFieldSafe(
                'hero_description_1',
                false,
                'Sweet Beauty is top rated beauty salon located in the heart of Leith in Edinburgh. We offer a wide range of services, such as traditional white facial cosmetology treatments, chemical peels, electrical and ultrasound treatments, aesthetic procedures, micro-sclerotherapy, fat dissolving injections, intramuscular vitamin injections, as well as cosmetic procedures including eyebrow tint, henna and shape, body waxing, massages, manicure and pedicure, eyelash lift and extension.'
            ),
            'description_2' => $this->getAcfFieldSafe(
                'hero_description_2',
                false,
                'At Sweet Beauty, we understand that everyone\'s skin is unique. That\'s why we personalise our services to your specific skin type. We have experience working with skin of people from all ethnic groups from Afro-Caribbean to Asian and European. This way, you can feel completely at ease.'
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
                get_theme_file_uri('resources/images/about/hero-model.png')
            ),
        ];
    }

    private function getTeamData()
    {
        $team_members = $this->getAcfFieldSafe('team_members', false, []);

        if (empty($team_members)) {
            // Default team data as fallback
            return [
                [
                    'name' => 'Weronika',
                    'image' => get_theme_file_uri('resources/images/about/team-1.jpg'),
                    'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy eirmod tempor.',
                ],
                [
                    'name' => 'Weronika',
                    'image' => get_theme_file_uri('resources/images/about/team-2.jpg'),
                    'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy eirmod tempor.',
                ],
                [
                    'name' => 'Weronika',
                    'image' => get_theme_file_uri('resources/images/about/team-3.jpg'),
                    'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy eirmod tempor.',
                ],
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

        return $processed_team;
    }

    private function getCertificatesData()
    {
        $certificates = $this->getAcfFieldSafe('certificates', false, []);

        if (empty($certificates)) {
            // Default certificates as fallback
            return [
                get_theme_file_uri('resources/images/about/cert-1.jpg'),
                get_theme_file_uri('resources/images/about/cert-2.jpg'),
                get_theme_file_uri('resources/images/about/cert-3.jpg'),
            ];
        }

        $processed_certs = [];
        foreach ($certificates as $cert) {
            $cert_url = $this->getImageFromField($cert['certificate_image'] ?? $cert, '');
            if (!empty($cert_url)) {
                $processed_certs[] = $cert_url;
            }
        }

        return $processed_certs;
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
            'testimonials' => $default_testimonials,
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
            'paragraphs' => [
                $this->getAcfFieldSafe('policy_paragraph_1', false, 'Relax, improved well-being and taking care of yourself should be possible for everyone, that is why the services I offer are affordable, but what\'s important, they go hand in hand with full professionalism.'),
                $this->getAcfFieldSafe('policy_paragraph_2', false, 'What counts for me is that my clients can afford regular visits – one-off treatments give a short-term effect and don\'t give permanent solution to most problems.'),
                $this->getAcfFieldSafe('policy_paragraph_3', false, 'I\'m still learning and training, each of my clients is treated individually and gives me the opportunity to expand my knowledge and skills.'),
                $this->getAcfFieldSafe('policy_paragraph_4', false, 'I am not a doctor – I do not make diagnoses. If something goes beyond my competence, I do not undertake the treatment.'),
                $this->getAcfFieldSafe('policy_paragraph_5', false, 'I do my best to provide comprehensive service to my clients. I believe that through hard work, constantly expanding my qualifications, knowledge and skills, I can make them trust me and feel special.'),
                $this->getAcfFieldSafe('policy_paragraph_6', false, 'I pride myself in great attention to detail.'),
            ],
        ];
    }

    private function getCtaData()
    {
        return [
            'title' => $this->getAcfFieldSafe('cta_title', false, 'Unlock your glow'),
            'view_more_text' => $this->getAcfFieldSafe('cta_view_more_text', false, 'VIEW more'),
            'view_more_url' => $this->getAcfFieldSafe('cta_view_more_url', false, '/reviews'),
            'book_now_text' => $this->getAcfFieldSafe('cta_book_now_text', false, 'BOOK now'),
            'book_now_url' => $this->getAcfFieldSafe('cta_book_now_url', false, '/book-now'),
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
