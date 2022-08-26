import './bootstrap';
import Handsontable from "handsontable";
import 'handsontable/dist/handsontable.full.css';
import Alpine from 'alpinejs';
import $ from "jquery";

window.Alpine = Alpine;

Alpine.start();
createTable();

//create a function
function createTable() {
console.log('createTable');
    const data = [
        ['', 'Tesla', 'Volvo', 'Toyota', 'Ford'],
        ['2019', 10, 11, 12, 13],
        ['2020', 20, 11, 14, 13],
        ['2021', 30, 15, 12, 13]
    ];
     const container = document.getElementById('example');




    $.get('/ajaxLoading', function(data) {
        // hot.loadData(data);
        //find data type
        console.log(data);

        const hot = new Handsontable(container, {
            data: data,
            rowHeaders: true,
            colHeaders: ['ID', 'User ID', 'Slug','Title']
        });
    });







}







