<div id="pc-menu" class="-sm:hidden fixed right-4 bottom-0 z-50 pointer-events-none [&>*]:pointer-events-auto">
    {{-- skin menu content --}}
    <div class="p-3 bg-bg-primary relative mb-3 rounded-md
                scale-x-0 transition-transform duration-500 select-none
                after:bubble-bottom after:border-[12px] after:border-t-bg-primary 
                after:left-1/2 after:-translate-x-1/2 shadow-drop
                [&_li.select]:bg-theme-primary
                [&:not(.show)]:collapse [&.show]:scale-x-100">
        <ul class="grid grid-cols-4">
            {{-- skins --}}
            @foreach ($skins as $skin)
                <li id="{{ $skin['id'] }}" data-src="{{ $skin['url'] }}" class="button-round m-2 btn-contrast">
                    @foreach ($skin['icons'] as $icon)
                        <i class="{{ $icon }}" aria-hidden="true"></i>
                    @endforeach
                </li>
            @endforeach
            {{-- dark toggle --}}
            <li id="dark-bg" class="button-round m-2 btn-contrast dark-toggle">
                <i class="fa-light fa-moon" aria-hidden="true"></i>
                <i class="fa-light fa-sun" aria-hidden="true"></i>
            </li>
        </ul>
        {{-- font style --}}
        <ul class="font-family-controls flex gap-2.5 mx-2.5 my-3">
            <li id="font-btn1" class="button-basic rounded-md btn-contrast flex-1 h-11 p-1.5" data-tag="serif">Serif</li>
            <li id="font-btn2" class="button-basic rounded-md btn-contrast flex-1 h-11 p-1.5" data-tag="sans-serif">Sans Serif</li>
        </ul>
    </div>
    {{-- skin menu toggle --}}
    <div class="relative bg-bg-primary px-2 py-3 rounded-t-xl select-none
                shadow-inner shadow-theme-primary cursor-pointer
                transition-transform duration-500 translate-y-full scroll:translate-y-0">
        <span id="open-skinMenu">
            <i class="fa-light fa-gear animate-spin-s mx-2"></i>切换主题 | SCHEME TOOL
        </span>
    </div>
</div>
<div id="mb-menu" class="sm:hidden fixed bottom-0 right-0 z-50 flex flex-col m-3 gap-3">
    <div id="mobileGoTop" class="p-4 rounded-xl shadow-lg button-basic btn-theme-primary" title="Go to top">
        <i class="fa fa-chevron-up" aria-hidden="true"></i>
    </div>
    <div id="mobileDark" class="p-4 rounded-xl shadow-lg button-basic btn-theme-primary dark-toggle">
        <i class="fa-light fa-moon" aria-hidden="true"></i>
        <i class="fa-light fa-sun" aria-hidden="true"></i>
    </div>
</div>
