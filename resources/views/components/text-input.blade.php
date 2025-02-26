@props(['disabled' => false, 'hasError' => false])

<input {{ $disabled ? 'disabled' : '' }} 
       {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ' . ($hasError ? 'border-red-500' : '')]) !!}>
