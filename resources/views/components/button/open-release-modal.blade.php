<button class="btn btn-outline btn-error btn-xs opacity-75 rounded-xl {{ $additionalClasses ?? '' }}" @isset($wireClick) wire:click="{{ $wireClick }}" @endisset>
    <x-common.material-icon :icon="$icon ?? 'delete'" size='xs' type='outlined'/>
    <span class="hidden mx-1 text-sm font-medium md:inline opacity-90">{{ $name ?? 'release' }}</span>
</button>
