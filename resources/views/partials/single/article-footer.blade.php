<footer class="text-fg-tertiary text-sm m-9 p-5 flex flex-col items-center
hover:[&_a]:text-theme-primary [&_a]:transition-colors 
gap-3 border-y-[1px] border-slate-200 border-dashed">

    @include('partials.snippet.cclicense')

    <div class="flex justify-between w-full">
        <div>
            @if (has_tag())
                <span class="post-tags">
                    <i class="fa-light fa-tags"></i>
                    @php(the_tags('', ' ', ''))
                </span>
            @endif
        </div>
        <div class="text-lg text-theme-primary">
            {{-- nova-todo --}}
            @if (of_get_option('post_share') == 'yes')
                <span class="post-share cursor-pointer hover:text-blue-500 transition-colors">
                    <span class="social-share sharehidden"></span>
                    <i class="fa-light fa-share font-bold"></i>
                </span>
            @endif
            {{-- nova-todo --}}
            {{-- @if (of_get_option('post_like') == 'yes')
                <span class="post-like ml-3 cursor-pointer hover:text-red-500 transition-colors">
                    <span data-action="ding" data-id="{{ the_ID() }}" class="specsZan @if (isset($_COOKIE['specs_zan_' . get_the_ID()])) done @endif">
                        <i class="fa-light fa-heart hover:font-bold"></i>
                        <span class="count">
                            {{ get_post_meta(get_the_ID(), 'specs_zan', true) ?: '0' }}
                        </span>
                    </span>
                </span>
            @endif --}}
        </div>
    </div>
</footer>
