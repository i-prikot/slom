@php
    use App\Support\LandingContact as C;
@endphp

@props([
    'cuttingPrices',
    'drillingPrices',
    'openingPrices',
    'demolitionPrices',
    'coefficientLabels',
])

<section id="pricing" class="bg-muted/40 py-16 sm:py-20 lg:py-24" x-data="{ tab: 'cutting' }">
    <div class="container-x">
        <div class="max-w-2xl">
            <div class="inline-flex items-center gap-2 rounded-full border border-primary/30 bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-primary">Прозрачные цены</div>
            <h2 class="mt-4 font-display text-3xl font-bold tracking-tight sm:text-4xl lg:text-5xl">Актуальный прайс-лист</h2>
            <p class="mt-4 text-base text-muted-foreground sm:text-lg">Цены — реальные, прямо как мы считаем на объекте. Никаких «звоните, узнаем». Точную сумму назовём по телефону за 2 минуты — нужны размеры и материал стены.</p>
        </div>
        <div class="mt-8">
            <livewire:landing.pricing-calculator />
        </div>
        <details class="group mt-8 rounded-2xl border border-border bg-card p-3 shadow-card sm:p-6" open>
            <summary class="cursor-pointer list-none">
                <div class="flex items-center justify-between gap-3 rounded-lg px-2 py-1 hover:bg-muted/50">
                    <div class="flex items-center gap-2">
                        <x-icons.lucide name="info" class="h-4 w-4 text-primary" />
                        <span class="font-display text-base font-bold sm:text-lg">Полный прайс-лист</span>
                    </div>
                    <span class="text-xs font-semibold text-primary transition group-open:rotate-180">▾</span>
                </div>
            </summary>
            <div class="mt-4">
                <div class="grid h-auto w-full grid-cols-2 gap-1 bg-muted p-1 sm:grid-cols-4">
                    <button type="button" class="rounded-lg px-3 py-2 text-xs sm:text-sm" :class="tab==='cutting' ? 'bg-background font-semibold' : ''" x-on:click="tab='cutting'">Резка стен</button>
                    <button type="button" class="rounded-lg px-3 py-2 text-xs sm:text-sm" :class="tab==='drilling' ? 'bg-background font-semibold' : ''" x-on:click="tab='drilling'">Бурение</button>
                    <button type="button" class="rounded-lg px-3 py-2 text-xs sm:text-sm" :class="tab==='openings' ? 'bg-background font-semibold' : ''" x-on:click="tab='openings'">Проёмы</button>
                    <button type="button" class="rounded-lg px-3 py-2 text-xs sm:text-sm" :class="tab==='demo' ? 'bg-background font-semibold' : ''" x-on:click="tab='demo'">Демонтаж</button>
                </div>
                <div x-show="tab==='cutting'" class="mt-6">
                    <div class="mb-3 text-sm text-muted-foreground">Алмазная резка — стоимость 1 погонного метра, в рублях</div>
                    <div class="overflow-x-auto rounded-xl border border-border"><table class="w-full text-sm"><thead class="bg-secondary text-secondary-foreground"><tr><th class="px-4 py-3 text-left font-semibold">Толщина стены</th><th class="px-4 py-3 text-right font-semibold">Бетон</th><th class="px-4 py-3 text-right font-semibold">Монолит</th><th class="px-4 py-3 text-right font-semibold">Кирпич</th></tr></thead><tbody>@foreach ($cuttingPrices as $i => $row)<tr class="{{ $i % 2 ? 'bg-muted/40' : 'bg-card' }}"><td class="px-4 py-2.5 font-medium">{{ $row['thickness'] }}</td><td class="px-4 py-2.5 text-right tabular-nums">{{ number_format($row['concrete'], 0, '.', ' ') }}</td><td class="px-4 py-2.5 text-right tabular-nums">{{ number_format($row['monolith'], 0, '.', ' ') }}</td><td class="px-4 py-2.5 text-right tabular-nums">{{ number_format($row['brick'], 0, '.', ' ') }}</td></tr>@endforeach</tbody></table></div>
                </div>
                <div x-show="tab==='drilling'" class="mt-6">
                    <div class="mb-3 text-sm text-muted-foreground">Алмазное сверление — за 1 см глубины, в рублях. Минимальный заказ — 2 000 ₽.</div>
                    <div class="overflow-x-auto rounded-xl border border-border"><table class="w-full text-sm"><thead class="bg-secondary text-secondary-foreground"><tr><th class="px-4 py-3 text-left font-semibold">Диаметр коронки</th><th class="px-4 py-3 text-right font-semibold">Цена за 1 см глубины</th></tr></thead><tbody>@foreach ($drillingPrices as $i => $row)<tr class="{{ $i % 2 ? 'bg-muted/40' : 'bg-card' }}"><td class="px-4 py-2.5 font-medium">{{ $row['diameter'] }}</td><td class="px-4 py-2.5 text-right tabular-nums">{{ $row['price'] }} ₽</td></tr>@endforeach</tbody></table></div>
                </div>
                <div x-show="tab==='openings'" class="mt-6">
                    <div class="mb-3 text-sm text-muted-foreground">Проёмы под ключ (стандарт 2,1 × 0,9–1,2 м), цена с уборкой мусора</div>
                    <div class="overflow-x-auto rounded-xl border border-border"><table class="w-full text-sm"><thead class="bg-secondary text-secondary-foreground"><tr><th class="px-4 py-3 text-left font-semibold">Тип работы</th><th class="px-4 py-3 text-right font-semibold">Стоимость</th></tr></thead><tbody>@foreach ($openingPrices as $i => $row)<tr class="{{ $i % 2 ? 'bg-muted/40' : 'bg-card' }}"><td class="px-4 py-2.5 font-medium">{{ $row['type'] }}</td><td class="px-4 py-2.5 text-right tabular-nums font-semibold">{{ $row['price'] }}</td></tr>@endforeach</tbody></table></div>
                </div>
                <div x-show="tab==='demo'" class="mt-6">
                    <div class="mb-3 text-sm text-muted-foreground">Демонтаж стен, перегородок и санкабин</div>
                    <div class="overflow-x-auto rounded-xl border border-border"><table class="w-full text-sm"><thead class="bg-secondary text-secondary-foreground"><tr><th class="px-4 py-3 text-left font-semibold">Тип</th><th class="px-4 py-3 text-right font-semibold">Стоимость</th></tr></thead><tbody>@foreach ($demolitionPrices as $i => $row)<tr class="{{ $i % 2 ? 'bg-muted/40' : 'bg-card' }}"><td class="px-4 py-2.5 font-medium">{{ $row['type'] }}</td><td class="px-4 py-2.5 text-right tabular-nums font-semibold">{{ $row['price'] }}</td></tr>@endforeach</tbody></table></div>
                </div>
                <div class="mt-6 rounded-lg border border-border px-4" x-data="{ coefOpen: false }">
                    <button type="button" class="flex w-full items-center justify-between py-4 text-left text-sm font-semibold" x-on:click="coefOpen = !coefOpen">
                        <span class="flex items-center gap-2"><x-icons.lucide name="info" class="h-4 w-4 text-primary" />Усложняющие коэффициенты — честно, без сюрпризов</span>
                        <span class="text-primary transition" :class="coefOpen ? 'rotate-180' : ''">▾</span>
                    </button>
                    <div x-show="coefOpen" x-transition class="pb-4">
                        <ul class="grid gap-1.5 text-sm text-muted-foreground sm:grid-cols-2">@foreach ($coefficientLabels as $coef)<li class="flex items-start gap-2"><span class="mt-2 h-1 w-1 shrink-0 rounded-full bg-primary"></span>{{ $coef }}</li>@endforeach</ul>
                        <p class="mt-3 text-xs text-muted-foreground">Не публичная оферта. В каждом случае стоимость рассчитывается на объекте индивидуально.</p>
                    </div>
                </div>
            </div>
        </details>
        <div class="mt-8 overflow-hidden rounded-2xl bg-secondary p-6 text-secondary-foreground sm:p-8">
            <div class="grid grid-cols-1 items-center gap-5 lg:grid-cols-12">
                <div class="flex items-start gap-4 lg:col-span-8">
                    <span class="hidden h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-primary/15 text-primary ring-1 ring-primary/30 sm:inline-flex"><x-icons.lucide name="calculator" class="h-6 w-6" /></span>
                    <div class="min-w-1"><div class="font-display text-xl font-bold sm:text-2xl">Не нашли свою позицию или сомневаетесь в расчёте?</div><div class="mt-1 text-sm text-secondary-foreground/70">Назовите размеры и материал — посчитаем точную цену по телефону за 2 минуты.</div></div>
                </div>
                <div class="flex w-full flex-col gap-2.5 sm:flex-row lg:col-span-4 lg:flex-col lg:items-stretch xl:flex-row">
                    <a href="tel:{{ C::PHONE_TEL }}" onclick="window.slomTrackCTA && window.slomTrackCTA('phone', 'pricing')" class="sm:flex-1 xl:flex-1"><span class="inline-flex h-14 w-full items-center justify-center gap-2 whitespace-nowrap rounded-xl bg-yellow-gradient px-8 text-base font-semibold text-primary-foreground shadow-cta transition hover:brightness-105 active:brightness-95"><x-icons.lucide name="phone" class="h-5 w-5" /> {{ C::PHONE_DISPLAY }}</span></a>
                    <div class="flex gap-2 sm:flex-1">
                        <a href="{{ C::messengerUrl(C::WHATSAPP_URL, 'pricing') }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('whatsapp', 'pricing')" aria-label="WhatsApp" class="flex h-14 flex-1 items-center justify-center rounded-xl bg-whatsapp text-whatsapp-foreground hover:brightness-110"><x-icons.lucide name="message-circle" class="h-5 w-5" /></a>
                        <a href="{{ C::messengerUrl(C::TELEGRAM_URL, 'pricing') }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('telegram', 'pricing')" aria-label="Telegram" class="flex h-14 flex-1 items-center justify-center rounded-xl bg-telegram text-telegram-foreground hover:brightness-110"><x-icons.lucide name="send" class="h-5 w-5" /></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
