@extends('layouts.app')

@section('content')
    {{-- @include('partials.page-header') --}}

    @if (!have_posts())
        <x-alert type="warning">
            {!! __('Sorry, no results were found.', 'sage') !!}
        </x-alert>

        {!! get_search_form(false) !!}
    @endif

    {{-- @while (have_posts())
        @php(the_post())
        @include('partials.content-search')
    @endwhile --}}

    <x-title-banner :bannerImage="\ThemeNova\Gallery\cover_gallery()">
        <header class="text-white font-medium text-3xl flex justify-center items-center z-10">
            <h1>{!! sprintf(__("Search results for \" %s \"", "sakura"), get_search_query()) !!}</h1>
    </header>
    </x-title-banner>

    @if (have_posts())
        <div class="flex flex-col items-center">
            <div class="flex flex-col max-w-5xl w-full gap-6 m-5">
                @while (have_posts())
                    {{-- @includeFirst(['partials.content-' . get_post_type(), 'partials.content']) --}}
                    @php(the_post())
                    @include('partials.snippet.article-item-lite')
                @endwhile
            </div>
        </div>
    @endif

    @include('partials.snippet.post-nav')

@endsection
