@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-pink-300 focus:ring focus:ring-pink-300 focus:ring-opacity-50 rounded-md shadow-sm']) !!}>
