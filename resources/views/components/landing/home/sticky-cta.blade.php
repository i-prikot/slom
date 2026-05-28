@php
    use App\Support\LandingContact as C;
@endphp

<div class="fixed inset-x-0 bottom-0 z-40 lg:hidden">
    <div class="grid grid-cols-5 border-t border-border bg-background shadow-elevated">
        <a href="tel:{{ C::PHONE_TEL }}" onclick="window.slomTrackCTA && window.slomTrackCTA('phone', 'sticky')" class="flex flex-col items-center justify-center gap-0.5 bg-yellow-gradient py-2.5 text-[10px] font-semibold text-primary-foreground active:brightness-95"><x-icons.lucide name="phone" class="h-4 w-4" />Позвонить</a>
        <a href="{{ C::messengerUrl(C::WHATSAPP_URL) }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('whatsapp', 'sticky')" class="flex flex-col items-center justify-center gap-0.5 bg-whatsapp py-2.5 text-[10px] font-semibold text-whatsapp-foreground active:brightness-95"><x-icons.lucide name="message-circle" class="h-4 w-4" />WhatsApp</a>
        <a href="{{ C::messengerUrl(C::TELEGRAM_URL) }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('telegram', 'sticky')" class="flex flex-col items-center justify-center gap-0.5 bg-telegram py-2.5 text-[10px] font-semibold text-telegram-foreground active:brightness-95"><x-icons.lucide name="send" class="h-4 w-4" />Telegram</a>
        <a href="{{ C::MAX_URL }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('max', 'sticky')" class="flex flex-col items-center justify-center gap-0.5 bg-max py-2.5 text-[10px] font-semibold text-max-foreground active:brightness-95"><x-icons.max class="h-4 w-4" />Max</a>
        <button type="button" class="flex flex-col items-center justify-center gap-0.5 bg-secondary py-2.5 text-[10px] font-semibold text-secondary-foreground active:brightness-95" x-data x-on:click="window.slomTrackCTA && window.slomTrackCTA('callback', 'sticky'); $dispatch('open-callback', { source: 'sticky' })"><x-icons.lucide name="phone-call" class="h-4 w-4" />Звонок</button>
    </div>
</div>
