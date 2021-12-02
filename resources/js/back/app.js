/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.moment = require('moment');
window.datepicker = require('bootstrap-datepicker');
// require('bootstrap-maxlength/bootstrap-maxlength.min');
require('metismenu/dist/metisMenu.min');

require('simplebar/dist/simplebar.min');
require('node-waves/dist/waves.min');
window.ApexCharts = require('apexcharts/dist/apexcharts.min');
require('parsleyjs/dist/parsley.min');
window.Swal = require('sweetalert2');
require('jszip/dist/jszip.min');
require('pdfmake/build/pdfmake.min');
require('pdfmake/build/vfs_fonts');
require('datatables.net');
require('datatables.net-bs4');
require('datatables.net-buttons/js/dataTables.buttons.min');
require('datatables.net-buttons-bs4/js/buttons.bootstrap4.min');

require('datatables.net-buttons/js/buttons.html5.min');
require('datatables.net-buttons/js/buttons.print.min');
require('datatables.net-buttons/js/buttons.flash.min');
require('datatables.net-buttons/js/buttons.colVis.min');

require('tinymce/tinymce.min');
require('tinymce/themes/silver/theme');

require('magnific-popup/dist/jquery.magnific-popup.min');
require('dropzone/dist/min/dropzone.min');


window.Switchery = require('switchery/switchery');

import slick from 'slick-slider';
// import typeahead from 'corejs-typeahead';
require('./custom.js');

jQuery.successResponse = function successResponse(response){
    $('audio#suc-sound').get(0).play();
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    Toast.fire({
        icon: 'success',
        title: response.message
    })
};

jQuery.errorResponse = function errorResponse(response){
    $('audio#warn-sound').get(0).play();
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    Toast.fire({
        icon: 'error',
        title: response.message
    })
};
// require('./delete');
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });
