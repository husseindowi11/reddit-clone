<div class="col-1 text-center">
    <a wire:click.prevent="vote(1)" href="">
        <div><i class="fa fa-2x fa-sort-up"></i></div>
    </a>
    <h4>{{$post->votes}}</h4>
    <a wire:click.prevent="vote(-1)" href="">
        <div><i class="fa fa-2x fa-sort-down"></i></div>
    </a>
</div>
