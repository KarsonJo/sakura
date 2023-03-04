<a class="sr-only focus:not-sr-only" href="#main">
    {{ __('Skip to content') }}
</a>

{{-- wrapper --}}
<div class="min-h-screen flex flex-col justify-start">
    @include('sections.header')

    <div>
        <div class="h-20"></div>
        <main id="main" class="main">
            @yield('content')
        </main>

        @hasSection('sidebar')
            <aside class="sidebar">
                @yield('sidebar')
            </aside>
        @endif
    </div>

    <div class="mt-auto">
        @include('sections.footer')
    </div>
</div>
