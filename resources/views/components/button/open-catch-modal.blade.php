<button class="px-12 btn btn-outline btn-primary btn-sm rounded-xl {{ $additionalClasses ?? '' }}" @isset($wireClick) wire:click="{{ $wireClick }}" @endisset>
    <x-common.material-icon :icon="$icon ?? 'done_outline'" size='sm' type='outlined'/>
    <span class="hidden mx-1 text-sm font-medium md:inline opacity-90">{{ $name ?? 'catch' }}</span>
</button>
