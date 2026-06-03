@php
    use App\Support\LandingContact as C;
@endphp

@props(['teamMembers'])

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
            @foreach ($teamMembers as $member)
                <div class="group relative overflow-hidden rounded-2xl border border-white/10 bg-white/[0.03] p-6 backdrop-blur-sm transition-all duration-300 hover:-translate-y-1 hover:border-primary/40 hover:bg-white/[0.06]">
                    <div class="pointer-events-none absolute -right-20 -top-20 h-44 w-44 rounded-full bg-yellow-gradient opacity-0 blur-3xl transition-opacity duration-500 group-hover:opacity-30" aria-hidden="true"></div>
                    <div class="relative flex items-start gap-4">
                        <div class="relative shrink-0">
                            <img src="{{ Vite::asset('resources/images/'.$member['photo']) }}" alt="{{ $member['name'] }}" class="h-16 w-16 rounded-full object-cover ring-2 ring-primary/40 ring-offset-2 ring-offset-secondary">
                            <span class="absolute -bottom-1 -right-1 inline-flex h-7 w-7 items-center justify-center rounded-full bg-primary text-secondary ring-2 ring-secondary"><x-icons.lucide :name="$member['icon']" class="h-3.5 w-3.5" /></span>
                        </div>
                        <div class="min-w-0 flex-1 pt-0.5">
                            <h3 class="font-display text-lg font-semibold leading-tight">{{ $member['name'] }}</h3>
                            <div class="mt-1 inline-flex items-center rounded-full bg-primary/15 px-2 py-0.5 text-[11px] font-semibold uppercase tracking-wider text-primary">стаж {{ $member['years'] }}</div>
                            <p class="mt-3 text-sm leading-relaxed text-secondary-foreground/70">{{ $member['role'] }}</p>
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
            <a href="tel:{{ C::PHONE_TEL }}" class="cursor-pointer inline-flex h-12 w-full items-center justify-center gap-2 rounded-lg bg-yellow-gradient px-7 text-base font-semibold text-primary-foreground shadow-cta transition hover:brightness-105 active:brightness-95 sm:w-auto"><x-icons.lucide name="phone" class="h-4 w-4" /> <nobr>{{ C::PHONE_DISPLAY }}</nobr></a>
        </div>
    </div>
</section>
