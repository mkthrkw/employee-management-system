<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='smartphone' text="Edit : {{ $mobilePhone->phone_number }}"/>
    </x-slot:title>

    <x-common.card class='max-w-2xl px-5 mx-auto mt-3'>
        <form method='POST' action="{{ route('mobile_phone.update',$mobilePhone) }}" onsubmit="return beforeSubmit('上書き更新しますか？')">
            @method('PATCH')
            @csrf
            <div class='justify-center card-title'>社用携帯：編集</div>
            <x-input.select-enum label='ステータス' name='status' :selected="old('status') ?? $mobilePhone->status->value" :cases="App\Enums\DeviceStatus::cases()" />
            <x-input.text label='デバイス名' name='name' :value="old('name') ?? $mobilePhone->name" />
            <x-input.text label='プロバイダー' name='provider' :value="old('provider') ?? $mobilePhone->provider" />
            <x-input.text label='電話番号' name='phone_number' :value="old('phone_number') ?? $mobilePhone->phone_number" />
            <x-input.select-enum label='保管支店' name='branch' :selected="old('branch') ?? $mobilePhone->branch->value" :cases="array_filter(App\Enums\Branch::cases(),function($case){return $case->is_use();})" />
            <div class='flex gap-12'>
                <x-input.text label='入荷日' name='arrival_date' placeholder="yyyy/mm/dd" type='date' :value="old('arrival_date') ?? $mobilePhone->arrival_date" />
                <x-input.text label='廃棄日' name='disposal_date' placeholder="yyyy/mm/dd" type='date' :value="old('disposal_date') ?? $mobilePhone->disposal_date" />
            </div>
            <x-input.textarea label='メモ' name='memo' placeholder='フリーワード' :value="old('memo') ?? $mobilePhone->memo" />
            <x-button.submit mt=8 icon='edit' label='更新'/>
        </form>
    </x-common.card>
    <div>
        @can('gate','gate8')
        <x-button.delete mt='6' action="{{ route('mobile_phone.destroy',$mobilePhone) }}" onsubmit="return beforeSubmit('この社用携帯を削除しますか？')"/>
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
