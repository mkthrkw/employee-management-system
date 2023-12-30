<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='mail' text="Show : {{ $mailingList->name }}"/>
    </x-slot:title>

    <div class='flex'>
        <div class='flex-1'>
            <x-common.card class='m-3' tone='light'>
                <div class='justify-center card-title'>メーリングリスト：詳細</div>
                <x-common.textline label='リスト名称' :value="$mailingList->name" />
                <x-common.textline label='メールアドレス' :value="$mailingList->address" />
                <x-common.textline label='送受信権限' value="{{ $mailingList->ext_send_permission ? 'あり' : 'なし'; }}" />
                <x-common.textline label='BCルート' :value="$mailingList->bc_route_id" />
                <x-common.textline label='メモ' :value="$mailingList->memo"/>
                <x-common.textline label='作成日時' :value="$mailingList->created_at"/>
                <x-common.textline label='更新日時' :value="$mailingList->updated_at"/>
            </x-common.card>
        </div>
        <div class='flex-1'>
            <x-common.card class='m-3' tone='light'>
                <div class='justify-center card-title'>所属者</div>
                @foreach ($mailingList->accounts()->get() as $index => $account)
                    <x-common.textline label="{{ $index+1 }}人目" value="{{ $account->employee_number }} : {{ $account->name }}"  size='lg'/>
                @endforeach
            </x-common.card>
        </div>
    </div>
    <x-button.back mt='6' />

</x-app-layout>
