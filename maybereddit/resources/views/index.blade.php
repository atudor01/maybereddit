<x-header></x-header>

<div class="grid  sm:grid-cols-1 md:grid-cols-2  justify-items-center">



    @if(isset ($posts))
        @foreach($posts as $post)
            <x-post-card :post='$post'></x-post-card>
        @endforeach
    @else
        No available book yet
    @endif





</div>
{{ $posts->links() }}



<x-post-card></x-post-card>
<x-footer></x-footer>
