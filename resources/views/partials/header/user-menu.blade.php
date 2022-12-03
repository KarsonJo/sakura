<div class="relative group h-full flex-shrink-0">
    <a href="{{ $profile_url }}">
        @if ($logged)
            <img class="faa-spin animated-hover h-full aspect-square rounded-full" src="{{ $avatar }}">
            @else
            <i class="fa-light fa-circle-user"></i>
        @endif
    </a>
    <div class="menu hidden group-hover:block animate-peek-in-t-f
                absolute -right-4 w-28 text-xs text-center bg-bg-primary rounded-md text-fg-primary top-[125%]
                after:bubble-top after:border-b-bg-primary after:right-6
                py-1 shadow-drop">
        @if ($logged)
            <div class="px-3 my-3 break-all">
                Signed in as<div class="text-sm font-bold">{!! $name !!}</div>
            </div>
            <div>
                @foreach ($menu as $item)
                    <a class="px-3 py-1.5 block hover:bg-theme-primary hover:text-fg-primary" 
                        href="{{ $item['url'] }}" target="{{ $item['top'] ? '_top' : '_blank' }}">
                        {!! $item['title'] !!}
                    </a>
                @endforeach
            </div>
        @else
            <div class="px-3 text-sm">
                Whether to
                <a href="{{ $profile_url }}" target="_blank" class="font-bold text-theme-primary">
                    log in
                </a>
                now?
            </div>
        @endif
    </div>
</div>
