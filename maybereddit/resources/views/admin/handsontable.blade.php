<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('posts2') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        {{ $posts->links() }}
        <div id="example1" class="hot">

        </div>


        <div class="controls">
            <label>
                <input type="hidden" type="checkbox" name="autosave" id="autosave" checked/>
                Autosave Activated
            </label>
        </div>

        <div hidden>
            @foreach($posts as $post)
                {{$post->upvotes = $post->upvotersCount()}}
                {{$post->downvotes = $post->downvotersCount()}}
            @endforeach
        </div>
    </x-slot>


    @push('scripts')
        <script
            src="https://code.jquery.com/jquery-3.6.1.js"
            integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
            crossorigin="anonymous"></script>

        <script type="text/javascript"
                src="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.js"></script>

        <script>

            window.onload = function () {
                loadData();
            };

            const container = document.querySelector('#example1');
            const exampleConsole = document.querySelector('#example1console');
            const autosave = document.querySelector('#autosave');
            const load = document.querySelector('#load');
            const save = document.querySelector('#save');
            const array = @json($posts);

            let autosaveNotification;

            const hot = new Handsontable(container, {
                startRows: 8,
                startCols: 10,
                rowHeaders: true,
                height: 'auto',
                colHeaders: ['Post id', 'Title', 'link', 'author_id', 'author', 'upvotes', 'downvotes'],
                columns: [
                    {data: 0, renderer: "html"},
                    {data: 1, renderer: "html"},
                    {data: 2, renderer: 'html', editor: false},
                    {data: 3, renderer: 'text'},
                    {data: 4, renderer: 'text'},
                    {data: 5, renderer: 'text', editor: false},
                    {data: 6, renderer: 'text', editor: false},

                ],
                hiddenColumns: {
                    columns: [0, 3],
                    // show UI indicators to mark hidden columns
                    indicators: false
                },

                licenseKey: 'non-commercial-and-evaluation',
                afterChange: function (change, source) {
                    // console.log(change);
                    if (source === 'loadData') {
                        return; //don't save this change
                    }

                    if (!autosave.checked) {
                        return;
                    }

                    clearTimeout(autosaveNotification);

                    const data_to_post = {
                        changes: change
                    };

                    //find changed post id
                    const changedRow = hot.getDataAtRow(change[0][0]);

                    $.ajax({
                        type: "POST",
                        url: "{{route('posts.update-via-ajax')}}",
                        data: {data: changedRow, change, _token: '{{csrf_token()}}'},
                        success: function (data) {
                            console.log(data);

                        },
                        error: function (data, textStatus, errorThrown) {
                            console.log(data);

                        },
                    });

                }
            });

            function loadData() {
                const array = @json($posts);
                console.log(array);
                const dataMapped = array.data.map(function (item) {

                    return [
                        item.id,
                        item.title,
                        `<a href="/posts/${item.slug}">View Post</a>`,
                        item.user.id,
                        item.user.name,
                        item.upvotes,
                        item.downvotes,
                    ];
                });
                hot.loadData(dataMapped);
                exampleConsole.innerText = 'Data loaded';
            }

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
                obj.setRequestHeader('X-CSRF-TOKEN', '{{csrf_token()}}');
                obj.send(params);

                return obj;
            }
        </script>
    @endpush

</x-app-layout>

