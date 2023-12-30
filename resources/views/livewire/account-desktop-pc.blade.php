<div>

    <x-common.loading/>

    @if(session()->has('desktop_pc_success'))
        <x-common.alert type='success' :message="session('desktop_pc_success')" additionalClasses='mb-2' />
    @endif

    @foreach ($lent_desktop_pcs as $lent_desktop_pc)
        <div class='flex items-center w-full gap-2 mb-2'>
            <x-common.collapse title="{{ $lent_desktop_pc->name }}" additionalClasses='peer'>
                <x-common.textline label='CPU' :value="$lent_desktop_pc->cpu"/>
                <x-common.textline label='memory' :value="$lent_desktop_pc->memory"/>
                <x-common.textline label='HDD' :value="$lent_desktop_pc->hdd"/>
                <x-common.textline label='VPN-ID' :value="$lent_desktop_pc->vpn_connection_id"/>
                <x-common.textline label='キャスナビ' :value="$lent_desktop_pc->casting_navi->label()"/>
                <x-common.textline label='保管支店' :value="$lent_desktop_pc->branch->label()"/>
                <x-common.textline label='メモ' :value="$lent_desktop_pc->memo"/>
            </x-common.collapse>
            <x-button.open-release-modal name='返却' icon='rotate_right' additionalClasses='peer-focus:scale-0'
            wireClick="openReleaseModal({{ $lent_desktop_pc->id }},'{{ $lent_desktop_pc->name }}')" />
        </div>
    @endforeach

    <div class='flex justify-center w-full mt-4'>
        <x-button.open-catch-modal name='新規レンタル' icon='done_outline' wireClick="openCatchModal()" />
    </div>


    <!-- modal -->
    <x-modal.release id="desktopPcReleaseModal" wireModel="isReleaseModalOpen" wireClick="closeReleaseModal()">
        <x-slot name='header'>
            <h3 class="text-lg font-bold text-center">返却確認</h3>
        </x-slot>
        <p class="py-4">{{ $releaseName }} を返却しますか？</p>
        <div class='flex justify-center gap-28'>
            <x-button.release-broken text='故障' icon='build' wireClick="releaseBroken({{ $releaseId }})" />
            <x-button.release text='返却' icon='rotate_right' wireClick="release({{ $releaseId }})" />
        </div>
    </x-modal.release>

    <x-modal.catch id="desktopPcCatchModal" wireModel="isCatchModalOpen" wireClick="closeCatchModal()">
        <x-slot name='header'>
            <h3 class="text-lg font-bold text-center">デスクトップPCの新規レンタル</h3>
        </x-slot>
        @if(count($stock_desktop_pcs)>0)
            <p class="py-4">レンタルするデスクトップPCを選択してください</p>
            @foreach ($stock_desktop_pcs as $stock_desktop_pc)
                <div class='flex w-full gap-2 mb-4'>
                    <x-common.collapse title="{{ $stock_desktop_pc->name }}" additionalClasses='peer border border-base-300 border-2'>
                        <x-common.textline label='CPU' :value="$stock_desktop_pc->cpu"/>
                            <x-common.textline label='memory' :value="$stock_desktop_pc->memory"/>
                            <x-common.textline label='HDD' :value="$stock_desktop_pc->hdd"/>
                            <x-common.textline label='VPN-ID' :value="$stock_desktop_pc->vpn_connection_id"/>
                            <x-common.textline label='キャスナビ' :value="$stock_desktop_pc->casting_navi->label()"/>
                            <x-common.textline label='保管支店' :value="$stock_desktop_pc->branch->label()"/>
                            <x-common.textline label='メモ' :value="$stock_desktop_pc->memo"/>
                    </x-common.collapse>
                    <x-button.catch text='レンタル' wireClick="catch({{ $stock_desktop_pc->id }})" />
                </div>
            @endforeach
        @else
            <p class="py-4">レンタルできるデスクトップPCがありません</p>
        @endif
    </x-modal.catch>

</div>
