@props(['workSteps'])

<section class="bg-secondary py-16 text-secondary-foreground sm:py-20 lg:py-24">
    <div class="container-x">
        <h2 class="font-display text-3xl font-bold tracking-tight sm:text-4xl">Как мы работаем</h2>
        <ol class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-6">
            @foreach ($workSteps as $index => $step)
                <li class="relative">
                    <div class="flex items-center gap-3 lg:flex-col lg:items-start">
                        <span class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-primary/15 text-primary ring-1 ring-primary/30">
                            <x-icons.lucide :name="$step['icon']" class="h-6 w-6" />
                        </span>
                        <div class="text-xs font-semibold text-primary">Шаг {{ $index + 1 }}</div>
                    </div>
                    <h3 class="mt-3 text-base font-semibold">{{ $step['title'] }}</h3>
                    <p class="mt-1 text-sm text-white/60">{{ $step['text'] }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>
