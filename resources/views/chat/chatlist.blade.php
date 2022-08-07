<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h1>チャットリスト</h1>
        <table class="table mt-5">                            
            <tbody>
                @foreach($chatlist as $user)
                 <tr>                                
                  {{--<td><a href="/showChatPage/{{ $user['name'] }}">{{ $user['name'] }}</a></td>   --}}
                   <td><a href="{{ route('showChatPage', $user['name'])}}">{{ $user['name'] }}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>