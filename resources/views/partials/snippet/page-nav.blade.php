@if ($links)
    <nav class="page-nav not-entry-content text-fg-primary mx-5 my-9 flex gap-3 justify-end items-center">
        @if ($prompt)
            <div class="text-lg"> {!! $prompt !!}</div>
        @endif
        <div class="flex flex-wrap gap-1.5 [&>a]:btn-theme-primary 
        [&>*]:rounded-md  [&>*]:w-9 [&>*]:h-9 [&>*]:button-basic [&>*]:shadow-md
        [&>span]:border-2 [&>span]:border-theme-primary [&>span]:cursor-default">
            {!! $links !!}
        </div>
    </nav>
@endif
