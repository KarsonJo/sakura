<div class="h-screen relative animate-peek-in-t {{ $bg_filter }}
            before:absolute before:inset-0 before:z-10">
    <img id="centerbg" class="absolute h-full w-full object-cover" src="{{ $bg_img }}">
    @if ($movie_enabled)
        <div id="video-container" class="absolute h-full w-full">
            <video id="bgvideo" class="absolute h-full w-full [&.focus]:bg-black" video-name="" src="" width="auto" preload="auto"></video>
            <div class="absolute bottom-2 right-2 z-10
                        [&>*]:cursor-pointer [&>*]:opacity-80
                        hover:[&>*]:opacity-100 animate-bounce-light
                        [&_img]:h-8 [&_img]:w-8">
                <div id="video-btn" class="mb-2">
                    <img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/play@32x32.png">
                </div>
                <div id="video-add">
                    <img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/add@32x32.png">
                </div>
            </div>
            <div class="absolute bottom-0 w-full py-1.5 text-center bg-black bg-opacity-80 text-lg text-white"></div>
        </div>
    @endif
    @if ($social_enabled)
        {{-- social info --}}
        <div class="absolute inset-0 flex flex-col justify-center items-center z-10 gap-5 max-w-3xl text-center m-auto">
            @if ($is_text_logo)
                <h1 class="todo" data-text="{{ $avatar_src }}">{{ $avatar_src }}</h1>
            @else
                <a href="{{ $siteUrl }}">
                    {{-- avatar --}}
                    <img class="w-32 h-32 rounded-full p-1 shadow-[inset_0_0_10px_#000F] hover:animate-rotate" src="{{ $avatar_src }}">
                </a>
            @endif
            <div class="bg-black/50 p-4 rounded-xl">
                <p class="text-white font-bold text-lg">{!! $motto !!}</p>
                <ul class="top-social flex items-center justify-center
                            [&_img]:w-9 [&_img]:h-9 [&_img]:p-1.5">
                    <li id="bg-pre" class="cursor-pointer">
                        <img class="-scale-x-100" src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/next-b.svg" />
                    </li>
                    <ul class="flex flex-wrap items-center justify-center">
                        @foreach ($socials as $social)
                            @if ($social['is_image'])
                                {{-- tag --}}
                                <li class="relative group">
                                    <a href="#" title="{{ $social['title'] }}">
                                        <img src="{{ $social['icon_src'] }}" />
                                    </a>
                                    {{-- popup image (QR Code) --}}
                                    <div class="w-64 h-64 absolute right-1/2 -mr-32 top-[175%] bg-black/50
                                    hidden group-hover:flex group-hover:animate-peek-in-t-f
                                    rounded-md content-center items-center after:-translate-x-1/2 after:left-1/2
                                    after:bubble-top after:border-b-black/50 p-3 after:border-[20px]">
                                        <img class="!w-auto !h-auto" src="{{ $social['social_src'] }}" alt="WeChat">
                                    </div>
                                </li>
                            @else
                                {{-- tag --}}
                                <li>
                                    <a href="{{ $social['social_src'] }}" target="_blank" title="{{ $social['title'] }}">
                                        <img src="{{ $social['icon_src'] }}" />
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <li id="bg-next" class="cursor-pointer">
                        <img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/next-b.svg" />
                    </li>
                </ul>
            </div>
        </div>
    @endif
</div>
