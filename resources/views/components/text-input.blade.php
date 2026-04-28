@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border border-black/40 bg-white text-gray-900 placeholder-gray-400 focus:border-black focus:ring-green-700 rounded-md shadow-sm']) }}>
