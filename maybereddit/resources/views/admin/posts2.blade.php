<x-app-layout>
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

    {{ $posts->links() }}
    <div id="example1" class="hot"></div>




    <div class="controls">
        {{--    <button id="load" class="button button--primary button--blue">Load data</button>&nbsp;--}}
        {{--        <button id="save" class="button button--primary button--blue">Save data</button>--}}
        <label>
            <input type="hidden" type="checkbox" name="autosave" id="autosave" checked/>
            Autosave Activated
        </label>
    </div>

    {{--    <pre id="example1console" class="console">Click "Load" to load data from server</pre>--}}


    @push('scripts')
        <script
            src="https://code.jquery.com/jquery-3.6.1.js"
            integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
            crossorigin="anonymous"></script>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.js"></script>

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
                colHeaders: true,
                height: 'auto',
                colHeaders: ['Post id' , 'Title', 'link', 'author_id','author' ],
                columns: [
                    {data: 0, renderer: "html"},
                    {data: 1, renderer: "html"},
                    {data: 2, renderer: 'html',editor: false},
                    {data: 3, renderer: 'text'},
                    {data: 4, renderer: 'text'},

                ],
                hiddenColumns: {
                    columns: [0,3],
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
                    ;
                    $.ajax({
                        type: "POST",
                        url: "{{route('posts.update-via-ajax')}}",
                        data: { data: changedRow, change , _token: '{{csrf_token()}}' },
                        success: function (data) {
                            console.log(data);
                        },
                        error: function (data, textStatus, errorThrown) {
                            console.log(data);

                        },
                    });

                    {{--$.ajax("{{route('posts.update-via-ajax')}}", 'POST', JSON.stringify(data_to_post),data => {--}}
                    {{--    console.log(typeof  data);--}}
                    {{--    // console.log(data.response);--}}
                    {{--    console.log(JSON.parse(data.response));--}}

                    {{--    // analize the--}}

                    {{--    // exampleConsole.innerText = 'Autosaved (' + change.length + ' ' + 'cell' + (change.length > 1 ? 's' : '') + ')';--}}
                    {{--    // autosaveNotification = setTimeout(() => {--}}
                    {{--    //     exampleConsole.innerText ='Changes will be autosaved';--}}
                    {{--    // }, 1000);--}}
                    {{--});--}}



                }
            });

            function loadData() {
                const array = @json($posts);
                const dataMapped = array.data.map(function(item) {
                    return [
                        item.id,
                        item.title,
                        `<a href="/posts/${item.slug}">${item.slug}</a>`,
                        item.user.id,
                        item.user.name,
                    ];
                }   );



                // const data = JSON.parse(res.response);

                hot.loadData(dataMapped);
                // or, use `updateData()` to replace `data` without resetting states

                exampleConsole.innerText = 'Data loaded';
            }

            Handsontable.dom.addEvent(load, 'click', () => {

            });

            Handsontable.dom.addEvent(save, 'click', () => {
                // save all cell's data
                ajax('saveChanges', 'GET', JSON.stringify({ data: hot.getData() }), res => {
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
                obj.setRequestHeader('X-CSRF-TOKEN', '{{csrf_token()}}');
                obj.send(params);

                return obj;
            }
        </script>
    @endpush

</x-app-layout>

