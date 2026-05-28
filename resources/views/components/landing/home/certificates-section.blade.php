@props(['certificates'])

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
                    <div><div class="font-display text-lg font-bold leading-none">{{ count($certificates) }}</div><div class="text-xs uppercase tracking-wider text-muted-foreground">документов</div></div>
                </div>
            </div>
            <div class="relative mt-8 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
                @foreach ($certificates as $certificate)
                    <button
                        type="button"
                        class="group relative overflow-hidden rounded-xl border border-border bg-card text-left shadow-card transition-all duration-300 hover:-translate-y-1 hover:border-primary/40 hover:shadow-elevated"
                        data-cert-image="{{ Vite::asset('resources/images/'.$certificate['image']) }}"
                        data-cert-title="{{ $certificate['title'] }}"
                        data-cert-subtitle="{{ $certificate['subtitle'] }}"
                        x-on:click="certOpen = true; certImage = $el.dataset.certImage; certTitle = $el.dataset.certTitle; certSubtitle = $el.dataset.certSubtitle"
                    >
                        <div class="relative aspect-[3/4] w-full overflow-hidden bg-muted">
                            <img src="{{ Vite::asset('resources/images/'.$certificate['image']) }}" alt="{{ $certificate['title'] }}" loading="lazy" class="h-full w-full object-cover object-top transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-secondary/80 via-secondary/0 to-secondary/0 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
                            <div class="absolute right-3 top-3 flex h-9 w-9 items-center justify-center rounded-full bg-primary text-primary-foreground opacity-0 shadow-cta transition-opacity duration-300 group-hover:opacity-100"><x-icons.lucide name="zoom-in" class="h-4 w-4" /></div>
                        </div>
                        <div class="border-t border-border p-3"><div class="truncate font-display text-sm font-semibold">{{ $certificate['title'] }}</div><div class="mt-0.5 truncate text-xs text-muted-foreground">{{ $certificate['subtitle'] }}</div></div>
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
