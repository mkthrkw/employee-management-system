<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='mail' text='MailingList'/>
    </x-slot:title>

    <x-common.card class='px-5 mx-5'>
        <form method='GET'>
            <div class='flex gap-x-16'>
                <div class='flex-1'>
                    <x-input.text label='リスト名称' name='name' placeholder="フリーワード（部分検索）" :value="$param['name'] ?? ''"/>
                    <x-input.text label='メールアドレス' name='address' placeholder="フリーワード（部分検索）" :value="$param['address'] ?? ''"/>
                </div>
                <div class='flex-1'>
                    <x-input.text label='メモ' name='memo' placeholder="フリーワード（部分検索）" :value="$param['memo'] ?? ''"/>
                </div>
            </div>
            <x-button.submit icon='search' label='検索'/>
        </form>
    </x-common.card>

    <div class='flex justify-between mx-10 mb-1 mt-7'>
        <div class='self-end font-medium text-primary'>
            <span class='text-2xl'>{{ $mailingLists->total() }} </span>件 / <span class='text-sm'>{{ $mailingLists->firstItem() }}-{{ $mailingLists->lastItem() }}件表示</span>
        </div>
        <div class=''>
            {{ $mailingLists->appends(request()->query())->onEachSide(2)->links() }}
        </div>
        <div>
            @can('gate','gate6')
            <a href={{ route('mailing_list.create') }} role="button" class="gap-1 btn btn-sm btn-accent opacity-90 rounded-xl">
                <x-common.material-icon icon='add' size='sm' type='outlined'/>
                <span class='text-sm font-medium'>新規作成</span>
            </a>
            @endcan
        </div>
    </div>

    <x-common.table class='mx-5'>
        <x-slot:thead>
            <tr>
                @foreach (['ID','リスト名称','メールアドレス','送受信権限','BCルート','操作'] as $th)
                    <th>{{ $th }}</th>
                @endforeach
            </tr>
        </x-slot:thead>
        <x-slot:tbody>
            @foreach ($mailingLists as $mailingList)
            <tr class='hover'>
                <td>{{ $mailingList->id }}</td>
                <td>{{ $mailingList->name }}</td>
                <td>{{ $mailingList->address }}</td>
                <td>@if($mailingList->ext_send_permission) あり @else なし @endif</td>
                <td>{{ $mailingList->bc_route_id }}</td>
                <td class='justify-center'>
                    <x-common.icon-link icon='search' text='詳細' :href="route('mailing_list.show',$mailingList)" size='xs' center=True />
                    @can('gate','gate6')
                    <x-common.icon-link icon='edit' text='編集' :href="route('mailing_list.edit',$mailingList)" size='xs' center=True />
                    @endcan
                </td>
            </tr>
            @endforeach
        </x-slot:tbody>
    </x-common.table>

</x-app-layout>
