@extends('layouts.app')

@section('content')
    {{-- @include('partials.page-header') --}}
    @if ($isWelcomePage)
        @if (of_get_option('head_notice'))
            @include('partials.index.notice')
        @endif
        @include('partials.index.feature')
    @endif
    @include('partials.index.article-list')
    {{-- @if (!have_posts())
        <x-alert type="warning">
            {!! __('Sorry, no results were found.', 'sage') !!}
        </x-alert>

        {!! get_search_form(false) !!}
    @endif

    @while (have_posts())
        @php(the_post())
        @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
    @endwhile --}}

    {{-- <div class="flex justify-center [&_.nav-links]:flex [&_.nav-links]:flex-row-reverse [&_.nav-links]:gap-5 [&_a]:button-theme-solid [&_a]:block">
        {!! get_the_posts_navigation() !!}
    </div> --}}
    @include('partials.snippet.post-nav')
@endsection

{{-- @section('sidebar')
    @include('sections.sidebar')
@endsection --}}
