<x-layouts.app
    :title="'Страница не найдена — СЛОМ24'"
    :metaTitle="'Страница не найдена — СЛОМ24'"
    :metaDescription="'Запрошенная страница не найдена. Вернитесь на главную сайта СЛОМ24 — алмазная резка и бурение бетона в Красноярске.'"
    :metaRobots="'noindex'"
>
    <div class="flex min-h-screen items-center justify-center bg-muted">
        <div class="text-center">
            <h1 class="mb-4 text-4xl font-bold">404</h1>
            <p class="mb-4 text-xl text-muted-foreground">Страница не найдена</p>
            <a href="{{ route('home') }}" class="text-primary underline hover:text-primary/90" wire:navigate>На главную</a>
        </div>
    </div>
</x-layouts.app>
