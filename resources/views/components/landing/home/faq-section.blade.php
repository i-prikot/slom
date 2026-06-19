@props(['faqs'])

<section class="bg-surface py-16 sm:py-20 lg:py-24">
    <div class="container-x max-w-4xl">
        <h2 class="font-display text-3xl font-bold tracking-tight sm:text-4xl">Часто задаваемые вопросы</h2>
        <div class="mt-8 divide-y divide-border rounded-2xl border border-border bg-card shadow-card" x-data="{ open: 0 }">
            @foreach ($faqs as $index => $faq)
                <div class="px-5 sm:px-6">
                    <button type="button" class="cursor-pointer flex w-full items-center justify-between py-4 text-left text-base font-semibold" x-on:click="open = open === {{ $index }} ? -1 : {{ $index }}">
                        <span>{{ $faq['question'] }}</span>
                        <span class="shrink-0 transition" :class="open === {{ $index }} ? 'rotate-180' : ''">
                            <x-icons.lucide name="chevron-down" class="h-5 w-5 text-muted-foreground" />
                        </span>
                    </button>
                    <div class="pb-4 text-sm text-muted-foreground" x-show="open === {{ $index }}" x-transition>{{ $faq['answer'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
