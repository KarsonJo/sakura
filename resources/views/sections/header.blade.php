<header class="banner">
    {{-- <a class="brand" href="{{ home_url('/') }}">
    {!! $siteName !!}
  </a>

  @if (has_nav_menu('primary_navigation'))
    <nav class="nav-primary" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
      {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'echo' => false]) !!}
    </nav>
  @endif --}}
    <div class="grid [&>*]:col-span-full [&>*]:row-span-full">
        @include('partials.navbar-top')
        {{-- 写在这里不太好，但为了跟header联动最好还是写在这 --}}
        @if (!of_get_option('head_focus') && $isWelcomePage)
            @include('partials.header.banner')
        @endif
    </div>
    @if (!(!of_get_option('head_focus') && $isWelcomePage))
        <div class="h-20"></div>
    @endif
</header>
