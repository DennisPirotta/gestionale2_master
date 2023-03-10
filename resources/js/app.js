import './bootstrap';
import "flowbite"
import "flowbite-datepicker"
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import jQuery from 'jquery';
import ApexCharts from 'apexcharts'
import moment from 'moment/min/moment-with-locales'

window.$ = jQuery;
window.Alpine = Alpine;
window.ApexCharts = ApexCharts
window.moment = moment

Alpine.plugin(focus);
Alpine.start();
