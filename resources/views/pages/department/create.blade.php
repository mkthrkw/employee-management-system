<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='add_business' text='Add New Department'/>
    </x-slot:title>

    <x-common.card class='max-w-2xl px-5 mx-auto mt-3'>
        <div class='justify-center card-title'>所属部署：新規作成</div>
        <form method='POST' action={{ route('department.store')}} onsubmit="return beforeSubmit()">
            @csrf
            <div class='flex-col justify-center'>
                <x-input.text label='部署名' name='name' placeholder='フリーワード' :value="old('name')" />
                <div class='w-full mb-3 form-control'>
                    <label class='py-0 mb-1 label'>
                        <span class='font-medium px-7 rounded-xl bg-base-content/50 label-text text-base-100'>紐づけ先</span>
                    </label>
                    <select name='parent_id' class="w-full py-0 border border-1 select select-bordered select-sm border-base-content/40 rounded-xl">
                        @foreach ($all_departments as $case)
                            <option value='{{ $case->id }}' @if($case->id == old('parent_id')) selected @endif>
                                [Depth{{ $case->depth }}] {{ $case->fullname }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <x-input.select-enum label='Depth Lv' name='depth' :selected="old('depth') ?? 1" :cases="App\Enums\DepartmentDepth::cases()" official=true/>
                <x-input.textarea label='メモ' name='memo' placeholder='フリーワード' :value="old('memo')" />
            </div>
            <x-button.submit mt=8 icon='add' label='新規作成'/>
        </form>
    </x-common.card>
    <x-button.back mt='6' />

    <x-slot:scripts>
        <script>
            function beforeSubmit() {
                if(window.confirm('所属部署を新規作成しますか？')) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
    </x-slot:scripts>

</x-app-layout>
