@props(['cases'])

<section class="bg-surface py-16 sm:py-20 lg:py-24">
    <div class="container-x">
        <h2 class="font-display text-3xl font-bold tracking-tight sm:text-4xl">Реальные работы</h2>
        <p class="mt-3 max-w-2xl text-muted-foreground">Несколько недавних объектов в Красноярске и крае.</p>
        <ul class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($cases as $case)
                <li class="overflow-hidden rounded-2xl border border-border bg-card shadow-card">
                    <div class="aspect-[4/3] overflow-hidden bg-muted"><img src="{{ Vite::asset('resources/images/'.$case['image']) }}" alt="{{ $case['title'] }}" class="h-full w-full object-cover"></div>
                    <div class="space-y-3 p-6"><h3 class="text-lg font-semibold">{{ $case['title'] }}</h3><div class="space-y-2 text-sm"><div><span class="text-muted-foreground">Задача: </span>{{ $case['task'] }}</div><div><span class="text-muted-foreground">Срок: </span><span class="font-medium">{{ $case['term'] }}</span></div><div><span class="text-muted-foreground">Результат: </span>{{ $case['result'] }}</div></div></div>
                </li>
            @endforeach
        </ul>
    </div>
</section>
