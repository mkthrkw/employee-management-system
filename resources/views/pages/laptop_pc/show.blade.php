<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='laptop' text="Show : {{ $laptopPc->name }}"/>
    </x-slot:title>

    <x-common.card class='max-w-2xl px-5 mx-auto mt-3' tone='light'>
        <div class='justify-center card-title'>ノートPC：詳細</div>
        <x-common.textline label='ステータス' :value="$laptopPc->status->label()"/>
        <x-common.textline label='端末番号' :value="$laptopPc->name"/>
        <x-common.textline label='デバイス名' :value="$laptopPc->device_name"/>
        <x-common.textline label='CPU' :value="$laptopPc->cpu"/>
        <x-common.textline label='メモリ' :value="$laptopPc->memory"/>
        <x-common.textline label='保管支店' :value="$laptopPc->branch->label()"/>
        <x-common.textline label='入荷日' :value="$laptopPc->arrival_date"/>
        <x-common.textline label='廃棄日' :value="$laptopPc->disposal_date"/>
        <x-common.textline label='メモ' :value="$laptopPc->memo"/>
        <x-common.textline label='作成日時' :value="$laptopPc->created_at"/>
        <x-common.textline label='更新日時' :value="$laptopPc->updated_at"/>
        @php $account = $laptopPc->account()->first(); @endphp
        <x-common.textline label='利用者' value="{{ ($account) ? $account->employee_number.' : '.$account->name : '利用者なし' }}"/>
    </x-common.card>
    <x-button.back mt='6' />

</x-app-layout>
