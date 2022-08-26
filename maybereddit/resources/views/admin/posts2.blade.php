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



</x-app-layout>
{{--@push('scripts')--}}
{{--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.js"></script>--}}

{{--    <script>--}}

{{--  --}}

{{--    console.log('hello');--}}
{{--        const data = [--}}
{{--            ['', 'Tesla', 'Volvo', 'Toyota', 'Ford'],--}}
{{--            ['2019', 10, 11, 12, 13],--}}
{{--            ['2020', 20, 11, 14, 13],--}}
{{--            ['2021', 30, 15, 12, 13]--}}
{{--        ];--}}
{{--        const container = document.getElementById('example');--}}

{{--        const hot = new Handsontable(container, {--}}
{{--            data: data,--}}
{{--            rowHeaders: true,--}}
{{--            colHeaders: ['Title', 'Author', 'Upvotes','Created at', 'Updated at']--}}
{{--        });--}}

{{--        function loadData() {--}}
{{--            $.ajax({--}}
{{--                url: 'ajaxLoading',--}}
{{--                type: 'get',--}}
{{--                dataType: 'json',--}}
{{--                async: true,--}}
{{--                success: function(res) {--}}
{{--                    hot.loadData(res.data);--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}

{{--        loadData();--}}
{{--    </script>--}}
{{--@endpush--}}
