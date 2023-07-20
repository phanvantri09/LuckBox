<?php

namespace App\Repositories;

use App\Events\Chat;
use App\Events\ChatRead;
use App\Helpers\ConstCommon;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageRepository implements MessageRepositoryInterface
{
    public function createMessage($userId, $content)
    {
        $message = new Message();
        $message->user_id = $userId;
        $message->content = $content;
        $message->save();

        event(new Chat(
            Auth::user()->email,
            $content,
            null,
            Auth::user()->id
        ));

        event(new ChatRead());

        return true;
    }

    public function createAdminMessage($userId, $adminId, $content)
    {
        $message = new Message();
        $message->user_id = $userId;
        $message->admin_id = $adminId;
        $message->content = $content;
        $message->read = 1;
        $message->save();

        event(new Chat(
            Auth::user()->email,
            $content,
            $adminId,
            $userId
        ));

        event(new ChatRead());

        return true;
    }

    public function updateMessageReadStatus($messageId)
    {
        $message = Message::findOrFail($messageId);
        $message->update([
            'read' => 1,
        ]);

        return $message;
    }

    public function getUsersWithLatestMessages()
    {
        $users = User::join(
            DB::raw('(SELECT user_id, MAX(created_at) AS latest_message FROM messages GROUP BY user_id) AS latest_messages'),
            'users.id',
            '=',
            'latest_messages.user_id'
        )
            ->join('messages', function ($join) {
                $join->on('users.id', '=', 'messages.user_id')
                    ->on('messages.created_at', '=', 'latest_messages.latest_message');
            })
            ->select('users.*', 'messages.*')
            ->orderBy('latest_messages.latest_message', 'desc')
            ->get();

        return $users;
    }

    public function getUserChat()
    {
        $chats = Message::where('user_id', Auth::user()->id)
            ->with('user', 'admin')
            ->get();

        return $chats;
    }

    public function getAdminChat($userId)
    {
        $chats = Message::where('user_id', $userId)
            ->with('user', 'admin')
            ->get();

        return $chats;
    }

    public function searchUser($search)
    {
        return User::where('email', 'like', "%$search%")->where('type', ConstCommon::TypeUser)->get();
    }
}
