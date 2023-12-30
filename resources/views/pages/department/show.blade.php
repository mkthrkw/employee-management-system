<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='business' text="Show : {{ $department->name }}"/>
    </x-slot:title>

    <div class='flex'>
        <div class='flex-1'>
            <x-common.card class='m-3' tone='light'>
                <div class='justify-center card-title'>所属部署：詳細</div>
                <x-common.textline label='部署名' :value="$department->name" />
                <x-common.textline label='部署名フルネーム（紐づけ結合）' :value="$department->fullname" />
                <x-common.textline label='紐づけ先（親）' value="Depth{{ $department->parent->depth ?? 'なし' }} : {{ $department->parent->name ?? '' }} (ID {{ $department->parent_id }})" />
                <x-common.textline label='Depthレベル' :value="$department->depth" />
                <x-common.textline label='メモ' :value="$department->memo"/>
                <x-common.textline label='作成日時' :value="$department->created_at"/>
                <x-common.textline label='更新日時' :value="$department->updated_at"/>
            </x-common.card>
        </div>
        <div class='flex-1'>
            <x-common.card class='m-3' tone='light'>
                <div class='justify-center card-title'>所属者</div>
                @foreach ($department->accounts()->get() as $index => $account)
                    <x-common.textline label="{{ $index+1 }}人目" value="{{ $account->employee_number }} : {{ $account->name }}"  size='lg'/>
                @endforeach
            </x-common.card>
        </div>
    </div>
    <x-button.back mt='6' />

</x-app-layout>
