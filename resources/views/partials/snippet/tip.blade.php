@php($QRcodes = array_filter([of_get_option('alipay_code'), of_get_option('wechat_code')]))
@if ($QRcodes)
    <div class=" group flex justify-center items-center w-12 h-12 my-9 rounded-full mx-auto
        bg-red-500 text-white text-lg cursor-default relative">
        {!! __('tip', 'nova') !!}
        {{-- popup --}}
        <div class="hidden absolute top-[125%] group-hover:block shadow-drop rounded-sm bg-red-50
                    after:bubble-top after:border-[12px] after:border-b-red-50 
                    after:left-1/2 after:-translate-x-1/2 animate-peek-in-t-f">
            <ul class="p-5 flex gap-5 items-stretch">
                @foreach ($QRcodes as $QRcode)
                    <li class="w-40 h-full object-contain">
                        <img src="{{ $QRcode }}">
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
