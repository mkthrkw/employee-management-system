<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='person_add_alt' text='Add New Account'/>
    </x-slot:title>

    <x-common.card class='max-w-2xl px-5 mx-auto'>
        <div class='justify-center card-title'>アカウント：新規作成</div>
        <form method='POST' action={{ route('account.store')}} onsubmit="return beforeSubmit()">
            @csrf
            <div class='flex-col justify-center'>
                <input name='status' type='hidden' value=1>
                <x-input.text label='社員番号' name='employee_number' placeholder='CC + 番号7桁' :value="old('employee_number')" />
                <x-input.text label='パスワード' name='password' placeholder='半角英数字' type='password' :value="old('password')"/>
                <x-input.text label='パスワード確認入力' name='password_confirmation' placeholder='半角英数字' type='password' :value="old('password_confirmation')"/>
                <div class='flex gap-12'>
                    <x-input.text label='姓' name='last_name' placeholder='全角' :value="old('last_name')" />
                    <x-input.text label='名' name='first_name' placeholder='全角' :value="old('first_name')" />
                </div>
                <div class='flex gap-12'>
                    <x-input.text label='セイ' name='last_name_kana' placeholder='全角カタカナ' :value="old('last_name_kana')" />
                    <x-input.text label='メイ' name='first_name_kana' placeholder='全角カタカナ' :value="old('first_name_kana')" />
                </div>
                <x-input.select-enum label='役職' name='position' :selected="old('position') ?? 1" :cases="App\Enums\Position::cases()" official=True />
                <div class='flex gap-4'>
                    <x-input.text label='メールアドレス' name='email' placeholder='アットマークの前まで' :value="old('email')" />
                    <span class='pt-1 mt-6 mr-4 text-base-content/75 w-44'>@staff-first.co.jp</span>
                </div>
                <x-input.select label='BCルート' name='bc_route_id' :selected="old('bc_route_id') ?? 0" :cases="App\Models\BcRoute::get()" zeroValue=1 />
                <x-input.text label='Windowsユーザー名' name='windows_username' placeholder='CRTM\ + 社員番号' :value="old('windows_username')"/>
                <x-input.select-enum label='権限' name='role' :selected="old('role') ?? 1" :cases="App\Enums\Role::cases()"/>
                <x-input.text label='入社日' name='joining_date' placeholder="yyyy/mm/dd" type='date' :value="old('joining_date')" addClasses='max-w-xs' />
                <x-input.textarea label='メモ' name='memo' placeholder='フリーワード' :value="old('memo')" />
            </div>
            <x-button.submit mt=8 icon='add' label='新規作成'/>
        </form>
    </x-common.card>
    <x-button.back mt='6' />

    <x-slot:scripts>
        <script>
            function beforeSubmit() {
                if(window.confirm('アカウントを新規作成しますか？')) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
    </x-slot:scripts>
</x-app-layout>
