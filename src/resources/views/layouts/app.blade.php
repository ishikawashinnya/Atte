<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')
</head>

<body>
    <div class="app">
        <header class="header">
            <div class="header__ttl">
                <h1>Atte</h1>
            </div>
            @yield('link')
        </header>

        <main>
            <div class="content">
                @yield('content')
            </div>
        </main>

        <footer class="footer">
            <div class="footer__ttl">
                <span class="footer__ttl-span">Atte,inc.</span>
            </div>
        </footer>
    </div>

    
</body>

</html>