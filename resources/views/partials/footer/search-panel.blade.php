<div class="search-panel [&:not(.show)]:hidden overflow-hidden z-[99] fixed inset-0 
            bg-bg-primary bg-opacity-60 backdrop-blur-sm flex animate-elastic-f">
    @if (of_get_option('live_search'))
    {!! do_shortcode('[wpdreams_ajaxsearchlite]') !!}
    @else
    <div class="!m-auto">
    <form method="get" action="@php(home_url())" role="search"
    class ="rounded-full hover:shadow-glow hover:shadow-theme-primary
                border-2 border-fg-secondary bg-bg-primary
                flex gap-3 text-2xl py-3 px-6 items-center">
                <i class="fa-light fa-magnifying-glass"></i>
        <input class="flex-1 focus:outline-none" type="search" name="s" placeholder="{{ __('Want to find something?', 'sakura') }}" required>
    </form>
</div>
    @endif
    <i class="search-close fa-light fa-xmark absolute top-5 right-4 cursor-pointer text-5xl
            text-fg-primary hover:text-theme-primary"></i>
</div>
