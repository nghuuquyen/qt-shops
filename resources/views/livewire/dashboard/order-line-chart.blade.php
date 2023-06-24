<div
    class="min-h-[250px] grid grid-cols-1 items-center"
    x-data="{ 
        data: @entangle('data'),
        categories: @entangle('categories'),
        setupChart() {
            options = {
                chart: {
                    type: 'area',
                    height: '100%',
                },
                grid: {
                    show: false,
                },
                markers: {
                    size: 5,
                },
                series: [{
                    name: 'sales',
                    data: this.data,
                }],
                xaxis: {
                    categories: this.categories
                },
                noData: {
                    text: '{{ __('No data to display') }}'
                }
            }

            chart = new ApexCharts($refs.order_line_chart, options);

            chart.render();
        }
    }"
    wire:init="initChart()"
    x-init="
        $wire.on('refresh-chart', () => {
            setupChart()
        });
    ">

    <div wire:loading.remove x-ref="order_line_chart"></div>

    <div class="w-full text-center">
        <x-loading wire:loading.delay />
    </div>
</div>
