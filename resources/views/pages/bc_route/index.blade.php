<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='visibility' text='BcRoute'/>
    </x-slot:title>

    <x-common.card class='px-5 mx-5'>
        <form method='GET'>
            <div class='flex gap-x-16'>
                <div class='flex-1'>
                    <x-input.text label='ルート名' name='name' placeholder="フリーワード（部分検索）" :value="$param['name'] ?? ''"/>
                    <x-input.text label='用途' name='display_memo3' placeholder="フリーワード（部分検索）" :value="$param['display_memo3'] ?? ''"/>
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
            <span class='text-2xl'>{{ $bcRoutes->total() }} </span>件 / <span class='text-sm'>{{ $bcRoutes->firstItem() }}-{{ $bcRoutes->lastItem() }}件表示</span>
        </div>
        <div class=''>
            {{ $bcRoutes->appends(request()->query())->onEachSide(2)->links() }}
        </div>
        <div>
            @can('gate','gate6')
            <a href={{ route('bc_route.create') }} role="button" class="gap-1 btn btn-sm btn-accent opacity-90 rounded-xl">
                <x-common.material-icon icon='add' size='sm' type='outlined'/>
                <span class='text-sm font-medium'>新規作成</span>
            </a>
            @endcan
        </div>
    </div>

    <x-common.table class='mx-5'>
        <x-slot:thead>
            <tr>
                @foreach (['ID','ルート名','区分','MGR・SMGR','用途','操作'] as $th)
                    <th>{{ $th }}</th>
                @endforeach
            </tr>
        </x-slot:thead>
        <x-slot:tbody>
            @foreach ($bcRoutes as $bcRoute)
            <tr class='hover'>
                <td>{{ $bcRoute->id }}</td>
                <td>{{ $bcRoute->name }}</td>
                <td>{{ $bcRoute->display_memo1 }}</td>
                <td>{{ $bcRoute->display_memo2 }}</td>
                <td>{{ $bcRoute->display_memo3 }}</td>
                <td class='justify-center'>
                    <x-common.icon-link icon='search' text='詳細' :href="route('bc_route.show',$bcRoute)" size='xs' center=True />
                    @can('gate','gate6')
                    <x-common.icon-link icon='edit' text='編集' :href="route('bc_route.edit',$bcRoute)" size='xs' center=True />
                    @endcan
                </td>
            </tr>
            @endforeach
        </x-slot:tbody>
    </x-common.table>

</x-app-layout>
