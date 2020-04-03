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

    @yield('css')

    @stack('css')

    @yield('js-top')

    @stack('js-top')

    @yield('js-init-top')

    @stack('js-init-top')
</head>

<body>
<div class="wrapper" id="site_wrapper">
    <header class="header" id="header">
        @include('DummyAlias::partials.header')
    </header>

    <main class="main" id="main">
        @yield('content')
    </main>

    <footer class="footer" id="footer">
        @include('DummyAlias::partials.footer')
    </footer>
</div>

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

@yield('js')

@stack('js')

@yield('js-init')

@stack('js-init')

</body>

</html>
