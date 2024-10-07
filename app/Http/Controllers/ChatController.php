<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Conversation; // Ensure you have this model
use App\Models\Message; // Ensure you have this model
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        // Fetch conversations for the authenticated user
        $conversations = Conversation::where('user_id', Auth::id())->with('messages')->get();
        return view('chat.index', compact('conversations'));
    }

    public function show($id)
    {
        // Fetch specific conversation
        $conversation = Conversation::with('messages')->findOrFail($id);
        return view('chat.show', compact('conversation'));
    }

    public function create()
    {
        $users = User::where('id', '!=', auth()->id())->get(); // Get users except the logged-in user
        return view('livewire.chat.create', compact('users')); // Ensure the view name is correct
    }
    
}


