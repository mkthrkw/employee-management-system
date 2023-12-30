<div class='mt-{{ $mt ?? 4 }} text-center'>
    <button type='submit' class='gap-1 opacity-90 btn btn-wide btn-primary rounded-xl'>
        <x-common.material-icon :icon="$icon ?? 'search'" size='sm' type='filled'/>
        <span class='text-base'>{{ $label }}</span>
    </button>
</div>
