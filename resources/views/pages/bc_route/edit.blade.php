<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='visibility' text="Edit : {{ $bcRoute->name }}"/>
    </x-slot:title>
    <div class='flex'>
        <div class='flex-1'>
            <x-common.card class='max-w-2xl px-5 mx-auto mt-3'>
                <form method='POST' action="{{ route('bc_route.update',$bcRoute) }}" onsubmit="return beforeSubmit('上書き更新しますか？')">
                    @method('PATCH')
                    @csrf
                    <div class='justify-center card-title'>BCルート：編集</div>
                    <x-input.text label='ルート名' name='name' :value="old('name') ?? $bcRoute->name" />
                    <x-input.text label='区分' name='display_memo1' :value="old('display_memo1') ?? $bcRoute->display_memo1" />
                    <x-input.text label='MGR・SMGR' name='display_memo2' :value="old('display_memo2') ?? $bcRoute->display_memo2" />
                    <x-input.text label='用途' name='display_memo3' :value="old('display_memo3') ?? $bcRoute->display_memo3" />
                    <x-input.textarea label='メモ' name='memo' placeholder='フリーワード' :value="old('memo') ?? $bcRoute->memo" />
                    <x-button.submit mt=8 icon='edit' label='更新'/>
                </form>
            </x-common.card>
        </div>
        <div class='flex-1'>
            <x-common.card class='m-3'>
                <div class='justify-center mb-2 card-title'>承認者：編集</div>
                @livewire('bc-route-account', ['bc_route' => $bcRoute])
            </x-common.card>
        </div>
    </div>
    <div>
        @can('gate','gate8')
        <x-button.delete mt='6' action="{{ route('bc_route.destroy',$bcRoute) }}" onsubmit="return beforeSubmit('このBCルートを削除しますか？')"/>
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
