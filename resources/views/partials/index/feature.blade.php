@extends('layouts.index-item-block', ['title' => of_get_option('feature_title', 'Feature')])
@section('block-content')
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
@overwrite
