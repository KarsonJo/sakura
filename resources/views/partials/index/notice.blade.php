@extends('layouts.index-item-block', ['title' => 'Notice'])
@section('block-content')
    <div class="notice notice-content">
        {{ of_get_option('notice_title') }}
    </div>
@overwrite
