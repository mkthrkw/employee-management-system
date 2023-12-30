<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='emoji_people' text="Show : {{ $account->name }}"/>
    </x-slot:title>

    <div class='flex'>
        <div class='flex-1'>
            <x-common.card class='m-3' tone='light'>
                <div class='justify-center card-title'>アカウント：詳細</div>
                <x-common.textline label='ステータス' :value="$account->status->label()" />
                <x-common.textline label='社員番号' :value="$account->employee_number" />
                <x-common.textline label='名前' :value="$account->name" />
                <x-common.textline label='フリガナ' :value="$account->name_kana" />
                <x-common.textline label='役職' :value="$account->position->label_official()" />
                <x-common.textline label='メールアドレス' :value="$account->email" />
                <x-common.textline label='BCルート' :value="$account->bc_route()->first()->name ?? '設定なし'" />
                <x-common.textline label='Windowsユーザー名' :value="$account->windows_username" />
                <x-common.textline label='chatwork_aid' :value="$account->chatwork_aid" />
                <x-common.textline label='権限' :value="$account->role->label()" />
                <x-common.textline label='入社日' :value="$account->joining_date" />
                <x-common.textline label='退社日' :value="$account->leaving_date" />
                <x-common.textline label='メモ' :value="$account->memo"/>
                <x-common.textline label='作成日時' :value="$account->created_at"/>
                <x-common.textline label='更新日時' :value="$account->updated_at"/>
            </x-common.card>
        </div>
        <div class='flex-1'>
            <x-common.card class='m-3' tone='light'>
                <div class='justify-center card-title'>所属部署</div>
                @foreach ($account->departments()->get() as $department)
                    <div class='flex items-center w-full gap-2 mb-2'>
                        <div class='px-2 text-sm rounded-full text-base-100 bg-base-content/50'>D{{ $department->depth->value }}</div>
                        <x-common.collapse title="{{ trim($department->get_fullname($department),'/') }}" size='md'>
                            @php $parent = $department->get_parent($department); @endphp
                            <x-common.textline label='紐づけ先' value="{{ ($parent) ? 'Depth'.$parent->depth->value.' : '.$parent->name : '' }}"/>
                            <x-common.textline label='メモ' :value="$department->memo"/>
                        </x-common.collapse>
                    </div>
                @endforeach
            </x-common.card>
            <x-common.card class='m-3' tone='light'>
                <div class='justify-center card-title'>メーリングリスト</div>
                @foreach ($account->mailing_lists()->get() as $mailing_list)
                    <x-common.collapse title="{{ $mailing_list->name }}" size='md'>
                        <x-common.textline label='アドレス' :value="$mailing_list->address"/>
                        <x-common.textline label='送信権限' :value="($mailing_list->ext_send_permission)?'あり':'なし'"/>
                        <x-common.textline label='BCルート' :value="$mailing_list->bc_route_id"/>
                        <x-common.textline label='メモ' :value="$mailing_list->memo"/>
                    </x-common.collapse>
                @endforeach
            </x-common.card>
            <x-common.card class='m-3' tone='light'>
                <div class='justify-center card-title'>デスクトップPC</div>
                @foreach ($account->desktop_pcs()->get() as $desktop_pc)
                    <x-common.collapse title="{{ $desktop_pc->name }}" size='md'>
                        <x-common.textline label='CPU' :value="$desktop_pc->cpu"/>
                        <x-common.textline label='メモリ' :value="$desktop_pc->memory.'GB'"/>
                        <x-common.textline label='HDD' :value="$desktop_pc->hdd"/>
                        <x-common.textline label='VPN接続ID' :value="$desktop_pc->vpn_connection_id"/>
                        <x-common.textline label='キャスナビ' :value="$desktop_pc->casting_navi->label()"/>
                        <x-common.textline label='保管支店' :value="$desktop_pc->branch->label()"/>
                        <x-common.textline label='メモ' :value="$desktop_pc->memo"/>
                    </x-common.collapse>
                @endforeach
            </x-common.card>
            <x-common.card class='m-3' tone='light'>
                <div class='justify-center card-title'>ノートPC</div>
                @foreach ($account->laptop_pcs()->get() as $laptop_pc)
                    <x-common.collapse title="{{ $laptop_pc->name }}" size='md'>
                        <x-common.textline label='デバイス名' :value="$laptop_pc->device_name"/>
                        <x-common.textline label='CPU' :value="$laptop_pc->cpu"/>
                        <x-common.textline label='メモリ' :value="$laptop_pc->memory"/>
                        <x-common.textline label='保管支店' :value="$laptop_pc->branch->label()"/>
                        <x-common.textline label='メモ' :value="$laptop_pc->memo"/>
                    </x-common.collapse>
                @endforeach
            </x-common.card>
            <x-common.card class='m-3' tone='light'>
                <div class='justify-center card-title'>社用携帯</div>
                @foreach ($account->mobile_phones()->get() as $mobile_phone)
                    <x-common.collapse title="{{ $mobile_phone->phone_number }}" size='md'>
                        <x-common.textline label='機種' :value="$mobile_phone->model"/>
                        <x-common.textline label='管理区分' :value="$mobile_phone->category"/>
                        <x-common.textline label='プロバイダー' :value="$mobile_phone->provider"/>
                        <x-common.textline label='保管支店' :value="$mobile_phone->branch->label()"/>
                        <x-common.textline label='メモ' :value="$mobile_phone->memo"/>
                    </x-common.collapse>
                @endforeach
            </x-common.card>
            @php $bc_authroutes = $account->bc_authroutes()->get(); @endphp
            @if(count($bc_authroutes)>0)
                <x-common.card class='m-3' tone='light'>
                    <div class='justify-center card-title'>BCルートの承認者設定</div>
                    @foreach ($bc_authroutes as $bc_authroute)
                        <x-common.collapse title="{{ $bc_authroute->name }}" size='md'>
                            <x-common.textline label='区分' :value="$bc_authroute->display_memo1"/>
                            <x-common.textline label='MGR・SMGR' :value="$bc_authroute->display_memo2"/>
                            <x-common.textline label='用途' :value="$bc_authroute->display_memo3"/>
                            <x-common.textline label='メモ' :value="$bc_authroute->memo"/>
                        </x-common.collapse>
                    @endforeach
                </x-common.card>
            @endif
        </div>
    </div>
    <x-button.back mt='6' />

</x-app-layout>
