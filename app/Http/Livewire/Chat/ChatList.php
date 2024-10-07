<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use Livewire\Component;
use Livewire\WithPagination; // Include the WithPagination trait

class ChatList extends Component
{
    use WithPagination; // Use the trait for pagination

    public $selectedConversation;
    public $query;

    protected $listeners = ['refresh' => '$refresh'];

    public function deleteByUser($id) {
        $userId = auth()->id();
        $conversation = Conversation::find(decrypt($id));

        $conversation->messages()->each(function($message) use($userId) {
            if ($message->sender_id === $userId) {
                $message->update(['sender_deleted_at' => now()]);
            } elseif ($message->receiver_id === $userId) {
                $message->update(['receiver_deleted_at' => now()]);
            }
        });

        $receiverAlsoDeleted = $conversation->messages()
            ->where(function ($query) use($userId) {
                $query->where('sender_id', $userId)
                      ->orWhere('receiver_id', $userId);
            })
            ->where(function ($query) use($userId) {
                $query->whereNull('sender_deleted_at')
                      ->orWhereNull('receiver_deleted_at');
            })
            ->doesntExist();

        if ($receiverAlsoDeleted) {
            $conversation->forceDelete();
        }

        return redirect(route('chat.index'));
    }

    public function render() {
        $user = auth()->user();

        // Retrieve conversations with pagination
        $conversations = $user->conversations()
            ->latest('updated_at')
            ->paginate(10); // Adjust the number per page as needed

        return view('livewire.chat.chat-list', [
            'conversations' => $conversations
        ]);
    }
}
