<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Carbon\Carbon;
use Livewire\Component;

class Comments extends Component
{
    public $comments;
    public $newComment;

    function mount()
    {
        $this->comments = Comment::all();
    }

    function updated($field) {
        $this->validateOnly($field,['newComment'=>'required|max:255']);
    }

    public function addComment()
    {
        // dd($this->newComment);
        $this->validate(['newComment'=>'required|max:255']);
        $createComment = Comment::create(['body' => $this->newComment, 'user_id' => 1]);
        $this->comments->prepend($createComment);
        $this->newComment = '';
        session()->flash('message','Comment Added Successfully :)');
    }

    function remove($commentId)
    {
        $comment = Comment::find($commentId);
        $comment->delete();
        $this->comments=$this->comments->   except($commentId);
    }
    public function render()
    {
        return view('livewire.comments', ['comments' => $this->comments]);
    }
}
