<div
    x-data="{
        open: $wire.entangle('open'),
        isSubmitting: false,
        source: $wire.entangle('source'),
        handleOpen(event) {
            const source = event.detail?.source;
            if (typeof source === 'string' && source !== '') {
                this.source = source;
            } else {
                this.source = 'unknown';
            }

            this.open = true;
        },
        closeDialog() {
            this.open = false;
        },
        async submitForm() {
            if (this.isSubmitting || !this.$wire.consent) {
                return;
            }

            this.isSubmitting = true;
            try {
                await this.$wire.submit();
            } finally {
                this.isSubmitting = false;
            }
        },
    }"
    x-on:keydown.escape.window="open && closeDialog()"
    x-on:open-callback.window="handleOpen($event)"
>
    <div x-cloak x-show="open" class="fixed inset-0 z-[50] flex items-center justify-center bg-black/60 p-4" x-transition.opacity>
        <div class="w-full max-w-md rounded-2xl border border-border bg-card p-6 shadow-elevated sm:max-w-md" x-transition.scale x-on:click.outside="closeDialog()" role="dialog" aria-modal="true" aria-labelledby="callback-dialog-title" aria-describedby="callback-dialog-description">
            <div class="flex items-start justify-between gap-3">
                <h3 id="callback-dialog-title" class="font-display text-2xl font-bold">Перезвоним за 5 минут</h3>
                <button type="button" class="cursor-pointer inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-lg border border-border bg-background transition hover:bg-muted" x-on:click="closeDialog()" aria-label="Закрыть">
                    <x-icons.lucide name="x" class="h-4 w-4" />
                </button>
            </div>
            <p id="callback-dialog-description" class="mt-1 text-sm text-muted-foreground">Оставьте номер — обсудим ваш объект и сразу назовём цену. Без спама.</p>

            <form x-on:submit.prevent="submitForm()" :class="isSubmitting ? 'pointer-events-none opacity-70' : ''" class="mt-4 space-y-4 transition-opacity">
                <div>
                    <label class="mb-1.5 block text-sm font-medium">Имя (необязательно)</label>
                    <input wire:model.live="name" class="w-full rounded-lg border border-input bg-background px-3 py-2" placeholder="Как к вам обращаться">
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium">Телефон <span class="text-destructive">*</span></label>
                    <input wire:model.live="phone" type="tel" inputmode="tel" required placeholder="+7 (___) ___-__-__" class="w-full rounded-lg border border-input bg-background px-3 py-2 text-base">
                </div>
                <label class="flex cursor-pointer items-start gap-2 text-xs text-muted-foreground">
                    <input wire:model.live="consent" type="checkbox" class="checkbox-site mt-0.5">
                    <span class="relative top-0.5">Я согласен с <a href="{{ route('privacy') }}" class="cursor-pointer text-primary hover:underline" wire:navigate>политикой конфиденциальности</a></span>
                </label>
                <button
                    type="submit" class="cursor-pointer inline-flex h-14 w-full items-center justify-center gap-2 rounded-xl bg-yellow-gradient px-8 text-base font-semibold text-primary-foreground shadow-cta transition hover:brightness-105 active:brightness-95 disabled:pointer-events-none disabled:opacity-50"
                    x-bind:disabled="isSubmitting || !$wire.consent"
                    @disabled(!$consent)
                >
                    <x-icons.lucide x-show="!isSubmitting" name="phone" class="h-5 w-5" />
                    <x-icons.lucide x-show="isSubmitting" name="loader-2" class="h-5 w-5 animate-spin" />
                    <span x-show="!isSubmitting">Жду звонка</span>
                    <span x-show="isSubmitting">Отправляем заявку...</span>
                </button>

                <ul class="space-y-1.5 text-xs text-muted-foreground">
                    <li class="flex items-center gap-2">
                        <x-icons.lucide name="clock" class="h-3.5 w-3.5 text-primary" />
                        Перезвоним в течение 5 минут (8:00–20:00)
                    </li>
                    <li class="flex items-center gap-2">
                        <x-icons.lucide name="shield-check" class="h-3.5 w-3.5 text-primary" />
                        Не передаём номер третьим лицам
                    </li>
                </ul>

                <div class="border-t pt-3 text-center text-sm text-muted-foreground">
                    Срочно? <a href="tel:{{ \App\Support\LandingContact::PHONE_TEL }}" class="mcn-phone cursor-pointer font-semibold text-foreground hover:text-primary">{{ \App\Support\LandingContact::PHONE_DISPLAY }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
