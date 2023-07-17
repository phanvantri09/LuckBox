<?php

namespace App\Http\Controllers;

use App\Repositories\MessageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    protected $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function index(Request $request)
    {
        $this->messageRepository->createMessage(Auth::user()->id, $request->input('message'));

        return true;
    }

    public function sendMessageAdmin(Request $request)
    {
        $this->messageRepository->createAdminMessage(
            $request->input('idUser'),
            Auth::user()->id,
            $request->input('message')
        );

        return true;
    }

    public function updateReadMessage(Request $request)
    {
        $message = $this->messageRepository->updateMessageReadStatus($request->input('id'));

        return response()->json($message);
    }

    public function indexAdmin()
    {
        return view('admin.chat.index', compact([]));
    }

    public function getUser()
    {
        $users = $this->messageRepository->getUsersWithLatestMessages();

        return response()->json($users);
    }

    public function getChat()
    {
        $chats = $this->messageRepository->getUserChat();

        return response()->json($chats);
    }

    public function getChatAdmin($id)
    {
        $chats = $this->messageRepository->getAdminChat($id);

        return response()->json($chats);
    }
}
