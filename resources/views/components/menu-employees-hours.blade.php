<div class="row-span-2 p-6 bg-white shadow-lg border border-gray-200 rounded-lg w-full dark:border-gray-700 dark:bg-gray-800">
    <div class="flex items-center justify-center md:justify-start">
        <div class="text-2xl justify-start flex items-end dark:text-white">
            <span>
                {{ __('Employees Hours') }}
            </span>
            <span class="border-l ml-2 pl-2 text-gray-400 text-lg align-bottom">
                {{ __('This Week') }}
            </span>
        </div>
    </div>
    <div id="employees_hours_chart" class="pr-4"></div>
</div>
<script type="module">
    $(()=>{
        let hours = @json($hours->sort()->reverse());
        const sortable = Object.fromEntries(
            Object.entries(hours).sort(([,a],[,b]) => a-b)
        );

        console.log(sortable);
        let data = []
        Object.keys(hours).filter( (key) => hours[key] > 0 ? data.push({ x:key,y:hours[key],fillColor:"#" + Math.floor(Math.random()*16777215).toString(16).padStart(6, '0').toUpperCase() }) : '')
        let options = {
            theme: {
                mode: window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
            },
            series: [{
                data: data
            }],
            chart: {
                height: 350,
                type: 'bar',
                toolbar: { show: false }
            },
            tooltip: { enabled: false },
            plotOptions: {
                bar: {
                    borderRadius: 5,
                    // barHeight: '100%',
                    distributed: true,
                    horizontal: true,
                    dataLabels: {
                        position: 'top'
                    },
                }
            },

            dataLabels: {
                enabled: true,
                offsetX: -10,
                formatter: function (val) {
                    return val + "h";
                }
            },
            xaxis: {
                labels: {
                    rotate: -90,
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
            legend: { show: false }
            // yaxis: {
            //     axisBorder: {
            //         show: false
            //     },
            //     axisTicks: {
            //         show: false,
            //     },
            //     labels: {
            //         show: false,
            //     }
            // }
        };
        let chart = new ApexCharts(document.querySelector("#employees_hours_chart"), options)
        chart.render()
    })
</script>
