<div class="header-user-avataendforeachr">
    <a href="{{ $profile_url }}">
        <img class="faa-spin animated-hover" src="{{ $avatar }}" width="30" height="30">
    </a>
    <div class="header-user-menu">
        @if ($logged)
            <div class="herder-user-name">
                Signed in as<div class="herder-user-name-u">{!! $name !!}</div>
            </div>
            <div class="user-menu-option">
                @foreach ($menu as $item)
                    <a href="{{ $item['url'] }}" target="{{ $item['top'] ? '_top' : '_blank' }}">
                        {!! $item['title'] !!}
                    </a>
                @endforeach
            </div>
        @else
            <div class="herder-user-name no-logged">Whether to
                <a href="{{ $profile_url }}" target="_blank" class="color:#333;font-weight:bold;text-decoration:none">
                    log in
                </a>
                now?
            </div>
        @endif
    </div>
</div>
