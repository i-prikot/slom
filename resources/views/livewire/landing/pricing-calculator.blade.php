@php
    use App\Support\LandingContact as C;

    $workOptions = [
        ['id' => 'cutting', 'title' => 'Резка стены', 'desc' => 'Алмазная резка бетона, кирпича, монолита'],
        ['id' => 'drilling', 'title' => 'Бурение отверстий', 'desc' => 'Под коммуникации, вентиляцию'],
        ['id' => 'opening', 'title' => 'Проём', 'desc' => 'Под дверь, окно, арку с усилением'],
        ['id' => 'demolition', 'title' => 'Демонтаж', 'desc' => 'Стены, перегородки, санкабины'],
    ];
    $materialOptions = ['concrete' => 'Бетон', 'monolith' => 'Монолит', 'brick' => 'Кирпич', 'unknown' => 'Не знаю'];
    $progressClass = match (min($step, 5)) {
        1 => 'w-0',
        2 => 'w-1/4',
        3 => 'w-1/2',
        4 => 'w-3/4',
        default => 'w-full',
    };
    $result = $this->result;
@endphp

<div id="calculator" class="overflow-hidden rounded-2xl border-2 border-primary/30 bg-card shadow-card">
    <div class="border-b border-border bg-gradient-to-r from-primary/10 via-primary/5 to-transparent px-5 py-4 sm:px-6">
        <div class="flex items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-primary/15 text-primary ring-1 ring-primary/30">
                    <x-icons.lucide name="calculator" class="h-5 w-5" />
                </span>
                <div>
                    <div class="font-display text-lg font-bold sm:text-xl">Калькулятор стоимости</div>
                    <div class="text-xs text-muted-foreground sm:text-sm">Ответьте на 3–4 вопроса — получите вилку цены за 30 секунд</div>
                </div>
            </div>
            @if ($step > 1 && $step < 5)
                <div class="hidden text-xs font-semibold text-muted-foreground sm:block">Шаг {{ $step }} / 4</div>
            @endif
        </div>
        @if ($step < 5)
            <div class="mt-3 h-1.5 overflow-hidden rounded-full bg-secondary/20">
                <div class="h-full bg-primary transition-all duration-300 {{ $progressClass }}"></div>
            </div>
        @endif
    </div>

    <div class="p-5 sm:p-6">
        @if ($step === 1)
            <div class="animate-in fade-in duration-200">
                <div class="mb-4 text-sm font-semibold uppercase tracking-wider text-muted-foreground">Что нужно сделать?</div>
                <div class="grid gap-3 sm:grid-cols-2">
                    @foreach ($workOptions as $option)
                    <button type="button" wire:click="$set('workType', '{{ $option['id'] }}')" class="rounded-xl border-2 bg-card p-4 text-left transition hover:border-primary/60 hover:bg-primary/5 {{ $workType === $option['id'] ? 'border-primary bg-primary/10 ring-2 ring-primary/30' : 'border-border' }}">
                        <div class="font-semibold">{{ $option['title'] }}</div>
                        <div class="mt-1 text-xs text-muted-foreground">{{ $option['desc'] }}</div>
                    </button>
                    @endforeach
                </div>
            </div>
        @elseif ($step === 2)
            <div class="animate-in fade-in duration-200">
                <div class="mb-4 text-sm font-semibold uppercase tracking-wider text-muted-foreground">Материал стены</div>
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
                @foreach ($materialOptions as $id => $label)
                    <button type="button" wire:click="$set('material', '{{ $id }}')" class="rounded-xl border-2 bg-card p-4 text-center transition hover:border-primary/60 hover:bg-primary/5 {{ $material === $id ? 'border-primary bg-primary/10 ring-2 ring-primary/30' : 'border-border' }}">
                        <div class="font-semibold">{{ $label }}</div>
                    </button>
                @endforeach
                </div>
                <p class="mt-3 text-xs text-muted-foreground">Не уверены? Выберите «Не знаю» — посчитаем по среднему, точную цену уточним по телефону.</p>
            </div>
        @elseif ($step === 3)
            <div class="animate-in fade-in space-y-4 duration-200">
                <div class="text-sm font-semibold uppercase tracking-wider text-muted-foreground">Размеры</div>
                @if ($workType === 'cutting')
                    <div class="grid gap-4 sm:grid-cols-2">
                    <label class="block">
                        <div class="mb-1.5 text-sm font-medium">Толщина стены, см</div>
                        <input wire:model.live="thicknessCm" type="number" min="5" max="75" class="w-full rounded-lg border border-input bg-background px-3 py-2">
                    </label>
                    <label class="block">
                        <div class="mb-1.5 text-sm font-medium">Длина реза, погонных метров</div>
                        <input wire:model.live="lengthM" type="number" min="0.5" step="0.5" class="w-full rounded-lg border border-input bg-background px-3 py-2">
                    </label>
                    </div>
                @elseif ($workType === 'drilling')
                    <div class="grid gap-4 sm:grid-cols-2">
                    <label class="block">
                        <div class="mb-1.5 text-sm font-medium">Диаметр отверстия, мм</div>
                        <input wire:model.live="diameterMm" type="number" min="25" max="800" class="w-full rounded-lg border border-input bg-background px-3 py-2">
                    </label>
                    <label class="block">
                        <div class="mb-1.5 text-sm font-medium">Глубина, см</div>
                        <input wire:model.live="depthCm" type="number" min="5" class="w-full rounded-lg border border-input bg-background px-3 py-2">
                    </label>
                    </div>
                @elseif ($workType === 'opening')
                    <div class="grid gap-2">
                        @foreach ($openingPrices as $index => $row)
                            <button type="button" wire:click="$set('presetIndex', {{ $index }})" class="rounded-xl border-2 p-3 text-left transition hover:border-primary/60 hover:bg-primary/5 {{ $presetIndex === $index ? 'border-primary bg-primary/10 ring-2 ring-primary/30' : 'border-border bg-card' }}">
                                <div class="flex items-center justify-between gap-3">
                                    <span class="text-sm font-medium">{{ $row['type'] }}</span>
                                    <span class="text-sm font-semibold text-primary">{{ $row['price'] }}</span>
                                </div>
                            </button>
                        @endforeach
                    </div>
                @elseif ($workType === 'demolition')
                    <div class="space-y-3">
                        <div class="grid gap-2">
                            @foreach ($demolitionPrices as $index => $row)
                                <button type="button" wire:click="$set('presetIndex', {{ $index }})" class="rounded-xl border-2 p-3 text-left transition hover:border-primary/60 hover:bg-primary/5 {{ $presetIndex === $index ? 'border-primary bg-primary/10 ring-2 ring-primary/30' : 'border-border bg-card' }}">
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="text-sm font-medium">{{ $row['type'] }}</span>
                                        <span class="shrink-0 text-sm font-semibold text-primary">{{ $row['price'] }}</span>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                        @if (($demolitionPrices[$presetIndex]['unit'] ?? null) === 'м²')
                            <label class="block">
                                <div class="mb-1.5 text-sm font-medium">Площадь, м²</div>
                                <input wire:model.live="quantity" type="number" min="1" class="w-full rounded-lg border border-input bg-background px-3 py-2">
                            </label>
                        @endif
                    </div>
                @endif
            </div>
        @elseif ($step === 4)
            <div class="animate-in fade-in duration-200">
                <div class="mb-1 text-sm font-semibold uppercase tracking-wider text-muted-foreground">Дополнительные условия</div>
                <p class="mb-4 text-xs text-muted-foreground">Отметьте, если применимо. Можно пропустить — посчитаем по базовой цене.</p>
                <div class="grid gap-2 sm:grid-cols-2">
                @foreach ($coefficients as $coef)
                    <button type="button" wire:click="toggleCoef('{{ $coef['id'] }}')" class="flex items-center justify-between gap-3 rounded-xl border-2 p-3 text-left {{ in_array($coef['id'], $coefIds, true) ? 'border-primary bg-primary/10' : 'border-border bg-card' }}">
                        <span class="text-sm font-medium">{{ $coef['label'] }}</span>
                        <span class="shrink-0 rounded-md px-2 py-0.5 text-xs font-semibold {{ in_array($coef['id'], $coefIds, true) ? 'bg-primary text-primary-foreground' : 'bg-muted text-muted-foreground' }}">{{ $coef['hint'] }}</span>
                    </button>
                @endforeach
                </div>
            </div>
        @elseif ($step === 5 && $result)
            <div class="animate-in fade-in duration-300">
            <div class="rounded-xl border-2 border-primary/40 bg-gradient-to-br from-primary/10 to-transparent p-5 sm:p-6">
                <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-primary">
                    <x-icons.lucide name="sparkles" class="h-3.5 w-3.5" />
                    Ориентировочная стоимость
                </div>
                <div class="mt-2 font-display text-3xl font-bold tabular-nums sm:text-4xl">
                    {{ number_format($result['min'], 0, '.', ' ') }} – {{ number_format($result['max'], 0, '.', ' ') }} ₽
                </div>
                <p class="mt-2 text-sm text-muted-foreground">Точную сумму назовём за 2 минуты — пришлите размеры и пару фото объекта. Без сюрпризов «на месте».</p>
            </div>

            <div class="mt-5 grid gap-2.5">
                <a href="tel:{{ C::PHONE_TEL }}" onclick="window.slomTrackCTA && window.slomTrackCTA('calc_cta_phone', 'calculator')">
                    <span class="inline-flex h-14 w-full items-center justify-center gap-2 rounded-xl bg-yellow-gradient px-8 text-base font-semibold text-primary-foreground shadow-cta transition hover:brightness-105 active:brightness-95">
                        <x-icons.lucide name="phone" class="h-5 w-5" />
                        Позвонить {{ C::PHONE_DISPLAY }}
                    </span>
                </a>
                <div class="grid grid-cols-2 gap-2.5">
                    <a href="{{ C::messengerUrlWithCalc(C::WHATSAPP_URL, $result['summary']) }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('calc_cta_whatsapp', 'calculator')">
                        <span class="inline-flex h-12 w-full items-center justify-center gap-2 rounded-lg bg-whatsapp px-7 text-base font-semibold text-whatsapp-foreground transition hover:bg-whatsapp/90">
                            <x-icons.lucide name="message-circle" class="h-5 w-5" />
                            WhatsApp
                        </span>
                    </a>
                    <a href="{{ C::messengerUrlWithCalc(C::TELEGRAM_URL, $result['summary']) }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('calc_cta_telegram', 'calculator')">
                        <span class="inline-flex h-12 w-full items-center justify-center gap-2 rounded-lg bg-telegram px-7 text-base font-semibold text-telegram-foreground transition hover:bg-telegram/90">
                            <x-icons.lucide name="send" class="h-5 w-5" />
                            Telegram
                        </span>
                    </a>
                </div>
                <button type="button" x-data x-on:click="window.slomTrackCTA && window.slomTrackCTA('calc_cta_callback', 'calculator'); $dispatch('open-callback', { source: 'calculator' })" class="text-sm font-medium text-primary underline-offset-4 hover:underline">
                    или закажите бесплатный обратный звонок
                </button>
            </div>

            <div class="mt-5 rounded-lg border border-border px-4" x-data="{ open: false }">
                <button type="button" class="flex w-full items-center justify-between py-4 text-left text-sm font-semibold" x-on:click="open = !open">
                    <span class="flex items-center gap-2">
                        <x-icons.lucide name="info" class="h-4 w-4 text-primary" />
                        Как считали
                    </span>
                    <span class="text-primary transition" :class="open ? 'rotate-180' : ''">▾</span>
                </button>
                <div x-show="open" x-transition class="pb-4">
                    <ul class="space-y-1.5 text-sm text-muted-foreground">
                        @foreach ($result['breakdown'] as $line)
                            <li class="flex items-start gap-2">
                                <span class="mt-2 h-1 w-1 shrink-0 rounded-full bg-primary"></span>
                                {{ $line }}
                            </li>
                        @endforeach
                    </ul>
                    <p class="mt-3 text-xs text-muted-foreground">Расчёт ориентировочный и не является публичной офертой. Финальная стоимость определяется после осмотра объекта.</p>
                </div>
            </div>
            </div>
        @endif

        <div class="mt-6 flex items-center justify-between gap-3">
            @if ($step > 1 && $step < 5)
                <button type="button" wire:click="prevStep" class="inline-flex h-9 items-center justify-center gap-2 rounded-md px-3 text-sm font-medium transition hover:bg-accent hover:text-accent-foreground">
                    <x-icons.lucide name="chevron-left" class="h-4 w-4" />
                    Назад
                </button>
            @else
                <span></span>
            @endif
            @if ($step < 5)
                <button type="button" wire:click="nextStep" class="inline-flex h-12 items-center justify-center gap-2 rounded-lg px-7 text-base font-medium transition disabled:pointer-events-none disabled:opacity-50 {{ $step === 4 ? 'bg-yellow-gradient font-semibold text-primary-foreground shadow-cta hover:brightness-105 active:brightness-95' : 'bg-primary text-primary-foreground hover:bg-primary/90' }}" @disabled($step === 1 && !$workType)>
                    {{ $step === 4 ? 'Показать цену' : 'Далее' }}
                </button>
            @else
                <button type="button" wire:click="resetCalculator" class="mx-auto inline-flex h-9 items-center justify-center gap-2 rounded-md px-3 text-sm font-medium transition hover:bg-accent hover:text-accent-foreground">
                    <x-icons.lucide name="rotate-ccw" class="h-4 w-4" />
                    Начать заново
                </button>
            @endif
        </div>
    </div>
</div>
