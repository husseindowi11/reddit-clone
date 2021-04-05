<div>

    <h4>Comments</h4>
    <form wire:submit.prevent="storeComment">
        @csrf
        <div>

            <label for="comment_text">Add a comment:</label>
            <textarea rows="4" wire:model="comment_text" name="comment_text" id="comment_text"
                   class="form-control  ms-2 fs--1 @error('comment_text') is-invalid
                   @enderror" type="text" placeholder="Write a comment..."></textarea>
            @error('comment_text')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-sm btn-falcon-default rounded-pill me-1 mb-1 mt-3 ">Add Comment</button>
    </form>
    <hr/>
    @forelse($post->comments as $comment)
        <div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-hidden="true">>
            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
                <div class="modal-content position-relative container-lg">
                    <form wire:submit.prevent="updateComment({{$comment}})">
                        <div class="modal-body">

                            @csrf
                            <h5>Edit Comment</h5>
                            <hr>
                            <label for="comment_text_update">Add a comment:</label>
                            <textarea rows="4" wire:model="comment_text_update" name="comment_text_update" id="comment_text_update"
                                      class="form-control" type="text" placeholder="{{ $comment->comment_text }}" required>
                               {{ $comment->comment_text }}
                            </textarea>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-sm btn-success" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex mt-3">
            <div class="avatar avatar-xl">
                <img class="rounded-circle"
                     src="{{ $comment->user->profile_photo_path == null ? "https://i.pinimg.com/originals/0c/3b/3a/0c3b3adb1a7530892e55ef36d3be6cb8.png" : $profile_photo_path  }}"
                     alt="">
            </div>
            <div class="flex-1 ms-2 fs--1">
                <p class="mb-1 bg-200 rounded-3 p-2">
                    <a class="fw-semi-bold" href="#">{{ $comment->user->name }}</a><br/>
                    {{ $comment->comment_text }}
                </p>
                <div class="px-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#error-modal">Edit</a> • <a href="#" wire:click.prevent="destroyComment({{ $comment }})">Delete</a>
                    • {{ $comment->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
    @empty
        No Comments yet...
    @endforelse
</div>
