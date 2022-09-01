<x-guest-layout>

    <x-slot name="slot">
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
    </x-slot>

</x-guest-layout>
