<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Str;

class Comments extends Component
{
    use WithPagination;

    // public Collection $comments;
    public $newComment;
    public $image;
    public $supportTicketId;

    protected $listeners = ['fileUpload' => 'handleFileUpload', 'ticketSelected'];

    // public function mount()
    // {
    // $this->comments =  Comment::query()->with('author')->latest()->get();
    // }

    public function ticketSelected($ticketId)
    {
        $this->supportTicketId = $ticketId;
    }

    public function handleFileUpload($imageDataBase64)
    {
        $this->image = $imageDataBase64;
    }

    public function addComment()
    {
        $this->validate(['newComment' => 'required|max:500']);
        $image = $this->storeImage();
        $comment = Comment::create([
            "body" => $this->newComment,
            "user_id" => 1,
            'image' => $image,
            'support_ticket_id' => $this->supportTicketId
        ]);
        // $this->comments->prepend($comment);
        $this->reset('newComment', 'image');
        session()->flash('message', 'Comment added successfully.');
    }

    public function storeImage()
    {
        if (!$this->image) return null;
        $img = ImageManagerStatic::make($this->image)->encode('jpg');
        $name = Str::random() .  '.jpg';
        Storage::disk('public')->put($name, $img);
        return $name;
    }

    public function remove($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        // $this->comments = $this->comments->except($commentId);
        Storage::disk('public')->delete($comment->image);
        $comment->delete();
        session()->flash('message', 'Comment successfully deleted.');
    }

    public function render()
    {
        return view('livewire.comments', [
            'comments' => Comment::where('support_ticket_id', $this->supportTicketId)->latest()->with('author')->paginate(3)
        ]);
    }
}
