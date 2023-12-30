<x-app-layout>

    <x-slot:title>
        <x-common.page-title icon='account_tree' text='Organization chart'/>
    </x-slot:title>

    <x-common.card class='mx-5'>
        <div class="flex-col">
            @if (count($chart) > 0)
                @include('pages.department.tree',['children' => $chart])
            @endif
        </div>
    </x-common.card>

    <x-button.back mt='6' />

</x-app-layout>
