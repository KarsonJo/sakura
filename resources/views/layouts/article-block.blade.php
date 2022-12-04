<article @php(post_class())>

    @yield('outer-before')

    <div class="max-w-main mx-auto">

        @yield('inner-before')

        <div class="entry-content">
            @php(the_content())
        @include('partials.snippet.page-nav', ['prompt' => __('Pages:', 'sage'), 'links' => wp_link_pages(['echo' => 0, 'before' => '', 'after' => ''])])
    </div>

        @yield('inner-after')

    </div>

    @yield('outer-after')

</article>
