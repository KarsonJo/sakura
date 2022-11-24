<header class="site-header no-select" role="banner">
    <div class="site-top">
        <!-- .site-branding -->
        <div class="site-top-aside site-branding">
            <div class="site-title">
                @if ($siteLogo)
                    <a href="{{ $siteUrl }}">
                        <img src="{{ $brand_logo }}">
                    </a>
                @else
                    <span class="logolink serif">
                        <a href="{{ $siteUrl }}">
                            <span class="site-name">{!! $siteName !!}</span>
                        </a>
                    </span>
                @endif
            </div>
        </div>
        <!-- #site-navigation -->
        <div class="lower">
            @if ($has_nav)
                <nav>
                    {!! $nav_menu() !!}
                </nav>
            @endif
        </div>
        <!-- right menu -->
        <div class="site-top-aside">
            @if ($enable_search)
                <div class="searchbox">
                    <i class="iconfont search-btn iconsearch icon-search"></i>
                </div>
            @endif
        </div>
    </div>
</header><!-- #masthead -->
