<html>
<head>
    <title>Edit Post</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
<div class="grid place-items-center">
    <div class="text-center text-3xl font-bold text-gray-800 px-8 py-8">Edit Post</div>
    <div class="w-full max-w-sm block p-6 rounded-lg shadow-lg bg-white">

        <form action="{{route('posts.update', $post)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group mb-6">
                <input type="text" value="{{ $post->title }}" class="form-control block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="title"
                       placeholder="Title" name="title">
            </div>
            <div class="form-group mb-6">
      <textarea
          class="
        form-control
        block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
      "
          id="body"
          name="body"
          rows="3"
      >{{ $post->body }}</textarea>
            </div>

            <button type="submit" class="
      w-full
      px-6
      py-2.5
      bg-blue-600
      text-white
      font-medium
      text-xs
      leading-tight
      uppercase
      rounded
      shadow-md
      hover:bg-blue-700 hover:shadow-lg
      focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
      active:bg-blue-800 active:shadow-lg
      transition
      duration-150
      ease-in-out">Submit</button>
        </form>
    </div>
</div>
</body>

</html>
