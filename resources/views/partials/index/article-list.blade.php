@extends('layouts.index-item-block', ['title' => 'Discovery1'])
@section('block-content')
    @if (have_posts())
        <div class="article-list">
            @while (have_posts())
                {{-- @includeFirst(['partials.content-' . get_post_type(), 'partials.content']) --}}
                @php(the_post())
                @include('partials.index.article-list-item')
            @endwhile
        </div>
    @endif
@overwrite
