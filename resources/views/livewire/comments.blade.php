<div>
{{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

    <div class="text-center w-50 mt-5 m-auto">
    
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <input type="text" wire:model.debounce.500ms="newComment" comment="comment" name="body" class="  mt-5 mb-3 form-control" id="" placeholder="Your Comment">
    
    @error('newComment')
        <div class="text-sm mb-3" style="color:red">{{ $message }}</div>
    @enderror
    
    <button wire:click="addComment" class="btn btn-success">Add Comment</button>


    @foreach ($comments as $comment)
        <div class="card mt-3 m-auto">
            <div class="card-header justify-content-between">
                <span  >{{ $comment->creator->name }}</span>
                <span style="float:right"><i class="bi bi-x-circle-fill  text-danger" wire:click="remove({{$comment->id}})" style="cursor: pointer;"></i>
                </span>
            </div>
            <div class="card-body">
                <h5 class="card-title">Card with header and footer</h5>
                {{ $comment->body }}
            </div>
            <div class="card-footer">
                {{ $comment->created_at->diffForHumans() }}
            </div>
        </div>
    @endforeach
</div>
