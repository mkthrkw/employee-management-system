<button @isset($wireClick)) wire:click={{ $wireClick }} @endisset class='gap-2 px-10 btn btn-outline btn-warning btn-sm rounded-xl'>
    <x-common.material-icon :icon="$icon ?? 'build'" size='sm' type='outlined'/>
    <span class='text-sm'>{{ $text ?? 'releaseBroken' }}</span>
</button>
