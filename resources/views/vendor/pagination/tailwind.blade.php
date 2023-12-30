@php
    $common = 'relative inline-flex items-center transition duration-150 ease-in-out btn btn-sm border border-base-100 border-1 join-item rounded-2xl';
    $enabled = 'bg-base-200 hover:bg-base-300 hover:text-base-100 text-base-content cursor-pointer';
    $disabled = 'btn-disabled bg-base-100 text-base-100';
@endphp

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center">

        <!-- for mobile -->
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <div class="{{ $common.' '.$disabled }}">
                    {!! __('pagination.previous') !!}
                </div>
            @else
                <a href="{{ url()->full().$paginator->currentPage() }}" class="{{ $common.' '.$enabled }}">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="{{ $common.' '.$enabled }}">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <div class="{{ $common.' '.$disabled }}">
                    {!! __('pagination.next') !!}
                </div>
            @endif
        </div>

        <!-- for PC -->
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <div class="relative z-0 inline-flex rounded-md shadow-sm join">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <div aria-disabled="true" aria-label="{{ __('pagination.previous') }}" class="{{ $common.' '.$disabled }}" aria-hidden="true">
                            <x-common.material-icon size='sm' type='filed' icon='first_page' />
                        </div>
                    @else
                        <a href="{{ $paginator->url(1) }}" rel="prev" class="{{ $common.' '.$enabled }}" aria-label="{{ __('pagination.previous') }}">
                            <x-common.material-icon size='sm' type='filed' icon='first_page' />
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <div aria-disabled="true" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium leading-5 text-gray-700 bg-white border border-gray-300 cursor-default btn-sm">
                                {{ $element }}
                            </div>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <div aria-current="page" class="{{ $common.' btn-disabled bg-primary text-base-100' }}">
                                        {{ $page }}
                                    </div>
                                @else
                                    <a href="{{ $url }}" class="{{ $common.' '.$enabled }}" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->url($paginator->lastPage()) }}" rel="next" class="{{ $common.' '.$enabled }}" aria-label="{{ __('pagination.next') }}">
                            <x-common.material-icon size='sm' type='filed' icon='last_page' />
                        </a>
                    @else
                        <div aria-disabled="true" aria-label="{{ __('pagination.next') }}" class="{{ $common.' '.$disabled }}" aria-hidden="true">
                            <x-common.material-icon size='sm' type='filed' icon='last_page' />
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>
@endif
