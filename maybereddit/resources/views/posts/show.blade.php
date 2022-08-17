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
 <button type="submit" class="button show_confirm text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Delete</button>        </form></span>

    @endif
    @endif

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">

    $('.show_confirm').click(function(event) {
        var form =  $(this).closest("form");
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
<x-footer> </x-footer>
