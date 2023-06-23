<div
    id="{{ $uuid }}"
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
                legend: {
                    show: false
                }
            };
            
            console.log('Render ' + '{{ $uuid }}');

            chart = new ApexCharts($refs.order_product_category_chart, options);
    
            chart.render();
        }
    }"
    x-on:refresh-chart-category.window="setupChart()">

    <div x-ref="order_product_category_chart"></div>
</div>
