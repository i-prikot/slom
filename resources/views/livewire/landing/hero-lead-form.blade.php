<form
    wire:submit="submit"
    x-data="{ consentAccepted: @entangle('consent').live }"
    class="rounded-2xl border-2 border-primary/50 bg-black/60 p-5 shadow-cta backdrop-blur-md sm:p-6"
>
    <div class="text-base font-bold text-white sm:text-lg">Получите точный расчёт за 5 минут</div>
    <p class="mt-1 text-sm text-white/65">Оставьте телефон — перезвоним и сразу назовём цену.</p>

    <div class="mt-4 flex flex-col items-stretch gap-2 sm:flex-row">
        <input
            wire:model.live="phone"
            placeholder="+7 (___) ___-__-__"
            type="tel"
            inputmode="tel"
            required
            class="block h-14 min-h-14 w-full min-w-0 flex-1 rounded-lg border border-input bg-white px-4 text-base text-foreground placeholder:text-muted-foreground"
        >
        <button
            type="submit" class="cursor-pointer inline-flex h-14 shrink-0 items-center justify-center gap-2 whitespace-nowrap rounded-xl bg-yellow-gradient px-8 text-base font-semibold text-primary-foreground shadow-cta transition hover:brightness-105 active:brightness-95 disabled:pointer-events-none disabled:opacity-50"
            wire:loading.attr="disabled"
            wire:target="submit"
            x-bind:disabled="!consentAccepted"
        >
            <x-icons.lucide name="phone" class="h-5 w-5" />
            <span wire:loading.remove wire:target="submit">Жду звонка</span>
            <span wire:loading wire:target="submit">Отправляем…</span>
        </button>
    </div>

    <label class="mt-3 flex cursor-pointer items-start gap-2 text-[12px] text-white/75">
        <input wire:model.live="consent" x-model="consentAccepted" type="checkbox" class="mt-0.5 h-4 w-4 rounded border-white/40">
        <span>
            Я согласен с
            <a href="{{ route('privacy') }}" class="cursor-pointer text-primary underline-offset-2 hover:underline" wire:navigate>политикой конфиденциальности</a>
        </span>
    </label>

    <ul class="mt-3 flex flex-wrap gap-x-4 gap-y-1.5 text-[11px] text-white/65">
        <li class="flex items-center gap-1.5">
            <x-icons.lucide name="clock" class="h-3 w-3 text-primary" />
            Перезвоним за 5 минут
        </li>
        <li class="flex items-center gap-1.5">
            <x-icons.lucide name="shield-check" class="h-3 w-3 text-primary" />
            Без спама · Бесплатная консультация
        </li>
    </ul>
</form>
