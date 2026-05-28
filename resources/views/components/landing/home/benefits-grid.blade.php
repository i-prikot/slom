@props(['benefits'])

<section class="bg-surface py-16 sm:py-20 lg:py-24">
    <div class="container-x">
        <h2 class="font-display text-3xl font-bold tracking-tight sm:text-4xl">Почему клиенты сразу звонят нам</h2>
        <p class="mt-3 max-w-2xl text-muted-foreground">Без долгих переписок и заявок — вы получаете ответ и понятную цену сразу по телефону.</p>
        <ul class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
            @foreach ($benefits as $benefit)
                <li class="group rounded-2xl border border-border bg-card p-6 shadow-card transition hover:-translate-y-0.5 hover:border-primary/40">
                    <span class="inline-flex h-11 w-11 items-center justify-center rounded-lg bg-primary/15 text-primary ring-1 ring-primary/25">
                        <x-icons.lucide :name="$benefit['icon']" class="h-5 w-5" />
                    </span>
                    <h3 class="mt-4 text-base font-semibold">{{ $benefit['title'] }}</h3>
                    <p class="mt-1.5 text-sm text-muted-foreground">{{ $benefit['text'] }}</p>
                </li>
            @endforeach
        </ul>
    </div>
</section>
