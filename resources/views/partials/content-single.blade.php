@extends('layouts.article-block')

@section('outer-before')
    @include('partials.single.single-banner')
@overwrite

@section('inner-after')
    @include('partials.snippet.tip')
    @include('partials.single.article-footer')
    @include('partials.single.adjacent-nav')
    @if (of_get_option('show_authorprofile'))
        @include('partials.single.author-info')
    @endif
    @php(comments_template())
@overwrite
