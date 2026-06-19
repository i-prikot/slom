<?php

declare(strict_types=1);

namespace App\Support;

use App\Models\LandingSettings;
use App\ViewModels\HomePageViewModel;

final class StructuredData
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function forHome(HomePageViewModel $vm): array
    {
        $siteUrl = route('home');
        $siteId = $siteUrl.'#website';
        $organizationId = $siteUrl.'#organization';

        return [
            self::website($siteId, $organizationId),
            self::localBusiness($organizationId, $vm),
            self::faqPage($vm),
            self::offerCatalog($vm),
        ];
    }

    /**
     * @return list<array<string, mixed>>
     */
    public static function forWebPage(string $name, string $description, string $url): array
    {
        $siteUrl = route('home');
        $siteId = $siteUrl.'#website';

        return [
            [
                '@context' => 'https://schema.org',
                '@type' => 'WebPage',
                'name' => $name,
                'description' => $description,
                'url' => $url,
                'inLanguage' => 'ru',
                'isPartOf' => [
                    '@id' => $siteId,
                ],
            ],
            self::website($siteId, $siteUrl.'#organization'),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private static function website(string $siteId, string $organizationId): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            '@id' => $siteId,
            'name' => config('seo.site_name'),
            'url' => route('home'),
            'inLanguage' => 'ru',
            'publisher' => [
                '@id' => $organizationId,
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private static function localBusiness(string $organizationId, HomePageViewModel $vm): array
    {
        $sameAs = array_values(array_filter([
            LandingContact::yandexProfileUrl(),
        ]));

        $business = [
            '@context' => 'https://schema.org',
            '@type' => ['LocalBusiness', 'HomeAndConstructionBusiness'],
            '@id' => $organizationId,
            'name' => LandingContact::company(),
            'url' => route('home'),
            'telephone' => LandingContact::phoneTel(),
            'email' => LandingContact::email(),
            'address' => self::postalAddress(),
            'openingHoursSpecification' => self::openingHours(),
            'areaServed' => array_map(
                static fn (string $city): array => [
                    '@type' => 'City',
                    'name' => $city,
                ],
                $vm->serviceAreaCities,
            ),
        ];

        if ($sameAs !== []) {
            $business['sameAs'] = $sameAs;
        }

        return $business;
    }

    /**
     * @return array<string, mixed>
     */
    private static function faqPage(HomePageViewModel $vm): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => array_map(
                static fn (array $faq): array => [
                    '@type' => 'Question',
                    'name' => $faq['question'],
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $faq['answer'],
                    ],
                ],
                $vm->faqs,
            ),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private static function offerCatalog(HomePageViewModel $vm): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'OfferCatalog',
            'name' => 'Услуги '.LandingContact::company(),
            'itemListElement' => array_map(
                static fn (array $service): array => [
                    '@type' => 'Offer',
                    'itemOffered' => [
                        '@type' => 'Service',
                        'name' => $service['title'],
                        'description' => $service['text'],
                        'provider' => [
                            '@type' => 'LocalBusiness',
                            'name' => LandingContact::company(),
                            'url' => route('home'),
                        ],
                    ],
                ],
                $vm->services,
            ),
        ];
    }

    /**
     * @return array<string, string>
     */
    private static function postalAddress(): array
    {
        $address = LandingContact::address();
        $city = LandingContact::city();
        $streetAddress = $address;

        if (str_starts_with($address, $city)) {
            $streetAddress = trim(substr($address, strlen($city)), ' ,');
        }

        return [
            '@type' => 'PostalAddress',
            'streetAddress' => $streetAddress,
            'addressLocality' => $city,
            'addressCountry' => 'RU',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private static function openingHours(): array
    {
        $settings = LandingSettings::instance();

        return [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => [
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday',
                'Sunday',
            ],
            'opens' => sprintf('%02d:00', $settings->work_hours_start),
            'closes' => sprintf('%02d:00', $settings->work_hours_end),
        ];
    }
}
