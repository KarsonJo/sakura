@php(comments_template('', true))

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="site-info" theme-info="{{ $themeVersion }}">
        <p>{!! of_get_option('footer_info', '') !!}</p>
        <div class="footer-device Ubuntu-font">
            <p>
                <span>
                    Theme <a href="https://2heng.xin/theme-sakura/" target="_blank">Nova</a> <i class="iconfont icon-sakura rotating"></i> by <a href="https://www.karsonjo.com/" target="_blank">KarsonJo</a>
                </span>
            </p>
        </div>
    </div><!-- .site-info -->
</footer><!-- #colophon -->

<div class="openNav no-select">
    <div class="iconflat no-select">
        <div class="icon"></div>
    </div>
    <!-- karson_obsolete -->
    <!-- why the hell would this thing in footer? -->
    <div class="site-branding">
        <div class="site-title-mb"><a href="{{ $siteUrl }}">
                @if ($siteLogo)
                    <img src="{{ $siteLogo }}">@else{{ $siteName }}
                @endif
            </a>
        </div>
    </div>
</div><!-- m-nav-bar -->
@include('partials.footer.skin-menu')
@include('partials.footer.search-panel')

@php(wp_footer())

@if (of_get_option('sakura_widget'))
    <aside id="secondary" class="widget-area" role="complementary" style="left: -400px;">
        <div class="heading">{{ __('Widgets') }}</div>
        <div class="sakura_widget">
            @if (function_exists('dynamic_sidebar'))
                @php(dynamic_sidebar('sakura_widget'))
            @endif
        </div>
        <div class="show-hide-wrap">
            <button class="show-hide">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 32 32">
                    <path d="M22 16l-10.105-10.6-1.895 1.987 8.211 8.613-8.211 8.612 1.895 1.988 8.211-8.613z"></path>
                </svg></button>
        </div>
    </aside>
@endif

@if (of_get_option('aplayer_server'))
    <div id="aplayer-float" style="z-index: 100;" class="aplayer" data-id="{{ of_get_option('aplayer_playlistid', '') }}" data-server="{{ of_get_option('aplayer_server') }}" data-type="playlist" data-fixed="true" data-theme="orange">
    </div>
@endif
