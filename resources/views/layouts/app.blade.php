<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ __('messages.Page analyzer') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="csrf-param" content="_token" />
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <script src="/js/bootstrap.bundle.min.js"></script>
    </head>
    <body class="min-vh-100 d-flex flex-column">
        <header class="flex-shrink-0">
            <nav class="navbar navbar-expand-md navbar-dark bg-dark px-3">
                <a class="navbar-brand" href="{{ route('home') }}">{{ __('messages.Page analyzer') }}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">{{ __('messages.Main') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('urls.index') }}">{{ __('messages.Sites') }}</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <main class="flex-grow-1">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            @include('flash::message')
            @yield('content')
        </main>
        <footer class="border-top py-3 mt-5 flex-shrink-0">
            <div class="container-lg">
                <div class="text-center">
                    <a href="https://hexlet.io/pages/about" target="_blank">Hexlet</a>
                </div>
            </div>
        </footer>
        </div>
    </body>
</html>
<html>
