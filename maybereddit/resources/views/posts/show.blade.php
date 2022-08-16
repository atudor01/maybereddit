<x-header> </x-header>

<div class="grid place-items-center">
    <div class="text-center text-3xl font-bold text-gray-800 px-8 py-8">{{$post->title}}</div>
{{$post->body}}
    @if (!Auth::guest())
    @if(Auth::user()->hasRole('admin')|| Auth::user()->id == $post->user_id)
        <a href="{{ route('posts.edit', $post)}}" class="mt-9 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;
@endif
        @if(Auth::user()->hasRole('admin'))
        <span class="inline-flex"><form method="POST" action="{{ route('posts.destroy', [$post])}}">
                        @csrf
            @method('DELETE')
 <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Delete</button>        </form></span>

    @endif
    @endif

</div>
<x-footer> </x-footer>
