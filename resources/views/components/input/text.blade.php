@php
    $classes = 'w-full input input-bordered input-sm border border-1 border-base-content/40 rounded-xl';
    if(isset($addClasses)){$classes .= ' '.$addClasses;}
@endphp

<div class='w-full mb-3 form-control'>
    <label class="py-0 mb-1 label">
        <span class="px-5 font-medium rounded-xl bg-base-content/50 label-text text-base-100 pt-0.5">{{ $label }}</span>
    </label>
    <input name="{{ $name }}" value="{{ $value ?? '' }}" type="{{ $type ?? 'text' }}" placeholder="{{ $placeholder ?? '' }}" class="{{ $classes }}" {{ $option ?? '' }} />
</div>
