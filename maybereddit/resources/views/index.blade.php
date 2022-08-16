<x-header></x-header>

<div class="w-full flex flex-wrap justify-center ">



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
