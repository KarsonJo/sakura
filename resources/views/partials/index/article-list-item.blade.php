{{-- card --}}
<article class="group m-5 bg-theme-primary bg-opacity-5 transition-colors hover:bg-opacity-20
                rounded-lg overflow-hidden animate-peek-in-l h-80 shadow-xl {{ $align_class }}
                flex flex-row-reverse [&.alternate:nth-child(2n)]:flex-row [&.reverse]:flex-row
                [&.alternate:nth-child(2n)]:text-right [&.reverse]:text-right
                -sm:!flex-col -sm:!h-auto" itemscope="" itemtype="http://schema.org/BlogPosting">
    {{-- psot image --}}
    <a class="basis-1/2" href="{{ $link }}">
        <img class="lazyload img-placeholder h-full w-full object-cover aspect-video
                    hover:scale-110 transition-transform duration-500" data-src="{{ $cover }}" {{--src="{{ $cover }}"--}}>
    </a>
    {{-- post info --}}
    <div class="flex flex-col
                py-5 px-10 basis-0 grow text-fg-tertiary text-xs 
                [&_a]:transition-colors hover:[&_a]:text-theme-primary [&_i]:mx-1">
        <div>
            <i class="fa-light fa-clock"></i>{!! $post_time !!}
            @if (is_sticky())
                <i class="fa-light fa-fire"></i>
            @endif
        </div>
        {{-- title --}}
        <a href="{{ $link }}" class="my-4 -webkit-ellipsis-2 text-lg text-fg-primary font-bold">
            {!! $title !!}
        </a>
        {{-- tags --}}
        <div>
            <span><i class="fa-light fa-eye"></i>{!! $heat !!}</span>
            <span><i class="fa-light fa-comment-dots"></i>{{ $echo_comment_link() }}</span>
            <span><i class="fa-light fa-folder-closed"></i><a href="{{ $category_link }}">{!! $category_name !!}</a></span>
        </div>
        {{-- description --}}
        <div class="grow">
            <p class="my-3 text-base text-fg-primary text-left -webkit-ellipsis-3">{!! $excerpt !!}</p>
        </div>
        {{-- link --}}
        <div>
            <a href="{{ $link }}" class="button-normal">
                <i class="fa-light fa-ellipsis text-5xl"></i>
            </a>
        </div>
    </div>
</article>
