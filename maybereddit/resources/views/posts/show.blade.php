<html>
<head>
    <title>{{$post->title}}</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
<div class="grid place-items-center">
    <div class="text-center text-3xl font-bold text-gray-800 px-8 py-8">{{$post->title}}</div>
{{$post->body}}
</body>

</html>
