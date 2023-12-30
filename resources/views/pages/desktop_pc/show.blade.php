<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='desktop_windows' text="Show : {{ $desktopPc->name }}"/>
    </x-slot:title>

    <x-common.card class='max-w-2xl px-5 mx-auto mt-3' tone='light'>
        <div class='justify-center card-title'>デスクトップPC：詳細</div>
        <x-common.textline label='ステータス' :value="$desktopPc->status->label()"/>
        <x-common.textline label='デバイス名' :value="$desktopPc->name"/>
        <x-common.textline label='CPU' :value="$desktopPc->cpu"/>
        <x-common.textline label='メモリ' :value="$desktopPc->memory"/>
        <x-common.textline label='HDD' :value="$desktopPc->hdd"/>
        <x-common.textline label='VPN接続ID' :value="$desktopPc->vpn_connection_id"/>
        <x-common.textline label='VPN固有ID' :value="$desktopPc->vpn_unique_id"/>
        <x-common.textline label='キャスナビ' :value="$desktopPc->casting_navi->label()"/>
        <x-common.textline label='保管支店' :value="$desktopPc->branch->label()"/>
        <x-common.textline label='入荷日' :value="$desktopPc->arrival_date"/>
        <x-common.textline label='廃棄日' :value="$desktopPc->disposal_date"/>
        <x-common.textline label='メモ' :value="$desktopPc->memo"/>
        <x-common.textline label='作成日時' :value="$desktopPc->created_at"/>
        <x-common.textline label='更新日時' :value="$desktopPc->updated_at"/>
        @php $account = $desktopPc->account()->first(); @endphp
        <x-common.textline label='利用者' value="{{ ($account) ? $account->employee_number.' : '.$account->name : '利用者なし' }}"/>
    </x-common.card>
    <x-button.back mt='6' />

</x-app-layout>
