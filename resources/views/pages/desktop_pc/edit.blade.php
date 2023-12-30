<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='desktop_windows' text="Edit : {{ $desktopPc->name }}"/>
    </x-slot:title>

    <x-common.card class='max-w-2xl px-5 mx-auto mt-3'>
        <form method='POST' action="{{ route('desktop_pc.update',$desktopPc) }}" onsubmit="return beforeSubmit('上書き更新しますか？')">
            @method('PATCH')
            @csrf
            <div class='justify-center card-title'>デスクトップPC：編集</div>
            <x-input.select-enum label='ステータス' name='status' :selected="old('status') ?? $desktopPc->status->value" :cases="App\Enums\DeviceStatus::cases()" />
            <x-input.text label='デバイス名' name='name' :value="old('name') ?? $desktopPc->name" />
            <x-input.text label='CPU' name='cpu' :value="old('cpu') ?? $desktopPc->cpu" />
            <x-input.text label='メモリ' name='memory' :value="old('memory') ?? $desktopPc->memory" />
            <x-input.text label='HDD' name='hdd' :value="old('hdd') ?? $desktopPc->hdd" />
            <x-input.text label='VPN接続ID' name='vpn_connection_id' :value="old('vpn_connection_id') ?? $desktopPc->vpn_connection_id" />
            <x-input.text label='VPN固有ID' name='vpn_unique_id' :value="old('vpn_unique_id') ?? $desktopPc->vpn_unique_id" />
            <x-input.select-enum label='キャスナビ' name='casting_navi' :selected="old('casting_navi') ?? $desktopPc->casting_navi->value" :cases="App\Enums\CastingNavi::cases()" />
            <x-input.select-enum label='保管支店' name='branch' :selected="old('branch') ?? $desktopPc->branch->value" :cases="array_filter(App\Enums\Branch::cases(),function($case){return $case->is_use();})" />
            <div class='flex gap-12'>
                <x-input.text label='入荷日' name='arrival_date' placeholder="yyyy/mm/dd" type='date' :value="old('arrival_date') ?? $desktopPc->arrival_date" />
                <x-input.text label='廃棄日' name='disposal_date' placeholder="yyyy/mm/dd" type='date' :value="old('disposal_date') ?? $desktopPc->disposal_date" />
            </div>
            <x-input.textarea label='メモ' name='memo' placeholder='フリーワード' :value="old('memo') ?? $desktopPc->memo" />
            <x-button.submit mt=8 icon='edit' label='更新'/>
        </form>
    </x-common.card>
    <div>
        @can('gate','gate8')
        <x-button.delete mt='6' action="{{ route('desktop_pc.destroy',$desktopPc) }}" onsubmit="return beforeSubmit('このデスクトップPCを削除しますか？')"/>
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
