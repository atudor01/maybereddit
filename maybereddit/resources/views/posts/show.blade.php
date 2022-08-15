<html>
<head>
    <title>{{$post->title}}</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
<div class="grid place-items-center">
    <div class="text-center text-3xl font-bold text-gray-800 px-8 py-8">{{$post->title}}</div>
{{$post->body}}
    <span class="inline-flex"><form method="POST" action="{{ route('posts.destroy', [$post])}}">
                        @csrf
            @method('DELETE')
                        <button type="submit" class=" px-1 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4  mb-2 dark:bg-red-600 dark:hover:bg-red-700  focus:outline-none dark:focus:ring-red-800">Delete</button>
        </form></span>
</div>
</body>

</html>
