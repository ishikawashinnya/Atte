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
    
    <header class="header">
        <div class="header__ttl">
            <h1>Atte</h1>
        </div>
        @if(Auth::check())
        <nav class="header-nav">
            <ul class="header-nav__list">
                <li class="header-nav__item">
                    <a href="/">ホーム</a>
                </li>
                <li class="header-nav__item">
                    <a href="/attendance">日付一覧</a>
                </li>
                <li class="header-nav__item">
                    <form action="/logout" method="post" class="logout">
                        @csrf
                        <button class="nav__logout">ログアウト</button>
                    </form>
                </li>
            </ul> 
        </nav>
        @endif
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
    

   
</body>

</html>