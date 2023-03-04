{{-- card --}}
<article class="group bg-theme-primary bg-opacity-5 transition-colors hover:bg-opacity-20
                rounded overflow-hidden animate-peek-in-l h-52 shadow-xl -md:!h-80
                grid grid-cols-[min-content_1fr] grid-rows-[100%]" itemscope="" itemtype="http://schema.org/BlogPosting">
    {{-- psot image --}}
    <a class="overflow-hidden row-span-full col-start-1
            md:aspect-[4/3] -md:col-span-full" href="{{ $link }}">
        <img class="lazyload img-placeholder h-full w-full object-cover
                    group-hover:scale-110 transition-transform duration-500" data-src="{{ $cover }}" {{--src="{{ $cover }}"--}}>
    </a>
    {{-- post info --}}
    <div class="py-5 px-10 relative z-10 backdrop-blur-sm row-span-full col-start-2
             -md:bg-bg-primary -md:bg-opacity-80 -md:self-end
             -md:col-span-full">
        <div class="flex flex-col items-center
                    text-fg-tertiary text-xs h-full overflow-hidden
                    [&_a]:transition-colors hover:[&_a]:text-theme-primary [&_i]:mx-1">
            {{-- title --}}
            <div>
                <a href="{{ $link }}" class="-webkit-ellipsis-2 text-lg text-fg-primary font-bold">
                    {!! $title !!}
                </a>
            </div>
            <div class="flex flex-wrap gap-2 my-3.5 justify-center">
                {{-- time --}}
                <div>
                    <i class="fa-light fa-clock"></i>{!! $post_time !!}
                    @if (!is_sticky())
                        <i class="fa-light fa-fire"></i>
                    @endif
                </div>
                {{-- tags --}}
                <div>
                    <span><i class="fa-light fa-eye"></i>{!! $heat !!}</span>
                    <span><i class="fa-light fa-comment-dots"></i>{{ $echo_comment_link() }}</span>
                    <span><i class="fa-light fa-folder-closed"></i><a href="{{ $category_link }}">{!! $category_name !!}</a></span>
                </div>
            </div>
            {{-- description --}}
            <div class="grow flex items-center">
                <p class="text-sm leading-relaxed text-fg-secondary text-left -webkit-ellipsis-3">{!! $excerpt !!}</p>
            </div>
        </div>
    </div>
</article>
