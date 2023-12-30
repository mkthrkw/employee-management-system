<div>

    <x-common.loading/>

    @if(session()->has('bc_authorizer_success'))
        <x-common.alert type='success' :message="session('bc_authorizer_success')" additionalClasses='mb-2' />
    @endif

    @foreach ($active_bc_authorizers as $active_bc_authorizer)
        <div class='flex items-center w-full gap-2 mb-2'>
            <div class='py-2 px-4 w-full border border-1 border-base-content/40 bg-base-100 rounded-3xl text-sm'>
                {{ $active_bc_authorizer->employee_number }} : {{ $active_bc_authorizer->name }}
            </div>
            <x-button.open-release-modal name='解除' icon='delete'
            wireClick="openReleaseModal({{ $active_mailing_list->id }},'{{ $active_mailing_list->name }}')" />
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
        <p class="py-4 text-center">{{ $releaseName }} を承認者から割当解除してもよいですか？</p>
        <div class='flex justify-center'>
            <x-button.release text='割当解除' icon='delete' wireClick="release({{ $releaseId }})" />
        </div>
    </x-modal.release>

    <x-modal.catch id="mailingListCatchModal" wireModel="isCatchModalOpen" wireClick="closeCatchModal()">
        <x-slot name='header'>
            <h3 class="text-lg font-bold text-center">承認者の新規割り当て</h3>
        </x-slot>
        @if(count($select_bc_authorizers)>0)
            <p class="py-4">割り当てる承認者を選択してください</p>
            @foreach ($select_bc_authorizers as $select_bc_authorizer)
                <div class='flex w-full gap-2 mb-2'>
                    <div class='py-2 px-4 w-full border border-1 border-base-content/40 bg-base-100 rounded-3xl text-sm'>
                        {{ $select_bc_authorizer->employee_number }} : {{ $select_bc_authorizer->name }}
                    </div>
                    <x-button.catch text='割り当て' wireClick="catch({{ $select_bc_authorizer->id }})" />
                </div>
            @endforeach
        @else
            <p class="py-4">割り当てできる承認者がいません</p>
        @endif
    </x-modal.catch>

</div>
