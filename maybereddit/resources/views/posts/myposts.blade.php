<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Posts') }}
        </h2>
    </x-slot>
</x-app-layout>

<div class="container">
    <div class="container flex flex-wrap  ">
        @if(isset ($posts))
            @foreach($posts as $post)
                <x-post-card :post='$post'></x-post-card>
            @endforeach
        @else
            No available book yet
        @endif
    </div>
</div>

{{ $posts->links() }}
