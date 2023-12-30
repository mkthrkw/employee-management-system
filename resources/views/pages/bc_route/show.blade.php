<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='visibility' text="Show : {{ $bcRoute->name }}"/>
    </x-slot:title>

    <div class='flex'>
        <div class='flex-1'>
            <x-common.card class='m-3' tone='light'>
                <div class='justify-center card-title'>BCルート：詳細</div>
                <x-common.textline label='ルート名' :value="$bcRoute->name" />
                <x-common.textline label='区分' :value="$bcRoute->display_memo1" />
                <x-common.textline label='MGR・SMGR' :value="$bcRoute->display_memo2" />
                <x-common.textline label='用途' :value="$bcRoute->display_memo3" />
                <x-common.textline label='メモ' :value="$bcRoute->memo"/>
                <x-common.textline label='作成日時' :value="$bcRoute->created_at"/>
                <x-common.textline label='更新日時' :value="$bcRoute->updated_at"/>
            </x-common.card>
        </div>
        <div class='flex-1'>
            <x-common.card class='m-3' tone='light'>
                <div class='justify-center card-title'>承認者</div>
                @foreach ($bcRoute->bc_authorizers()->get() as $index => $account)
                    <x-common.textline label="{{ $index+1 }}人目" value="{{ $account->employee_number }} : {{ $account->name }}" size='lg'/>
                @endforeach
            </x-common.card>
            <x-common.card class='m-3' tone='light'>
                <div class='justify-center card-title'>所属者</div>
                @foreach ($bcRoute->accounts()->where('status',2)->get() as $index => $account)
                    <x-common.textline label="{{ $index+1 }}人目" value="{{ $account->employee_number }} : {{ $account->name }}" size='lg'/>
                @endforeach
            </x-common.card>
        </div>
    </div>
    <x-button.back mt='6' />

</x-app-layout>
