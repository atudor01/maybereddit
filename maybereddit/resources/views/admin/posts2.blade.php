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



</x-app-layout>

<div id="example1" class="hot"></div>

<div class="controls">
    <button id="load" class="button button--primary button--blue">Load data</button>&nbsp;
    <button id="save" class="button button--primary button--blue">Save data</button>
    <label>
        <input type="checkbox" name="autosave" id="autosave"/>
        Autosave
    </label>
</div>

<pre id="example1console" class="console">Click "Load" to load data from server</pre>


{{--@push('scripts')--}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.js"></script>

    <script>

        //when page loads, load data from server
        window.onload = function () {
            loadData();
        };



        const container = document.querySelector('#example1');
        const exampleConsole = document.querySelector('#example1console');
        const autosave = document.querySelector('#autosave');
        const load = document.querySelector('#load');
        const save = document.querySelector('#save');

        let autosaveNotification;

        const hot = new Handsontable(container, {
            startRows: 8,
            startCols: 10,
            rowHeaders: true,
            colHeaders: true,
            height: 'auto',
            colHeaders: ['Title', 'Description', 'Comments', ],
            columns: [
                {data: 0, renderer: "html"},
                {data: 1, renderer: "html"},
                {data: 2, renderer: 'text'},

            ],
            licenseKey: 'non-commercial-and-evaluation',
            afterChange: function (change, source) {
                if (source === 'loadData') {
                    return; //don't save this change
                }

                if (!autosave.checked) {
                    return;
                }

                clearTimeout(autosaveNotification);

                ajax('/docs/12.1/scripts/json/save.json', 'GET', JSON.stringify({ data: change }), data => {
                    exampleConsole.innerText = 'Autosaved (' + change.length + ' ' + 'cell' + (change.length > 1 ? 's' : '') + ')';
                    autosaveNotification = setTimeout(() => {
                        exampleConsole.innerText ='Changes will be autosaved';
                    }, 1000);
                });
            }
        });




        // Post Title, Post Link (html), Author Name, Upvotes, Downvotes

        function loadData() {
            const array = @json($posts);

            const dataMapped = array.data.map(function(item) {
                return [
                    item.title,
                    `<a href="/posts/${item.slug}">${item.slug}</a>`,
                    item.user.name];
            }   );



            // const data = JSON.parse(res.response);
            console.log(dataMapped);
            hot.loadData(dataMapped);
            // or, use `updateData()` to replace `data` without resetting states

            exampleConsole.innerText = 'Data loaded';
        }

        Handsontable.dom.addEvent(load, 'click', () => {

          

        });
        Handsontable.dom.addEvent(save, 'click', () => {
            // save all cell's data
            ajax('/docs/12.1/scripts/json/save.json', 'GET', JSON.stringify({ data: hot.getData() }), res => {
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
            obj.send(params);

            return obj;
        }
    </script>
{{--@endpush--}}
