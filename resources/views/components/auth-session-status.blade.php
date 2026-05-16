@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'flex items-center gap-3 p-4 mb-4 text-sm font-medium rounded-xl bg-[#E8EFE9] text-[#4A6B51] border border-[#D4E2D5] shadow-sm animate-fade-in']) }}>
        <span class="text-lg">🍃</span>
        <div>
            {{ $status }}
        </div>
    </div>
@endif