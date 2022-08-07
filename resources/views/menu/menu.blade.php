<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h1>メニュー</h1>
        <h2>Hi! {{ $userName}}</h2>

        <a href="/showChatList">チャット</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-jet-dropdown-link href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        this.closest('form').submit();">
                {{ __('Logout') }}
            </x-jet-dropdown-link>
        </form>
    </body>
</html>