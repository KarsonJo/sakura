@php
    $next = ['post' => get_next_post(), 'text' => 'Next Post'];
    $prev = ['post' => get_previous_post(), 'text' => 'Previous Post'];
@endphp

<section class="my-12 flex bg-black">
    @foreach ([$next, $prev] as $adjacent)
        <div class="flex-1 relative h-40 last:text-right overflow-hidden">
            <a class="group" href="{{ get_permalink($adjacent['post']) }}" rel="next">
                <img class="h-full w-full object-cover lazyload img-placeholder duration-300
                            transition opacity-40 group-hover:opacity-60 group-hover:scale-110" data-src="{{ \ThemeNova\Post\post_preview_image($adjacent['post']) }}" src="{{ \ThemeNova\Post\post_preview_image($adjacent['post']) }}">
                <div class="absolute inset-10">
                    <span class="text-slate-200">{!! $adjacent['text'] !!}</span>
                    <h3 class="text-white font-bold">{{ $adjacent['post']->post_title }}</h3>
                </div>
            </a>
        </div>
    @endforeach
</section>
