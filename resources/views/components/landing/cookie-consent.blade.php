<div
    x-data="{ mounted: false, visible: false }"
    x-init="
        if (document.cookie.includes('cookie_consent=accepted')) return;
        mounted = true;
        setTimeout(() => visible = true, 600);
    "
>
    <template x-if="mounted">
        <div
            role="dialog"
            aria-live="polite"
            aria-label="Согласие на использование cookie"
            class="pointer-events-none fixed inset-x-0 bottom-0 z-[60] px-3 pb-3 transition-all duration-500 ease-out sm:px-4 sm:pb-4"
            :class="visible ? 'translate-y-0 opacity-100' : 'translate-y-full opacity-0'"
            x-cloak
        >
            <div class="pointer-events-auto mx-auto flex max-w-4xl flex-col items-start gap-3 rounded-xl border border-border bg-card p-4 text-card-foreground shadow-lg sm:flex-row sm:items-start sm:gap-4 sm:p-5">
                <img src="{{ Vite::asset('resources/images/cookie.jpg') }}" alt="" class="hidden h-10 w-10 shrink-0 select-none sm:block" draggable="false">
                <p class="flex-1 text-sm leading-relaxed text-foreground/90">
                    Находясь на этом сайте, вы соглашаетесь с использованием файлов cookie, которые помогают
                    нам сделать сайт удобнее. Вы также подтверждаете
                    <a href="{{ route('terms') }}" class="text-primary hover:underline" wire:navigate>Согласие на обработку</a>
                    персональных данных согласно нашей
                    <a href="{{ route('privacy') }}" class="text-primary hover:underline" wire:navigate>Политике конфиденциальности</a>.
                </p>
                <button
                    type="button"
                    class="w-full shrink-0 rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-primary-foreground sm:w-auto"
                    x-on:click="
                        document.cookie = 'cookie_consent=accepted; max-age=31536000; path=/; SameSite=Lax';
                        visible = false;
                        setTimeout(() => mounted = false, 500);
                    "
                >
                    Принять
                </button>
            </div>
        </div>
    </template>
</div>
