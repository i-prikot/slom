@php
    use App\Support\LandingContact as C;
@endphp

@props([
    'cuttingPrices',
    'drillingPrices',
    'openingPrices',
    'demolitionPrices',
    'coefficients',
])

<div
    id="calculator" class="overflow-hidden rounded-2xl border-2 border-primary/30 bg-card shadow-card"
    x-data="pricingCalculator({
        cuttingPrices: @js($cuttingPrices),
        drillingPrices: @js($drillingPrices),
        openingPrices: @js($openingPrices),
        demolitionPrices: @js($demolitionPrices),
        coefficients: @js($coefficients),
        whatsappBaseUrl: @js(C::WHATSAPP_URL),
        telegramBaseUrl: @js(C::TELEGRAM_URL),
    })"
>
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
            <template x-if="step > 1 && step < 5">
                <div class="hidden text-xs font-semibold text-muted-foreground sm:block">Шаг <span x-text="step"></span> / 4</div>
            </template>
        </div>
        <template x-if="step < 5">
            <div class="mt-3 h-1.5 overflow-hidden rounded-full bg-secondary/20">
                <div class="h-full bg-primary transition-all duration-300" :class="progressClass"></div>
            </div>
        </template>
    </div>

    <div class="p-5 sm:p-6">
        <div x-show="step === 1" class="animate-in fade-in duration-200">
            <div class="mb-4 text-sm font-semibold uppercase tracking-wider text-muted-foreground">Что нужно сделать?</div>
            <div class="grid gap-3 sm:grid-cols-2">
                <template x-for="option in workOptions" :key="option.id">
                    <button type="button" @click="workType = option.id" class="cursor-pointer rounded-xl border-2 bg-card p-4 text-left transition hover:border-primary/60 hover:bg-primary/5" :class="workType === option.id ? 'border-primary bg-primary/10 ring-2 ring-primary/30' : 'border-border'">
                        <div class="font-semibold" x-text="option.title"></div>
                        <div class="mt-1 text-xs text-muted-foreground" x-text="option.desc"></div>
                    </button>
                </template>
            </div>
        </div>

        <div x-show="step === 2" class="animate-in fade-in duration-200">
            <div class="mb-4 text-sm font-semibold uppercase tracking-wider text-muted-foreground">Материал стены</div>
            <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
                <template x-for="materialOption in materialOptions" :key="materialOption.id">
                    <button type="button" @click="material = materialOption.id" class="cursor-pointer rounded-xl border-2 bg-card p-4 text-center transition hover:border-primary/60 hover:bg-primary/5" :class="material === materialOption.id ? 'border-primary bg-primary/10 ring-2 ring-primary/30' : 'border-border'">
                        <div class="font-semibold" x-text="materialOption.label"></div>
                    </button>
                </template>
            </div>
            <p class="mt-3 text-xs text-muted-foreground">Не уверены? Выберите «Не знаю» — посчитаем по среднему, точную цену уточним по телефону.</p>
        </div>

        <div x-show="step === 3" class="animate-in fade-in space-y-4 duration-200">
            <div class="text-sm font-semibold uppercase tracking-wider text-muted-foreground">Размеры</div>

            <div x-show="workType === 'cutting'" class="grid gap-4 sm:grid-cols-2">
                <label class="block">
                    <div class="mb-1.5 text-sm font-medium">Толщина стены, см</div>
                    <input x-model.number="thicknessCm" type="number" min="5" max="75" class="w-full rounded-lg border border-input bg-background px-3 py-2">
                </label>
                <label class="block">
                    <div class="mb-1.5 text-sm font-medium">Длина реза, погонных метров</div>
                    <input x-model.number="lengthM" type="number" min="0.5" step="0.5" class="w-full rounded-lg border border-input bg-background px-3 py-2">
                </label>
            </div>

            <div x-show="workType === 'drilling'" class="grid gap-4 sm:grid-cols-2">
                <label class="block">
                    <div class="mb-1.5 text-sm font-medium">Диаметр отверстия, мм</div>
                    <input x-model.number="diameterMm" type="number" min="25" max="800" class="w-full rounded-lg border border-input bg-background px-3 py-2">
                </label>
                <label class="block">
                    <div class="mb-1.5 text-sm font-medium">Глубина, см</div>
                    <input x-model.number="depthCm" type="number" min="5" class="w-full rounded-lg border border-input bg-background px-3 py-2">
                </label>
            </div>

            <div x-show="workType === 'opening'" class="grid gap-2">
                <template x-for="(row, index) in openingPrices" :key="'opening-' + index">
                    <button type="button" @click="presetIndex = index" class="cursor-pointer rounded-xl border-2 p-3 text-left transition hover:border-primary/60 hover:bg-primary/5" :class="presetIndex === index ? 'border-primary bg-primary/10 ring-2 ring-primary/30' : 'border-border bg-card'">
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-sm font-medium" x-text="row.type"></span>
                            <span class="text-sm font-semibold text-primary" x-text="row.price"></span>
                        </div>
                    </button>
                </template>
            </div>

            <div x-show="workType === 'demolition'" class="space-y-3">
                <div class="grid gap-2">
                    <template x-for="(row, index) in demolitionPrices" :key="'demo-' + index">
                        <button type="button" @click="presetIndex = index" class="cursor-pointer rounded-xl border-2 p-3 text-left transition hover:border-primary/60 hover:bg-primary/5" :class="presetIndex === index ? 'border-primary bg-primary/10 ring-2 ring-primary/30' : 'border-border bg-card'">
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-sm font-medium" x-text="row.type"></span>
                                <span class="shrink-0 text-sm font-semibold text-primary" x-text="row.price"></span>
                            </div>
                        </button>
                    </template>
                </div>
                <label x-show="isDemolitionSquareMeter" class="block">
                    <div class="mb-1.5 text-sm font-medium">Площадь, м²</div>
                    <input x-model.number="quantity" type="number" min="1" class="w-full rounded-lg border border-input bg-background px-3 py-2">
                </label>
            </div>
        </div>

        <div x-show="step === 4" class="animate-in fade-in duration-200">
            <div class="mb-1 text-sm font-semibold uppercase tracking-wider text-muted-foreground">Дополнительные условия</div>
            <p class="mb-4 text-xs text-muted-foreground">Отметьте, если применимо. Можно пропустить — посчитаем по базовой цене.</p>
            <div class="grid gap-2 sm:grid-cols-2">
                <template x-for="coef in coefficients" :key="coef.id">
                    <button type="button" @click="toggleCoef(coef.id)" class="cursor-pointer flex items-center justify-between gap-3 rounded-xl border-2 p-3 text-left" :class="coefIds.includes(coef.id) ? 'border-primary bg-primary/10' : 'border-border bg-card'">
                        <span class="text-sm font-medium" x-text="coef.label"></span>
                        <span class="shrink-0 rounded-md px-2 py-0.5 text-xs font-semibold" :class="coefIds.includes(coef.id) ? 'bg-primary text-primary-foreground' : 'bg-muted text-muted-foreground'" x-text="coef.hint"></span>
                    </button>
                </template>
            </div>
        </div>

        <div x-show="step === 5 && result !== null" class="animate-in fade-in duration-300">
            <div class="rounded-xl border-2 border-primary/40 bg-gradient-to-br from-primary/10 to-transparent p-5 sm:p-6">
                <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-primary">
                    <x-icons.lucide name="sparkles" class="h-3.5 w-3.5" />
                    Ориентировочная стоимость
                </div>
                <div class="mt-2 font-display text-3xl font-bold tabular-nums sm:text-4xl">
                    <span x-text="result ? formatCurrency(result.min) : '0'"></span> – <span x-text="result ? formatCurrency(result.max) : '0'"></span> ₽
                </div>
                <p class="mt-2 text-sm text-muted-foreground">Точную сумму назовём за 2 минуты — пришлите размеры и пару фото объекта. Без сюрпризов «на месте».</p>
            </div>

            <div class="mt-5 grid gap-2.5">
                <a href="tel:{{ C::PHONE_TEL }}" onclick="window.slomTrackCTA && window.slomTrackCTA('calc_cta_phone', 'calculator')" class="mcn-phone">
                    <span class="inline-flex h-14 w-full items-center justify-center gap-2 rounded-xl bg-yellow-gradient px-8 text-base font-semibold text-primary-foreground shadow-cta transition hover:brightness-105 active:brightness-95">
                        <x-icons.lucide name="phone" class="h-5 w-5" />
                        Позвонить {{ C::PHONE_DISPLAY }}
                    </span>
                </a>
                <div class="grid grid-cols-2 gap-2.5">
                    <a :href="whatsAppHref" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('calc_cta_whatsapp', 'calculator')">
                        <span class="inline-flex h-12 w-full items-center justify-center gap-2 rounded-lg bg-whatsapp px-7 text-base font-semibold text-whatsapp-foreground transition hover:bg-whatsapp/90">
                            <x-icons.lucide name="message-circle" class="h-5 w-5" />
                            WhatsApp
                        </span>
                    </a>
                    <a :href="telegramHref" target="_blank" rel="noopener" onclick="window.slomTrackCTA && window.slomTrackCTA('calc_cta_telegram', 'calculator')">
                        <span class="inline-flex h-12 w-full items-center justify-center gap-2 rounded-lg bg-telegram px-7 text-base font-semibold text-telegram-foreground transition hover:bg-telegram/90">
                            <x-icons.lucide name="send" class="h-5 w-5" />
                            Telegram
                        </span>
                    </a>
                </div>
                <button type="button" x-on:click="window.slomTrackCTA && window.slomTrackCTA('calc_cta_callback', 'calculator'); $dispatch('open-callback', { source: 'calculator' })" class="cursor-pointer text-sm font-medium text-primary underline-offset-4 hover:underline">
                    или закажите бесплатный обратный звонок
                </button>
            </div>

            <div class="mt-5 rounded-lg border border-border px-4" x-data="{ open: false }">
                <button type="button" class="cursor-pointer flex w-full items-center justify-between py-4 text-left text-sm font-semibold" x-on:click="open = !open">
                    <span class="flex items-center gap-2">
                        <x-icons.lucide name="info" class="h-4 w-4 text-primary" />
                        Как считали
                    </span>
                    <span class="text-primary transition" :class="open ? 'rotate-180' : ''">▾</span>
                </button>
                <div x-show="open" x-transition class="pb-4">
                    <ul class="space-y-1.5 text-sm text-muted-foreground">
                        <template x-for="(line, idx) in result ? result.breakdown : []" :key="'breakdown-' + idx">
                            <li class="flex items-start gap-2">
                                <span class="mt-2 h-1 w-1 shrink-0 rounded-full bg-primary"></span>
                                <span x-text="line"></span>
                            </li>
                        </template>
                    </ul>
                    <p class="mt-3 text-xs text-muted-foreground">Расчёт ориентировочный и не является публичной офертой. Финальная стоимость определяется после осмотра объекта.</p>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-between gap-3">
            <template x-if="step > 1 && step < 5">
                <button type="button" @click="prevStep()" class="cursor-pointer inline-flex h-9 items-center justify-center gap-2 rounded-md px-3 text-sm font-medium transition hover:bg-accent hover:text-accent-foreground">
                    <x-icons.lucide name="chevron-left" class="h-4 w-4" />
                    Назад
                </button>
            </template>
            <template x-if="!(step > 1 && step < 5)">
                <span></span>
            </template>

            <template x-if="step < 5">
                <button type="button" @click="nextStep()" class="cursor-pointer inline-flex h-12 items-center justify-center gap-2 rounded-lg px-7 text-base font-medium transition disabled:pointer-events-none disabled:opacity-50" :class="step === 4 ? 'bg-yellow-gradient font-semibold text-primary-foreground shadow-cta hover:brightness-105 active:brightness-95' : 'bg-primary text-primary-foreground hover:bg-primary/90'" :disabled="step === 1 && workType === null">
                    <span x-text="step === 4 ? 'Показать цену' : 'Далее'"></span>
                </button>
            </template>
            <template x-if="step >= 5">
                <button type="button" @click="resetCalculator()" class="cursor-pointer mx-auto inline-flex h-9 items-center justify-center gap-2 rounded-md px-3 text-sm font-medium transition hover:bg-accent hover:text-accent-foreground">
                    <x-icons.lucide name="rotate-ccw" class="h-4 w-4" />
                    Начать заново
                </button>
            </template>
        </div>
    </div>
</div>

<script>
    function pricingCalculator(config) {
        return {
                    step: 1,
                    workType: null,
                    material: 'concrete',
                    thicknessCm: 20,
                    lengthM: 2.0,
                    diameterMm: 100,
                    depthCm: 20,
                    presetIndex: 0,
                    quantity: 1,
                    coefIds: [],
                    result: null,
                    cuttingPrices: config.cuttingPrices,
                    drillingPrices: config.drillingPrices,
                    openingPrices: config.openingPrices,
                    demolitionPrices: config.demolitionPrices,
                    coefficients: config.coefficients,
                    whatsappBaseUrl: config.whatsappBaseUrl,
                    telegramBaseUrl: config.telegramBaseUrl,
                    workOptions: [
                        { id: 'cutting', title: 'Резка стены', desc: 'Алмазная резка бетона, кирпича, монолита' },
                        { id: 'drilling', title: 'Бурение отверстий', desc: 'Под коммуникации, вентиляцию' },
                        { id: 'opening', title: 'Проём', desc: 'Под дверь, окно, арку с усилением' },
                        { id: 'demolition', title: 'Демонтаж', desc: 'Стены, перегородки, санкабины' },
                    ],
                    materialOptions: [
                        { id: 'concrete', label: 'Бетон' },
                        { id: 'monolith', label: 'Монолит' },
                        { id: 'brick', label: 'Кирпич' },
                        { id: 'unknown', label: 'Не знаю' },
                    ],
                    get progressClass() {
                        const progressByStep = { 1: 'w-0', 2: 'w-1/4', 3: 'w-1/2', 4: 'w-3/4', 5: 'w-full' };

                        return progressByStep[Math.min(this.step, 5)];
                    },
                    get isDemolitionSquareMeter() {
                        const row = this.demolitionPrices[this.presetIndex];

                        return row !== undefined && row.unit === 'м²';
                    },
                    get whatsAppHref() {
                        return this.messengerHref(this.whatsappBaseUrl);
                    },
                    get telegramHref() {
                        return this.messengerHref(this.telegramBaseUrl);
                    },
                    nextStep() {
                        if (this.step === 1 && (this.workType === 'opening' || this.workType === 'demolition')) {
                            this.step = 3;
                            return;
                        }
                        if (this.step === 4) {
                            this.result = this.calculateResult();
                        }
                        this.step = Math.min(5, this.step + 1);
                    },
                    prevStep() {
                        if (this.step === 3 && (this.workType === 'opening' || this.workType === 'demolition')) {
                            this.step = 1;
                            return;
                        }
                        this.step = Math.max(1, this.step - 1);
                    },
                    resetCalculator() {
                        this.step = 1;
                        this.workType = null;
                        this.material = 'concrete';
                        this.thicknessCm = 20;
                        this.lengthM = 2;
                        this.diameterMm = 100;
                        this.depthCm = 20;
                        this.presetIndex = 0;
                        this.quantity = 1;
                        this.coefIds = [];
                        this.result = null;
                    },
                    toggleCoef(id) {
                        if (this.coefIds.includes(id)) {
                            this.coefIds = this.coefIds.filter((value) => value !== id);
                            return;
                        }
                        this.coefIds.push(id);
                    },
                    calculateResult() {
                        const materialLabels = {
                            concrete: 'бетон',
                            monolith: 'монолит',
                            brick: 'кирпич',
                            unknown: 'материал уточним',
                        };
                        if (this.workType === null) {
                            return null;
                        }
                        if (materialLabels[this.material] === undefined) {
                            throw new Error('Unsupported material value');
                        }

                        const breakdown = [];
                        let base = 0;
                        let summary = '';

                        if (this.workType === 'cutting') {
                            const thicknessCm = Number.isFinite(this.thicknessCm) ? this.thicknessCm : 20;
                            const row = this.nearestCutting(thicknessCm);
                            const length = Math.max(0.5, Number.isFinite(this.lengthM) ? this.lengthM : 1);
                            const concrete = Number(row.concrete);
                            const monolith = Number(row.monolith);
                            const brick = Number(row.brick);
                            let pricePerM = concrete;
                            if (this.material === 'monolith') {
                                pricePerM = monolith;
                            } else if (this.material === 'brick') {
                                pricePerM = brick;
                            } else if (this.material === 'unknown') {
                                pricePerM = Math.round((concrete + monolith + brick) / 3);
                            }
                            base = pricePerM * length;
                            breakdown.push(`Резка ${materialLabels[this.material]}, ${row.thickness}: ${this.formatCurrency(pricePerM)} ₽/п.м.`);
                            breakdown.push(`Длина реза: ${length} п.м.`);
                            summary = `Алмазная резка, ${materialLabels[this.material]}, толщина ${row.thickness}, ${length} п.м.`;
                        } else if (this.workType === 'drilling') {
                            const diameterMm = Number.isFinite(this.diameterMm) ? this.diameterMm : 100;
                            const row = this.nearestDrilling(diameterMm);
                            const depth = Math.max(5, Number.isFinite(this.depthCm) ? Math.round(this.depthCm) : 20);
                            base = Math.max(2000, Number(row.price) * depth);
                            breakdown.push(`Бурение ⌀${row.diameter}: ${row.price} ₽/см`);
                            breakdown.push(`Глубина: ${depth} см (мин. заказ 2 000 ₽)`);
                            summary = `Алмазное бурение, ⌀${row.diameter}, глубина ${depth} см`;
                        } else if (this.workType === 'opening') {
                            if (this.openingPrices[this.presetIndex] === undefined) {
                                throw new Error('Unsupported opening preset index');
                            }
                            const row = this.openingPrices[this.presetIndex];
                            base = Number(row.base);
                            breakdown.push(`${row.type}: ${row.price}`);
                            summary = row.type;
                        } else if (this.workType === 'demolition') {
                            if (this.demolitionPrices[this.presetIndex] === undefined) {
                                throw new Error('Unsupported demolition preset index');
                            }
                            const row = this.demolitionPrices[this.presetIndex];
                            const quantity = Math.max(1, Number.isFinite(this.quantity) ? Math.round(this.quantity) : 1);
                            base = row.unit === 'шт' ? Number(row.base) : Number(row.base) * quantity;
                            breakdown.push(`${row.type}: ${row.price}`);
                            if (row.unit !== 'шт') {
                                breakdown.push(`Объём: ${quantity} м²`);
                            }
                            summary = row.unit === 'шт' ? row.type : `${row.type}, ${quantity} м²`;
                        } else {
                            throw new Error('Unsupported work type');
                        }

                        let multiplier = 1;
                        for (const coef of this.coefficients) {
                            if (this.coefIds.includes(coef.id)) {
                                multiplier *= Number(coef.value);
                                breakdown.push(`Коэффициент: ${coef.label} (${coef.hint})`);
                            }
                        }

                        const total = base * multiplier;
                        const min = Math.round(total * 0.85);
                        const max = Math.round(total * 1.15);

                        return {
                            base,
                            multiplier,
                            min,
                            max,
                            breakdown,
                            summary: `${summary}\nОриентировочно: ${this.formatCurrency(min)} – ${this.formatCurrency(max)} ₽`,
                        };
                    },
                    nearestCutting(thicknessCm) {
                        let best = this.cuttingPrices[0];
                        for (const row of this.cuttingPrices) {
                            if (Math.abs(Number(row.thicknessCm) - thicknessCm) < Math.abs(Number(best.thicknessCm) - thicknessCm)) {
                                best = row;
                            }
                        }

                        return best;
                    },
                    nearestDrilling(diameterMm) {
                        let best = this.drillingPrices[0];
                        for (const row of this.drillingPrices) {
                            if (Math.abs(Number(row.diameterMm) - diameterMm) < Math.abs(Number(best.diameterMm) - diameterMm)) {
                                best = row;
                            }
                        }

                        return best;
                    },
                    formatCurrency(value) {
                        return new Intl.NumberFormat('ru-RU', { maximumFractionDigits: 0 }).format(value);
                    },
                    messengerHref(baseUrl) {
                        const summary = this.result !== null ? this.result.summary : '';
                        const text = `Здравствуйте! Рассчитал на сайте:\n${summary}\nПодскажите, когда сможете приехать?`;

                        return `${baseUrl}?text=${encodeURIComponent(text)}`;
                    },
        };
    }
</script>
