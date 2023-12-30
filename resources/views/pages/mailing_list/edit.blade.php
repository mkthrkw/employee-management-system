<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='mail' text="Edit : {{ $mailingList->name }}"/>
    </x-slot:title>

    <x-common.card class='max-w-2xl px-5 mx-auto mt-3'>
        <form method='POST' action="{{ route('mailing_list.update',$mailingList) }}" onsubmit="return beforeSubmit('上書き更新しますか？')">
            @method('PATCH')
            @csrf
            <div class='justify-center card-title'>メーリングリスト：編集</div>
            <x-input.text label='リスト名称' name='name' :value="old('name') ?? $mailingList->name" />
            <x-input.text label='メールアドレス' name='address' :value="old('address') ?? $mailingList->address" />
            <x-input.select label='送信権限' name='ext_send_permission' :selected="old('ext_send_permission') ?? $mailingList->ext_send_permission ?? 0" :cases="[['id'=>0,'name'=>'なし'],['id'=>1,'name'=>'あり']]" />
            <x-input.select label='BCルート' name='bc_route_id' :selected="old('bc_route_id') ?? $mailingList->bc_route_id ?? 0" :cases="App\Models\BcRoute::get()" zeroValue=1 />
            <x-input.textarea label='メモ' name='memo' placeholder='フリーワード' :value="old('memo') ?? $mailingList->memo" />
            <x-button.submit mt=8 icon='edit' label='更新'/>
        </form>
    </x-common.card>
    <div>
        @can('gate','gate8')
        <x-button.delete mt='6' action="{{ route('mailing_list.destroy',$mailingList) }}" onsubmit="return beforeSubmit('このメーリングリストを削除しますか？')"/>
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
