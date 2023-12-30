<input type="checkbox" id="{{ $id }}" class="modal-toggle" @isset($wireModel) wire:model="{{ $wireModel }}" @endisset />
<div class="z-40 modal">
    <div class="modal-box rounded-2xl">
        <div tabindex="0" autofocus></div>
        <div>
            {{ $header ?? '' }}
        </div>
        <div class="px-2 overflow-y-auto">
            {{ $slot }}
        </div>
    </div>
    <button class="modal-backdrop" for="{{ $id }}" @isset($wireClick) wire:click="{{ $wireClick }}" @endisset>
        Close
    </button>
</div>
