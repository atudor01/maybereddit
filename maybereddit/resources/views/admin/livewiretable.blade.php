<x-app-layout>

    <x-slot name="header">
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>HTML 5 Boilerplate</title>
            <script src="https://cdn.tailwindcss.com"></script>
            <script defer src="https://unpkg.com/alpinejs@3.10.3/dist/cdn.min.js"></script>
        </head>
        <body>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <livewire:post-table theme="tailwind"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-slot>

</x-app-layout>


</body>
</html>










