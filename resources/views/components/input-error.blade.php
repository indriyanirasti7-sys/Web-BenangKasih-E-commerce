@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'space-y-1.5 mt-2 bg-[#FDF2F2] border border-[#FDE8E8] p-3 rounded-xl']) }}>
        @foreach ((array) $messages as $message)
            <li class="text-xs text-red-600 flex items-center gap-2 font-medium">
                <span class="text-sm">⚠️</span>
                <span>{{ $message }}</span>
            </li>
        @endforeach
    </ul>
@endif