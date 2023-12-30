<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='business' text="Edit : {{ $department->name }}"/>
    </x-slot:title>

    <x-common.card class='max-w-2xl px-5 mx-auto mt-3'>
        <form method='POST' action="{{ route('department.update',$department) }}" onsubmit="return beforeSubmit('上書き更新しますか？')">
            @method('PATCH')
            @csrf
            <div class='justify-center card-title'>所属部署：編集</div>
            <x-input.text label='部署名' name='name' :value="old('name') ?? $department->name" />
            <div class='w-full mb-3 form-control'>
                <label class='py-0 mb-1 label'>
                    <span class='font-medium px-7 rounded-xl bg-base-content/50 label-text text-base-100'>紐づけ先（親）</span>
                </label>
                <select name='parent_id' class="w-full py-0 border border-1 select select-bordered select-sm border-base-content/40 rounded-xl">
                    @php $selected = old('parent_id') ?? $department->parent_id; @endphp
                    @foreach ($select_departments as $case)
                        <option value='{{ $case->id }}' @if($case->id == $selected) selected @endif>
                            [Depth{{ $case->depth }}] {{ $case->fullname }}
                        </option>
                    @endforeach
                </select>
            </div>
            <x-input.text label='Depth Lv' name='depth' :value="old('depth') ?? $department->depth" />
            <x-input.textarea label='メモ' name='memo' placeholder='フリーワード' :value="old('memo') ?? $department->memo" />
            <x-button.submit mt=8 icon='edit' label='更新'/>
        </form>
    </x-common.card>
    <div>
        @can('gate','gate8')
        <x-button.delete mt='6' action="{{ route('department.destroy',$department) }}" onsubmit="return beforeSubmit('この所属部署を削除しますか？')"/>
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
