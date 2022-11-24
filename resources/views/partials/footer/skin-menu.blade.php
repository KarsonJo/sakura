<div class="pc-menu">
    <div class="skin-menu no-select">
        <ul class="menu-list">
            @foreach ($skins as $skin)
                <li id="{{ $skin['id'] }}" class="selected" data-src="{{ $skin['url'] }}">
                    @foreach ($skin['icons'] as $icon)
                        <i class="{{ $icon }}" aria-hidden="true"></i>
                    @endforeach
                </li>
            @endforeach
            {{-- <li id="white-bg" class="selected" data="none">
                <i class="fa fa-television" aria-hidden="true"></i>
            </li>
            <!--Default-->
            <li id="sakura-bg" data-src="https://cdn.jsdelivr.net/gh/spirit1431007/cdn@1.6/img/sakura.png">
                <i class="iconfont icon-sakura"></i>
            </li>
            <!--Sakura-->
            <li id="gribs-bg" data-src="https://cdn.jsdelivr.net/gh/spirit1431007/cdn@1.6/img/plaid2dbf8.jpg">
                <i class="fa fa-slack" aria-hidden="true"></i>
            </li>
            <!--Grids-->
            <li id="KAdots-bg" data-src="https://cdn.jsdelivr.net/gh/spirit1431007/cdn@1.6/img/star02.png">
                <i class="iconfont icon-dots"></i>
            </li>
            <!--Dots-->
            <li id="totem-bg" data-src="https://cdn.jsdelivr.net/gh/spirit1431007/cdn@1.6/img/kyotoanimation.png">
                <i class="fa fa-superpowers" aria-hidden="true"></i>
            </li>
            <!--Orange-->
            <li id="pixiv-bg" data-src="https://cdn.jsdelivr.net/gh/spirit1431007/cdn@1.6/img/dot_orange.gif">
                <i class="iconfont icon-pixiv"></i>
            </li>
            <!--Start-->
            <li id="bing-bg" data-src="https://api.mashiro.top/bing/">
                <i class="iconfont icon-bing"></i>
            </li>
            <!--Bing-->
            <li id="dark-bg" class="dark-toggle" data-src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.2/other-sites/api-index/images/me.png">
                <i class="fa fa-moon-o" aria-hidden="true"></i>
                <i class="fa fa-sun-o" aria-hidden="true"></i>
            </li>
            <!--Night--> --}}
        </ul>
        <ul class="font-family-controls">
            <li id="font-btn1" data-tag="serif">Serif</li>
            <li id="font-btn2" data-tag="sans-serif">Sans Serif</li>
        </ul>
    </div>
    <div class="changeSkin-gear no-select">
        <span id="open-skinMenu">
            <i class="iconfont icon-gear inline-block rotating"></i>切换主题 | SCHEME TOOL
        </span>
    </div>
</div>
<div class="mobile-menu">
    <div id="mobileGoTop" title="Go to top"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
    <div id="mobileDark" class="dark-toggle">
        @foreach ($skin['icons'] as $icon)
            <i class="{{ $icon }}" aria-hidden="true"></i>
        @endforeach
    </div>
</div>
