<div
    class="min-h-[250px]"
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

    <div x-ref="order_line_chart"></div>
</div>
