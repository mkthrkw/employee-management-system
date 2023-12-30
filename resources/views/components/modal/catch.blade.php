<input type="checkbox" id="{{ $id }}" class="modal-toggle" @isset($wireModel) wire:model="{{ $wireModel }}" @endisset />
<div class="z-40 modal">
    <div class="modal-box rounded-2xl" @isset($wide)min-w-[44rem] @endisset>
        <div tabindex="0" autofocus></div>
        <div>
            {{ $header ?? '' }}
        </div>
        <div class="max-h-96 h-[70vh] overflow-y-auto px-2">
            {{ $slot }}
        </div>
    </div>
    <button class="modal-backdrop" for="{{ $id }}" @isset($wireClick) wire:click="{{ $wireClick }}" @endisset>
        Close
    </button>
</div>
