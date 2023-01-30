<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;


class Comments extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $newComment;
    public $image;
  
    protected $listeners = ['fileUpload'=>'handleFileUpload'];

    function handleFileUpload($image)
    {
        $this->image = $image;
    }

    function updated($field) {
        $this->validateOnly($field,['newComment'=>'required|max:255']);
    }

    public function addComment()
    {
        // dd($this->newComment);
        $this->validate(['newComment'=>'required|max:255']);
        $createComment = Comment::create(['body' => $this->newComment, 'user_id' => 1]);
        $this->newComment = '';
        session()->flash('message','Comment Added Successfully :)');
    }

    function remove($commentId)
    {
        $comment = Comment::find($commentId);
        $comment->delete();
        session()->flash('message','Comment Deleted Successfully :)');

    }
    public function render()
    {
        return view('livewire.comments', ['comments' => Comment::latest()->paginate(2)]);
    }
}
