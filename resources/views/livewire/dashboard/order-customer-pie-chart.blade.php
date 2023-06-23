<div
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

            chart = new ApexCharts($refs.order_customer_pie_chart, options);
    
            chart.render();
        }
    }"
    x-init="
        $wire.on('refresh-chart', () => {
            setupChart()
        });
    ">

    <div x-ref="order_customer_pie_chart"></div>
</div>
