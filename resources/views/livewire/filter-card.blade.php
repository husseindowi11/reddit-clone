<div>
    <form>
        <div class="row g-0 justify-content-between mt-3 pb-1">
            <div class="col">
                <a href="{{ route('communities.show', $community) }}"
                   class="btn btn-light btn-sm rounded-pill shadow-none d-inline-flex
                           align-items-center fs--1 mb-2 me-1 @if(request('sort') == '') active @endif">
                    <img class="cursor-pointer" src="{{asset('/assets/img/illustrations/navbar-vertical.png')}}"
                         width="22" alt="">
                    <span class="ms-2">Newest Posts</span>
                </a>
                <a href="{{ route('communities.show', $community) }}?sort=popular"
                   class="btn btn-light btn-sm rounded-pill shadow-none d-inline-flex
                           align-items-center fs--1 mb-2 me-1 @if(request('sort') == 'popular') active @endif">
                    <img class="cursor-pointer" src="{{asset('/assets/img/illustrations/rocket.png')}}" width="22"
                         alt="">
                    <span class="ms-2  ">Popular Posts</span>
                </a>
            </div>

        </div>
    </form>
</div>
