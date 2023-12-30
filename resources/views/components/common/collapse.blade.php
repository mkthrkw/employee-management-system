<div tabindex="0" class="w-full border collapse collapse-arrow border-base-content/40 bg-base-100 rounded-3xl {{ $additionalClasses ?? '' }}">
    <div class="px-4 py-2 font-medium min-h-fit collapse-title">
        <span class="text-{{ $size ?? 'sm' }}">{{ $title ?? '' }}</span>
    </div>
    <div class="collapse-content">
        {{ $slot ?? '' }}
    </div>
</div>
