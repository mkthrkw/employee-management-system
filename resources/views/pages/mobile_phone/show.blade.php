<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='smartphone' text="Show : {{ $mobilePhone->phone_number }}"/>
    </x-slot:title>

    <x-common.card class='max-w-2xl px-5 mx-auto mt-3' tone='light'>
        <div class='justify-center card-title'>社用携帯：詳細</div>
        <x-common.textline label='ステータス' :value="$mobilePhone->status->label()"/>
        <x-common.textline label='デバイス名' :value="$mobilePhone->name"/>
        <x-common.textline label='プロバイダー' :value="$mobilePhone->provider"/>
        <x-common.textline label='電話番号' :value="$mobilePhone->phone_number"/>
        <x-common.textline label='保管支店' :value="$mobilePhone->branch->label()"/>
        <x-common.textline label='入荷日' :value="$mobilePhone->arrival_date"/>
        <x-common.textline label='廃棄日' :value="$mobilePhone->disposal_date"/>
        <x-common.textline label='メモ' :value="$mobilePhone->memo"/>
        <x-common.textline label='作成日時' :value="$mobilePhone->created_at"/>
        <x-common.textline label='更新日時' :value="$mobilePhone->updated_at"/>
        @php $account = $mobilePhone->account()->first(); @endphp
        <x-common.textline label='利用者' value="{{ ($account) ? $account->employee_number.' : '.$account->name : '利用者なし' }}"/>
    </x-common.card>
    <x-button.back mt='6' />

</x-app-layout>
