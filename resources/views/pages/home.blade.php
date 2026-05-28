@php
    use App\Support\LandingContact as C;
    use App\Support\PricingEstimator as P;
@endphp

<x-layouts.app
    :title="'Алмазная резка и бурение бетона в Красноярске — СЛОМ24'"
    :metaTitle="'СЛОМ24 — Алмазная резка и бурение бетона'"
    :metaDescription="'Алмазная резка, бурение и демонтаж бетона в Красноярске и крае. Приезд за 60 минут, точная цена за 2 минуты.'"
>
    <main class="min-h-screen pb-16 lg:pb-0" x-data x-init="
        const storageKey = 'cb_trigger_shown_v1';
        if (!sessionStorage.getItem(storageKey)) {
            let triggered = false;
            const fire = (source) => {
                if (triggered || sessionStorage.getItem(storageKey)) return;
                triggered = true;
                sessionStorage.setItem(storageKey, '1');
                window.dispatchEvent(new CustomEvent('open-callback', { detail: { source } }));
            };
            if (window.matchMedia('(pointer: coarse)').matches) {
                let interacted = false;
                const markInteract = () => {
                    if (interacted) return;
                    interacted = true;
                    window.setTimeout(() => fire('time_delay'), 45000);
                };
                window.addEventListener('scroll', markInteract, { once: true, passive: true });
                window.addEventListener('touchstart', markInteract, { once: true, passive: true });
            } else {
                document.addEventListener('mouseleave', (e) => {
                    if (e.clientY <= 0) fire('exit_intent');
                });
            }
        }
    ">
        <header class="absolute inset-x-0 top-0 z-30">
            <div class="container-x flex items-center justify-between gap-3 py-4 sm:py-5">
                <a href="#" class="flex items-center gap-3" aria-label="{{ C::COMPANY }} — алмазная резка и бурение в {{ C::CITY }}е">
                    <img src="{{ Vite::asset('resources/images/logo-dark.png') }}" alt="{{ C::COMPANY }} — алмазная резка и бурение в {{ C::CITY }}е" class="h-11 w-auto sm:h-14">
                </a>
                <div class="flex items-center gap-2 sm:gap-3">
                    <div class="hidden text-right md:block">
                        <a href="tel:{{ C::PHONE_TEL }}" class="block text-lg font-bold text-white hover:text-primary">{{ C::PHONE_DISPLAY }}</a>
                        <span class="inline-flex items-center gap-1.5 text-xs text-white/60">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_0_3px_rgba(52,211,153,0.2)]"></span>
                            Сейчас отвечаем · 8:00 – 20:00
                        </span>
                    </div>
                    <a href="{{ C::messengerUrl(C::WHATSAPP_URL) }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('whatsapp', 'header')" aria-label="Написать в WhatsApp" class="hidden h-10 w-10 items-center justify-center rounded-md bg-whatsapp text-whatsapp-foreground hover:brightness-110 sm:inline-flex"><x-icons.lucide name="message-circle" class="h-5 w-5" /></a>
                    <a href="{{ C::messengerUrl(C::TELEGRAM_URL) }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('telegram', 'header')" aria-label="Написать в Telegram" class="hidden h-10 w-10 items-center justify-center rounded-md bg-telegram text-telegram-foreground hover:brightness-110 sm:inline-flex"><x-icons.lucide name="send" class="h-5 w-5" /></a>
                    <a href="{{ C::MAX_URL }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('max', 'header')" aria-label="Написать в Max" class="hidden h-10 w-10 items-center justify-center rounded-md bg-max text-max-foreground hover:brightness-110 sm:inline-flex"><x-icons.max class="h-5 w-5" /></a>
                    <a href="tel:{{ C::PHONE_TEL }}" onclick="window.slomTrackCTA && window.slomTrackCTA('phone', 'header_mobile')" class="inline-flex h-10 items-center justify-center gap-2 rounded-md bg-yellow-gradient px-4 py-2 text-sm font-semibold text-primary-foreground shadow-cta transition hover:brightness-105 active:brightness-95 md:hidden"><x-icons.lucide name="phone" class="h-4 w-4" /> Позвонить</a>
                </div>
            </div>
        </header>

        <section class="relative isolate overflow-hidden bg-secondary text-white">
            <div class="absolute inset-0 -z-10">
                <img src="{{ Vite::asset('resources/images/hero-cutting.jpg') }}" alt="Алмазная резка бетона" class="h-full w-full object-cover object-center">
                <div class="absolute inset-0 bg-overlay-gradient"></div>
            </div>
            <div class="container-x relative pb-10 pt-24 sm:pt-28 lg:pb-14 lg:pt-32">
                <div class="grid gap-10 lg:grid-cols-12 lg:gap-8">
                    <div class="lg:col-span-7">
                        <a href="{{ C::YANDEX_PROFILE_URL }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3 py-1.5 text-xs font-medium text-white backdrop-blur transition hover:bg-white/15">
                            <span class="flex h-5 w-5 items-center justify-center rounded bg-[#FC3F1D] text-[10px] font-bold">Я</span>
                            <span class="font-bold">{{ C::YANDEX_RATING }}</span>
                            <span class="flex gap-0.5 text-primary">
                                @for ($i = 0; $i < 5; $i++)
                                    <x-icons.lucide name="star" class="h-3 w-3 fill-current" />
                                @endfor
                            </span>
                            <span class="text-white/70">на Яндекс.Картах</span>
                            <x-icons.lucide name="external-link" class="h-3 w-3 text-white/50" />
                        </a>
                        <h1 class="mt-4 font-display text-4xl font-bold leading-[1.05] tracking-tight sm:text-5xl lg:text-[3.5rem]">
                            Алмазная резка и бурение бетона <br class="hidden sm:block">
                            <span class="text-primary">в {{ C::CITY }}е — приедем за 60 минут</span>
                        </h1>
                        <p class="mt-4 max-w-xl text-base text-white/75 sm:text-lg">Точную цену называем по телефону за 2 минуты. Работаем без трещин и пыли, с гарантией.</p>
                        <div class="mt-7 max-w-xl">
                            <livewire:landing.hero-lead-form />
                            <div class="mt-5 flex flex-wrap items-center gap-x-5 gap-y-3">
                                <div class="flex items-center gap-2.5">
                                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-primary text-primary-foreground">
                                        <x-icons.lucide name="phone" class="h-4 w-4" />
                                    </span>
                                    <div class="leading-tight">
                                        <a href="tel:{{ C::PHONE_TEL }}" onclick="window.slomTrackCTA && window.slomTrackCTA('phone', 'hero_main')" class="block font-display text-xl font-bold tracking-tight text-white hover:text-primary sm:text-2xl">{{ C::PHONE_DISPLAY }}</a>
                                        <span class="inline-flex items-center gap-1.5 text-[11px] text-white/60">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_0_3px_rgba(52,211,153,0.2)]"></span>
                                            <x-icons.lucide name="clock" class="h-3 w-3" /> Сейчас отвечаем
                                        </span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 sm:ml-auto">
                                    <a href="{{ C::messengerUrl(C::WHATSAPP_URL, 'hero') }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('whatsapp', 'hero')" aria-label="Написать в WhatsApp" class="flex h-11 w-11 items-center justify-center rounded-full bg-whatsapp text-whatsapp-foreground transition hover:brightness-110"><x-icons.lucide name="message-circle" class="h-5 w-5" /></a>
                                    <a href="{{ C::messengerUrl(C::TELEGRAM_URL, 'hero') }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('telegram', 'hero')" aria-label="Написать в Telegram" class="flex h-11 w-11 items-center justify-center rounded-full bg-telegram text-telegram-foreground transition hover:brightness-110"><x-icons.lucide name="send" class="h-5 w-5" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <a href="#calculator" class="block border-b border-border bg-card transition hover:bg-muted/50">
            <div class="container-x flex flex-col items-start gap-3 py-3.5 sm:flex-row sm:items-center sm:gap-6 sm:py-3">
                <div class="text-xs font-semibold uppercase tracking-wider text-muted-foreground">Цены от</div>
                <ul class="flex flex-wrap items-center gap-x-6 gap-y-1.5 text-sm">
                    <li class="flex items-baseline gap-1.5"><span class="text-muted-foreground">Резка бетона</span><span class="font-semibold text-foreground">от 1 000 ₽/п.м.</span></li>
                    <li class="flex items-baseline gap-1.5"><span class="text-muted-foreground">Бурение</span><span class="font-semibold text-foreground">от 20 ₽/см</span></li>
                    <li class="flex items-baseline gap-1.5"><span class="text-muted-foreground">Проём под дверь</span><span class="font-semibold text-foreground">от 8 500 ₽</span></li>
                </ul>
                <span class="inline-flex items-center gap-1 text-xs font-semibold text-primary sm:ml-auto">
                    Рассчитать точно <x-icons.lucide name="arrow-right" class="h-3 w-3" />
                </span>
            </div>
        </a>

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

        <section class="bg-surface py-16 sm:py-20 lg:py-24">
            <div class="container-x">
                <h2 class="font-display text-3xl font-bold tracking-tight sm:text-4xl">Почему клиенты сразу звонят нам</h2>
                <p class="mt-3 max-w-2xl text-muted-foreground">Без долгих переписок и заявок — вы получаете ответ и понятную цену сразу по телефону.</p>
                <ul class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
                    @foreach ([
                        ['Быстро понимаем задачу', 'Уточняем детали по телефону и даём предварительную оценку.'],
                        ['Точная цена без сюрпризов', 'Озвучиваем стоимость до начала работ. Без скрытых доплат.'],
                        ['Аккуратно и безопасно', 'Не повреждаем конструкции и не создаём трещин.'],
                        ['Чистота на объекте', 'Минимум пыли и воды. Убираем после себя и вывозим мусор.'],
                        ['Работаем в срок', 'Соблюдаем оговорённые сроки и не подводим клиентов.'],
                    ] as [$title, $text])
                        <li class="group rounded-2xl border border-border bg-card p-6 shadow-card transition hover:-translate-y-0.5 hover:border-primary/40">
                            <span class="inline-flex h-11 w-11 items-center justify-center rounded-lg bg-primary/15 text-primary ring-1 ring-primary/25">
                                <x-icons.lucide :name="['phone-call', 'calculator', 'shield-check', 'sparkles', 'clock'][$loop->index]" class="h-5 w-5" />
                            </span>
                            <h3 class="mt-4 text-base font-semibold">{{ $title }}</h3>
                            <p class="mt-1.5 text-sm text-muted-foreground">{{ $text }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        <section class="bg-background py-16 sm:py-20 lg:py-24">
            <div class="container-x">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <h2 class="font-display text-3xl font-bold tracking-tight sm:text-4xl">Что мы делаем</h2>
                        <p class="mt-3 max-w-2xl text-muted-foreground">Решаем задачи любой сложности. Не уверены, что именно нужно? Позвоните — подскажем лучшее решение для вашего объекта.</p>
                    </div>
                    <a href="tel:{{ C::PHONE_TEL }}" onclick="window.slomTrackCTA && window.slomTrackCTA('phone', 'services')" class="shrink-0">
                        <span class="inline-flex h-12 items-center justify-center gap-2 rounded-lg bg-yellow-gradient px-7 text-base font-semibold text-primary-foreground shadow-cta transition hover:brightness-105 active:brightness-95">
                            <x-icons.lucide name="phone" class="h-4 w-4" />
                            Позвонить и уточнить
                        </span>
                    </a>
                </div>
                <ul class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ([
                        ['case-opening.jpg', 'Резка проёмов', 'Двери, окна, арки в несущих и ненесущих стенах. Главная специализация.', true],
                        ['case-drilling.jpg', 'Алмазное бурение', 'Отверстия под вентиляцию, коммуникации, дымоходы, трубопроводы.', false],
                        ['case-demolition.jpg', 'Демонтаж конструкций', 'Демонтаж стен, перегородок, перекрытий, фундаментов без ударов и вибрации.', false],
                        ['service-reinforcement.jpg', 'Усиление проёмов', 'Усиление металлом по строительным нормам — официально и надёжно.', false],
                    ] as [$image, $title, $text, $primary])
                    <li class="group overflow-hidden rounded-2xl border bg-card shadow-card transition hover:-translate-y-0.5 {{ $primary ? 'border-primary/50 ring-1 ring-primary/30' : 'border-border hover:border-primary/40' }}">
                        <div class="relative aspect-[4/3] overflow-hidden bg-muted">
                            <img src="{{ Vite::asset('resources/images/'.$image) }}" alt="{{ $title }}" loading="lazy" width="900" height="700" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            @if($primary)<span class="absolute left-3 top-3 rounded-md bg-primary px-2.5 py-1 text-xs font-semibold text-primary-foreground">Главная услуга</span>@endif
                        </div>
                        <div class="p-5"><h3 class="text-lg font-semibold">{{ $title }}</h3><p class="mt-1.5 text-sm text-muted-foreground">{{ $text }}</p></div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </section>

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
                            <div class="overflow-x-auto rounded-xl border border-border">
                            <table class="w-full text-sm">
                                <thead class="bg-secondary text-secondary-foreground"><tr><th class="px-4 py-3 text-left font-semibold">Толщина стены</th><th class="px-4 py-3 text-right font-semibold">Бетон</th><th class="px-4 py-3 text-right font-semibold">Монолит</th><th class="px-4 py-3 text-right font-semibold">Кирпич</th></tr></thead>
                                <tbody>
                                @foreach (P::CUTTING_PRICES as $i => $row)
                                    <tr class="{{ $i % 2 ? 'bg-muted/40' : 'bg-card' }}"><td class="px-4 py-2.5 font-medium">{{ $row['thickness'] }}</td><td class="px-4 py-2.5 text-right tabular-nums">{{ number_format($row['concrete'], 0, '.', ' ') }}</td><td class="px-4 py-2.5 text-right tabular-nums">{{ number_format($row['monolith'], 0, '.', ' ') }}</td><td class="px-4 py-2.5 text-right tabular-nums">{{ number_format($row['brick'], 0, '.', ' ') }}</td></tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div x-show="tab==='drilling'" class="mt-6">
                            <div class="mb-3 text-sm text-muted-foreground">Алмазное сверление — за 1 см глубины, в рублях. Минимальный заказ — 2 000 ₽.</div>
                            <div class="overflow-x-auto rounded-xl border border-border">
                            <table class="w-full text-sm">
                                <thead class="bg-secondary text-secondary-foreground"><tr><th class="px-4 py-3 text-left font-semibold">Диаметр коронки</th><th class="px-4 py-3 text-right font-semibold">Цена за 1 см глубины</th></tr></thead>
                                <tbody>
                                @foreach (P::DRILLING_PRICES as $i => $row)
                                    <tr class="{{ $i % 2 ? 'bg-muted/40' : 'bg-card' }}"><td class="px-4 py-2.5 font-medium">{{ $row['diameter'] }}</td><td class="px-4 py-2.5 text-right tabular-nums">{{ $row['price'] }} ₽</td></tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div x-show="tab==='openings'" class="mt-6">
                            <div class="mb-3 text-sm text-muted-foreground">Проёмы под ключ (стандарт 2,1 × 0,9–1,2 м), цена с уборкой мусора</div>
                            <div class="overflow-x-auto rounded-xl border border-border">
                            <table class="w-full text-sm"><thead class="bg-secondary text-secondary-foreground"><tr><th class="px-4 py-3 text-left font-semibold">Тип работы</th><th class="px-4 py-3 text-right font-semibold">Стоимость</th></tr></thead><tbody>@foreach (P::OPENING_PRICES as $i => $row)<tr class="{{ $i % 2 ? 'bg-muted/40' : 'bg-card' }}"><td class="px-4 py-2.5 font-medium">{{ $row['type'] }}</td><td class="px-4 py-2.5 text-right tabular-nums font-semibold">{{ $row['price'] }}</td></tr>@endforeach</tbody></table>
                            </div>
                        </div>
                        <div x-show="tab==='demo'" class="mt-6">
                            <div class="mb-3 text-sm text-muted-foreground">Демонтаж стен, перегородок и санкабин</div>
                            <div class="overflow-x-auto rounded-xl border border-border">
                            <table class="w-full text-sm"><thead class="bg-secondary text-secondary-foreground"><tr><th class="px-4 py-3 text-left font-semibold">Тип</th><th class="px-4 py-3 text-right font-semibold">Стоимость</th></tr></thead><tbody>@foreach (P::DEMOLITION_PRICES as $i => $row)<tr class="{{ $i % 2 ? 'bg-muted/40' : 'bg-card' }}"><td class="px-4 py-2.5 font-medium">{{ $row['type'] }}</td><td class="px-4 py-2.5 text-right tabular-nums font-semibold">{{ $row['price'] }}</td></tr>@endforeach</tbody></table>
                            </div>
                        </div>
                        <div class="mt-6 rounded-lg border border-border px-4" x-data="{ coefOpen: false }">
                            <button type="button" class="flex w-full items-center justify-between py-4 text-left text-sm font-semibold" x-on:click="coefOpen = !coefOpen">
                                <span class="flex items-center gap-2"><x-icons.lucide name="info" class="h-4 w-4 text-primary" />Усложняющие коэффициенты — честно, без сюрпризов</span>
                                <span class="text-primary transition" :class="coefOpen ? 'rotate-180' : ''">▾</span>
                            </button>
                            <div x-show="coefOpen" x-transition class="pb-4">
                                <ul class="grid gap-1.5 text-sm text-muted-foreground sm:grid-cols-2">
                                    @foreach (P::COEFFICIENT_LABELS as $coef)
                                        <li class="flex items-start gap-2"><span class="mt-2 h-1 w-1 shrink-0 rounded-full bg-primary"></span>{{ $coef }}</li>
                                    @endforeach
                                </ul>
                                <p class="mt-3 text-xs text-muted-foreground">Не публичная оферта. В каждом случае стоимость рассчитывается на объекте индивидуально.</p>
                            </div>
                        </div>
                    </div>
                </details>
                <div class="mt-8 overflow-hidden rounded-2xl bg-secondary p-6 text-secondary-foreground sm:p-8">
                    <div class="grid grid-cols-1 items-center gap-5 lg:grid-cols-12">
                        <div class="flex items-start gap-4 lg:col-span-8">
                            <span class="hidden h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-primary/15 text-primary ring-1 ring-primary/30 sm:inline-flex">
                                <x-icons.lucide name="calculator" class="h-6 w-6" />
                            </span>
                            <div class="min-w-1">
                                <div class="font-display text-xl font-bold sm:text-2xl">Не нашли свою позицию или сомневаетесь в расчёте?</div>
                                <div class="mt-1 text-sm text-secondary-foreground/70">Назовите размеры и материал — посчитаем точную цену по телефону за 2 минуты.</div>
                            </div>
                        </div>
                        <div class="flex w-full flex-col gap-2.5 sm:flex-row lg:col-span-4 lg:flex-col lg:items-stretch xl:flex-row">
                            <a href="tel:{{ C::PHONE_TEL }}" onclick="window.slomTrackCTA && window.slomTrackCTA('phone', 'pricing')" class="sm:flex-1 xl:flex-1">
                                <span class="inline-flex h-14 w-full items-center justify-center gap-2 whitespace-nowrap rounded-xl bg-yellow-gradient px-8 text-base font-semibold text-primary-foreground shadow-cta transition hover:brightness-105 active:brightness-95"><x-icons.lucide name="phone" class="h-5 w-5" /> {{ C::PHONE_DISPLAY }}</span>
                            </a>
                            <div class="flex gap-2 sm:flex-1">
                                <a href="{{ C::messengerUrl(C::WHATSAPP_URL, 'pricing') }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('whatsapp', 'pricing')" aria-label="WhatsApp" class="flex h-14 flex-1 items-center justify-center rounded-xl bg-whatsapp text-whatsapp-foreground hover:brightness-110"><x-icons.lucide name="message-circle" class="h-5 w-5" /></a>
                                <a href="{{ C::messengerUrl(C::TELEGRAM_URL, 'pricing') }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('telegram', 'pricing')" aria-label="Telegram" class="flex h-14 flex-1 items-center justify-center rounded-xl bg-telegram text-telegram-foreground hover:brightness-110"><x-icons.lucide name="send" class="h-5 w-5" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-surface py-16 sm:py-20 lg:py-24">
            <div class="container-x">
                <h2 class="font-display text-3xl font-bold tracking-tight sm:text-4xl">Реальные работы</h2>
                <p class="mt-3 max-w-2xl text-muted-foreground">Несколько недавних объектов в Красноярске и крае.</p>
                <ul class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ([
                        ['case-opening.jpg', 'Проём в несущей стене', 'Создать арочный проём в несущей стене квартиры.', '1 день', 'Ровный проём без трещин с усилением металлом.'],
                        ['case-drilling.jpg', 'Бурение под вентиляцию', 'Сделать сквозные отверстия 200 мм для вентканалов.', '3 часа', 'Точные отверстия без пыли в жилом помещении.'],
                        ['case-demolition.jpg', 'Демонтаж перегородки', 'Снести перегородку в офисе под перепланировку.', '1 день', 'Аккуратный демонтаж без повреждений соседних стен.'],
                    ] as [$image, $title, $task, $term, $result])
                    <li class="overflow-hidden rounded-2xl border border-border bg-card shadow-card">
                        <div class="aspect-[4/3] overflow-hidden bg-muted"><img src="{{ Vite::asset('resources/images/'.$image) }}" alt="{{ $title }}" class="h-full w-full object-cover"></div>
                        <div class="space-y-3 p-6"><h3 class="text-lg font-semibold">{{ $title }}</h3><div class="space-y-2 text-sm"><div><span class="text-muted-foreground">Задача: </span>{{ $task }}</div><div><span class="text-muted-foreground">Срок: </span><span class="font-medium">{{ $term }}</span></div><div><span class="text-muted-foreground">Результат: </span>{{ $result }}</div></div></div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </section>

        <section class="bg-secondary py-16 text-secondary-foreground sm:py-20 lg:py-24">
            <div class="container-x">
                <h2 class="font-display text-3xl font-bold tracking-tight sm:text-4xl">Как мы работаем</h2>
                <ol class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-6">
                    @foreach ([
                        ['Вы звоните', 'Или пишете в WhatsApp.'],
                        ['Уточняем задачу', 'Детали и условия объекта.'],
                        ['Выезд специалиста', 'При необходимости — бесплатно.'],
                        ['Фиксируем цену', 'В договоре, без доплат.'],
                        ['Выполняем работу', 'Аккуратно и в срок.'],
                        ['Сдаём чистый объект', 'Убираем мусор за собой.'],
                    ] as $index => [$title, $text])
                    <li class="relative">
                        <div class="flex items-center gap-3 lg:flex-col lg:items-start">
                            <span class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-primary/15 text-primary ring-1 ring-primary/30">
                                <x-icons.lucide :name="['phone', 'message-square', 'truck', 'file-text', 'wrench', 'check-circle-2'][$index]" class="h-6 w-6" />
                            </span>
                            <div class="text-xs font-semibold text-primary">Шаг {{ $index + 1 }}</div>
                        </div>
                        <h3 class="mt-3 text-base font-semibold">{{ $title }}</h3>
                        <p class="mt-1 text-sm text-white/60">{{ $text }}</p>
                    </li>
                    @endforeach
                </ol>
            </div>
        </section>

        <section id="service-area" class="bg-background py-16 sm:py-20">
            <div class="container-x">
                <div class="grid gap-8 rounded-2xl border border-border bg-card p-6 shadow-card sm:p-10 lg:grid-cols-12 lg:gap-10">
                    <div class="lg:col-span-5">
                            <div class="inline-flex items-center gap-2 rounded-full border border-primary/30 bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-primary">
                                <x-icons.lucide name="map-pin" class="h-3.5 w-3.5" />
                                Зона выезда
                            </div>
                        <h2 class="mt-4 font-display text-3xl font-bold tracking-tight sm:text-4xl">Работаем по <span class="text-primary">Красноярску</span><br class="hidden sm:block"> и всему краю</h2>
                        <p class="mt-4 text-muted-foreground">По Красноярску — выезд в день обращения. По краю — в течение 24 часов после согласования.</p>
                            <div class="mt-5 flex items-start gap-3 rounded-xl bg-secondary/5 p-4 text-sm">
                                <x-icons.lucide name="truck" class="mt-0.5 h-5 w-5 shrink-0 text-primary" />
                                <div>За пределами Красноярска к стоимости работ добавляются транспортные расходы — назовём их сразу при согласовании выезда.</div>
                            </div>
                    </div>
                    <div class="lg:col-span-7">
                        <ul class="grid grid-cols-2 gap-2 sm:grid-cols-3">
                            @foreach (['Красноярск','Дивногорск','Сосновоборск','Берёзовка','Емельяново','Железногорск','Зеленогорск','Канск','Ачинск','Минусинск','Назарово'] as $city)
                                <li class="flex items-center gap-2 rounded-lg border border-border bg-background px-3 py-2.5 text-sm font-medium"><span class="h-1.5 w-1.5 shrink-0 rounded-full bg-primary"></span>{{ $city }}</li>
                            @endforeach
                            <li class="flex items-center gap-2 rounded-lg border border-dashed border-border bg-background px-3 py-2.5 text-sm text-muted-foreground">и другие населённые пункты края</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-background py-16 sm:py-20 lg:py-24">
            <div class="container-x">
                <h2 class="font-display text-3xl font-bold tracking-tight sm:text-4xl">Нам доверяют</h2>
                <div class="mt-10 grid gap-10 lg:grid-cols-2">
                    <div class="grid grid-cols-3 gap-6">
                        @foreach ([['25 лет', 'на рынке'], ['2000+', 'успешных проектов'], ['100%', 'положительных отзывов']] as [$value, $label])
                        <div><div class="font-display text-3xl font-bold sm:text-4xl">{{ $value }}</div><div class="mt-1 text-sm text-muted-foreground">{{ $label }}</div></div>
                        @endforeach
                    </div>
                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                        @foreach (['СРО и допуски', 'Страховка ответственности', 'Работаем по договору'] as $doc)
                        <div class="flex items-center gap-3 rounded-xl border border-border bg-card p-4 shadow-card">
                            <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-primary/15 text-primary ring-1 ring-primary/25">
                                <x-icons.lucide :name="['award', 'shield-check', 'file-check'][$loop->index]" class="h-5 w-5" />
                            </span>
                            <div class="text-sm font-medium">{{ $doc }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="relative mt-16 overflow-hidden rounded-2xl border border-border bg-gradient-to-br from-surface via-card to-surface p-6 shadow-card sm:mt-20 sm:p-10">
                    <div class="pointer-events-none absolute -right-16 -top-16 h-56 w-56 rounded-full bg-primary/10 blur-3xl"></div>
                    <div class="pointer-events-none absolute -bottom-16 -left-16 h-56 w-56 rounded-full bg-primary/5 blur-3xl"></div>
                    <div class="relative flex flex-col items-start justify-between gap-3 sm:flex-row sm:items-end">
                        <div>
                            <div class="inline-flex items-center gap-2 rounded-full border border-primary/30 bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-foreground">
                                <span class="h-1.5 w-1.5 rounded-full bg-primary"></span>
                                С нами работали
                            </div>
                            <h3 class="mt-3 font-display text-2xl font-bold tracking-tight sm:text-3xl">Корпоративные клиенты, которые нам доверяют</h3>
                            <p class="mt-2 max-w-xl text-sm text-muted-foreground sm:text-base">Более 300 компаний выбирают нас для обслуживания своих объектов — от ТРЦ и заводов до банков и аэропортов.</p>
                        </div>
                        <div class="hidden shrink-0 text-right sm:block">
                            <div class="font-display text-4xl font-bold text-primary">300+</div>
                            <div class="text-xs uppercase tracking-wider text-muted-foreground">партнёров</div>
                        </div>
                    </div>
                    <div class="relative mt-8 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-5">
                        @foreach ([
                            ['clients/planeta.jpg', 'ТРЦ Планета'],
                            ['clients/rosneft.jpg', 'Роснефть · Ачинский НПЗ'],
                            ['clients/sberbank.jpg', 'Сбербанк России'],
                            ['clients/opera.jpg', 'Театр оперы и балета'],
                            ['clients/kultbytstroy.jpg', 'Культбытстрой'],
                            ['clients/emelyanovo.jpg', 'Аэропорт Емельяново'],
                            ['clients/sibiryak.jpg', 'Сибиряк'],
                            ['clients/bellini.jpg', 'Bellini Group'],
                            ['clients/kraskom.jpg', 'КрасКом'],
                            ['clients/sgk.jpg', 'Сибирская генерирующая компания'],
                        ] as [$logo, $client])
                            <div title="{{ $client }}" class="group relative flex h-32 items-center justify-center overflow-hidden rounded-2xl border border-border bg-card p-5 shadow-card transition-all duration-300 hover:-translate-y-1 hover:border-primary/40 hover:shadow-elevated sm:h-36">
                                <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-primary/0 to-primary/0 transition-all duration-300 group-hover:from-primary/5 group-hover:to-transparent"></div>
                                <img src="{{ Vite::asset('resources/images/'.$logo) }}" alt="{{ $client }}" class="relative max-h-20 w-auto max-w-full object-contain grayscale transition-all duration-500 group-hover:scale-105 group-hover:grayscale-0 sm:max-h-24">
                                <div class="absolute inset-x-0 bottom-0 translate-y-full bg-secondary/95 px-3 py-2 text-center text-xs font-medium text-secondary-foreground backdrop-blur transition-transform duration-300 group-hover:translate-y-0">{{ $client }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-surface py-16 sm:py-20 lg:py-24" x-data="{ certOpen: false, certImage: '', certTitle: '', certSubtitle: '' }">
            <div class="container-x">
                <div class="relative overflow-hidden rounded-2xl border border-border bg-gradient-to-br from-card via-background to-card p-6 shadow-card sm:p-10">
                    <div class="pointer-events-none absolute -right-20 -top-20 h-64 w-64 rounded-full bg-primary/10 blur-3xl"></div>
                    <div class="pointer-events-none absolute -bottom-20 -left-20 h-64 w-64 rounded-full bg-primary/5 blur-3xl"></div>
                    <div class="relative flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-end">
                        <div>
                            <div class="inline-flex items-center gap-2 rounded-full border border-primary/30 bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-foreground"><x-icons.lucide name="shield-check" class="h-3.5 w-3.5 text-primary" />Допуски и сертификаты</div>
                            <h2 class="mt-3 font-display text-3xl font-bold tracking-tight sm:text-4xl">Работаем официально с <span class="text-primary">2001 года</span></h2>
                            <p class="mt-2 max-w-2xl text-sm text-muted-foreground sm:text-base">Свидетельство СРО и допуски ко всем видам работ на объектах капитального строительства. Все документы — в открытом доступе.</p>
                        </div>
                        <div class="hidden shrink-0 items-center gap-2 rounded-xl border border-border bg-card px-4 py-3 shadow-card sm:flex">
                            <x-icons.lucide name="award" class="h-5 w-5 text-primary" />
                            <div><div class="font-display text-lg font-bold leading-none">8</div><div class="text-xs uppercase tracking-wider text-muted-foreground">документов</div></div>
                        </div>
                    </div>
                    <div class="relative mt-8 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
                        @foreach ([
                            ['certificates/sro-cover.jpg', 'Свидетельство СРО', '№ С-248-2466270133-01'],
                            ['certificates/sro-1.jpg', 'Приложение · стр. 1', 'Виды работ'],
                            ['certificates/sro-2.jpg', 'Приложение · стр. 2', 'Подготовительные и земляные работы'],
                            ['certificates/sro-3.jpg', 'Приложение · стр. 3', 'Наружные сети и газоснабжение'],
                            ['certificates/sro-4.jpg', 'Приложение · стр. 4', 'Монтажные и пусконаладочные работы'],
                            ['certificates/sro-5.jpg', 'Приложение · стр. 5', 'Дороги, мосты, гидротехника'],
                            ['certificates/sro-6.jpg', 'Приложение · стр. 6', 'Строительный контроль'],
                            ['certificates/sro-7.jpg', 'Приложение · стр. 7', 'Организация строительства'],
                        ] as [$image, $title, $subtitle])
                        <button
                            type="button"
                            class="group relative overflow-hidden rounded-xl border border-border bg-card text-left shadow-card transition-all duration-300 hover:-translate-y-1 hover:border-primary/40 hover:shadow-elevated"
                            data-cert-image="{{ Vite::asset('resources/images/'.$image) }}"
                            data-cert-title="{{ $title }}"
                            data-cert-subtitle="{{ $subtitle }}"
                            x-on:click="certOpen = true; certImage = $el.dataset.certImage; certTitle = $el.dataset.certTitle; certSubtitle = $el.dataset.certSubtitle"
                        >
                            <div class="relative aspect-[3/4] w-full overflow-hidden bg-muted">
                                <img src="{{ Vite::asset('resources/images/'.$image) }}" alt="{{ $title }}" loading="lazy" class="h-full w-full object-cover object-top transition-transform duration-500 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-secondary/80 via-secondary/0 to-secondary/0 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
                                <div class="absolute right-3 top-3 flex h-9 w-9 items-center justify-center rounded-full bg-primary text-primary-foreground opacity-0 shadow-cta transition-opacity duration-300 group-hover:opacity-100"><x-icons.lucide name="zoom-in" class="h-4 w-4" /></div>
                            </div>
                            <div class="border-t border-border p-3"><div class="truncate font-display text-sm font-semibold">{{ $title }}</div><div class="mt-0.5 truncate text-xs text-muted-foreground">{{ $subtitle }}</div></div>
                        </button>
                        @endforeach
                    </div>
                </div>
            </div>
            <div x-show="certOpen" x-transition.opacity class="fixed inset-0 z-[80] flex items-center justify-center bg-black/70 p-4">
                <div class="max-h-[92vh] w-full max-w-4xl overflow-hidden rounded-xl bg-card">
                    <div class="flex items-center justify-between gap-4 border-b border-border px-5 py-3">
                        <div class="min-w-0"><div class="truncate font-display text-base font-semibold" x-text="certTitle"></div><div class="truncate text-xs text-muted-foreground" x-text="certSubtitle"></div></div>
                        <button type="button" class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-lg border border-border bg-background transition hover:bg-muted" x-on:click="certOpen = false" aria-label="Закрыть"><x-icons.lucide name="x" class="h-4 w-4" /></button>
                    </div>
                    <div class="overflow-auto bg-muted p-4"><img :src="certImage" :alt="certTitle" class="mx-auto h-auto w-full max-w-3xl rounded-md shadow-elevated"></div>
                </div>
            </div>
        </section>

        <section id="reviews" class="bg-background py-16 sm:py-20 lg:py-24">
            <div class="container-x">
                <div class="flex flex-col items-start gap-6 lg:flex-row lg:items-end lg:justify-between">
                    <div class="max-w-2xl">
                        <div class="inline-flex items-center gap-2 rounded-full border border-primary/30 bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-primary">Отзывы клиентов</div>
                        <h2 class="mt-4 font-display text-3xl font-bold tracking-tight sm:text-4xl lg:text-5xl">Нам ставят <span class="text-primary">{{ C::YANDEX_RATING }} ★</span><br class="hidden sm:block"> на Яндекс.Картах</h2>
                        <p class="mt-4 text-base text-muted-foreground sm:text-lg">Реальные отзывы людей, для которых мы делали работу. Все можно проверить на Яндексе.</p>
                    </div>
                    <a href="{{ C::YANDEX_PROFILE_URL }}" target="_blank" rel="noopener" class="inline-flex items-center gap-3 rounded-xl border border-border bg-card px-4 py-3 shadow-card transition hover:border-primary/40 hover:shadow-elevated">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#FC3F1D] font-bold text-white">Я</div>
                        <div><div class="flex items-center gap-1.5"><span class="font-display text-2xl font-bold leading-none">{{ C::YANDEX_RATING }}</span><span class="text-primary">★★★★★</span></div><div class="text-xs text-muted-foreground">Рейтинг на Яндекс.Картах</div></div>
                    </a>
                </div>
                <div class="mt-12 grid gap-5 md:grid-cols-2">
                    @foreach ([
                        ['Григорий С.', '25 отзывов · Знаток города 5 уровня', '23 октября 2025', 'Огромная благодарность! Приехал мужчина, всё подробно рассказал, проконсультировал, объяснил, на что обратить внимание. Очень вежливый, профессиональный и доброжелательный. Остались только положительные впечатления — видно, что человек знает своё дело. Рекомендую!'],
                        ['Сергей', 'Знаток города 2 уровня', '12 июля 2024', 'Большое спасибо Евгению за подробную консультацию с выездом на объект! Очень грамотный специалист, я обратился по поводу трещины во внутренней стене дома. Евгений очень подробно всё разъяснил по поводу причин возникновения и методов устранения. Я очень благодарен за высокий профессионализм и ответственное отношение к работе.'],
                        ['Светлана А.', '68 отзывов · Знаток города 12 уровня', '6 декабря 2023', 'В организацию обращалась неоднократно и с разными запросами: установка крыльца в нежилом помещении (прошло уже 10 лет — крыльцо как новое!), установка ж/б конструкции в лестничном проёме, ж/б конструкции для возведения балкона. Всё быстро, аккуратно, в срок. Работой осталась очень довольна!'],
                        ['Сергей Ф.', 'Знаток города 3 уровня', '30 марта 2024', 'Вырезали дверной проём в кирпичном доме, расширяли другие два проёма. На осмотр и сами работы приехали в назначенный день и время, после работ прибрали мусор. По выбору места проёма и его усиления дали чёткие рекомендации, виден профессионализм и инженерное мышление Евгения. Подобные работы нужно доверять только профессионалам с большим опытом.'],
                    ] as [$name, $meta, $date, $text])
                    <figure class="flex flex-col rounded-2xl border border-border bg-card p-6 shadow-card transition hover:-translate-y-0.5 hover:shadow-elevated">
                        <div class="flex items-start justify-between gap-3"><div class="flex items-center gap-3"><div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-secondary font-display text-lg font-bold text-secondary-foreground">{{ mb_substr($name, 0, 1) }}</div><div><div class="font-semibold leading-tight">{{ $name }}</div><div class="text-[11px] text-muted-foreground">{{ $meta }}</div></div></div><div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-md bg-[#FC3F1D] text-xs font-bold text-white">Я</div></div>
                        <div class="mt-4 flex items-center justify-between"><span class="text-primary">★★★★★</span><span class="text-xs text-muted-foreground">{{ $date }}</span></div>
                        <blockquote class="mt-4 flex-1 text-sm leading-relaxed text-foreground/90">{{ $text }}</blockquote>
                    </figure>
                    @endforeach
                </div>
                <div class="mt-8 text-center">
                    <a href="{{ C::YANDEX_PROFILE_URL }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-sm font-semibold text-foreground hover:text-primary">
                        Смотреть все отзывы на Яндекс.Картах
                        <x-icons.lucide name="external-link" class="h-4 w-4" />
                    </a>
                </div>
            </div>
        </section>

        <section id="team" class="relative overflow-hidden bg-secondary py-20 text-secondary-foreground sm:py-24 lg:py-28">
            <div class="pointer-events-none absolute inset-0 opacity-[0.07]" aria-hidden="true">
                <div class="absolute inset-0 [background-image:radial-gradient(hsl(var(--primary))_1px,transparent_1px)] [background-size:28px_28px]"></div>
            </div>
            <div class="pointer-events-none absolute -right-40 -top-40 h-[480px] w-[480px] rounded-full bg-yellow-gradient opacity-20 blur-3xl" aria-hidden="true"></div>
            <div class="pointer-events-none absolute -bottom-40 -left-40 h-[420px] w-[420px] rounded-full bg-yellow-gradient opacity-10 blur-3xl" aria-hidden="true"></div>
            <div class="container-x relative">
                <div class="flex flex-col items-start gap-6 lg:flex-row lg:items-end lg:justify-between">
                    <div class="max-w-2xl">
                        <div class="inline-flex items-center gap-2 rounded-full border border-primary/30 bg-primary/10 px-3 py-1 text-xs font-medium uppercase tracking-wider text-primary"><span class="h-1.5 w-1.5 rounded-full bg-primary"></span>Наша команда</div>
                        <h2 class="mt-4 font-display text-3xl font-bold tracking-tight sm:text-4xl lg:text-5xl">Мастера, которые <span class="text-primary">приедут к вам</span></h2>
                        <p class="mt-4 text-base text-secondary-foreground/70 sm:text-lg">Никаких подрядчиков с улицы — только наши проверенные специалисты со стажем 5–20+ лет.</p>
                    </div>
                    <div class="grid w-full grid-cols-3 gap-px overflow-hidden rounded-2xl border border-white/10 bg-white/5 backdrop-blur lg:w-auto">
                        <div class="bg-secondary/60 px-5 py-4 text-center lg:px-7"><div class="font-display text-2xl font-bold text-primary sm:text-3xl">9</div><div class="mt-1 text-[11px] uppercase tracking-wider text-secondary-foreground/60">мастеров</div></div>
                        <div class="bg-secondary/60 px-5 py-4 text-center lg:px-7"><div class="font-display text-2xl font-bold text-primary sm:text-3xl">89+</div><div class="mt-1 text-[11px] uppercase tracking-wider text-secondary-foreground/60">лет опыта</div></div>
                        <div class="bg-secondary/60 px-5 py-4 text-center lg:px-7"><div class="font-display text-2xl font-bold text-primary sm:text-3xl">100%</div><div class="mt-1 text-[11px] uppercase tracking-wider text-secondary-foreground/60">в штате</div></div>
                    </div>
                </div>
                <div class="mt-14 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ([
                        ['team/1-evgeniy.png', 'Евгений', '20+ лет', 'руководитель'],
                        ['team/2-viktor.png', 'Виктор', '10+ лет', 'помощник руководителя'],
                        ['team/3-dmitriy.png', 'Дмитрий', '10+ лет', 'старший мастер'],
                        ['team/4-igor.png', 'Игорь', '10+ лет', 'мастер алмазного бурения и резки'],
                        ['team/5-aleksandr.png', 'Александр', '10+ лет', 'мастер алмазного бурения и резки'],
                        ['team/6-artem.png', 'Артём', '10+ лет', 'мастер алмазного бурения и резки'],
                        ['team/7-vladimir.png', 'Владимир', '10+ лет', 'мастер бурения, резки и монтажно-сварочных работ'],
                        ['team/8-konstantin.png', 'Константин', '5 лет', 'специалист по монтажно-сварочным работам'],
                        ['team/9-dmitriy.png', 'Дмитрий', '4 года', 'мастер монтажно-сварочных работ'],
                    ] as [$photo, $name, $years, $role])
                    <div class="group relative overflow-hidden rounded-2xl border border-white/10 bg-white/[0.03] p-6 backdrop-blur-sm transition-all duration-300 hover:-translate-y-1 hover:border-primary/40 hover:bg-white/[0.06]">
                        <div class="pointer-events-none absolute -right-20 -top-20 h-44 w-44 rounded-full bg-yellow-gradient opacity-0 blur-3xl transition-opacity duration-500 group-hover:opacity-30" aria-hidden="true"></div>
                        <div class="relative flex items-start gap-4">
                            <div class="relative shrink-0">
                                <img src="{{ Vite::asset('resources/images/'.$photo) }}" alt="{{ $name }}" class="h-16 w-16 rounded-full object-cover ring-2 ring-primary/40 ring-offset-2 ring-offset-secondary">
                                <span class="absolute -bottom-1 -right-1 inline-flex h-7 w-7 items-center justify-center rounded-full bg-primary text-secondary ring-2 ring-secondary"><x-icons.lucide :name="['award', 'hard-hat', 'hard-hat', 'wrench', 'wrench', 'wrench', 'flame', 'flame', 'flame'][$loop->index]" class="h-3.5 w-3.5" /></span>
                            </div>
                            <div class="min-w-0 flex-1 pt-0.5">
                                <h3 class="font-display text-lg font-semibold leading-tight">{{ $name }}</h3>
                                <div class="mt-1 inline-flex items-center rounded-full bg-primary/15 px-2 py-0.5 text-[11px] font-semibold uppercase tracking-wider text-primary">стаж {{ $years }}</div>
                                <p class="mt-3 text-sm leading-relaxed text-secondary-foreground/70">{{ $role }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-12 flex flex-col items-center gap-4 rounded-2xl border border-white/10 bg-white/[0.03] p-6 text-center sm:flex-row sm:justify-between sm:text-left">
                    <div>
                        <div class="font-display text-lg font-semibold sm:text-xl">Хотите, чтобы наш мастер приехал на ваш объект?</div>
                        <div class="mt-1 text-sm text-secondary-foreground/70">Оценим работу и сразу скажем точную цену.</div>
                    </div>
                    <a href="tel:{{ C::PHONE_TEL }}" class="inline-flex h-12 w-full items-center justify-center gap-2 rounded-lg bg-yellow-gradient px-7 text-base font-semibold text-primary-foreground shadow-cta transition hover:brightness-105 active:brightness-95 sm:w-auto"><x-icons.lucide name="phone" class="h-4 w-4" /> {{ C::PHONE_DISPLAY }}</a>
                </div>
            </div>
        </section>

        <section class="bg-surface py-16 sm:py-20 lg:py-24">
            <div class="container-x max-w-4xl">
                <h2 class="font-display text-3xl font-bold tracking-tight sm:text-4xl">Часто задаваемые вопросы</h2>
                <div class="mt-8 divide-y divide-border rounded-2xl border border-border bg-card shadow-card" x-data="{ open: 0 }">
                    @foreach ([
                        ['q' => 'Сколько стоит алмазная резка?', 'a' => 'Цена зависит от толщины бетона, объёма и сложности. Скажем стоимость по телефону за 2–3 минуты.'],
                        ['q' => 'Можно ли срочно выполнить работу?', 'a' => 'Да, часто выезжаем в день обращения. Позвоните — проверим возможность.'],
                        ['q' => 'Вы работаете по договору?', 'a' => 'Да, заключаем официальный договор и даём гарантию на выполненные работы.'],
                        ['q' => 'Будет ли пыль и грязь?', 'a' => 'Используем профессиональное оборудование с подачей воды. Пыли минимум, убираем после себя.'],
                        ['q' => 'Работаете с несущими стенами?', 'a' => 'Да, выполняем резку в несущих стенах с обязательным усилением проёмов и соблюдением всех норм.'],
                        ['q' => 'Куда выезжаете?', 'a' => 'Красноярск и все районы Красноярского края.'],
                    ] as $index => $faq)
                        <div class="px-5 sm:px-6">
                            <button type="button" class="flex w-full items-center justify-between py-4 text-left text-base font-semibold" x-on:click="open = open === {{ $index }} ? -1 : {{ $index }}">
                                <span>{{ $faq['q'] }}</span>
                                <span>▾</span>
                            </button>
                            <div class="pb-4 text-sm text-muted-foreground" x-show="open === {{ $index }}" x-transition>{{ $faq['a'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="relative isolate overflow-hidden bg-secondary py-16 text-white sm:py-20">
            <div class="absolute inset-0 -z-10 opacity-25">
                <img src="{{ Vite::asset('resources/images/hero-cutting.jpg') }}" alt="" class="h-full w-full object-cover">
                <div class="absolute inset-0 bg-secondary/70"></div>
            </div>
            <div class="container-x">
                <div class="grid items-center gap-8 lg:grid-cols-2">
                    <div><h2 class="font-display text-3xl font-bold leading-tight sm:text-4xl">Нужно срочно? Позвоните — <span class="text-primary">подскажем решение уже сейчас!</span></h2><p class="mt-3 text-white/70">Ответим за 5 минут. Назовём точную цену по телефону.</p></div>
                    <div class="rounded-2xl border border-white/10 bg-black/40 p-6 backdrop-blur-md">
                        <a href="tel:{{ C::PHONE_TEL }}" class="block text-center font-display text-3xl font-bold tracking-tight hover:text-primary sm:text-4xl">{{ C::PHONE_DISPLAY }}</a>
                        <p class="mt-2 text-center text-sm text-white/60">Ответим за 5 минут</p>
                        <div class="mt-5 grid gap-3 sm:grid-cols-3">
                            <a href="tel:{{ C::PHONE_TEL }}" onclick="window.slomTrackCTA && window.slomTrackCTA('phone', 'final_btn')">
                                <span class="inline-flex h-14 w-full items-center justify-center gap-2 rounded-xl bg-yellow-gradient px-8 text-base font-semibold text-primary-foreground shadow-cta transition hover:brightness-105 active:brightness-95"><x-icons.lucide name="phone" class="h-5 w-5" /> Позвонить</span>
                            </a>
                            <a href="{{ C::messengerUrl(C::WHATSAPP_URL) }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('whatsapp', 'final')">
                                <span class="inline-flex h-14 w-full items-center justify-center gap-2 rounded-xl bg-whatsapp px-8 text-base font-semibold text-whatsapp-foreground transition hover:bg-whatsapp/90"><x-icons.lucide name="message-circle" class="h-5 w-5" /> WhatsApp</span>
                            </a>
                            <a href="{{ C::messengerUrl(C::TELEGRAM_URL) }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('telegram', 'final')">
                                <span class="inline-flex h-14 w-full items-center justify-center gap-2 rounded-xl bg-telegram px-8 text-base font-semibold text-telegram-foreground transition hover:bg-telegram/90"><x-icons.lucide name="send" class="h-5 w-5" /> Telegram</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="bg-secondary text-secondary-foreground">
            <div class="container-x py-12 sm:py-14">
                <div class="grid gap-10 lg:grid-cols-12">
                    <div class="lg:col-span-5">
                        <div class="text-xs font-semibold uppercase tracking-wider text-white/50">Звоните напрямую</div>
                        <a href="tel:{{ C::PHONE_TEL }}" onclick="window.slomTrackCTA && window.slomTrackCTA('phone', 'footer')" class="mt-2 flex items-center gap-3 font-display text-2xl font-bold text-white transition hover:text-primary sm:text-3xl">
                            <span class="flex h-11 w-11 items-center justify-center rounded-full bg-primary text-primary-foreground"><x-icons.lucide name="phone" class="h-5 w-5" /></span>
                            {{ C::PHONE_DISPLAY }}
                        </a>
                        <div class="mt-2 flex flex-col gap-1 text-sm">
                            <a href="tel:{{ C::PHONE_SECONDARY_TEL }}" onclick="window.slomTrackCTA && window.slomTrackCTA('phone', 'footer_secondary')" class="text-white/80 transition hover:text-primary">{{ C::PHONE_SECONDARY_DISPLAY }} <span class="text-white/40">— офис</span></a>
                            <a href="tel:{{ C::PHONE_MOBILE_TEL }}" onclick="window.slomTrackCTA && window.slomTrackCTA('phone', 'footer_mobile')" class="text-white/80 transition hover:text-primary">{{ C::PHONE_MOBILE_DISPLAY }} <span class="text-white/40">— мобильный</span></a>
                        </div>
                        <div class="mt-3 flex flex-wrap items-center gap-x-3 gap-y-1.5 text-sm">
                            <span class="inline-flex items-center gap-1.5 text-white/70">
                                <span class="h-2 w-2 rounded-full {{ C::isOpenNow() ? 'bg-emerald-400 shadow-[0_0_0_3px_rgba(52,211,153,0.2)]' : 'bg-white/30' }}"></span>
                                <span class="font-semibold text-white">{{ C::isOpenNow() ? 'Сейчас открыто' : 'Сейчас закрыто' }}</span>
                            </span>
                            <span class="text-white/50">·</span>
                            <span class="text-white/60">{{ C::WORK_HOURS_LABEL }}</span>
                        </div>
                        <div class="mt-5 flex flex-wrap items-center gap-2">
                            <button type="button" x-data x-on:click="window.slomTrackCTA && window.slomTrackCTA('callback', 'footer'); $dispatch('open-callback', { source: 'footer' })" class="inline-flex h-12 items-center justify-center gap-2 rounded-lg bg-yellow-gradient px-7 text-base font-semibold text-primary-foreground shadow-cta transition hover:brightness-105 active:brightness-95">
                                <x-icons.lucide name="phone-call" class="h-4 w-4" /> Жду звонка
                            </button>
                            <a href="{{ C::messengerUrl(C::WHATSAPP_URL, 'footer') }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('whatsapp', 'footer')" aria-label="WhatsApp" class="flex h-12 w-12 items-center justify-center rounded-lg bg-whatsapp text-whatsapp-foreground hover:brightness-110"><x-icons.lucide name="message-circle" class="h-5 w-5" /></a>
                            <a href="{{ C::messengerUrl(C::TELEGRAM_URL, 'footer') }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('telegram', 'footer')" aria-label="Telegram" class="flex h-12 w-12 items-center justify-center rounded-lg bg-telegram text-telegram-foreground hover:brightness-110"><x-icons.lucide name="send" class="h-5 w-5" /></a>
                            <a href="{{ C::MAX_URL }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('max', 'footer')" aria-label="Max" class="flex h-12 w-12 items-center justify-center rounded-lg bg-max text-max-foreground hover:brightness-110"><x-icons.max class="h-5 w-5" /></a>
                        </div>
                    </div>
                    <div class="lg:col-span-4">
                        <div class="text-xs font-semibold uppercase tracking-wider text-white/50">Отзывы и рейтинг</div>
                        <a href="{{ C::YANDEX_PROFILE_URL }}" target="_blank" rel="noopener" class="mt-3 flex items-center gap-3 rounded-xl border border-white/10 bg-white/5 px-4 py-3 transition hover:border-primary/40 hover:bg-white/10">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#FC3F1D] font-bold text-white">Я</div>
                            <div class="flex-1">
                                <div class="flex items-center gap-1.5">
                                    <span class="font-display text-xl font-bold leading-none text-white">{{ C::YANDEX_RATING }}</span>
                                    <span class="flex gap-0.5 text-primary">@for ($i = 0; $i < 5; $i++)<x-icons.lucide name="star" class="h-3.5 w-3.5 fill-current" />@endfor</span>
                                </div>
                                <div class="text-xs text-white/60">Профиль на Яндекс.Картах</div>
                            </div>
                            <x-icons.lucide name="external-link" class="h-4 w-4 text-white/40" />
                        </a>
                    </div>
                    <div class="lg:col-span-3">
                        <div class="text-xs font-semibold uppercase tracking-wider text-white/50">Офис и контакты</div>
                        <a href="{{ C::ADDRESS_MAP_URL }}" target="_blank" rel="noopener" class="mt-3 flex items-start gap-2 text-sm text-white/80 transition hover:text-primary"><x-icons.lucide name="map-pin" class="mt-0.5 h-4 w-4 shrink-0 text-primary" /><span>{{ C::ADDRESS }}</span></a>
                        <a href="mailto:{{ C::EMAIL }}" onclick="window.slomTrackCTA && window.slomTrackCTA('email', 'footer')" class="mt-2 flex items-center gap-2 text-sm text-white/80 transition hover:text-primary"><x-icons.lucide name="mail" class="h-4 w-4 shrink-0 text-primary" /><span>{{ C::EMAIL }}</span></a>
                        <div class="mt-3 text-xs text-white/60">{{ C::COMPANY }} — алмазная резка, бурение и демонтаж бетона в Красноярске и крае с 2001 года.</div>
                    </div>
                </div>
                <div class="mt-10 flex flex-col items-start justify-between gap-3 border-t border-white/10 pt-6 text-xs text-white/50 sm:flex-row sm:items-center">
                    <div>© {{ now()->year }} {{ C::COMPANY }}. Все права защищены.</div>
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-1">
                        <a href="{{ route('privacy') }}" class="text-white/70 transition hover:text-primary" wire:navigate>Политика конфиденциальности</a>
                        <a href="{{ route('terms') }}" class="text-white/70 transition hover:text-primary" wire:navigate>Соглашение об обработке персональных данных</a>
                        <span>Информация на сайте не является публичной офертой.</span>
                    </div>
                </div>
            </div>
        </footer>

        <div class="fixed inset-x-0 bottom-0 z-40 lg:hidden">
            <div class="grid grid-cols-5 border-t border-border bg-background shadow-elevated">
                <a href="tel:{{ C::PHONE_TEL }}" onclick="window.slomTrackCTA && window.slomTrackCTA('phone', 'sticky')" class="flex flex-col items-center justify-center gap-0.5 bg-yellow-gradient py-2.5 text-[10px] font-semibold text-primary-foreground active:brightness-95"><x-icons.lucide name="phone" class="h-4 w-4" />Позвонить</a>
                <a href="{{ C::messengerUrl(C::WHATSAPP_URL) }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('whatsapp', 'sticky')" class="flex flex-col items-center justify-center gap-0.5 bg-whatsapp py-2.5 text-[10px] font-semibold text-whatsapp-foreground active:brightness-95"><x-icons.lucide name="message-circle" class="h-4 w-4" />WhatsApp</a>
                <a href="{{ C::messengerUrl(C::TELEGRAM_URL) }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('telegram', 'sticky')" class="flex flex-col items-center justify-center gap-0.5 bg-telegram py-2.5 text-[10px] font-semibold text-telegram-foreground active:brightness-95"><x-icons.lucide name="send" class="h-4 w-4" />Telegram</a>
                <a href="{{ C::MAX_URL }}" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('max', 'sticky')" class="flex flex-col items-center justify-center gap-0.5 bg-max py-2.5 text-[10px] font-semibold text-max-foreground active:brightness-95"><x-icons.max class="h-4 w-4" />Max</a>
                <button type="button" class="flex flex-col items-center justify-center gap-0.5 bg-secondary py-2.5 text-[10px] font-semibold text-secondary-foreground active:brightness-95" x-data x-on:click="window.slomTrackCTA && window.slomTrackCTA('callback', 'sticky'); $dispatch('open-callback', { source: 'sticky' })"><x-icons.lucide name="phone-call" class="h-4 w-4" />Звонок</button>
            </div>
        </div>

        <livewire:landing.callback-dialog />
        <x-landing.cookie-consent />
    </main>
</x-layouts.app>
