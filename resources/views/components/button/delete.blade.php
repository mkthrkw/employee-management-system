<div class="mt-{{ $mt ?? 4 }} text-center">
    <form action="{{ $action }}" method="POST" @isset($onsubmit) onsubmit="{{ $onsubmit }}" @endisset>
        @method('DELETE')
        @csrf
        <button type='submit' class='px-8 opacity-90 btn btn-sm btn-outline btn-error rounded-xl'>
            <span class='text-sm'>削除</span>
        </button>
    </form>
</div>
