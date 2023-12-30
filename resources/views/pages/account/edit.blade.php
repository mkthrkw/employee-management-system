<x-app-layout>


    <x-slot:title>
        <x-common.page-title icon='self_improvement' text="Edit : {{ $account->name }}"/>
    </x-slot:title>

    <div class='flex'>
        <div class='flex-1'>
            <x-common.card class='m-3'>

                <form method='POST' action="{{ route('account.update',$account) }}" onsubmit="return beforeSubmit('上書き更新しますか？')">
                    @method('PATCH')
                    @csrf
                    <div class='justify-center card-title'>アカウント：編集</div>

                    <x-input.select-enum label='ステータス' name='status' :selected="old('status') ?? $account->status->value" :cases="App\Enums\AccountStatus::cases()"/>
                    <x-input.text label='社員番号' name='employee_number' :value="old('employee_number') ?? $account->employee_number" />
                    <div class='flex gap-12'>
                        <x-input.text label='姓' name='last_name' placeholder='全角' :value="old('last_name') ?? $account->last_name" />
                        <x-input.text label='名' name='first_name' placeholder='全角' :value="old('first_name') ?? $account->first_name" />
                    </div>
                    <div class='flex gap-12'>
                        <x-input.text label='セイ' name='last_name_kana' placeholder='全角カタカナ' :value="old('last_name_kana') ?? $account->last_name_kana" />
                        <x-input.text label='メイ' name='first_name_kana' placeholder='全角カタカナ' :value="old('first_name_kana') ?? $account->first_name_kana" />
                    </div>
                    <x-input.select-enum label='役職' name='position' :selected="old('position') ?? $account->position->value" :cases="App\Enums\Position::cases()" official=True />
                    <div class='flex gap-2'>
                        <x-input.text label='メールアドレス' name='email' :value="old('email') ?? $account->email" />
                        <span class='pt-1 mt-6 mr-4 text-base-content/75 w-44'>@staff-first.co.jp</span>
                    </div>
                    <x-input.select label='BCルート' name='bc_route_id' :selected="old('bc_route_id') ?? $account->bc_route_id ?? 0" :cases="App\Models\BcRoute::get()" zeroValue=1/>
                    <x-input.text label='Windowsユーザー名' name='windows_username' placeholder='CRTM\ + 社員番号' :value="old('windows_username') ?? $account->windows_username"/>
                    <x-input.text label='Chatwork aid' name='chatwork_aid' placeholder='To:●●●●●●● の番号' :value="old('chatwork_aid') ?? $account->chatwork_aid"/>
                    <x-input.select-enum label='権限' name='role' :selected="old('role') ?? $account->role->value ?? 1" :cases="App\Enums\Role::cases()"/>
                    <div class='flex gap-12'>
                        <x-input.text label='入社日' name='joining_date' placeholder="yyyy/mm/dd" type='date' :value="old('joining_date') ?? $account->joining_date" />
                        <x-input.text label='退社日' name='leaving_date' placeholder="yyyy/mm/dd" type='date' :value="old('leaving_date') ?? $account->leaving_date" />
                    </div>
                        <x-input.textarea label='メモ' name='memo' placeholder='フリーワード' :value="old('memo') ?? $account->memo" />
                    <div class="border border-2 border-base-300 p-4 mt-6 rounded-2xl text-center">
                        <span class="text-sm">↓変更する場合のみ入力↓</span>
                        <x-input.text label='パスワード' name='password' placeholder='半角英数字' type='password' :value="old('password') ?? ''"/>
                        <x-input.text label='パスワード確認入力' name='password_confirmation' placeholder='半角英数字' type='password' :value="old('password_confirmation') ?? ''"/>
                    </div>
                    <x-button.submit mt=8 icon='edit' label='更新'/>
                </form>
            </x-common.card>
        </div>
        <div class='flex-1'>
            <x-common.card class='m-3'>
                <div class='justify-center mb-2 card-title'>所属部署</div>
                @livewire('account-department', ['account' => $account])
            </x-common.card>
            <x-common.card class='m-3'>
                <div class='justify-center mb-2 card-title'>メーリングリスト</div>
                @livewire('account-mailing-list', ['account' => $account])
            </x-common.card>
            <x-common.card class='m-3'>
                <div class='justify-center mb-2 card-title'>デスクトップPC</div>
                @livewire('account-desktop-pc', ['account' => $account])
            </x-common.card>
            <x-common.card class='m-3'>
                <div class='justify-center mb-2 card-title'>ノートPC</div>
                @livewire('account-laptop-pc', ['account' => $account])
            </x-common.card>
            <x-common.card class='m-3'>
                <div class='justify-center mb-2 card-title'>社用携帯</div>
                @livewire('account-mobile-phone', ['account' => $account])
            </x-common.card>
        </div>
    </div>
    <div>
        @can('gate','gate8')
        <x-button.delete mt='6' action="{{ route('account.destroy',$account) }}" onsubmit="return beforeSubmit('このアカウントを削除しますか？')"/>
        @endcan
        <x-button.back mt='6' />
    </div>
    <x-slot:scripts>
        <script>
            function beforeSubmit(message) {
                if(window.confirm(message)) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
    </x-slot:scripts>

</x-app-layout>
