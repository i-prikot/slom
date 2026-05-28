@php
    use App\Support\LandingContact as C;
@endphp

<section class="relative isolate overflow-hidden bg-secondary text-white">
    <div class="absolute inset-0 -z-10">
        <img src="{{ Vite::asset('resources/images/hero-cutting.jpg') }}" alt="Алмазная резка бетона" class="h-full w-full object-cover object-center">
        <div class="absolute inset-0 bg-overlay-gradient"></div>
    </div>
    <div class="container-x relative pb-10 pt-24 sm:pt-28 lg:pb-14 lg:pt-32">
        <div class="grid gap-10 lg:grid-cols-12 lg:gap-8">
            <div class="lg:col-span-7">
                <a href="{{ C::YANDEX_PROFILE_URL }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3 py-1.5 text-xs font-medium text-white backdrop-blur transition hover:bg-white/15">
                    <span class="flex h-5 w-5 items-center justify-center rounded bg-[#FC3F1D] text-[10px] font-bold">Я</span>
                    <span class="font-bold">{{ C::YANDEX_RATING }}</span>
                    <span class="flex gap-0.5 text-primary">
                        @for ($i = 0; $i < 5; $i++)
                            <x-icons.lucide name="star" class="h-3 w-3 fill-current" />
                        @endfor
                    </span>
                    <span class="text-white/70">на Яндекс.Картах</span>
                    <x-icons.lucide name="external-link" class="h-3 w-3 text-white/50" />
                </a>
                <h1 class="mt-4 font-display text-4xl font-bold leading-[1.05] tracking-tight sm:text-5xl lg:text-[3.5rem]">
                    Алмазная резка и бурение бетона <br class="hidden sm:block">
                    <span class="text-primary">в {{ C::CITY }}е — приедем за 60 минут</span>
                </h1>
                <p class="mt-4 max-w-xl text-base text-white/75 sm:text-lg">Точную цену называем по телефону за 2 минуты. Работаем без трещин и пыли, с гарантией.</p>
                <div class="mt-7 max-w-xl">
                    <livewire:landing.hero-lead-form />
                    <div class="mt-5 flex flex-wrap items-center gap-x-5 gap-y-3">
                        <div class="flex items-center gap-2.5">
                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-primary text-primary-foreground">
                                <x-icons.lucide name="phone" class="h-4 w-4" />
                            </span>
                            <div class="leading-tight">
                                <a href="tel:{{ C::PHONE_TEL }}" onclick="window.slomTrackCTA && window.slomTrackCTA('phone', 'hero_main')" class="block font-display text-xl font-bold tracking-tight text-white hover:text-primary sm:text-2xl">{{ C::PHONE_DISPLAY }}</a>
                                <span class="inline-flex items-center gap-1.5 text-[11px] text-white/60">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_0_3px_rgba(52,211,153,0.2)]"></span>
                                    <x-icons.lucide name="clock" class="h-3 w-3" /> Сейчас отвечаем
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 sm:ml-auto">
                            <a href="{{ C::messengerUrl(C::WHATSAPP_URL, 'hero') }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('whatsapp', 'hero')" aria-label="Написать в WhatsApp" class="flex h-11 w-11 items-center justify-center rounded-full bg-whatsapp text-whatsapp-foreground transition hover:brightness-110"><x-icons.lucide name="message-circle" class="h-5 w-5" /></a>
                            <a href="{{ C::messengerUrl(C::TELEGRAM_URL, 'hero') }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('telegram', 'hero')" aria-label="Написать в Telegram" class="flex h-11 w-11 items-center justify-center rounded-full bg-telegram text-telegram-foreground transition hover:brightness-110"><x-icons.lucide name="send" class="h-5 w-5" /></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
