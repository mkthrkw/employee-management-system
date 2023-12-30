<button @isset($wireClick)) wire:click={{ $wireClick }} @endisset class='gap-2 my-auto btn btn-outline btn-primary btn-xs rounded-xl peer-focus:scale-0'>
    <x-common.material-icon :icon="$icon ?? 'done_outline'" size='xs' type='outlined'/>
    <span class='text-sm'>{{ $text ?? 'catch' }}</span>
</button>
