<article @php(post_class())>
    @include('partials.single.single-banner')

    <div class="max-w-main mx-auto">
        <div class="entry-content">
            @php(the_content())
        </div>
        @include('partials.snippet.page-nav', ['prompt' => __('Pages:', 'sage'), 'links' => wp_link_pages(['echo' => 0, 'before' => '', 'after' => ''])])
        @include('partials.snippet.tip')
        @include('partials.single.article-footer')
        @include('partials.single.adjacent-nav')
        @if (of_get_option('show_authorprofile'))
            @include('partials.single.author-info')
        @endif
        @php(comments_template())
    </div>
</article>
