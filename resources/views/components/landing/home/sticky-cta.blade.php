@php
    use App\Support\LandingContact as C;
@endphp

<div class="fixed inset-x-0 bottom-0 z-40 lg:hidden">
    <div class="grid {{ C::stickyCtaGridClass() }} border-t border-border bg-background shadow-elevated">
        <a href="tel:{{ C::phoneTel() }}" onclick="window.slomTrackCTA && window.slomTrackCTA('phone', 'sticky')" class="cursor-pointer flex flex-col items-center justify-center gap-0.5 bg-yellow-gradient py-2.5 text-[10px] font-semibold text-primary-foreground active:brightness-95"><x-icons.lucide name="phone" class="h-4 w-4" />Позвонить</a>
        @if (C::showWhatsApp())
            <a href="{{ C::messengerUrl(C::whatsappUrl()) }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('whatsapp', 'sticky')" class="cursor-pointer flex flex-col items-center justify-center gap-0.5 bg-whatsapp py-2.5 text-[10px] font-semibold text-whatsapp-foreground active:brightness-95"><x-icons.lucide name="message-circle" class="h-4 w-4" />WhatsApp</a>
        @endif
        @if (C::showTelegram())
            <a href="{{ C::messengerUrl(C::telegramUrl()) }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('telegram', 'sticky')" class="cursor-pointer flex flex-col items-center justify-center gap-0.5 bg-telegram py-2.5 text-[10px] font-semibold text-telegram-foreground active:brightness-95"><x-icons.lucide name="send" class="h-4 w-4" />Telegram</a>
        @endif
        @if (C::showMax())
            <a href="{{ C::maxUrl() }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('max', 'sticky')" class="cursor-pointer flex flex-col items-center justify-center gap-0.5 bg-max py-2.5 text-[10px] font-semibold text-max-foreground active:brightness-95"><x-icons.max class="h-4 w-4" />Max</a>
        @endif
        <button type="button" class="cursor-pointer flex flex-col items-center justify-center gap-0.5 bg-secondary py-2.5 text-[10px] font-semibold text-secondary-foreground active:brightness-95" x-data x-on:click="window.slomTrackCTA && window.slomTrackCTA('callback', 'sticky'); $dispatch('open-callback', { source: 'sticky' })"><x-icons.lucide name="phone-call" class="h-4 w-4" />Звонок</button>
    </div>
</div>
