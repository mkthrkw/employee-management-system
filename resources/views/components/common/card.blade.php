@php
    $classes = (isset($tone) && $tone == 'light')
        ? 'border shadow-xl card border-2 bg-base-100 border-base-200 rounded-xl'
        : 'border shadow-xl card border-4 bg-base-200 border-base-300 rounded-xl';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    <div class='card-body'>
        {{ $slot }}
    </div>
</div>
