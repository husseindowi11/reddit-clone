<div class="row">
    <div class="col-2">
        <a class="btn rounded-2 p-0 text-700 " wire:click.prevent="vote(1)" href=""
           data-bs-toggle="tooltip" data-bs-placement="bottom" title="UpVote">
            <span class="fas fa-angle-up" style="font-size: 18px"></span>
        </a>
    </div>
    <div class="col-2">
        <a  class="rounded-2 p-0 btn text-700" wire:click.prevent="vote(-1)" href=""
           data-bs-toggle="tooltip" data-bs-placement="bottom" title="DownVote">
            <span class="fas fa-angle-down" style="font-size: 18px"></span>
        </a>
    </div>
    <div class="col-2">
        <a class="rounded-2 p-0 btn text-700 " href="{{ route('communities.posts.show', [$post->community->slug ,$post->id]) }}"
           data-bs-toggle="tooltip" data-bs-placement="bottom" title="View post">
            <span class="far fa-eye" style="font-size: 18px"></span>
        </a>
    </div>
    <div class="col-6">
        <a class="rounded-2 p-0 btn text-700 fs--1" href="{{ route('communities.posts.show', [$post->community->slug ,$post->id]) }}"
           data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $sumVotes }} votes">
            <span class="ms-1">{{ $sumVotes }} votes</span>
        </a>
    </div>
</div>
