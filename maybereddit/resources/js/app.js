import './bootstrap';
import Handsontable from "handsontable";
import 'handsontable/dist/handsontable.full.css';
import Alpine from 'alpinejs';
import $ from "jquery";

window.Alpine = Alpine;

Alpine.start();
// createTable();
// createFuctionalTable();

//create a function
// function createTable() {
// console.log('createTable');
//     const data = [
//         ['', 'Tesla', 'Volvo', 'Toyota', 'Ford'],
//         ['2019', 10, 11, 12, 13],
//         ['2020', 20, 11, 14, 13],
//         ['2021', 30, 15, 12, 13]
//     ];
//      const container = document.getElementById('example');
//
//
//
//
//     $.get('/ajaxLoading', function(data) {
//         // hot.loadData(data);
//         //find data type
//         console.log(data);
//
//        //map trough the data retrive only the atributes that id, user_id, slug, title
//          const dataMapped = data.map(function(item) {
//             return [item.title, item.created_at, item.user.name, item.user.email];
//         }   );
//
//
//         const hot = new Handsontable(container, {
//             data: dataMapped,
//             rowHeaders: true,
//             colHeaders: ['Title', 'Created at', 'User name','user mail']
//         });
//     });
//
//
//
//
//
//
//
// }
//
// function createFuctionalTable(){
//     const container = document.querySelector('#example1');
//     const exampleConsole = document.querySelector('#example1console');
//     const autosave = document.querySelector('#autosave');
//     const load = document.querySelector('#load');
//     const save = document.querySelector('#save');
//
//     let autosaveNotification;
//
//     const hot = new Handsontable(container, {
//         startRows: 8,
//         startCols: 6,
//         rowHeaders: true,
//         colHeaders: true,
//         height: 'auto',
//         licenseKey: 'non-commercial-and-evaluation',
//         afterChange: function (change, source) {
//             if (source === 'loadData') {
//                 return; //don't save this change
//             }
//
//             if (!autosave.checked) {
//                 return;
//             }
//
//             clearTimeout(autosaveNotification);
//
//             ajax('/docs/12.1/scripts/json/save.json', 'GET', JSON.stringify({ data: change }), data => {
//                 exampleConsole.innerText = 'Autosaved (' + change.length + ' ' + 'cell' + (change.length > 1 ? 's' : '') + ')';
//                 autosaveNotification = setTimeout(() => {
//                     exampleConsole.innerText ='Changes will be autosaved';
//                 }, 1000);
//             });
//         }
//     });
//
//     Handsontable.dom.addEvent(load, 'click', () => {
//         ajax('ajaxLoading', 'GET', '', res => {
//             console.log(res.response);
//             const data = JSON.parse(res.response);
//
//             hot.loadData(data.data);
//             // or, use `updateData()` to replace `data` without resetting states
//
//             exampleConsole.innerText = 'Data loaded';
//         });
//     });
//     Handsontable.dom.addEvent(save, 'click', () => {
//         // save all cell's data
//         ajax('/docs/12.1/scripts/json/save.json', 'GET', JSON.stringify({ data: hot.getData() }), res => {
//             const response = JSON.parse(res.response);
//
//             if (response.result === 'ok') {
//                 exampleConsole.innerText = 'Data saved';
//             } else {
//                 exampleConsole.innerText = 'Save error';
//             }
//         });
//     });
//
//     Handsontable.dom.addEvent(autosave, 'click', () => {
//         if (autosave.checked) {
//             exampleConsole.innerText = 'Changes will be autosaved';
//         } else {
//             exampleConsole.innerText ='Changes will not be autosaved';
//         }
//     });
//
//     function ajax(url, method, params, callback) {
//         let obj;
//
//         try {
//             obj = new XMLHttpRequest();
//         } catch (e) {
//             try {
//                 obj = new ActiveXObject('Msxml2.XMLHTTP');
//             } catch (e) {
//                 try {
//                     obj = new ActiveXObject('Microsoft.XMLHTTP');
//                 } catch (e) {
//                     alert('Your browser does not support Ajax.');
//                     return false;
//                 }
//             }
//         }
//         obj.onreadystatechange = () => {
//             if (obj.readyState == 4) {
//                 callback(obj);
//             }
//         };
//         obj.open(method, url, true);
//         obj.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
//         obj.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
//         obj.send(params);
//
//         return obj;
//     }
// }
const data = [
    ['', 'Tesla', 'Volvo', 'Toyota', 'Ford'],
    ['2019', 10, 11, 12, 13],
    ['2020', 20, 11, 14, 13],
    ['2021', 30, 15, 12, 13]
];

const container = document.getElementById('lemon');
const hot = new Handsontable(container, {
    data: data,
    rowHeaders: true,
    colHeaders: true,
    height: 'auto',
    licenseKey: 'non-commercial-and-evaluation' // for non-commercial use only
});


















