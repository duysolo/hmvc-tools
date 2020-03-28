<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <title>{{ page_title()->render() }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    {!! seo()->render() !!}

    <script>
      var BASE_URL = '{{ asset('') }}'
    </script>

    <base href="{{ asset('') }}">

    @php do_action(THEME_ACTION_HEADER_CSS) @endphp

    @yield('css')

    @stack('css')

    @php do_action(THEME_ACTION_HEADER_JS) @endphp

    @yield('js-top')

    @stack('js-top')

    @yield('js-init-top')

    @stack('js-init-top')
</head>

<body class="{{ $bodyClass ?? '' }} @php do_action(THEME_ACTION_BODY_CLASS) @endphp">
<input type="checkbox" class="hidden" id="menu_visible_trigger">

<div class="wrapper" id="site_wrapper">
    @php do_action('front_before_header_wrapper_content') @endphp

    <header class="header" id="header">
        @include('DummyAlias::content.partials.header')
    </header>

    @include('DummyAlias::content.partials.flash-messages')

    @php do_action('front_before_main_wrapper_content') @endphp

    <main class="main" id="main">
        @yield('content')
    </main>

    @php do_action('front_before_footer_wrapper_content') @endphp

    <footer class="footer" id="footer">
        @include('DummyAlias::content.partials.footer')
    </footer>

    @php do_action('front_bottom_wrapper_content') @endphp
</div>

@php do_action('front_bottom_content') @endphp

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

@php do_action('front_footer_js') @endphp

@yield('js')

@stack('js')

@yield('js-init')

@stack('js-init')

</body>

</html>
