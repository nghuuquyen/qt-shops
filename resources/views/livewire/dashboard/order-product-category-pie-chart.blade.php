<div
    class="h-[250px] flex justify-center items-center"
    x-data="{ 
        series: @entangle('series'),
        labels: @entangle('labels'),
        setupChart() {
            options = {
                series: this.series,
                chart: {
                    width: '100%',
                    type: 'pie',
                },
                labels: this.labels,
                theme: {
                    monochrome: {
                        enabled: false
                    }
                },
                plotOptions: {
                    pie: {
                        dataLabels: {
                            offset: -5
                        }
                    }
                },
                dataLabels: {
                    formatter(val, opts) {
                        const name = opts.w.globals.labels[opts.seriesIndex]
                        return [name, val.toFixed(1) + '%']
                    }
                },
                tooltip: {
                    enabled: false
                },
                legend: {
                    show: false
                },
                noData: {
                    text: '{{ __('No data to display') }}'
                }
            };

            chart = new ApexCharts($refs.order_product_category_chart, options);
    
            chart.render();
        }
    }"
    wire:init="initChart()"
    x-init="
        $wire.on('refresh-chart', () => {
            setupChart()
        });
    ">

    <div wire:loading.remove x-ref="order_product_category_chart"></div>
    
    <x-loading wire:loading.delay />
</div>
