@props(['cities'])

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
                    @foreach ($cities as $city)
                        <li class="flex items-center gap-2 rounded-lg border border-border bg-background px-3 py-2.5 text-sm font-medium"><span class="h-1.5 w-1.5 shrink-0 rounded-full bg-primary"></span>{{ $city }}</li>
                    @endforeach
                    <li class="flex items-center gap-2 rounded-lg border border-dashed border-border bg-background px-3 py-2.5 text-sm text-muted-foreground">и другие населённые пункты края</li>
                </ul>
            </div>
        </div>
    </div>
</section>
