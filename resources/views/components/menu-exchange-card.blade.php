<div class="md:col-span-2 p-6 bg-white shadow border border-gray-200 rounded-lg w-full dark:border-gray-700 dark:bg-gray-800">
    <div class="flex items-center justify-center md:justify-start">
        <div class="text-2xl justify-start flex items-end dark:text-white">
            <span>
                {{ __('Swiss Franc Exchange') }}
            </span>
            <span class="border-l ml-2 pl-2 text-gray-400 text-lg align-bottom hidden md:block">
                {{ __('Last Week') }}
            </span>
        </div>
        <div class="ml-auto md:text-2xl justify-start flex items-end">
            <span class="text-gray-400 align-bottom">
                {{ __('Last Update') }}
            </span>
            <span class="border-l ml-2 pl-2 dark:text-white">
                {{ $exchanges->last()->value ?? '-' }}
            </span>
        </div>
    </div>
    <div id="exchanges_chart" class="pr-4"></div>
</div>
<script type="module">
    $(()=>{
        let exchanges = @json($exchanges);
        let options = {
            theme: {
                mode: window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
            },
            chart: {
                height: 300,
                zoom: { enabled: false },
                toolbar: { show: false },
                type: "area",
                background: 'transparent'
            },
            dataLabels: {
                enabled: false
            },
            series: [
                {
                    name: "{{ __('Euro → Swiss Franc') }}",
                    data: exchanges.map( ({value,datetime}) => ({ y:value,x:moment(datetime).locale('it').format('dddd DD MMMM YYYY HH:mm') }) )
                }
            ],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9
                }
            },
            xaxis: {
                axisTicks: { show: false },
                tooltip: { enabled: false },
                labels: { show: false }
            }
        };
        let chart = new ApexCharts(document.querySelector("#exchanges_chart"), options);
        chart.render();
    })
</script>
