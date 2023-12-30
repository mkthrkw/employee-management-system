<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='business' text='Department'/>
    </x-slot:title>

    <x-common.card class='px-5 mx-5'>
        <form method='GET'>
            <div class='flex gap-x-16'>
                <div class='flex-1'>
                    <x-input.text label='部署名' name='name' placeholder="フリーワード（部分検索）" :value="$param['name'] ?? ''"/>
                    <x-input.text label='DepthLv' name='depth' placeholder="1～4のいずれか" :value="$param['depth'] ?? ''"/>
                    <x-input.text label='メモ' name='memo' placeholder="フリーワード（部分検索）" :value="$param['memo'] ?? ''"/>
                    <x-button.submit icon='search' label='検索'/>
                </div>
                <div class='flex-1 self-center justify-center'>
                    <div class="max-w-xs mx-auto">
                        <x-common.icon-link icon='account_tree' text='組織図チャートへ' :href="route('department.chart')" size='lg' center=True />
                    </div>
                </div>
            </div>
        </form>
    </x-common.card>

    <div class='flex justify-between mx-10 mb-1 mt-7'>
        <div class='self-end font-medium text-primary'>
            <span class='text-2xl'>{{ $departments->total() }} </span>件 / <span class='text-sm'>{{ $departments->firstItem() }}-{{ $departments->lastItem() }}件表示</span>
        </div>
        <div class=''>
            {{ $departments->appends(request()->query())->onEachSide(2)->links() }}
        </div>
        <div>
            @can('gate','gate6')
            <a href={{ route('department.create') }} role="button" class="gap-1 btn btn-sm btn-accent opacity-90 rounded-xl">
                <x-common.material-icon icon='add' size='sm' type='outlined'/>
                <span class='text-sm font-medium'>新規作成</span>
            </a>
            @endcan
        </div>
    </div>

    <x-common.table class='mx-5'>
        <x-slot:thead>
            <tr>
                @foreach (['ID','部署名','紐づけID','Depth Lv','操作'] as $th)
                    <th>{{ $th }}</th>
                @endforeach
            </tr>
        </x-slot:thead>
        <x-slot:tbody>
            @foreach ($departments as $department)
            <tr class='hover'>
                <td>{{ $department->id }}</td>
                <td>{{ $department->name }}<br>
                <span class="text-xs text-base-content/50">{{ $department->fullname }}</span></td>
                <td>{{ $department->parent_id }}</td>
                <td>{{ $department->depth }}</td>
                <td class='justify-center'>
                    <x-common.icon-link icon='search' text='詳細' :href="route('department.show',$department)" size='xs' center=True />
                    @can('gate','gate6')
                    <x-common.icon-link icon='edit' text='編集' :href="route('department.edit',$department)" size='xs' center=True />
                    @endcan
                </td>
            </tr>
            @endforeach
        </x-slot:tbody>
    </x-common.table>

</x-app-layout>
