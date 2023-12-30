<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='laptop' text="Edit : {{ $laptopPc->name }}"/>
    </x-slot:title>

    <x-common.card class='max-w-2xl px-5 mx-auto mt-3'>
        <form method='POST' action="{{ route('laptop_pc.update',$laptopPc) }}" onsubmit="return beforeSubmit('上書き更新しますか？')">
            @method('PATCH')
            @csrf
            <div class='justify-center card-title'>ノートPC：編集</div>
            <x-input.select-enum label='ステータス' name='status' :selected="old('status') ?? $laptopPc->status->value" :cases="App\Enums\DeviceStatus::cases()" />
            <x-input.text label='端末番号' name='name' :value="old('name') ?? $laptopPc->name" />
            <x-input.text label='デバイス名' name='device_name' :value="old('device_name') ?? $laptopPc->device_name" />
            <x-input.text label='CPU' name='cpu' :value="old('cpu') ?? $laptopPc->cpu" />
            <x-input.text label='メモリ' name='memory' :value="old('memory') ?? $laptopPc->memory" />
            <x-input.select-enum label='保管支店' name='branch' :selected="old('branch') ?? $laptopPc->branch->value" :cases="array_filter(App\Enums\Branch::cases(),function($case){return $case->is_use();})" />
            <div class='flex gap-12'>
                <x-input.text label='入荷日' name='arrival_date' placeholder="yyyy/mm/dd" type='date' :value="old('arrival_date') ?? $laptopPc->arrival_date" />
                <x-input.text label='廃棄日' name='disposal_date' placeholder="yyyy/mm/dd" type='date' :value="old('disposal_date') ?? $laptopPc->disposal_date" />
            </div>
            <x-input.textarea label='メモ' name='memo' placeholder='フリーワード' :value="old('memo') ?? $laptopPc->memo" />
            <x-button.submit mt=8 icon='edit' label='更新'/>
        </form>
    </x-common.card>
    <div>
        @can('gate','gate8')
        <x-button.delete mt='6' action="{{ route('laptop_pc.destroy',$laptopPc) }}" onsubmit="return beforeSubmit('このノートPCを削除しますか？')"/>
        @endcan
        <x-button.back mt='6' />
    </div>

    <x-slot:scripts>
        <script>
            function beforeSubmit(message) {
                if(window.confirm(message)) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
    </x-slot:scripts>

</x-app-layout>
