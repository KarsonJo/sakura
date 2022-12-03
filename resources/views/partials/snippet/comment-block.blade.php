<li {{ comment_class('nova-comment') }} id="comment-{{ $cmt['id'] }}">
    <div class="content">
        {{-- header --}}
        <div class="main">
            {{-- avatar --}}
            <a class="profile" href="{!! $cmt['authorUrl'] !!}" target="_blank" rel="nofollow">
                <img class="lazyload" data-src="{!! $cmt['authorAvatar'] !!}" alt="{{ $cmt['authorName'] }}" src="{!! $cmt['authorAvatar'] !!}">
            </a>
            <div class="author">
                <a href="{!! $cmt['authorUrl'] !!}" target="_blank" rel="nofollow">
                    @if ($isPostAuthor)
                        <span class="tag" title="{{ __('Author', 'sakura') }}">{!! __('Blogger', 'sakura') !!}</span>
                    @endif
                    <span class="name">{{ $cmt['authorName'] }}</span>
                </a>
            </div>
            <div class="info">
                <time datetime="{{ $cmt['dateTime'] }}">
                    {!! $cmt['displayTime'] !!}
                </time>

                @if (of_get_option('open_useragent'))
                    <span class="useragent-info">
                        <img src="{{ $useragent['broweSrc'] }}">
                        <span class="ua-text">{{ $useragent['browerType'] }}</span>
                        <img src="{{ $useragent['osSrc'] }}">
                        <span class="ua-text">{{ $useragent['osType'] }}</span>
                    </span>
                @endif

                @if (of_get_option('open_location'))
                    <span>{!! __('Location', 'sakura') !!}':'{{ $cmt['ip'] }}</span>
                @endif

                @if ($cmt['editLink'] && !wp_is_mobile())
                    <span>
                        <a class="comment-edit-link" href="{{ $cmt['editLink'] }}">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> {!! __('Edit', 'mashiro') !!}
                        </a>
                    </span>
                    <span>·</span>
                    <a href="javascript:;" data-actionp="set_private" data-idp="{{ $cmt['id'] }}" id="sp">
                        {!! __('Private', 'sakura') !!}:
                        <span class="has_set_private">
                            @if ($isPrivate)
                                {!! __('Yes', 'sakura') !!} <i class="fa fa-lock" aria-hidden="true"></i>
                            @else
                                {!! __('No', 'sakura') !!} <i class="fa fa-unlock" aria-hidden="true"></i>
                            @endif
                        </span>
                    </a>
                @endif
            </div>
            @php(comment_reply_link(['depth' => $depth, 'max_depth' => get_option('thread_comments_depth')]))
        </div>
        {{-- content --}}
        <div class="body">
            @php(comment_text())
        </div>
    </div>
    {{-- caution: there is NO closing </li> --}}
