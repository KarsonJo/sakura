@php
    $authorId = get_the_author_meta('ID');
    $authorUrl = esc_url(get_author_posts_url($authorId, get_the_author_meta('user_nicename')));
    $postTime = \ThemeNova\Post\post_display_time();
    $postViewCount = \ThemeNova\Post\get_post_views(get_the_ID());
    $postViewStr = $postViewCount . ' ' . _n('View', 'Views', $postViewCount, 'sakura'); /*次阅读*/
@endphp

<x-title-banner :bannerImage="\ThemeNova\Post\post_cover()">
    <header class="single-header max-w-main w-full px-[4%] py-6 mx-auto z-10 
                    text-white font-medium text-3xl
                    flex flex-col items-start justify-end gap-5">
        <h1 class="entry-title">{!! the_title() !!}</h1>
        <div class="flex gap-1.5 items-center text-sm">
            <div class="shrink-0">
                <a href="{{ $authorUrl }}">
                    <img class="w-10 h-10 rounded-full mx-3" src="{!! get_avatar_url($authorId, ['size' => 64]) !!}">
                </a>
            </div>
            {{-- author info --}}
            <div>
                <span>
                    <a href="{{ $authorUrl }}"> {!! get_the_author() !!} </a>
                </span>
                <span>·</span>
                {!! $postTime !!}
                <span>·</span>
                {!! $postViewStr !!}
                @if (current_user_can('level_10'))
                    <span>·</span>
                    <a href="{!! get_edit_post_link() !!}">EDIT</a>
                @endif
            </div>
        </div>
    </header>
</x-title-banner>
