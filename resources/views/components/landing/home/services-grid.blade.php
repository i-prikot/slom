@php
    use App\Support\LandingContact as C;
@endphp

@props(['services'])

<section class="bg-background py-16 sm:py-20 lg:py-24">
    <div class="container-x">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <h2 class="font-display text-3xl font-bold tracking-tight sm:text-4xl">Что мы делаем</h2>
                <p class="mt-3 max-w-2xl text-muted-foreground">Решаем задачи любой сложности. Не уверены, что именно нужно? Позвоните — подскажем лучшее решение для вашего объекта.</p>
            </div>
            <a href="tel:{{ C::PHONE_TEL }}" onclick="window.slomTrackCTA && window.slomTrackCTA('phone', 'services')" class="cursor-pointer shrink-0">
                <span class="inline-flex h-12 items-center justify-center gap-2 rounded-lg bg-yellow-gradient px-7 text-base font-semibold text-primary-foreground shadow-cta transition hover:brightness-105 active:brightness-95">
                    <x-icons.lucide name="phone" class="h-4 w-4" />
                    Позвонить и уточнить
                </span>
            </a>
        </div>
        <ul class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($services as $service)
                <li class="group overflow-hidden rounded-2xl border bg-card shadow-card transition hover:-translate-y-0.5 {{ $service['primary'] ? 'border-primary/50 ring-1 ring-primary/30' : 'border-border hover:border-primary/40' }}">
                    <div class="relative aspect-[4/3] overflow-hidden bg-muted">
                        <img src="{{ Vite::asset('resources/images/'.$service['image']) }}" alt="{{ $service['title'] }}" loading="lazy" width="900" height="700" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        @if($service['primary'])<span class="absolute left-3 top-3 rounded-md bg-primary px-2.5 py-1 text-xs font-semibold text-primary-foreground">Главная услуга</span>@endif
                    </div>
                    <div class="p-5"><h3 class="text-lg font-semibold">{{ $service['title'] }}</h3><p class="mt-1.5 text-sm text-muted-foreground">{{ $service['text'] }}</p></div>
                </li>
            @endforeach
        </ul>
    </div>
</section>
