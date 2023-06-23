<div
    x-data="{ 
        data: @entangle('data'),
        categories: @entangle('categories'),
        setupChart() {
            options = {
                chart: {
                    type: 'area',
                    height: 160,
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
    x-init="
        $wire.on('refresh-chart', () => {
            setupChart()
        });
    ">

    <div x-ref="order_line_chart"></div>
</div>
