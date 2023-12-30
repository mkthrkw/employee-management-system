<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='visibility' text='Add New BcRoute'/>
    </x-slot:title>

    <x-common.card class='max-w-2xl px-5 mx-auto mt-3'>
        <div class='justify-center card-title'>BCルート：新規作成</div>
        <form method='POST' action={{ route('bc_route.store')}} onsubmit="return beforeSubmit()">
            @csrf
            <div class='flex-col justify-center'>
                <x-input.text label='ルート名' name='name' placeholder='フリーワード' :value="old('name')" />
                <x-input.text label='区分' name='display_memo1' placeholder='フリーワード' :value="old('display_memo1')" />
                <x-input.text label='MGR・SMGR' name='display_memo2' placeholder='フリーワード' :value="old('display_memo2')" />
                <x-input.text label='用途' name='display_memo3' placeholder='フリーワード' :value="old('display_memo3')" />
                <x-input.textarea label='メモ' name='memo' placeholder='フリーワード' :value="old('memo')" />
            </div>
            <x-button.submit mt=8 icon='add' label='新規作成'/>
        </form>
    </x-common.card>
    <x-button.back mt='6' />

    <x-slot:scripts>
        <script>
            function beforeSubmit() {
                if(window.confirm('BossCheckルートを新規作成しますか？')) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
    </x-slot:scripts>

</x-app-layout>
