<button @isset($wireClick)) wire:click={{ $wireClick }} @endisset class='gap-2 px-10 btn btn-outline btn-error btn-sm rounded-xl'>
    <x-common.material-icon :icon="$icon ?? 'delete'" size='sm' type='outlined'/>
    <span class='text-sm'>{{ $text ?? 'release' }}</span>
</button>
