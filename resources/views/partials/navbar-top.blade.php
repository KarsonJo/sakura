<header class="px-5 flex items-stretch w-full h-20 z-30 transition duration-500 
                hover,scroll:bg-bg-trans-d hover,scroll:shadow-drop scroll:fixed 
                [&_.lower]:hover,scroll:[&:not(:only-child)]:animate-peek-in-l 
                [&_.lower]:hover,scroll:[&:not(:only-child)]:opacity-100
                [&_.lower]:[&:not(:only-child)]:opacity-0
                select-none" role="banner">
    {{-- brand --}}
    <div class="basis-40 flex justify-center items-center animate-peek-in-l">
        @if ($siteLogo)
            <a href="{{ $siteUrl }}">
                <img src="{{ $brand_logo }}">
            </a>
        @else
            <span class="w-full h-4/5">
                <a class="w-full h-full flex justify-center items-center text-theme-primary text-xl font-extrabold" href="{{ $siteUrl }}">
                    <span class="site-name">{!! $siteName !!}</span>
                </a>
            </span>
        @endif
    </div>
    {{-- navigation --}}
    <div class="lower grow">
        @if ($has_nav)
            <nav class="h-full
                        [&_ul]:flex [&_ul]:justify-center [&_ul]:items-center [&_ul]:gap-5 [&_ul]:h-full
                        [&_li]:relative [&_li]:h-full [&_li]:flex [&_li]:items-center
                        [&_li]:transition-colors [&_li]:duration-300 [&_li]:text-fg-secondary
                        [&_li]:after:h-1.5 [&_li]:after:absolute [&_li]:after:bg-theme-primary
                        [&_li]:after:w-full [&_li]:after:max-w-0 [&_li]:after:bottom-0 
                        [&_li]:after:transition-[max-width] [&_li]:after:duration-300 [&_li]:after:ease-out
                        [&_li:hover]:text-theme-primary
                        [&_li:hover]:after:max-w-full">
                {!! $nav_menu() !!}
            </nav>
        @endif
    </div>
    {{-- right menu --}}
    <div class="basis-40 flex justify-end items-center gap-5 h-9 self-center
                [&_i]:text-shadow text-3xl [&>*]:hover:cursor-pointer hover:[&>*]:text-theme-primary">
        @if ($enable_search)
            <div class="searchbox">
                <i class="fa-light fa-magnifying-glass"></i>
            </div>
        @endif
        @include('partials.header.user-menu')
    </div>
</header>
