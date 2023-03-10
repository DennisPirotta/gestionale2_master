<div class="row-span-2 p-6 bg-white shadow-lg border border-gray-200 rounded-lg w-full dark:border-gray-700 dark:bg-gray-800">
    <div class="flex items-center justify-center md:justify-start">
        <div class="text-2xl justify-start flex items-end">
            <span>
                {{ __('Orders Statuses') }}
            </span>
            <span class="border-l ml-2 pl-2 text-gray-400 text-lg align-bottom">
                {{ __('Lifetime') }}
            </span>
        </div>
    </div>
    <div id="order_status_chart" class="pt-4 pr-4"></div>
</div>
<script type="module">
    $(()=>{
        let orders_statuses = @json($statuses);
        let data = []
        Object.keys(orders_statuses).filter( (key) => data.push({ x:key,y:orders_statuses[key],fillColor:"#" + Math.floor(Math.random()*16777215).toString(16).padStart(6, '0').toUpperCase() }))
        console.log(Object.values(orders_statuses))
        let options = {
            series: Object.values(orders_statuses),
            labels: Object.keys(orders_statuses),
            chart: {
                height: 350,
                type: 'donut',
                toolbar: { show: false }
            },
            // tooltip: { enabled: false },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            legend: {
                position: 'bottom'
            },
            dataLabels: {
                enabled: true,
            },
            xaxis: {
                labels: {
                    rotate: 0,
                    hideOverlappingLabels: false
                },
                position: 'bottom',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                tooltip: {
                    enabled: false,
                }
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                }

            }
        };

        let chart = new ApexCharts(document.querySelector("#order_status_chart"), options)
        chart.render()
    })
</script>
