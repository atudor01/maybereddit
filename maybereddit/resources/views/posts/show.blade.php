<x-header></x-header>

<div class="grid place-items-center mb-auto">
    <div class="text-center text-3xl font-bold text-gray-800 px-8 py-8">{{$post->title}}</div>
    <div class="text-center text-gray-800 px-8 pb-8"> posted
        by {{$post->author->name}} {{$post->created_at->diffForHumans()}}</div>
    <div class="text-center text-gray-800 px-8 py-8">{{$post->body}}</div>
    <hr />

    <div class="max-w-lg shadow-md w-full mb-10">
        <form method="post" action="{{ route('comments.store') }}" class="w-full p-4">
            @csrf
            <label class="block mb-2">
                <div class="form-group">
                    <span class="text-gray-600">Add a comment</span>
                    {{--            <input type="text" name="comment_body" class="form-control" />--}}
                    <textarea class="form-control block w-full mt-1 rounded bg-gray-100" rows="3" name="comment_body" required ></textarea>
                    <input type="hidden" name="post_id" value="{{ $post->id }}" />
                </div>
            </label>
            @if (!Auth::guest())
            <div class="form-group">
                <input type="submit" class="btn btn-warning px-3 py-2 text-sm text-blue-100 bg-blue-600 rounded hover:bg-sky-700 cursor-pointer" value="Comment" />
            </div>
            @else

                <div class="form-group pt-3">
                    <a href="{{ route('login') }}" class="btn btn-warning px-3 py-2 text-sm text-blue-100 bg-blue-600 rounded hover:bg-sky-700 cursor-pointer">Comment</a>
                </div>

                @endif
        </form>
    </div>


    @include('partials._comment_replies', ['comments' => $post->comments, 'post_id' => $post->id])
    <hr />













    @if (!Auth::guest())
        @if(Auth::user()->hasRole('admin')|| Auth::user()->id == $post->user_id)
            <a href="{{ route('posts.edit', $post)}}"
               class="mt-9 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium
               rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none
               dark:focus:ring-blue-800">Edit</a>
        @endif

        @if(Auth::user()->hasRole('admin'))
            <span class="inline-flex">
                <form method="POST" action="{{ route('posts.destroy', [$post])}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button show_confirm text-white bg-blue-700 hover:bg-blue-800
                    focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2
                    dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Delete</button>
                </form>
            </span>
        @endif
    @endif

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">

    $('.show_confirm').click(function (event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: `Are you sure you want to delete this post?`,
            text: "If you delete this, it will be gone forever! You can't undo this. Please reconsider your decision. ",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    });

</script>
<x-footer></x-footer>
