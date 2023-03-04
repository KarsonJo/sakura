{{-- 
    https://github.com/WordPress/wordpress-develop/blob/6.1/src/wp-includes/class-wp-user.php
    WP_User includs properties provided by usermeta
--}}

{{-- @php
    global $author;
    $curauth = get_userdata(intval($author));
    $authmeta = get_user_meta(intval($author));
@endphp
<div>
    {{ $curauth->use_ssl }}
</div>
<div style="white-space: pre-wrap">
    {{ json_encode($curauth, JSON_PRETTY_PRINT) }}
</div>
<br>
<div style="white-space: pre-wrap">
    {{ json_encode($authmeta, JSON_PRETTY_PRINT) }}
</div> --}}

{{-- left profile --}}

@extends('layouts.app')

@php
    global $author;
    $curauth = get_userdata(intval($author));
    $authmeta = get_user_meta(intval($author));
@endphp
@section('content')
    {{-- background --}}
    <div class="fixed inset-0 bg-theme-primary bg-opacity-5 -z-50">
    </div>
    {{-- profile card --}}
    <div class="flex max-w-7xl mx-auto my-8 px-12 py-8 shadow-xl rounded-lg bg-bg-primary border-slate-100">
        {{-- left column --}}
        <div class="p-4 m-4 w-64 sticky top-0 mb-auto">
            {{-- avatar --}}
            <div>
                <a>
                    <img class="w-full aspect-square" src="{{ get_avatar_url($curauth->id, ['size' => 256]) }}">
                </a>
            </div>

            <div class="flex items-center my-6">
                <span class="text-fg-tertiary text-xs pr-2">Author</span>
                <hr class="flex-1">
            </div>

            {{-- author info --}}
            <div class="px-2">
                <a class="hover:text-theme-primary hover:cursor-pointer">
                    <h1 class="text-3xl my-4">
                        {{ $curauth->display_name }}
                    </h1>
                </a>

                <div class="flex flex-col gap-1 text-fg-tertiary text-sm">
                    <div>
                        <span class="font-bold">{{ __('email: ', 'nova') }}</span>{{ $curauth->user_email }}
                    </div>
                    <div>
                        <span class="font-bold">{{ __('url: ', 'nova') }}</span>{{ $curauth->user_url }}
                    </div>
                </div>
            </div>

            <div class="flex items-center my-6">
                <span class="text-fg-tertiary text-xs pr-2">Description</span>
                <hr class="flex-1">
            </div>

            {{-- author description --}}
            <div class="px-2 text-sm text-fg-secondary">
                <p>
                    {{ $curauth->description }}
                    {{ $authmeta->description }}
                </p>
            </div>
        </div>

        {{-- separator --}}
        <div class="m-8 border-l"></div>

        {{-- right column --}}
        <div class="flex-1">
            @if (have_posts())
                <div class="flex flex-col max-w-5xl w-full gap-6">
                    @while (have_posts())
                        {{-- @includeFirst(['partials.content-' . get_post_type(), 'partials.content']) --}}
                        @php(the_post())
                        @include('partials.snippet.article-item-lite')
                    @endwhile
                </div>
            @endif
        </div>
    </div>
@endsection
