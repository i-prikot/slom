@php
    use App\Support\LandingContact as C;
@endphp

@props(['reviews'])

<section id="reviews" class="bg-background py-16 sm:py-20 lg:py-24">
    <div class="container-x">
        <div class="flex flex-col items-start gap-6 lg:flex-row lg:items-end lg:justify-between">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 rounded-full border border-primary/30 bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-primary">Отзывы клиентов</div>
                <h2 class="mt-4 font-display text-3xl font-bold tracking-tight sm:text-4xl lg:text-5xl">Нам ставят <span class="text-primary">{{ C::YANDEX_RATING }} ★</span><br class="hidden sm:block"> на Яндекс.Картах</h2>
                <p class="mt-4 text-base text-muted-foreground sm:text-lg">Реальные отзывы людей, для которых мы делали работу. Все можно проверить на Яндексе.</p>
            </div>
            <a href="{{ C::YANDEX_PROFILE_URL }}" target="_blank" rel="noopener" class="inline-flex items-center gap-3 rounded-xl border border-border bg-card px-4 py-3 shadow-card transition hover:border-primary/40 hover:shadow-elevated">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#FC3F1D] font-bold text-white">Я</div>
                <div><div class="flex items-center gap-1.5"><span class="font-display text-2xl font-bold leading-none">{{ C::YANDEX_RATING }}</span><span class="text-primary">★★★★★</span></div><div class="text-xs text-muted-foreground">Рейтинг на Яндекс.Картах</div></div>
            </a>
        </div>
        <div class="mt-12 grid gap-5 md:grid-cols-2">
            @foreach ($reviews as $review)
                <figure class="flex flex-col rounded-2xl border border-border bg-card p-6 shadow-card transition hover:-translate-y-0.5 hover:shadow-elevated">
                    <div class="flex items-start justify-between gap-3"><div class="flex items-center gap-3"><div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-secondary font-display text-lg font-bold text-secondary-foreground">{{ mb_substr($review['name'], 0, 1) }}</div><div><div class="font-semibold leading-tight">{{ $review['name'] }}</div><div class="text-[11px] text-muted-foreground">{{ $review['meta'] }}</div></div></div><div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-md bg-[#FC3F1D] text-xs font-bold text-white">Я</div></div>
                    <div class="mt-4 flex items-center justify-between"><span class="text-primary">★★★★★</span><span class="text-xs text-muted-foreground">{{ $review['date'] }}</span></div>
                    <blockquote class="mt-4 flex-1 text-sm leading-relaxed text-foreground/90">{{ $review['text'] }}</blockquote>
                </figure>
            @endforeach
        </div>
        <div class="mt-8 text-center">
            <a href="{{ C::YANDEX_PROFILE_URL }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-sm font-semibold text-foreground hover:text-primary">
                Смотреть все отзывы на Яндекс.Картах
                <x-icons.lucide name="external-link" class="h-4 w-4" />
            </a>
        </div>
    </div>
</section>
