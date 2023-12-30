@php
    $classes = 'w-full input input-bordered input-sm border border-1 border-base-content/40 rounded-xl';
    if($type=='date' && isset($value1)){$value1 = date($value1);}
    if($type=='date' && isset($value2)){$value2 = date($value2);}
@endphp

<div class='w-full mb-3 form-control'>
    <label class="py-0 mb-1 label">
        <span class="px-5 font-medium rounded-xl bg-base-content/50 label-text text-base-100 pt-0.5">{{ $label }}</span>
    </label>
    <div class='flex gap-{{ $gap }} items-center'>
        <input name="{{ $name1 }}" value="{{ $value1 ?? '' }}" type="{{ $type ?? 'text' }}" placeholder="{{ $placeholder ?? '' }}" class="{{ $classes }}" {{ $option ?? '' }}/>
        <span>{{ $midtext ?? '' }}</span>
        <input name="{{ $name2 }}" value="{{ $value2 ?? '' }}" type="{{ $type ?? 'text' }}" placeholder="{{ $placeholder ?? '' }}" class="{{ $classes }}" {{ $option ?? '' }}/>
    </div>
</div>
