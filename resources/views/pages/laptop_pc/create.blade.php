<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='laptop' text='Add New LaptopPC'/>
    </x-slot:title>

    <x-common.card class='max-w-2xl px-5 mx-auto mt-3'>
        <div class='justify-center card-title'>ノートPC：新規作成</div>
        <form method='POST' action={{ route('laptop_pc.store')}} onsubmit="return beforeSubmit()">
            @csrf
            <div class='flex-col justify-center'>
                <input name='status' type='hidden' value=1>
                <x-input.text label='端末番号' name='name' placeholder='フリーワード' :value="old('name')" />
                <x-input.text label='デバイス名' name='device_name' placeholder='フリーワード' :value="old('device_name')" />
                <x-input.text label='CPU' name='cpu' placeholder='フリーワード' :value="old('cpu')" />
                <x-input.text label='メモリ' name='memory' placeholder='フリーワード' :value="old('memory')" />
                <x-input.select-enum label='保管支店' name='branch' :selected="old('branch') ?? 1" :cases="array_filter(App\Enums\Branch::cases(),function($case){return $case->is_use();})"/>
                <x-input.text label='入荷日' name='arrival_date' placeholder="yyyy/mm/dd" type='date' :value="old('arrival_date')" addClasses='max-w-xs' />
                <x-input.textarea label='メモ' name='memo' placeholder='フリーワード' :value="old('memo')" />
            </div>
            <x-button.submit mt=8 icon='add' label='新規作成'/>
        </form>
    </x-common.card>
    <x-button.back mt='6' />

    <x-slot:scripts>
        <script>
            function beforeSubmit() {
                if(window.confirm('ノートPCを新規作成しますか？')) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
    </x-slot:scripts>

</x-app-layout>
