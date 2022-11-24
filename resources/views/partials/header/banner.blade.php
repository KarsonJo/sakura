<div class="headertop {{ $bg_filter }}">
    <figure id="center-figure" class="abs-stretch">
        <img id="centerbg" class="abs-stretch" src="{{ $bg_img }}">
        @if ($movie_enabled)
            <div id="video-container" class="abs-stretch">
                <video id="bgvideo" class="video" video-name="" src="" width="auto" preload="auto"></video>
                <div id="video-btn" class="loadvideo videolive"></div>
                <div id="video-add"></div>
                <div class="video-stu"></div>
            </div>
        @endif
        @if ($social_enabled)
            <div class="focusinfo">
                @if ($is_text_logo)
                    <h1 class="center-text glitch is-glitching Ubuntu-font" data-text="{{ $avatar_src }}">{{ $avatar_src }}</h1>
                @else
                    <div class="header-avatar">
                        <a href="{{ $siteUrl }}"><img src="{{ $avatar_src }}">
                        </a>
                    </div>
                @endif
                <div class="header-info">
                    <p>{!! $motto !!}</p>
                    <div class="top-social">
                        <li id="bg-pre">
                            <img class="flipx" src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/next-b.svg" />
                        </li>
                        @foreach ($socials as $social)
                            @if ($social['is_image'])
                                <li>
                                    <a href="#" title="{{ $social['title'] }}">
                                        <img src="{{ $social['icon_src'] }}" />
                                    </a>
                                    <div class="wechatInner">
                                        <img src="{{ $social['social_src'] }}" alt="WeChat">
                                    </div>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $social['social_src'] }}" target="_blank" title="{{ $social['title'] }}">
                                        <img src="{{ $social['icon_src'] }}" />
                                    </a>
                                </li>
                            @endif
                        @endforeach
                        <li id="bg-next">
                            <img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/next-b.svg" />
                        </li>
                    </div>
                </div>
            </div>
        @endif
    </figure>
</div>
