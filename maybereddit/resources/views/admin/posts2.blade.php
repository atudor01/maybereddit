<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('posts2') }}
        </h2>
    </x-slot>
    <x-slot name="slot">
       <div class="grid h-screen place-items-center">
        <div id="example"></div>
       </div>
    </x-slot>

    @push('scripts')
        <script>

        </script>
    @endpush

</x-app-layout>
