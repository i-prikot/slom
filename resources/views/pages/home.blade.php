<x-layouts.app
    :title="'Алмазная резка и бурение бетона в Красноярске — СЛОМ24'"
    :metaTitle="'СЛОМ24 — Алмазная резка и бурение бетона'"
    :metaDescription="'Алмазная резка, бурение и демонтаж бетона в Красноярске и крае. Приезд за 60 минут, точная цена за 2 минуты.'"
    :canonicalUrl="route('home')"
    :structuredData="$structuredData"
>
    <main class="min-h-screen lg:pb-0" x-data x-init="window.initHomeCallbackTrigger?.()">
        <x-landing.home.header />
        <x-landing.home.hero />
        <x-landing.home.quick-prices-strip />
        <x-landing.home.emergency-banner />
        <x-landing.home.benefits-grid :benefits="$vm->benefits" />
        <x-landing.home.services-grid :services="$vm->services" />
        <x-landing.home.pricing-section
            :cutting-prices="$vm->cuttingPrices"
            :drilling-prices="$vm->drillingPrices"
            :opening-prices="$vm->openingPrices"
            :demolition-prices="$vm->demolitionPrices"
            :coefficients="$vm->coefficients"
            :coefficient-labels="$vm->coefficientLabels"
        />

        <x-landing.home.cases-section :cases="$vm->cases" />
        <x-landing.home.work-steps :work-steps="$vm->workSteps" />

        <x-landing.home.service-area :cities="$vm->serviceAreaCities" />

        <x-landing.home.trust-proof
            :trust-stats="$vm->trustStats"
            :trust-documents="$vm->trustDocuments"
            :trust-clients="$vm->trustClients"
        />
        <x-landing.home.certificates-section :certificates="$vm->certificates" />
        <x-landing.home.reviews-section :reviews="$vm->reviews" />
        <x-landing.home.team-section :team-members="$vm->teamMembers" />
        <x-landing.home.faq-section :faqs="$vm->faqs" />
        <x-landing.home.final-cta />

        <x-landing.home.footer />
        <x-landing.home.sticky-cta />
        <x-landing.home.callback-trigger-script />

        <livewire:landing.callback-dialog />
        <x-landing.cookie-consent />
    </main>
</x-layouts.app>
