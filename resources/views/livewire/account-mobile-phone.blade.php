<div>

    <x-common.loading/>

    @if(session()->has('mobile_phone_success'))
        <x-common.alert type='success' :message="session('mobile_phone_success')" additionalClasses='mb-2' />
    @endif

    @foreach ($lent_mobile_phones as $lent_mobile_phone)
        <div class='flex items-center w-full gap-2 mb-2'>
            <x-common.collapse title="{{ $lent_mobile_phone->phone_number }}" additionalClasses='peer'>
                <x-common.textline label='機種' :value="$lent_mobile_phone->model"/>
                <x-common.textline label='管理区分' :value="$lent_mobile_phone->category"/>
                <x-common.textline label='プロバイダー' :value="$lent_mobile_phone->provider"/>
                <x-common.textline label='保管支店' :value="$lent_mobile_phone->branch->label()"/>
                <x-common.textline label='メモ' :value="$lent_mobile_phone->memo"/>
            </x-common.collapse>
            <x-button.open-release-modal name='返却' icon='rotate_right' additionalClasses='peer-focus:scale-0'
            wireClick="openReleaseModal({{ $lent_mobile_phone->id }},'{{ $lent_mobile_phone->name }}')" />
        </div>
    @endforeach

    <div class='flex justify-center w-full mt-4'>
        <x-button.open-catch-modal name='新規レンタル' icon='done_outline' wireClick="openCatchModal()" />
    </div>


    <!-- modal -->
    <x-modal.release id="mobilePhoneReleaseModal" wireModel="isReleaseModalOpen" wireClick="closeReleaseModal()">
        <x-slot name='header'>
            <h3 class="text-lg font-bold text-center">返却確認</h3>
        </x-slot>
        <p class="py-4">{{ $releaseName }} を返却しますか？</p>
        <div class='flex justify-center gap-28'>
            <x-button.release-broken text='故障' icon='build' wireClick="releaseBroken({{ $releaseId }})" />
            <x-button.release text='返却' icon='rotate_right' wireClick="release({{ $releaseId }})" />
        </div>
    </x-modal.release>

    <x-modal.catch id="mobilePhoneCatchModal" wireModel="isCatchModalOpen" wireClick="closeCatchModal()">
        <x-slot name='header'>
            <h3 class="text-lg font-bold text-center">社用携帯の新規レンタル</h3>
        </x-slot>
        @if(count($stock_mobile_phones)>0)
            <p class="py-4">レンタルする社用携帯を選択してください</p>
            @foreach ($stock_mobile_phones as $stock_mobile_phone)
                <div class='flex w-full gap-2 mb-2'>
                    <x-common.collapse title="{{ $stock_mobile_phone->phone_number }}" additionalClasses='peer border border-base-300 border-2'>
                        <x-common.textline label='機種' :value="$stock_mobile_phone->model"/>
                        <x-common.textline label='管理区分' :value="$stock_mobile_phone->category"/>
                        <x-common.textline label='プロバイダー' :value="$stock_mobile_phone->provider"/>
                        <x-common.textline label='保管支店' :value="$stock_mobile_phone->branch->label()"/>
                        <x-common.textline label='メモ' :value="$stock_mobile_phone->memo"/>
                    </x-common.collapse>
                    <x-button.catch text='レンタル' wireClick="catch({{ $stock_mobile_phone->id }})" />
                </div>
            @endforeach
        @else
            <p class="py-4">レンタルできる社用携帯がありません</p>
        @endif
    </x-modal.catch>

</div>
