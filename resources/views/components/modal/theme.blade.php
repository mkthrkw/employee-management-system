<label for="theme-select-modal" tabindex="0" class="flex items-center px-3 py-1 transition-colors duration-300 transform rounded-lg hover:bg-primary hover:text-primary-content">
    <x-common.material-icon icon='palette' size='sm' type='outlined'/>
    <span class="hidden mx-1 text-sm font-medium md:inline opacity-90">Theme</span>
</label>

<input type="checkbox" id="theme-select-modal" class="modal-toggle" />
<label for="theme-select-modal" class="cursor-pointer modal">
    <div class="relative bg-gray-300 modal-box rounded-2xl">
        <div class="text-base-content top-px max-h-96 h-[70vh] overflow-y-auto">
            <div class="grid grid-cols-1 gap-3 p-3" tabindex="0">
                @foreach (["light", "dark", "cupcake", "bumblebee", "emerald", "corporate", "synthwave", "retro", "cyberpunk", "valentine", "halloween", "garden", "forest", "aqua", "lofi", "pastel", "fantasy", "wireframe", "black", "luxury", "dracula", "cmyk", "autumn", "business", "acid", "lemonade", "night", "coffee", "winter"] as $theme_name)
                    <button class="overflow-hidden text-left rounded-lg outline-base-content" data-set-theme="{{ $theme_name }}" data-act-class="[&_svg]:visible">
                        <div data-theme="{{ $theme_name }}" class="w-full font-sans cursor-pointer bg-base-100 text-base-content">
                            <div class="grid grid-cols-5 grid-rows-3">
                                <div class="flex items-center col-span-5 row-span-3 row-start-1 gap-2 px-4 py-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" class="invisible w-3 h-3">
                                        <path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"></path>
                                    </svg>
                                    <div class="flex-grow text-sm font-bold">{{ $theme_name }}</div>
                                    <div class="flex flex-wrap flex-shrink-0 h-full gap-1">
                                        <div class="w-2 rounded bg-primary"></div>
                                        <div class="w-2 rounded bg-secondary"></div>
                                        <div class="w-2 rounded bg-accent"></div>
                                        <div class="w-2 rounded bg-neutral"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </button>
                @endforeach
            </div>
        </div>
    </div>
</label>
