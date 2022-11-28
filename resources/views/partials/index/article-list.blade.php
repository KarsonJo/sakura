@extends('layouts.index-item-block', ['title' => 'Articles'])
@section('block-content')
    @if (have_posts())
        <div class="flex flex-col gap-5">
            @while (have_posts())
                {{-- @includeFirst(['partials.content-' . get_post_type(), 'partials.content']) --}}
                @php(the_post())
                @include('partials.index.article-list-item')
            @endwhile
        </div>
    @endif
@overwrite
