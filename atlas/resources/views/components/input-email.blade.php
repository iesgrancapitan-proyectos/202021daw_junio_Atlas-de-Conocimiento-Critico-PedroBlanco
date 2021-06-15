@props([ 'disabled' => false, 'domains' => '()' ])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'cthulhu border-gray-300 focus:border-pink-300 focus:ring focus:ring-pink-300 focus:ring-opacity-50 rounded-md shadow-sm']) !!}
{!! ($domains!='()') ? ('pattern="[a-z0-9._%+-]+@'.$domains.'$" placeholder="Sólo direcciones '.str_replace(['(','|',')'], ['@',' @',''], $domains ).'"')
: ('pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"') !!}
/>
