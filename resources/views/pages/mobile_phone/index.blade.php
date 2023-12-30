<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='smartphone' text='MobilePhone'/>
    </x-slot:title>

    <x-common.card class='px-5 mx-5'>
        <form method='GET'>
            <div class='flex gap-x-16'>
                <div class='flex-1'>
                    @php $placeholder = 'フリーワード（部分検索）'; @endphp
                    <x-input.checkbox-enum label='ステータス' name='status' :cases="App\Enums\DeviceStatus::cases()" :value="$param['status'] ?? ''" />
                    <x-input.text label='デバイス名' name='name' :placeholder="$placeholder" :value="$param['name'] ?? ''" />
                    <x-input.text label='プロバイダー' name='provider' :placeholder="$placeholder" :value="$param['provider'] ?? ''" />
                    <x-input.text label='電話番号' name='phone_number' :placeholder="$placeholder" :value="$param['phone_number'] ?? ''" />
                    <x-input.checkbox-enum label='保管支店' name='branch' :cases="array_filter(App\Enums\Branch::cases(),function($case){return $case->is_use();})" :value="$param['branch'] ?? ''"/>
                </div>
                <div class='flex-1'>
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
            <span class='text-2xl'>{{ $mobilePhones->total() }} </span>件 / <span class='text-sm'>{{ $mobilePhones->firstItem() }}-{{ $mobilePhones->lastItem() }}件表示</span>
        </div>
        <div class=''>
            {{ $mobilePhones->appends(request()->query())->onEachSide(2)->links() }}
        </div>
        <div>
            @can('gate','gate6')
            <a href={{ route('mobile_phone.create') }} role="button" class="gap-1 btn btn-sm btn-accent opacity-90 rounded-xl">
                <x-common.material-icon icon='add' size='sm' type='outlined'/>
                <span class='text-sm font-medium'>新規作成</span>
            </a>
            @endcan
        </div>
    </div>

    <x-common.table class='mx-5'>
        <x-slot:thead>
            <tr>
                @foreach (['ID','ステータス','デバイス名','管理区分','プロバイダー','電話番号','支店','利用者','操作'] as $th)
                    <th>{{ $th }}</th>
                @endforeach
            </tr>
        </x-slot:thead>
        <x-slot:tbody>
            @foreach ($mobilePhones as $mobilePhone)
            <tr class='hover'>
                <td>{{ $mobilePhone->id }}</td>
                <td>{{ $mobilePhone->status->label() }}</td>
                <td class='text-xs xl:text-sm'>{{ $mobilePhone->name }}</td>
                <td class='text-xs xl:text-sm'>{{ $mobilePhone->category }}</td>
                <td class='text-xs xl:text-sm'>{{ $mobilePhone->provider }}</td>
                <td class='text-xs xl:text-sm'>{{ $mobilePhone->phone_number }}</td>
                <td class='text-xs xl:text-sm'>{{ $mobilePhone->branch->label() }}</td>
                <td class='text-xs xl:text-sm'>
                    {{ $mobilePhone->account_name }}<br>
                    {{ $mobilePhone->account_employee_number }}
                </td>
                <td class='justify-center'>
                    <x-common.icon-link icon='search' text='詳細' :href="route('mobile_phone.show',$mobilePhone)" size='xs' center=True />
                    @can('gate','gate6')
                    <x-common.icon-link icon='edit' text='編集' :href="route('mobile_phone.edit',$mobilePhone)" size='xs' center=True />
                    @endcan
                </td>
            </tr>
            @endforeach
        </x-slot:tbody>
    </x-common.table>

</x-app-layout>
