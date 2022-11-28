{{-- @extends('layouts.index-item-block', ['title' => of_get_option('feature_title', 'Feature')]) --}}
{{-- @section('block-content')
    <div class="top-feature-container">
        @foreach ($features as $feature)
            <div class="top-feature-v2">
                <div class="the-feature square from_left_and_right">
                    <a href="{{ $feature['link'] }}" target={{ str_starts_with($feature['link'], '#') ? '_self' : '_blank' }}>
                        <div class="img pattern-attachment-img">
                            <img src="{{ $feature['image'] }}">
                        </div>
                        <div class="info">
                            <h3>{!! $feature['title'] !!}</h3>
                            <p>{!! $feature['description'] !!}</p>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@overwrite --}}
<div class="px-8 lg:px-32 overflow-hidden bg-black bg-opacity-90">
    <div class="flex-gallery h-[90vh] my-[10vh] -lg:flex-col">
        <h1 class="bg-theme-primary text-theme-fg-primary lg:h-full lg:writing-v-rl lg:rotate-180 text-4xl p-3">
            Feature
        </h1>
        @foreach ($features as $feature)
            <div class="group g-card">
                <a href="{{ $feature['link'] }}" target={{ str_starts_with($feature['link'], '#') ? '_self' : '_blank' }}>
                    <img src="{{ $feature['image'] }}">
                </a>
                <div class="g-title">
                    <div class="text-center w-0 group-hover:w-full text-fg-primary transition-[width]">{!! $feature['title'] !!}</div>
                </div>
            </div>
        @endforeach
    </div>
</div>
