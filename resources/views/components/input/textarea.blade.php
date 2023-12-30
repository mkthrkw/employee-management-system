@php $classes = 'w-full textarea textarea-bordered textarea-sm border border-1 border-base-content/40 rounded-xl'; @endphp

<div class='w-full mb-3 form-control'>
    <label class="py-0 mb-1 label">
        <span class="px-5 font-medium rounded-xl bg-base-content/50 label-text text-base-100 pt-0.5">{{ $label }}</span>
    </label>
    <textarea name="{{ $name }}" placeholder="{{ $placeholder ?? '' }}" class="{{ $classes }}" >{{ $value ?? '' }}</textarea>
</div>
