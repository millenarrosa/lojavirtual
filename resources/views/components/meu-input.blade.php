@props(['name', 'label', 'type' => 'text'])

<label class="block mb-1 text-gray-700">{{ $label }}</label>

<input
    name="{{ $name }}"
    type="{{ $type }}"
    {{ $attributes->merge(['class' => 'w-full p-2 mb-4 rounded border bg-white text-gray-900']) }}
/>