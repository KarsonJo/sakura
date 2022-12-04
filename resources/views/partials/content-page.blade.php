{{-- @php(the_content())

{!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!} --}}
@extends('layouts.article-block')

@section('outer-before')
    @include('partials.single.single-banner')
@overwrite
