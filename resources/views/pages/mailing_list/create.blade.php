<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='mail' text='Add New MailingList'/>
    </x-slot:title>

    <x-common.card class='max-w-2xl px-5 mx-auto mt-3'>
        <div class='justify-center card-title'>メーリングリスト：新規作成</div>
        <form method='POST' action={{ route('mailing_list.store')}} onsubmit="return beforeSubmit()">
            @csrf
            <div class='flex-col justify-center'>
                <x-input.text label='リスト名称' name='name' placeholder='フリーワード' :value="old('name')" />
                <x-input.text label='メールアドレス' name='address' placeholder='フリーワード' :value="old('address')" />
                <x-input.select label='送信権限' name='ext_send_permission' :selected="old('ext_send_permission') ?? 0" :cases="[['id'=>0,'name'=>'なし'],['id'=>1,'name'=>'あり']]" />
                <x-input.select label='BCルート' name='bc_route_id' :selected="old('bc_route_id') ?? 0" :cases="App\Models\BcRoute::get()" zeroValue=1 />
                <x-input.textarea label='メモ' name='memo' placeholder='フリーワード' :value="old('memo')" />
            </div>
            <x-button.submit mt=8 icon='add' label='新規作成'/>
        </form>
    </x-common.card>
    <x-button.back mt='6' />

    <x-slot:scripts>
        <script>
            function beforeSubmit() {
                if(window.confirm('メーリングリストを新規作成しますか？')) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
    </x-slot:scripts>

</x-app-layout>
