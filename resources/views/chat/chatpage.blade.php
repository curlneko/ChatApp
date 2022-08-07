<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h1>チャットページ</h1>
        <h2>{{ $userName}}</h2>

        <table class="table mt-5">                            
            <tbody>
                @foreach($chatMessages as $chatMessage)
                <tr>
                    <td>{{ $chatMessage->sender }}</td>                                
                    <td>{{ $chatMessage->receiver }}</td>
                    <td>{{ $chatMessage->dateTime }}</td>
                    <td>{{ $chatMessage->message }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <form action="{{ route('sendMessage') }}" method="POST">
            @csrf
            <input type="hidden" name="userName" value="{{ $userName}}" >
            <input type="text" name="message" >
            <input type="submit" value="送信ボタン" >
        </form>
    </body>
</html>