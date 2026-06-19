@php
    use App\Support\LandingContact as C;
@endphp

<footer class="bg-secondary text-secondary-foreground">
    <div class="container-x pt-12 pb-28 sm:pt-14 sm:pb-28 lg:py-14">
        <div class="grid gap-10 lg:grid-cols-12">
            <div class="lg:col-span-5">
                <div class="text-xs font-semibold uppercase tracking-wider text-white/50">Звоните напрямую</div>
                <a href="tel:{{ C::phoneTel() }}" onclick="window.slomTrackCTA && window.slomTrackCTA('phone', 'footer')" class="mcn-phone cursor-pointer mt-2 flex items-center gap-3 font-display text-2xl font-bold text-white transition hover:text-primary sm:text-3xl">
                    <span class="flex h-11 w-11 items-center justify-center rounded-full bg-primary text-primary-foreground"><x-icons.lucide name="phone" class="h-5 w-5" /></span>
                    {{ C::phoneDisplay() }}
                </a>
                <!--<div class="mt-2 flex flex-col gap-1 text-sm">
                    <a href="tel:{{ C::phoneOfficeTel() }}" onclick="window.slomTrackCTA && window.slomTrackCTA('phone', 'footer_secondary')" class="mcn-phone cursor-pointer text-white/80 transition hover:text-primary">{{ C::phoneOfficeDisplay() }} <span class="text-white/40">— офис</span></a>
                    <a href="tel:{{ C::phoneMobileTel() }}" onclick="window.slomTrackCTA && window.slomTrackCTA('phone', 'footer_mobile')" class="mcn-phone cursor-pointer text-white/80 transition hover:text-primary">{{ C::phoneMobileDisplay() }} <span class="text-white/40">— мобильный</span></a>
                </div>-->
                <div class="mt-3 flex flex-wrap items-center gap-x-3 gap-y-1.5 text-sm">
                    <span class="inline-flex items-center gap-1.5 text-white/70">
                        <span class="h-2 w-2 rounded-full {{ C::isOpenNow() ? 'bg-emerald-400 shadow-[0_0_0_3px_rgba(52,211,153,0.2)]' : 'bg-white/30' }}"></span>
                        <span class="font-semibold text-white">{{ C::isOpenNow() ? 'Сейчас работаем' : 'Сейчас закрыто' }}</span>
                    </span>
                    <span class="text-white/50">·</span>
                    <span class="text-white/60">{{ C::workHoursLabel() }}</span>
                </div>
                <div class="mt-5 flex flex-wrap items-center gap-2">
                    <button type="button" onclick="window.slomTrackCTA && window.slomTrackCTA('callback', 'footer'); window.dispatchEvent(new CustomEvent('open-callback', { detail: { source: 'footer' } }));" class="cursor-pointer inline-flex h-12 items-center justify-center gap-2 rounded-lg bg-yellow-gradient px-7 text-base font-semibold text-primary-foreground shadow-cta transition hover:brightness-105 active:brightness-95">
                        <x-icons.lucide name="phone-call" class="h-4 w-4" /> Жду звонка
                    </button>
                    @if (C::showWhatsApp())
                        <a href="{{ C::messengerUrl(C::whatsappUrl(), 'footer') }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('whatsapp', 'footer')" aria-label="WhatsApp" class="cursor-pointer flex h-12 w-12 items-center justify-center rounded-lg bg-whatsapp text-whatsapp-foreground hover:brightness-110"><x-icons.lucide name="message-circle" class="h-5 w-5" /></a>
                    @endif
                    @if (C::showTelegram())
                        <a href="{{ C::messengerUrl(C::telegramUrl(), 'footer') }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('telegram', 'footer')" aria-label="Telegram" class="cursor-pointer flex h-12 w-12 items-center justify-center rounded-lg bg-telegram text-telegram-foreground hover:brightness-110"><x-icons.lucide name="send" class="h-5 w-5" /></a>
                    @endif
                    @if (C::showMax())
                        <a href="{{ C::maxUrl() }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('max', 'footer')" aria-label="Max" class="cursor-pointer flex h-12 w-12 items-center justify-center rounded-lg bg-max text-max-foreground hover:brightness-110"><x-icons.max class="h-5 w-5" /></a>
                    @endif
                </div>
            </div>
            <div class="lg:col-span-4">
                <div class="text-xs font-semibold uppercase tracking-wider text-white/50">Отзывы и рейтинг</div>
                <a href="{{ C::yandexProfileUrl() }}" target="_blank" rel="noopener" class="cursor-pointer mt-3 flex items-center gap-3 rounded-xl border border-white/10 bg-white/5 px-4 py-3 transition hover:border-primary/40 hover:bg-white/10">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#FC3F1D] font-bold text-white">Я</div>
                    <div class="flex-1"><div class="flex items-center gap-1.5"><span class="font-display text-xl font-bold leading-none text-white">{{ C::yandexRating() }}</span><span class="flex gap-0.5 text-primary">@for ($i = 0; $i < 5; $i++)<x-icons.lucide name="star" class="h-3.5 w-3.5 fill-current" />@endfor</span></div><div class="text-xs text-white/60">Профиль на Яндекс.Картах</div></div>
                    <x-icons.lucide name="external-link" class="h-4 w-4 text-white/40" />
                </a>
            </div>
            <div class="lg:col-span-3">
                <div class="text-xs font-semibold uppercase tracking-wider text-white/50">Офис и контакты</div>
                <a href="{{ C::addressMapUrl() }}" target="_blank" rel="noopener" class="cursor-pointer mt-3 flex items-start gap-2 text-sm text-white/80 transition hover:text-primary"><x-icons.lucide name="map-pin" class="mt-0.5 h-4 w-4 shrink-0 text-primary" /><span>{{ C::address() }}</span></a>
                <a href="mailto:{{ C::email() }}" onclick="window.slomTrackCTA && window.slomTrackCTA('email', 'footer')" class="cursor-pointer mt-2 flex items-center gap-2 text-sm text-white/80 transition hover:text-primary"><x-icons.lucide name="mail" class="h-4 w-4 shrink-0 text-primary" /><span>{{ C::email() }}</span></a>
                <div class="mt-3 text-xs text-white/60">{{ C::company() }} — алмазная резка, бурение и демонтаж бетона в {{ C::city() }}е и крае с 2001 года.</div>
            </div>
        </div>
        <div class="mt-10 flex flex-col items-start justify-between gap-3 border-t border-white/10 pt-6 text-xs text-white/50 sm:flex-row sm:items-center">
            <div>© {{ now()->year }} {{ C::company() }}. Все права защищены.</div>
            <div class="flex flex-wrap items-center gap-x-4 gap-y-1">
                <a href="{{ route('privacy') }}" class="cursor-pointer text-white/70 transition hover:text-primary" wire:navigate>Политика конфиденциальности</a>
                <a href="{{ route('terms') }}" class="cursor-pointer text-white/70 transition hover:text-primary" wire:navigate>Соглашение об обработке персональных данных</a>
                <span>Информация на сайте не является публичной офертой.</span>
            </div>
        </div>
    </div>
</footer>
