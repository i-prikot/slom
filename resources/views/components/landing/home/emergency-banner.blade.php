@php
    use App\Support\LandingContact as C;
@endphp

<section class="border-y border-destructive/30 bg-destructive/[0.06]">
    <div class="container-x flex flex-col items-start gap-4 py-4 sm:flex-row sm:items-center sm:justify-between sm:py-3.5">
        <div class="flex items-start gap-3">
            <span class="relative mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-destructive text-destructive-foreground sm:h-10 sm:w-10">
                <span class="absolute inset-0 animate-ping rounded-full bg-destructive/40"></span>
                <x-icons.lucide name="alert-triangle" class="relative h-4 w-4 sm:h-5 sm:w-5" />
            </span>
            <div class="text-sm sm:text-base">
                <div class="font-semibold text-foreground">Аварийный выезд — 24/7</div>
                <div class="text-muted-foreground">Протечка, авария, нужно срочно вскрыть конструкцию? Звоните или напишите в любое время.</div>
            </div>
        </div>
        <div class="flex w-full flex-col gap-2 sm:w-auto sm:flex-row sm:items-center">
            <a href="tel:{{ C::PHONE_TEL }}" onclick="window.slomTrackCTA && window.slomTrackCTA('phone', 'emergency')" class="inline-flex h-12 w-full items-center justify-center gap-2 rounded-lg bg-yellow-gradient px-7 text-base font-semibold text-primary-foreground shadow-cta transition hover:brightness-105 active:brightness-95 sm:w-auto"><x-icons.lucide name="phone" class="h-4 w-4" /> {{ C::PHONE_DISPLAY }}</a>
            <div class="flex gap-2">
                <a href="{{ C::messengerUrl(C::WHATSAPP_URL, 'emergency') }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('whatsapp', 'emergency')" aria-label="WhatsApp" class="flex h-12 w-12 items-center justify-center rounded-lg bg-whatsapp text-whatsapp-foreground hover:brightness-110"><x-icons.lucide name="message-circle" class="h-5 w-5" /></a>
                <a href="{{ C::messengerUrl(C::TELEGRAM_URL, 'emergency') }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('telegram', 'emergency')" aria-label="Telegram" class="flex h-12 w-12 items-center justify-center rounded-lg bg-telegram text-telegram-foreground hover:brightness-110"><x-icons.lucide name="send" class="h-5 w-5" /></a>
            </div>
        </div>
    </div>
</section>
