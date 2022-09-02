<section class="relative flex items-center justify-center antialiased bg-white min-w-screen min-w-[20rem]">
    <div class="container px-0 mx-auto sm:px-5">

        <div class="  ">
            <div class="flex flex-row">
                @foreach($comments as $comment)
                    <div class="display-comment">
                        <div class="flex-col mt-1">
                            <div
                                class="flex items-center flex-1 px-4 font-bold leading-tight">{{ $comment->user->name }}
                                <span
                                    class="ml-2 text-xs font-normal text-gray-500">{{$comment->created_at->diffForHumans()}}
                                </span>
                            </div>
                            <div
                                class="flex-1 px-2 ml-2 text-sm font-medium leading-loose text-gray-600">{{ $comment->body }}
                            </div>
                            <a href="" id="reply"></a>
                            <form method="post" action="{{ route('reply.store') }}">
                                @csrf
                                <div class="form-group">
                                    <textarea class="form-control block mt-1 rounded bg-gray-100" rows="1"
                                              name="comment_body" required>
                                    </textarea>
                                    <input type="hidden" name="post_id" value="{{ $post_id }}"/>
                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}"/>
                                </div>
                                @if (!Auth::guest())
                                    <div class="form-group">
                                        <button type="submit"
                                                class="inline-flex items-center px-1 pt-2 ml-1 flex-column">
                                            Reply
                                        </button>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <a href="{{ route('login') }}"
                                           class="inline-flex items-center px-1 pt-2 ml-1 flex-column">
                                            Reply
                                        </a>
                                @endif
                            </form>
                            @include('partials._comment_replies', ['comments' => $comment->replies])
                        </div>
                        @endforeach
                    </div>
            </div>
        </div>
</section>
