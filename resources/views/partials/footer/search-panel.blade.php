<div class="search-panel" method="get" action="@php(home_url())" role="search">
    @if (of_get_option('live_search'))
    @php(do_shortcode('[wpdreams_ajaxsearchlite]'))
    @else
    <form class="search-form hover-glow">
        <i class="iconfont icon-search"></i>
        <input class="text-input" type="search" name="s" placeholder="{{ __('Want to find something?', 'sakura') }}" required>
    </form>
    @endif
    <div class="search-close"></div>
</div>
