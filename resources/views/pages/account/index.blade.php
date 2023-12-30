<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='group' text='Account'/>
    </x-slot:title>

    <x-common.card class='px-5 mx-5'>
        <form method='GET'>
            <div class='flex gap-x-16'>
                <div class='flex-1'>
                    @php $placeholder = 'フリーワード（部分検索）'; @endphp
                    <x-input.checkbox-enum label='ステータス' name='status' :cases="App\Enums\AccountStatus::cases()" :value="$param['status'] ?? ''" />
                    <x-input.text label='社員番号' name='employee_number' :placeholder="$placeholder" :value="$param['employee_number'] ?? ''" />
                    <x-input.text label='名前' name='name' :placeholder="$placeholder" :value="$param['name'] ?? ''"/>
                    <x-input.text label='フリガナ' name='name_kana' :placeholder="$placeholder" :value="$param['name_kana'] ?? ''"/>
                    <x-input.checkbox-enum label='役職' name='position' :cases="App\Enums\Position::cases()" :value="$param['position'] ?? ''"/>
                </div>
                <div class='flex-1'>
                    <x-input.text label='メールアドレス' name='email' :placeholder="$placeholder" :value="$param['email'] ?? ''"/>
                    <x-input.text label='メモ' name='memo' :placeholder="$placeholder" :value="$param['memo'] ?? ''"/>
                    <x-input.text-split label='入社日' type='date' placeholder="yyyy/mm/dd" midtext="～" gap=4
                        name1='joining_date_from' :value1="$param['joining_date_from'] ?? ''"
                        name2='joining_date_to' :value2="$param['joining_date_to'] ?? ''"
                    />
                    <x-input.text-split label='退社日' type='date' placeholder="yyyy/mm/dd" midtext="～" gap=4
                    name1='leaving_date_from' :value1="$param['leaving_date_from'] ?? ''"
                    name2='leaving_date_to' :value1="$param['leaving_date_to'] ?? ''"
                    />
                </div>
            </div>
            <x-button.submit icon='search' label='検索'/>
        </form>
    </x-common.card>

    <div class='flex justify-between mx-10 mb-1 mt-7'>
        <div class='self-end font-medium text-primary'>
            <span class='text-2xl'>{{ $accounts->total() }} </span>件 / <span class='text-sm'>{{ $accounts->firstItem() }}-{{ $accounts->lastItem() }}件表示</span>
        </div>
        <div class=''>
            {{ $accounts->appends(request()->query())->onEachSide(2)->links() }}
        </div>
        <div>
            @can('gate','gate6')
            <a href={{ route('account.create') }} role="button" class="gap-1 btn btn-sm btn-accent opacity-90 rounded-xl">
                <x-common.material-icon icon='add' size='sm' type='outlined'/>
                <span class='text-sm font-medium'>新規作成</span>
            </a>
            @endcan
        </div>
    </div>

    <x-common.table class='mx-5'>
        <x-slot:thead>
            <tr>
                @foreach (['ID','ステータス','社員番号','名前','役職','メールアドレス','操作'] as $th)
                    <th>{{ $th }}</th>
                @endforeach
            </tr>
        </x-slot:thead>
        <x-slot:tbody>
            @foreach ($accounts as $account)
            <tr class='hover'>
                <td>{{ $account->id }}</td>
                <td>{{ $account->status->label() }}</td>
                <td>{{ $account->employee_number }}</td>
                <td>
                    {{ $account->name }}<br>
                    <span class='text-xs'>{{ $account->name_kana }}</span>
                </td>
                <td>{{ $account->position->label() }}</td>
                <td>
                    <span class='text-xs xl:text-sm'>{{ $account->email }}</span>
                </td>
                <td class='justify-center'>
                    <x-common.icon-link icon='search' text='詳細' :href="route('account.show',$account)" size='xs' center=True />
                    @can('gate','gate6')
                    <x-common.icon-link icon='edit' text='編集' :href="route('account.edit',$account)" size='xs' center=True />
                    @endcan
                </td>
            </tr>
            @endforeach
        </x-slot:tbody>
    </x-common.table>

</x-app-layout>
