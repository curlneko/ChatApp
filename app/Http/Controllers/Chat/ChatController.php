<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ChatController extends Controller
{
    //チャットリストをDBから取得
    public function getChatList() {
        $userName = Auth::user()->name;

        $users = DB::table('users')->where('name', '<>', $userName)->get();    // 全てのデータが取得できる

        $chatlist = array();

        foreach ($users as $user) {
            array_push($chatlist,array('id' => $user->id, 'name' => $user->name));
        }

        return $chatlist;
    }

    //チャットメッセージをDBから取得
    public function getChatMessage($receiverName) {
        $senderName = Auth::user()->name;

        //ここおかしい
        $chatMessages = DB::table('chat_message')->where(['receiver' => $receiverName, 'sender' => $senderName])->orWhere(['receiver' => $senderName, 'sender' => $receiverName])->get();
    
        $chatMessageArray = array();
    
        foreach ($chatMessages as $chatMessage) {
            array_push($chatMessageArray,array('sender' => $chatMessage->sender, 'receiver' => $chatMessage->receiver, 'dateTime' => $chatMessage->dateTime, 'message' => $chatMessage->message));
        }
    
        return $chatMessages;
    }

    //取得したチャットリストをチャットリスト画面に渡す
    public function showChatList(){
        $chatlist = $this->getChatList();
        return view('chat/chatlist')->with('chatlist',$chatlist);
    }

    //チャット専用ページに必要な情報を返す
    public function showChatPage($userName){
        $chatMessages = $this->getChatMessage($userName);
        return view('chat/chatpage')->with(['chatMessages'=>$chatMessages, 'userName'=>$userName]);
    }

    //メッセージをDBに登録
    public function sendMessage(Request $request){
        $receiverName = $request->input('userName');
        $message = $request->input('message');
        $now = new DateTime();
        $senderName = Auth::user()->name;
        $currentTimestamp = Carbon::now()->timestamp;

        //DBにメッセージを登録する処理
        DB::table('chat_message')->insert([
            'id' => $currentTimestamp,
            'sender' => $senderName,
            'receiver' => $receiverName,
            'dateTime' => $now,
            'message' => $message
        ]);

        $chatMessages = $this->getChatMessage($receiverName);

        return view('chat/chatpage')->with(['chatMessages'=>$chatMessages, 'userName'=>$receiverName]);
    }
}
