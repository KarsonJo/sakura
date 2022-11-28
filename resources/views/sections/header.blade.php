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
        @if (!of_get_option('head_focus') && is_home())
            @include('partials.header.banner')
        @endif
    </div>
</header>
