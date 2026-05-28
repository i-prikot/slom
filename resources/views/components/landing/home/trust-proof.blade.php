@props(['trustStats', 'trustDocuments', 'trustClients'])

<section class="bg-background py-16 sm:py-20 lg:py-24">
    <div class="container-x">
        <h2 class="font-display text-3xl font-bold tracking-tight sm:text-4xl">Нам доверяют</h2>
        <div class="mt-10 grid gap-10 lg:grid-cols-2">
            <div class="grid grid-cols-3 gap-6">
                @foreach ($trustStats as $stat)
                    <div><div class="font-display text-3xl font-bold sm:text-4xl">{{ $stat['value'] }}</div><div class="mt-1 text-sm text-muted-foreground">{{ $stat['label'] }}</div></div>
                @endforeach
            </div>
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                @foreach ($trustDocuments as $document)
                    <div class="flex items-center gap-3 rounded-xl border border-border bg-card p-4 shadow-card">
                        <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-primary/15 text-primary ring-1 ring-primary/25">
                            <x-icons.lucide :name="$document['icon']" class="h-5 w-5" />
                        </span>
                        <div class="text-sm font-medium">{{ $document['title'] }}</div>
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
                @foreach ($trustClients as $client)
                    <div title="{{ $client['client'] }}" class="group relative flex h-32 items-center justify-center overflow-hidden rounded-2xl border border-border bg-card p-5 shadow-card transition-all duration-300 hover:-translate-y-1 hover:border-primary/40 hover:shadow-elevated sm:h-36">
                        <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-primary/0 to-primary/0 transition-all duration-300 group-hover:from-primary/5 group-hover:to-transparent"></div>
                        <img src="{{ Vite::asset('resources/images/'.$client['logo']) }}" alt="{{ $client['client'] }}" class="relative max-h-20 w-auto max-w-full object-contain grayscale transition-all duration-500 group-hover:scale-105 group-hover:grayscale-0 sm:max-h-24">
                        <div class="absolute inset-x-0 bottom-0 translate-y-full bg-secondary/95 px-3 py-2 text-center text-xs font-medium text-secondary-foreground backdrop-blur transition-transform duration-300 group-hover:translate-y-0">{{ $client['client'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
