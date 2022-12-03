@php
    $authorId = get_the_author_meta('ID');
    $authorUrl = esc_url(get_author_posts_url($authorId, get_the_author_meta('user_nicename')));
@endphp
<section class="m-8 flex flex-col gap-3 items-center">
    <div class="w-20 h-20 border-2 border-slate-300 rounded-full overflow-hidden" itemprop="author" itemscope="" itemtype="http://schema.org/Person">
        <a href="{{ $authorUrl }}" class="profile gravatar">
            <img src="{!! get_avatar_url($authorId) !!}">
        </a>
    </div>
    <h3 class="text-lg font-bold text-slate-300 hover:text-fg-primary" itemprop="name">
        <a href="{{ $authorUrl }}" rel="author">{!! get_the_author() !!}</a>
    </h3>
    <p class="py-4 border-y border-slate-100">
        <i class="fa-light fa-pen mx-4 text-theme-primary"></i>{{ get_the_author_meta('description') ?: of_get_option('admin_des', 'Hello, world!') }}
    </p>
</section>
