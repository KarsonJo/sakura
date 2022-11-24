<article class="post post-list-thumb {{ $align_class }}" itemscope="" itemtype="http://schema.org/BlogPosting">
    <div class="post-thumb">
        <a href="{{ $link }}">
            <img class="lazyload pattern-attachment-img" data-src="{{ $cover }}"></a>
    </div><!-- thumbnail-->
    <div class="post-content-wrap">
        <div class="post-content">
            <div class="post-date">
                <i class="iconfont icon-time"></i>{!! $post_time !!}
                @if (is_sticky())
                    <i class="iconfont hotpost icon-hot"></i>
                @endif
            </div>

            <a href="{{ $link }}" class="post-title">
                <h3>{!! $title !!}</h3>
            </a>
            <div class="post-meta">
                <span><i class="iconfont icon-attention"></i>{!! $heat !!}</span>
                <span class="comments-number"><i class="iconfont icon-mark"></i>{{ $echo_comment_link() }}</span>
                <span><i class="iconfont icon-file"></i><a href="{{ $category_link }}">{!! $category_name !!}</a></span>
            </div>
            <div class="float-content">
                <p>{!! $excerpt !!}</p>
                <div class="post-bottom">
                    <a href="{{ $link }}" class="button-normal"><i class="iconfont icon-caidan"></i></a>
                </div>
            </div>
        </div>
    </div>
</article>