<div class="comment-fields flex items-center m-4">
    {{-- avatar --}}
    <div class="relative w-16 h-16 shrink-0 m-2">
        {{-- default --}}
        <img class="rounded-full" src="{{ get_template_directory_uri() . '/resources/images/mystery-person.jpg' }}">
        <div class="absolute bottom-0 right-0">
            <i class="fa-brands fa-qq"></i>
            <i class="fa-brands fa-google"></i>
        </div>
    </div>
    {{-- fields --}}
    @foreach ($fields as $field)
        <div class="relative text-sm m-2.5 flex-1">
            <input class="peer h-8 p-5 w-full shadow-md rounded outline-1 bg-transparent backdrop-contrast-75 
                        outline-slate-400 hover:outline focus-visible:outline-theme-primary focus-visible:outline" type="text" placeholder="{{ $field['prompt'] }} {{ $field['required'] ? __('Must* ', ' sakura') : '' }}" name="{{ $field['name'] }}" id="{{ $field['name'] }}" autocomplete="off" @if ($field['required']) aria-required="true" @endif />
            <span class="absolute bottom-full hidden mb-2 bg-fg-primary right-0 w-full p-2 text-bg-primary text-center text-xs rounded-md
            after:bubble-bottom after:border-8 after:border-t-fg-primary after:left-1/2 after:-translate-x-1/2
            peer-focus:block peer-focus:animate-fade-in">
                {!! $field['tooltip'] !!}
            </span>
        </div>
    @endforeach
</div>
