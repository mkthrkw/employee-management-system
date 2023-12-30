<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='developer_mode' text='Execute Select SQL'/>
    </x-slot:title>

    <x-common.card class='px-5 mx-5'>
        <form method='POST' action="{{ route('develop.sql.post') }}" onsubmit="return beforeSubmit()">
            @csrf
            <x-input.text label='実行キー' name='key' value="" addClasses='max-w-xs'/>
            <x-input.textarea label='SQL文' name='sql' placeholder='SELECT文以外は受け付けません' value="" />
            <x-input.radio label='出力タイプ' :cases="[['name'=>'table','value'=>'table'],['name'=>'csv','value'=>'csv']]" checked='table' />
            <x-button.submit mt=1 icon='edit' label='実行'/>
        </form>
    </x-common.card>

    @if(isset($msg))
        <x-common.card class='px-5 mx-5 mt-3'>
            <p class='text-xl'>エラーメッセージ</p>
            <div class="bg-base-100 border rounded-xl border-1 border-base-content/40 px-5 py-3">
                <p class="text-red-500">{{ $msg }}</p>
            </div>
        </x-common.card>

    @elseif (isset($data))
        <x-common.card class='px-5 mx-5 mt-3'>
            <p class='text-xl'>実行したSQL</p>
            <div class="bg-base-100 border rounded-xl border-1 border-base-content/40 px-5 py-3">
                <p>{{ $sql }}</p>
            </div>
        </x-common.card>

        @if(count($data) > 0)
            <x-common.card class='px-5 mx-5 mt-3'>
                <p class='text-xl'>実行結果 : {{ count($data) }} レコード表示</p>
                @if($display_type=='table')
                    <x-common.table>
                        <x-slot:thead>
                            <tr class="bg-base-100">
                                @foreach ($data[0] as $k => $v)
                                    <th>{{ $k }}</th>
                                @endforeach
                            </tr>
                        </x-slot:thead>
                        <x-slot:tbody>
                            @foreach ($data as $row)
                                <tr class="bg-base-100">
                                    @foreach ($row as $val)
                                        <td>{{ $val }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </x-slot:tbody>
                    </x-common.table>
                @else
                    <div class="bg-base-100 border rounded-xl border-1 border-base-content/40 px-5 py-3">
                        {{ implode(",",array_keys((array) $data[0])) }}
                        <br>
                        @foreach ($data as $row)
                            {{ implode(",",(array) $row) }}
                            <br>
                        @endforeach
                    </div>
                @endif
            </x-common.card>
        @else
            <x-common.card class='px-5 mx-5 mt-3'>
                <div class="boxInner pt10 pr10 pb10 pl10">
                    <p class="center f20">※データがありません</p>
                </div>
            </x-common.card>
        @endif
    @endif

    <x-button.back mt='6' />

    <x-slot:scripts>
        <script>
            function beforeSubmit() {
                if(window.confirm('SQL実行しますか？')) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
    </x-slot:scripts>

</x-app-layout>
