<div>

    <x-common.loading/>

    @if(session()->has('department_success'))
        <x-common.alert type='success' :message="session('department_success')" additionalClasses='mb-2' />
    @endif

    @foreach ($active_departments as $active_department)
        <div class='flex items-center w-full gap-2 mb-2'>
            <div class="px-2 text-sm rounded-full text-base-100 bg-base-content/50">D{{ $active_department['depth'] }}</div>
            <div class='py-2 px-4 w-full border border-1 border-base-content/40 bg-base-100 rounded-3xl text-sm'>{{ $active_department['fullname'] }}</div>
            <x-button.open-release-modal name='解除' icon='delete'
            wireClick="openReleaseModal({{ $active_department['id'] }},'{{ $active_department['name'] }}')" />
        </div>
    @endforeach

    <div class='flex justify-center w-full mt-4'>
        <x-button.open-catch-modal name='新規割り当て' icon='done_outline' wireClick="openCatchModal()" wide=true />
    </div>


    <!-- modal -->
    <x-modal.release id="departmentReleaseModal" wireModel="isReleaseModalOpen" wireClick="closeReleaseModal()">
        <x-slot name='header'>
            <h3 class="text-lg font-bold text-center">解除確認</h3>
        </x-slot>
        <p class="py-4 text-center">{{ $releaseName }} を所属解除してもよいですか？</p>
        <div class='flex justify-center'>
            <x-button.release text='所属解除' icon='delete' wireClick="release({{ $releaseId }})" />
        </div>
    </x-modal.release>

    <x-modal.catch id="departmentCatchModal" wireModel="isCatchModalOpen" wireClick="closeCatchModal()">
        <x-slot name='header'>
            <h3 class="text-lg font-bold text-center">所属部署の新規割り当て</h3>
        </x-slot>
        @if(count($select_departments)>0)
            <p class="py-4">割り当てる部署を選択してください</p>
            @foreach ($select_departments as $select_department)
                <div class='flex items-center w-full gap-2 mb-2'>
                    <span class="px-2 text-sm rounded-full text-base-100 bg-base-content/50">D{{ $select_department['depth'] }}</span>
                    <div class="w-full px-2 py-1 text-sm border rounded-full w-96 border-1 border-base-content/40">{{ $select_department['fullname'] }}</div>
                    <x-button.catch text='割り当て' wireClick="catch({{ $select_department['id'] }})" />
                </div>
            @endforeach
        @else
            <p class="py-4">割り当てる部署がありません</p>
        @endif
    </x-modal.catch>

</div>
