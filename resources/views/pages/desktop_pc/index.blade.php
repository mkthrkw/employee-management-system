<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='desktop_windows' text='DesktopPc'/>
    </x-slot:title>

    <x-common.card class='px-5 mx-5'>
        <form method='GET'>
            <div class='flex gap-x-16'>
                <div class='flex-1'>
                    @php $placeholder = 'フリーワード（部分検索）'; @endphp
                    <x-input.checkbox-enum label='ステータス' name='status' :cases="App\Enums\DeviceStatus::cases()" :value="$param['status'] ?? ''" />
                    <x-input.text label='デバイス名' name='name' :placeholder="$placeholder" :value="$param['name'] ?? ''" />
                    <x-input.text label='CPU' name='cpu' :placeholder="$placeholder" :value="$param['cpu'] ?? ''" />
                    <x-input.text label='メモリ' name='memory' :placeholder="$placeholder" :value="$param['memory'] ?? ''" />
                    <x-input.text label='HDD' name='hdd' :placeholder="$placeholder" :value="$param['hdd'] ?? ''" />
                    <x-input.text label='VPN-ID' name='vpn_connection_id' :placeholder="$placeholder" :value="$param['vpn_connection_id'] ?? ''"/>
                    <x-input.checkbox-enum label='キャスナビ' name='casting_navi' :cases="App\Enums\CastingNavi::cases()" :value="$param['casting_navi'] ?? ''"/>
                </div>
                <div class='flex-1'>
                    <x-input.checkbox-enum label='保管支店' name='branch' :cases="array_filter(App\Enums\Branch::cases(),function($case){return $case->is_use();})" :value="$param['branch'] ?? ''"/>
                    <x-input.text-split label='入荷日' type='date' placeholder="yyyy/mm/dd" midtext="～" gap=4
                        name1='arrival_date_from' :value1="$param['arrival_date_from'] ?? ''"
                        name2='arrival_date_to' :value2="$param['arrival_date_to'] ?? ''"
                    />
                    <x-input.text-split label='廃棄日' type='date' placeholder="yyyy/mm/dd" midtext="～" gap=4
                    name1='disposal_date_from' :value1="$param['disposal_date_from'] ?? ''"
                    name2='disposal_date_to' :value1="$param['disposal_date_to'] ?? ''"
                    />
                    <x-input.text label='メモ' name='memo' :placeholder="$placeholder" :value="$param['memo'] ?? ''"/>
                    <x-input.text label='利用者名' name='account_name' :placeholder="$placeholder" :value="$param['account_name'] ?? ''"/>
                    <x-input.text label='利用者社員番号' name='account_employee_number' :placeholder="$placeholder" :value="$param['account_employee_number'] ?? ''"/>
                </div>
            </div>
            <x-button.submit icon='search' label='検索'/>
        </form>
    </x-common.card>

    <div class='flex justify-between mx-10 mb-1 mt-7'>
        <div class='self-end font-medium text-primary'>
            <span class='text-2xl'>{{ $desktopPcs->total() }} </span>件 / <span class='text-sm'>{{ $desktopPcs->firstItem() }}-{{ $desktopPcs->lastItem() }}件表示</span>
        </div>
        <div class=''>
            {{ $desktopPcs->appends(request()->query())->onEachSide(2)->links() }}
        </div>
        <div>
            @can('gate','gate6')
            <a href={{ route('desktop_pc.create') }} role="button" class="gap-1 btn btn-sm btn-accent opacity-90 rounded-xl">
                <x-common.material-icon icon='add' size='sm' type='outlined'/>
                <span class='text-sm font-medium'>新規作成</span>
            </a>
            @endcan
        </div>
    </div>

    <x-common.table class='mx-5'>
        <x-slot:thead>
            <tr>
                @foreach (['ID','ステータス','デバイス名','CPU/HDD','メモリ','VPN-ID','キャスナビ','支店','利用者','操作'] as $th)
                    <th>{{ $th }}</th>
                @endforeach
            </tr>
        </x-slot:thead>
        <x-slot:tbody>
            @foreach ($desktopPcs as $desktopPc)
            <tr class='hover'>
                <td>{{ $desktopPc->id }}</td>
                <td>{{ $desktopPc->status->label() }}</td>
                <td class='text-xs xl:text-sm'>{{ $desktopPc->name }}</td>
                <td class='text-xs xl:text-sm'>
                    {{ $desktopPc->cpu }}<br>
                    {{ $desktopPc->hdd }}
                </td>
                <td class='text-xs xl:text-sm'>{{ $desktopPc->memory }}</td>
                <td class='text-xs xl:text-sm'>{{ $desktopPc->vpn_connection_id }}</td>
                <td class='text-xs xl:text-sm'>{{ $desktopPc->casting_navi->label() }}</td>
                <td class='text-xs xl:text-sm'>{{ $desktopPc->branch->label() }}</td>
                <td class='text-xs xl:text-sm'>
                    {{ $desktopPc->account_name }}<br>
                    {{ $desktopPc->account_employee_number }}
                </td>
                <td class='justify-center'>
                    <x-common.icon-link icon='search' text='詳細' :href="route('desktop_pc.show',$desktopPc)" size='xs' center=True />
                    @can('gate','gate6')
                    <x-common.icon-link icon='edit' text='編集' :href="route('desktop_pc.edit',$desktopPc)" size='xs' center=True />
                    @endcan
                </td>
            </tr>
            @endforeach
        </x-slot:tbody>
    </x-common.table>

</x-app-layout>
