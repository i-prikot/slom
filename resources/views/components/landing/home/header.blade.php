@php
    use App\Support\LandingContact as C;
@endphp

<header class="absolute inset-x-0 top-0 z-30">
    <div class="container-x flex items-center justify-between gap-3 py-4 sm:py-5">
        <a href="#" class="cursor-pointer flex items-center gap-3" aria-label="{{ C::company() }} — алмазная резка и бурение в {{ C::city() }}е">
            <img src="{{ Vite::asset('resources/images/logo-dark.png') }}" alt="{{ C::company() }} — алмазная резка и бурение в {{ C::city() }}е" class="h-11 w-auto sm:h-14">
        </a>
        <div class="flex items-center gap-2 sm:gap-3">
            <div class="hidden text-right md:block">
                <a href="tel:{{ C::phoneTel() }}" class="mcn-phone cursor-pointer block text-lg font-bold text-white hover:text-primary">{{ C::phoneDisplay() }}</a>
                <span class="inline-flex items-center gap-1.5 text-xs text-white/60">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_0_3px_rgba(52,211,153,0.2)]"></span>
                    Сейчас отвечаем · {{ C::workHoursLabel() }}
                </span>
            </div>
            @if (C::showWhatsApp())
                <a href="{{ C::messengerUrl(C::whatsappUrl()) }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('whatsapp', 'header')" aria-label="Написать в WhatsApp" class="cursor-pointer hidden h-10 w-10 items-center justify-center rounded-md bg-whatsapp text-whatsapp-foreground hover:brightness-110 sm:inline-flex"><x-icons.lucide name="message-circle" class="h-5 w-5" /></a>
            @endif
            @if (C::showTelegram())
                <a href="{{ C::messengerUrl(C::telegramUrl()) }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('telegram', 'header')" aria-label="Написать в Telegram" class="cursor-pointer hidden h-10 w-10 items-center justify-center rounded-md bg-telegram text-telegram-foreground hover:brightness-110 sm:inline-flex"><x-icons.lucide name="send" class="h-5 w-5" /></a>
            @endif
            @if (C::showMax())
                <a href="{{ C::maxUrl() }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('max', 'header')" aria-label="Написать в Max" class="cursor-pointer hidden h-10 w-10 items-center justify-center rounded-md bg-max text-max-foreground hover:brightness-110 sm:inline-flex"><x-icons.max class="h-5 w-5" /></a>
            @endif
            <a href="tel:{{ C::phoneTel() }}" onclick="window.slomTrackCTA && window.slomTrackCTA('phone', 'header_mobile')" class="cursor-pointer inline-flex h-10 items-center justify-center gap-2 rounded-md bg-yellow-gradient px-4 py-2 text-sm font-semibold text-primary-foreground shadow-cta transition hover:brightness-105 active:brightness-95 md:hidden"><x-icons.lucide name="phone" class="h-4 w-4" /> Позвонить</a>
        </div>
    </div>
</header>
