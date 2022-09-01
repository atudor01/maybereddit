<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('posts2') }}
        </h2>
    </x-slot>
    {{--    <x-slot name="slot">--}}
    {{--       <div class="grid h-screen place-items-center">--}}
    {{--        <div id="example"></div>--}}



    {{--       </div>--}}
    {{--    </x-slot>--}}



</x-guest-layout>
<div class="controls">
    <button id="load" class="button button--primary button--blue">Load data</button>&nbsp;
    <button id="save" class="button button--primary button--blue">Save data</button>
    <label>
        <input type="checkbox" name="autosave" id="autosave" />
        Autosave
    </label>
</div>

<pre id="example1console" class="console">Click "Load" to load data from server</pre>
<div id="example1" class="hot"></div>




{{--@push('scripts')--}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.js">
  </script>
<script
    src="https://code.jquery.com/jquery-3.6.1.js"
    integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>

<script>

// window.onload = function(){
//     loadData();
// }

    {{--const container = document.getElementById('example1');--}}

    const data = [
        @foreach($posts as $post)
        ['{{ $post->id }}', '{{ $post->title }}', '{{ $post->user->name }}', {{ $post->upvotersCount() }}, {{ $post->downvotersCount() }}, '{{ $post->created_at }}'],
        @endforeach
    ];
    // const data = JSON.parse(JSON.stringify(lemon));

    const container = document.querySelector('#example1');
    const exampleConsole = document.querySelector('#example1console');
    const autosave = document.querySelector('#autosave');
    const load = document.querySelector('#load');
    const save = document.querySelector('#save');

    let autosaveNotification;

    const hot = new Handsontable(container, {
        startRows: 8,
        startCols: 6,
        colHeaders: ['ID', 'Title', 'User', 'Upvotes', 'Downvotes', 'Created At'],
        height: 'auto',
        hiddenColumns: {
            // specify columns hidden by default
            columns: [0]
        },
        licenseKey: 'non-commercial-and-evaluation',
        afterChange: function (change, source) {

            if (source === 'loadData') {
                return; //don't save this change
            }

            if (!autosave.checked) {
                return;
            }

            clearTimeout(autosaveNotification);

            console.log(change);
            $.ajax({
                type: "POST",
                url: "{{route('admin.something')}}",
                data: {
                    change: change,


                    data: hot.getData()[change[0][0]]
                },
                // datatype: 'json',

            });
            {{--ajax("{{route('admin.something')}}", 'POST', change , data => {--}}
            {{--    exampleConsole.innerText = 'Autosaved (' + change.length + ' ' + 'cell' + (change.length > 1 ? 's' : '') + ')';--}}
            {{--    autosaveNotification = setTimeout(() => {--}}
            {{--        exampleConsole.innerText ='Changes will be autosaved';--}}
            {{--    }, 1000);--}}
            {{--});--}}

        }
    });

    Handsontable.dom.addEvent(load, 'click', () => {
        // ajax('/docs/12.1/scripts/json/load.json', 'GET', '', res => {
        //     const data = JSON.parse(res.response);
        //
        //     hot.loadData(data.data);
        //     // or, use `updateData()` to replace `data` without resetting states
        //
        //     exampleConsole.innerText = 'Data loaded';
        // });
        const data = [
                @foreach($posts as $post)
            ['{{ $post->id }}', '{{ $post->title }}', '{{ $post->user->name }}', {{ $post->upvotersCount() }}, {{ $post->downvotersCount() }}, '{{ $post->created_at }}'],
            @endforeach
        ];
        hot.loadData(data);
    });
    Handsontable.dom.addEvent(save, 'click', () => {
        // save all cell's data
        console.log(hot.getData());
        ajax("{{route('admin.something', $post)}}", 'POST', JSON.stringify({ _token: '{{csrf_token()}}', data: hot.getData() }), res => {
            const response = JSON.parse(res.response);

            if (response.result === 'ok') {
                exampleConsole.innerText = 'Data saved';
            } else {
                exampleConsole.innerText = 'Save error';
            }
        });
    });

    Handsontable.dom.addEvent(autosave, 'click', () => {
        if (autosave.checked) {
            exampleConsole.innerText = 'Changes will be autosaved';
        } else {
            exampleConsole.innerText ='Changes will not be autosaved';
        }
    });

    function ajax(url, method, params, callback) {
        let obj;

        try {
            obj = new XMLHttpRequest();
        } catch (e) {
            try {
                obj = new ActiveXObject('Msxml2.XMLHTTP');
            } catch (e) {
                try {
                    obj = new ActiveXObject('Microsoft.XMLHTTP');
                } catch (e) {
                    alert('Your browser does not support Ajax.');
                    return false;
                }
            }
        }
        obj.onreadystatechange = () => {
            if (obj.readyState == 4) {
                callback(obj);
            }
        };
        obj.open(method, url, true);
        obj.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        obj.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        obj.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
        obj.send(params);

        return obj;
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
{{--@endpush--}}
