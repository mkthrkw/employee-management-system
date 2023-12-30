<div>

    <x-common.loading/>

    @if(session()->has('mailing_list_success'))
        <x-common.alert type='success' :message="session('mailing_list_success')" additionalClasses='mb-2' />
    @endif

    @foreach ($active_mailing_lists as $active_mailing_list)
        <div class='flex items-center w-full gap-2 mb-2'>
            <x-common.collapse title="{{ $active_mailing_list->name }}" additionalClasses='peer'>
                <x-common.textline label='メールアドレス' :value="$active_mailing_list->address"/>
                <x-common.textline label='メモ' :value="$active_mailing_list->memo"/>
            </x-common.collapse>
            <x-button.open-release-modal name='解除' icon='delete' additionalClasses='peer-focus:scale-0'
            wireClick="openReleaseModal({{ $active_mailing_list->id }},'{{ $active_mailing_list->name }}({{ $active_mailing_list->address }})')" />
        </div>
    @endforeach

    <div class='flex justify-center w-full mt-4'>
        <x-button.open-catch-modal name='新規割り当て' icon='done_outline' wireClick="openCatchModal()" />
    </div>


    <!-- modal -->
    <x-modal.release id="mailingListReleaseModal" wireModel="isReleaseModalOpen" wireClick="closeReleaseModal()">
        <x-slot name='header'>
            <h3 class="text-lg font-bold text-center">解除確認</h3>
        </x-slot>
        <p class="py-4 text-center">{{ $releaseName }} を割当解除してもよいですか？</p>
        <div class='flex justify-center'>
            <x-button.release text='割当解除' icon='delete' wireClick="release({{ $releaseId }})" />
        </div>
    </x-modal.release>

    <x-modal.catch id="mailingListCatchModal" wireModel="isCatchModalOpen" wireClick="closeCatchModal()">
        <x-slot name='header'>
            <h3 class="text-lg font-bold text-center">メーリングリストの新規割り当て</h3>
        </x-slot>
        @if(count($select_mailing_lists)>0)
            <p class="py-4">割り当てるメーリングリストを選択してください</p>
            @foreach ($select_mailing_lists as $select_mailing_list)
                <div class='flex w-full gap-2 mb-2'>
                    <x-common.collapse title="{{ $select_mailing_list->name }}" additionalClasses='peer border border-base-300 border-2'>
                        <x-common.textline label='メールアドレス' :value="$select_mailing_list->address"/>
                        <x-common.textline label='メモ' :value="$select_mailing_list->memo"/>
                    </x-common.collapse>
                    <x-button.catch text='割り当て' wireClick="catch({{ $select_mailing_list->id }})" />
                </div>
            @endforeach
        @else
            <p class="py-4">割り当て出来るメーリングリストがありません</p>
        @endif
    </x-modal.catch>

</div>
