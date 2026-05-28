@php
    use App\Support\LandingContact as C;
@endphp

<section class="relative isolate overflow-hidden bg-secondary py-16 text-white sm:py-20">
    <div class="absolute inset-0 -z-10 opacity-25">
        <img src="{{ Vite::asset('resources/images/hero-cutting.jpg') }}" alt="" class="h-full w-full object-cover">
        <div class="absolute inset-0 bg-secondary/70"></div>
    </div>
    <div class="container-x">
        <div class="grid items-center gap-8 lg:grid-cols-2">
            <div><h2 class="font-display text-3xl font-bold leading-tight sm:text-4xl">Нужно срочно? Позвоните — <span class="text-primary">подскажем решение уже сейчас!</span></h2><p class="mt-3 text-white/70">Ответим за 5 минут. Назовём точную цену по телефону.</p></div>
            <div class="rounded-2xl border border-white/10 bg-black/40 p-6 backdrop-blur-md">
                <a href="tel:{{ C::PHONE_TEL }}" class="block text-center font-display text-3xl font-bold tracking-tight hover:text-primary sm:text-4xl">{{ C::PHONE_DISPLAY }}</a>
                <p class="mt-2 text-center text-sm text-white/60">Ответим за 5 минут</p>
                <div class="mt-5 grid gap-3 sm:grid-cols-3">
                    <a href="tel:{{ C::PHONE_TEL }}" onclick="window.slomTrackCTA && window.slomTrackCTA('phone', 'final_btn')">
                        <span class="inline-flex h-14 w-full items-center justify-center gap-2 rounded-xl bg-yellow-gradient px-8 text-base font-semibold text-primary-foreground shadow-cta transition hover:brightness-105 active:brightness-95"><x-icons.lucide name="phone" class="h-5 w-5" /> Позвонить</span>
                    </a>
                    <a href="{{ C::messengerUrl(C::WHATSAPP_URL) }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('whatsapp', 'final')">
                        <span class="inline-flex h-14 w-full items-center justify-center gap-2 rounded-xl bg-whatsapp px-8 text-base font-semibold text-whatsapp-foreground transition hover:bg-whatsapp/90"><x-icons.lucide name="message-circle" class="h-5 w-5" /> WhatsApp</span>
                    </a>
                    <a href="{{ C::messengerUrl(C::TELEGRAM_URL) }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('telegram', 'final')">
                        <span class="inline-flex h-14 w-full items-center justify-center gap-2 rounded-xl bg-telegram px-8 text-base font-semibold text-telegram-foreground transition hover:bg-telegram/90"><x-icons.lucide name="send" class="h-5 w-5" /> Telegram</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
